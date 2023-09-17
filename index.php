<?php
include_once('header.php');

// ### Read products from database
$readSql = "SELECT * FROM products ORDER BY name";
$result = mysqli_query($conn, $readSql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Count GOOD and WARNING products
$goodSql = "SELECT COUNT(*) AS goodCount FROM products WHERE quantity >= min_quantity AND quantity >= quantity_per_set";
$goodResult = mysqli_query($conn, $goodSql);
$goodResult = mysqli_query($conn, $goodSql);
$goodRow = mysqli_fetch_assoc($goodResult);
$goodCount = $goodRow['goodCount'];

$warningSql = "SELECT COUNT(*) AS warningCount FROM products WHERE quantity < min_quantity OR quantity < quantity_per_set";
$warningResult = mysqli_query($conn, $warningSql);
$warningResult = mysqli_query($conn, $warningSql);
$warningRow = mysqli_fetch_assoc($warningResult);
$warningCount = $warningRow['warningCount'];

// Count products with remarks
$remarkSql = "SELECT COUNT(*) AS count FROM products WHERE remark IS NOT NULL AND remark <> ''";
$remarkResult = mysqli_query($conn, $remarkSql);
$remarkRow = mysqli_fetch_assoc($remarkResult);
$remarkCount = $remarkRow['count'];


// ### Function to DELETE PRODUCT 
if ($_SESSION['role'] === 'admin' && isset($_GET['delete'])) {

    $productId = $_GET['delete'];
    $deleteSql = "DELETE FROM products WHERE id = $productId";

    // get the product detail of deleted product to store it in action history
    $p = getProductById($conn, $productId);
    $name = $p['name'];
    $drawingId = $p['drawing_id'];
    $partId = $p['part_id'];
    $type = $p['type'];
    $package = $p['package'];
    $type1 = $p['type1'];
    $type2 = $p['type2'];
    $type3 = $p['type3'];
    $cost = $p['cost'];
    $quantity = $p['quantity'];
    $location = $p['location'];
    $minQuantity = $p['min_quantity'];
    $quantityPerSet = $p['quantity_per_set'];
    $remark = $p['remark'];

    if (mysqli_query($conn, $deleteSql)) {
        // add to action history
        $actionDescription = "Deleted ($name, $drawingId, $partId, $type, $package, $type1, $type2, $type3, $cost, $location, $quantity, $minQuantity, $quantityPerSet, $remark)";
        createHistory($conn, "DELETE", $actionDescription);
        echo '<script>window.history.back();</script>';
        exit;
    } else {
        $deleteError = "Error deleting product: " . mysqli_error($conn);
    }
}

?>

<!-- Dashboard -->
<div class="p-4">
    <div class="row">
        <div class="col-md-4">
            <a href="status.php" class="text-decoration-none">
                <div class="card alert alert-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">GOOD</h5>
                        <p class="card-text"><?php echo $goodCount; ?> products</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="status.php" class="text-decoration-none">
                <div class="card alert alert-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">WARNING</h5>
                        <p class="card-text"><?php echo $warningCount; ?> products</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="remark.php" class="text-decoration-none">
                <div class="card alert alert-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Remarks</h5>
                        <p class="card-text"><?php echo $remarkCount; ?> products</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>



<!-- Main Product Table -->
<div class="p-4 ">
    <div class="d-flex my-2">
        <h2>Product Table</h2>
        <button class="btn btn-primary ms-auto" id="export-product-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg>
            Export to CSV
        </button>
    </div>

    <!-- select filter -->
    <div class="d-flex my-4">
        
        <select id="selectType" class="form-select">
            <option value="">All Type</option>
        </select>

        <select id="selectPackage" class="form-select">
            <option value="">All Packages</option>
        </select>

        <select id="selectType1" class="form-select">
            <option value="">All Type1</option>
        </select>

        <select id="selectType2" class="form-select">
            <option value="">All Type2</option>
        </select>

        <select id="selectType3" class="form-select">
            <option value="">All Type3</option>
        </select>

    </div>

    <table id="product-table" class="table table-bordered table-striped w-100">
        <thead class="table-primary">
            <tr>
                <th>Name</th>
                <th>Drawing ID</th>
                <th>Part ID</th>
                <th>Type <input type="text" id="searchType" class="form-control" placeholder="search" onclick="stopPropagation(event)"> </th>
                <th>Package<input type="text" id="searchPackage" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type1<input type="text" id="searchType1" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type2<input type="text" id="searchType2" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type3<input type="text" id="searchType3" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Cost</th>
                <th>Location</th>
                <th>Quantity</th>
                <th>Min Quantity</th>
                <th>Quantity Per Set</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['drawing_id']; ?></td>
                    <td><?php echo $product['part_id']; ?></td>
                    <td><?php echo $product['type']; ?></td>
                    <td><?php echo $product['package']; ?></td>
                    <td><?php echo $product['type1']; ?></td>
                    <td><?php echo $product['type2']; ?></td>
                    <td><?php echo $product['type3']; ?></td>
                    <td><?php echo $product['cost']; ?></td>
                    <td><?php echo $product['location']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['min_quantity']; ?></td>
                    <td><?php echo $product['quantity_per_set']; ?></td>
                    <td><?php echo $product['remark']; ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="update-product.php?id=<?php echo $product["id"]; ?>" class="btn btn-primary btn-sm">Update</a>

                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <a href="index.php?delete=<?php echo $product['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
</div>







<script>

// initiate product datatable
var productTable;

function resetDropdowns() {
    document.querySelector("#selectType").selectedIndex = 0;
    document.querySelector("#selectPackage").selectedIndex = 0;
    document.querySelector("#selectType1").selectedIndex = 0;
    document.querySelector("#selectType2").selectedIndex = 0;
    document.querySelector("#selectType3").selectedIndex = 0;
}

window.onload = function(){ 
    resetDropdowns()
}

$(document).ready(function() {
    productTable = $('#product-table').DataTable({
        columnDefs: [
            { width: '20%', targets: 0 }, // Adjust the width of the first column
        ]
    });

    var uniqueType, uniquePackage, uniqueType1, uniqueType2, uniqueType3
    var initialUniqueType, initialUniquePackage, initialUniqueType1, initialUniqueType2, initialUniqueType3

    // reset dropdown to default
    resetDropdowns();
    getAllUniqueValues()

    function getAllUniqueValues(){
        uniqueType = getUniqueValues(3)
        uniquePackage = getUniqueValues(4)
        uniqueType1 = getUniqueValues(5)
        uniqueType2 = getUniqueValues(6)
        uniqueType3 = getUniqueValues(7)

    }

    logValues()
    updateAllDropdown()

    function logValues(){
        console.log(uniqueType)
        console.log(uniquePackage)
        console.log(uniqueType1)
        console.log(uniqueType2)
        console.log(uniqueType3)
    }

    function updateAllDropdown(){
        updateDropdownValue('#selectType', uniqueType)
        updateDropdownValue('#selectPackage', uniquePackage)
        updateDropdownValue('#selectType1', uniqueType1)
        updateDropdownValue('#selectType2', uniqueType2)
        updateDropdownValue('#selectType3', uniqueType3)
    }


    $("#selectType").on('change', function() {
        var selectedValue = $(this).val();
        updateTableByFilter(selectedValue, 3);

        getAllUniqueValues()
        logValues()
        updateDropdownValue('#selectPackage', uniquePackage)
        updateDropdownValue('#selectType1', uniqueType1)
        updateDropdownValue('#selectType2', uniqueType2)
        updateDropdownValue('#selectType3', uniqueType3)
    });

    $("#selectPackage").on('change', function() {
        var selectedValue = $(this).val();
        updateTableByFilter(selectedValue, 4);

        getAllUniqueValues()
        logValues()
        updateDropdownValue('#selectType1', uniqueType1)
        updateDropdownValue('#selectType2', uniqueType2)
        updateDropdownValue('#selectType3', uniqueType3)
    });

    $("#selectType1").on('change', function() {
        var selectedValue = $(this).val();
        updateTableByFilter(selectedValue, 5);

        getAllUniqueValues()
        logValues()
        updateDropdownValue('#selectType2', uniqueType2)
        updateDropdownValue('#selectType3', uniqueType3)
    });
    $("#selectType2").on('change', function() {
        var selectedValue = $(this).val();
        updateTableByFilter(selectedValue, 6);

        getAllUniqueValues()
        logValues()
        updateDropdownValue('#selectType3', uniqueType3)
    });

    $("#selectType3").on('change', function() {
        var selectedValue = $(this).val();
        updateTableByFilter(selectedValue, 7);

        getAllUniqueValues()
        logValues()
    });

    var filteredData = productTable.column(columnIndex, { search: 'applied' }).data().toArray();

    // Function to update the table based on the selected dropdown value
    function updateTableByFilter(selectedValue, columnNumber) {
        productTable.column(columnNumber).search(selectedValue).draw();
        
    }

    function getUniqueValues(columnNumber){
        return productTable.column(columnNumber, { search: 'applied' }).data().unique().toArray();
        // return productTable.column(columnNumber).data().unique().toArray();
    }

    // 每一次选择dropdown filter的时候 都会call这个update dropdown value
    function updateDropdownValue(dropdownId, uniqueValues){
        // Clear existing options and add an "All" option
        $(dropdownId).empty().append($(`<option value=''>All</option>`))

        // Populate the dropdown with unique "Type" values
        $.each(uniqueValues, function(index, value) {
            $(dropdownId).append($("<option></option>").attr("value", value).text(value));
        });
    }
   
});






$('#searchType').on('keyup', function () {
    productTable.columns(3).search(this.value).draw();
});
$('#searchPackage').on('keyup', function () {
    productTable.columns(4).search(this.value).draw();
});

$('#searchType1').on('keyup', function () {
    productTable.columns(5).search(this.value).draw();
});
$('#searchType2').on('keyup', function () {
    productTable.columns(6).search(this.value).draw();
});

$('#searchType3').on('keyup', function () {
    productTable.columns(7).search(this.value).draw();
});


// function to stop propagation
//stop clicking thru the element
function stopPropagation(event) {
    event.stopPropagation();
}

</script>




<?php
include_once('footer.php');

?>