<?php
include_once('header.php');

// Warning Products
$warningProductQuery = "SELECT * FROM products WHERE quantity < min_quantity OR quantity < quantity_per_set";
$warningProductResult = mysqli_query($conn, $warningProductQuery);
$warningProducts = mysqli_fetch_all($warningProductResult, MYSQLI_ASSOC);

$goodProductQuery = "SELECT * FROM products WHERE quantity >= min_quantity AND quantity >= quantity_per_set";
$goodProductResult = mysqli_query($conn, $goodProductQuery);
$goodProducts = mysqli_fetch_all($goodProductResult, MYSQLI_ASSOC);


?>

<!-- Main Product Table -->

<div class="p-4 ">
    <div class="d-flex my-2">
        <h2>Warning Status Table</h2>
        <button class="btn btn-primary ms-auto" id="export-warning-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg>    
        Export to CSV</button>
    </div>
    <table id="status-warning-table" class="table table-bordered table-striped">
        <thead class="table-danger">
            <tr>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>Product ID</th>
                <!-- <th>Place</th>
                <th>Package</th>
                <th>Lead Count</th>
                <th>Type 1</th>
                <th>Type 2</th>
                <th>Type 3</th>
                <th>Type 4</th> -->
                <th>Quantity</th>
                <th>Min Quantity</th>
                <th>Quantity Per Set</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($warningProducts as $warningProduct) : ?>
                <tr>
                    <td><?php echo $warningProduct['name']; ?></td>
                    <td><?php echo $warningProduct['product_id']; ?></td>
                    <!-- <td><?php //echo $warningProduct['place']; ?></td>
                    <td><?php //echo $warningProduct['package']; ?></td>
                    <td><?php //echo $warningProduct['lead_count']; ?></td> -->
                    
                    <!-- <td>
                        <?php 
                            // if($warningProduct['lead_count'] >= $warningProduct['min_count']){
                            //     echo "<span class='badge bg-success'> GOOD </span>";
                            // }else{
                            //     echo "<span class='badge bg-danger'> WARNING </span>";
                            // }
                        ?>
                    </td> -->
                    <!-- <td><?php //echo $product['type1']; ?></td>
                    <td><?php //echo $warningProduct['type2']; ?></td>
                    <td><?php //echo $warningProduct['type3']; ?></td>
                    <td><?php //echo $warningProduct['type4']; ?></td> -->
                    <td><?php echo $warningProduct['quantity']; ?></td>
                    <td><?php echo $warningProduct['min_quantity']; ?></td>
                    <td><?php echo $warningProduct['quantity_per_set']; ?></td>
                    <td><?php echo $warningProduct['remark']; ?></td>
                    <td>
                        <a href="update-product.php?id=<?php echo $warningProduct["id"]; ?>" class="btn btn-primary btn-sm">Update</a>

                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <a href="index.php?delete=<?php echo $warningProduct['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        <?php endif; ?>

                    </td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="p-4 ">
    <div class="d-flex my-2">
        <h2>GOOD Status Table</h2>
        <button class="btn btn-primary ms-auto" id="export-good-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg>
            Export to CSV
        </button>
        
    </div>
    <table id="status-good-table" class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>Product ID</th>
                <!-- <th>Place</th>
                <th>Package</th>
                <th>Lead Count</th>
                <th>Type 1</th>
                <th>Type 2</th>
                <th>Type 3</th>
                <th>Type 4</th> -->
                <th>Quantity</th>
                <th>Min Quantity</th>
                <th>Quantity Per Set</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($goodProducts as $goodProduct) : ?>
                <tr>
                    <td><?php echo $goodProduct['name']; ?></td>
                    <td><?php echo $goodProduct['product_id']; ?></td>
                    <!-- <td><?php //echo $goodProduct['place']; ?></td>
                    <td><?php //echo $goodProduct['package']; ?></td>
                    <td><?php //echo $goodProduct['lead_count']; ?></td> -->
                    
                    <!-- <td>
                        <?php 
                            // if($goodProduct['lead_count'] >= $goodProduct['min_count']){
                            //     echo "<span class='badge bg-success'> GOOD </span>";
                            // }else{
                            //     echo "<span class='badge bg-danger'> WARNING </span>";
                            // }
                        ?>
                    </td> -->
                    <!-- <td><?php //echo $product['type1']; ?></td>
                    <td><?php //echo $goodProduct['type2']; ?></td>
                    <td><?php //echo $warningProduct['type3']; ?></td>
                    <td><?php //echo $goodProduct['type4']; ?></td> -->
                    <td><?php echo $goodProduct['quantity']; ?></td>
                    <td><?php echo $goodProduct['min_quantity']; ?></td>
                    <td><?php echo $goodProduct['quantity_per_set']; ?></td>
                    <td><?php echo $goodProduct['remark']; ?></td>
                    <td>
                        <a href="update-product.php?id=<?php echo $goodProduct["id"]; ?>" class="btn btn-primary btn-sm">Update</a>

                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <a href="index.php?delete=<?php echo $goodProduct['id']; ?>"
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
$(document).ready(function() {
    $('#status-good-table').DataTable({});
    $('#status-warning-table').DataTable({});
});
</script>





<?php
include_once('footer.php');
?>