<?php
include_once('header.php');

// ### Read products from database
$readSql = "SELECT * FROM products";
$result = mysqli_query($conn, $readSql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// ### Calculate product status counts
// $goodCount = 0;
// $warningCount = 0;
// $remarkCount = 0;

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
// while ($row = mysqli_fetch_assoc($countResult)) {
//     if ($row['status'] === 'GOOD') {
//         $goodCount = $row['count'];
//     } elseif ($row['status'] === 'WARNING') {
//         $warningCount = $row['count'];
//     }
// }

// Count products with remarks
$remarkSql = "SELECT COUNT(*) AS count FROM products WHERE remark IS NOT NULL AND remark <> ''";
$remarkResult = mysqli_query($conn, $remarkSql);
$remarkRow = mysqli_fetch_assoc($remarkResult);
$remarkCount = $remarkRow['count'];



// ### DELETE PRODUCT
if ($_SESSION['role'] === 'admin' && isset($_GET['delete'])) {

    $productId = $_GET['delete'];
    $deleteSql = "DELETE FROM products WHERE id = $productId";

    // get the product detail of deleted product to store it in action history
    $p = getProductById($conn, $productId);
    $name = $p['name'];
    $productId = $p['product_id'];
    $place = $p['place'];
    $package = $p['package'];
    $leadCount = $p['lead_count'];
    $type1 = $p['type1'];
    $type2 = $p['type2'];
    $type3 = $p['type3'];
    $type4 = $p['type4'];
    $quantity = $p['quantity'];
    $minQuantity = $p['min_quantity'];
    $quantityPerSet = $p['quantity_per_set'];
    $remark = $p['remark'];

    
    if (mysqli_query($conn, $deleteSql)) {

        // add to action history
        $actionDescription = "Deleted ($name, $productId, $place, $package, $leadCount, $type1, $type2, $type3, $type4, $quantity, $minQuantity, $quantityPerSet, $remark)";
        createHistory($conn, "DELETE", $actionDescription);

        header("Location: index.php");
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
                <div class="card alert alert-primary mb-3">
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
        <button class="btn btn-primary ms-auto" id="export-product-button">Export to CSV</button>
    </div>

    <!-- select filter -->
    <div class="d-flex my-4">
        <select id="selectPlace" class="form-select">
            <option value="">All Places</option>
        </select>

        <select id="selectPackage" class="form-select">
            <option value="">All Packages</option>
        </select>

        <select id="selectLeadCount" class="form-select">
            <option value="">All LeadCount</option>
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

        <select id="selectType4" class="form-select">
            <option value="">All Type4</option>
        </select>
    </div>

    <table id="product-table" class="table table-bordered table-striped w-100">
        <thead class="table-primary">
            <tr>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>ID</th>
                <th>Place<input type="text" id="searchPlace" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Package<input type="text" id="searchPackage" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>LeadCount<input type="text" id="searchLeadCount" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type1<input type="text" id="searchType1" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type2<input type="text" id="searchType2" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type3<input type="text" id="searchType3" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
                <th>Type4<input type="text" id="searchType4" class="form-control" placeholder="search" onclick="stopPropagation(event)"></th>
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
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['place']; ?></td>
                    <td><?php echo $product['package']; ?></td>
                    <td><?php echo $product['lead_count']; ?></td>
                    <td><?php echo $product['type1']; ?></td>
                    <td><?php echo $product['type2']; ?></td>
                    <td><?php echo $product['type3']; ?></td>
                    <td><?php echo $product['type4']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['min_quantity']; ?></td>
                    <td><?php echo $product['quantity_per_set']; ?></td>
                    <td><?php echo $product['remark']; ?></td>
                    <td>
                        <a href="update-product.php?id=<?php echo $product["id"]; ?>" class="btn btn-primary btn-sm">Update</a>

                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <a href="index.php?delete=<?php echo $product['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
</div>







<script>

// initiate product datatable
var productTable;

$(document).ready(function() {
    productTable = $('#product-table').DataTable({
        columnDefs: [
            { width: '20%', targets: 0 }, // Adjust the width of the first column
        ]
    });

    // Call setupDropdownFilter for different columns
    setupDropdownFilter('#selectPlace', 2); // Place column
    setupDropdownFilter('#selectPackage', 3); // Package column
    setupDropdownFilter('#selectLeadCount', 4); // Lead Count column
    setupDropdownFilter('#selectType1', 5); // Type1 column
    setupDropdownFilter('#selectType2', 6); // Type2 column
    setupDropdownFilter('#selectType3', 7); // Type3 column
    setupDropdownFilter('#selectType4', 8); // Type4 column

});


function setUpAgainDropdownFilter(){
    setupDropdownFilter('#selectPlace', 2); // Place column
    setupDropdownFilter('#selectPackage', 3); // Package column
    setupDropdownFilter('#selectLeadCount', 4); // Lead Count column
    setupDropdownFilter('#selectType1', 5); // Type1 column
    setupDropdownFilter('#selectType2', 6); // Type2 column
    setupDropdownFilter('#selectType3', 7); // Type3 column
    setupDropdownFilter('#selectType4', 8); // Type4 column
}


// Function to populate dropdown with unique values
function populateDropdown(dropdownId, values) {
    var dropdown = $(dropdownId);
    // dropdown.empty().append('<option value="">All</option>');
    var valuesArray = Array.from(values);
    valuesArray.forEach(function(value) {
        dropdown.append($('<option></option>').attr('value', value).text(value));
    });
}

// Function to update table based on selected dropdown value
function updateTableByColumn(selectedValue, columnIndex) {
    productTable.columns(columnIndex).search(selectedValue).draw();
}

// Function to handle dropdown change
function handleDropdownChange(dropdownId, columnIndex) {
    $(dropdownId).on('change', function() {
        var selectedValue = $(this).val();
        updateTableByColumn(selectedValue, columnIndex);
    });
}

// Populate dropdown and attach change event handler
function setupDropdownFilter(dropdownId, columnIndex) {
    var columnValues = productTable.column(columnIndex).data().unique();
    populateDropdown(dropdownId, columnValues);
    handleDropdownChange(dropdownId, columnIndex);
}



// Function to populate dropdown with unique values
// function populateDropdown(dropdownId, values) {
//     var dropdown = $(dropdownId);
    
//     // Clear existing options
//     dropdown.empty().append('<option value="">All</option>');
    
//     // Convert values to an array
//     var valuesArray = Array.from(values);
    
//     // Populate with new options
//     valuesArray.forEach(function(value) {
//         dropdown.append($('<option></option>').attr('value', value).text(value));
//     });
// }

// // Function to update table based on selected dropdown value
// function updateTableByColumn(selectedValue, columnIndex) {
//     productTable.columns(columnIndex).search(selectedValue).draw();
// }

// // Function to handle dropdown change
// function handleDropdownChange(dropdownId, columnIndex) {
//     $(dropdownId).on('change', function() {
//         var selectedValue = $(this).val();
//         updateTableByColumn(selectedValue, columnIndex);
//     });
// }

// // Populate dropdown and attach change event handler
// function setupDropdownFilter(dropdownId, columnIndex) {
//     var columnValues = productTable.column(columnIndex).data().unique();
//     populateDropdown(dropdownId, columnValues);
//     handleDropdownChange(dropdownId, columnIndex);
// }

// function updateNextDropdown(currentDropdownId, nextDropdownId, columnIndex) {
//     var selectedValue = $(currentDropdownId).val().trim(); // Trim whitespace
//     var filteredColumn = productTable.column(columnIndex).data().filter(function(value) {
//         return value.trim() === selectedValue; // Trim whitespace for comparison
//     });
//     var uniqueValues = Array.from(new Set(filteredColumn.toArray()));
    
//     populateDropdown(nextDropdownId, uniqueValues);
// }


// $('#selectPlace').on('change', function() {
//     updateNextDropdown('#selectPlace', '#selectPackage', ); // Place column
// });














$('#searchPlace').on('keyup', function () {
    productTable.columns(2).search(this.value).draw();
});
$('#searchPackage').on('keyup', function () {
    productTable.columns(3).search(this.value).draw();
});
$('#searchLeadCount').on('keyup', function () {
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
$('#searchType4').on('keyup', function () {
    productTable.columns(8).search(this.value).draw();
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