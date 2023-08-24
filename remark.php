<!-- this page shows product that has remarks only -->


<?php
include_once('header.php');

// ### Read products from database
$remarkQuery = "SELECT * FROM products WHERE remark IS NOT NULL AND remark <> ''";
$result = mysqli_query($conn, $remarkQuery);
$remarkProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="p-4 ">
    <div class="d-flex my-2">
        <h2>Remark Table</h2>
        <button class="btn btn-primary ms-auto" id="export-remark-button">Export to CSV</button>
    </div>
    <table id="remark-table" class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>ID</th>
                <th>Place</th>
                <th>Package</th>
                <th>Lead Count</th>
                <th>Type1</th>
                <th>Type2</th>
                <th>Type3</th>
                <th>Type4</th>
                <th>Quantity</th>
                <th>Min Quantity</th>
                <th>Quantity Per Set</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($remarkProducts as $remarkProduct) : ?>
                <tr>
                    <td><?php echo $remarkProduct['name']; ?></td>
                    <td><?php echo $remarkProduct['product_id']; ?></td>
                    <td><?php echo $remarkProduct['place']; ?></td>
                    <td><?php echo $remarkProduct['package']; ?></td>
                    <td><?php echo $remarkProduct['lead_count']; ?></td>
                    
                    <!-- <td>
                        <?php 
                            // if($product['lead_count'] >= $product['min_count']){
                            //     echo "<span class='badge bg-success'> GOOD </span>";
                            // }else{
                            //     echo "<span class='badge bg-danger'> WARNING </span>";
                            // }
                        ?>
                    </td> -->
                    <td><?php echo $remarkProduct['type1']; ?></td>
                    <td><?php echo $remarkProduct['type2']; ?></td>
                    <td><?php echo $remarkProduct['type3']; ?></td>
                    <td><?php echo $remarkProduct['type4']; ?></td>
                    <td><?php echo $remarkProduct['quantity']; ?></td>
                    <td><?php echo $remarkProduct['min_quantity']; ?></td>
                    <td><?php echo $remarkProduct['quantity_per_set']; ?></td>
                    <td><?php echo $remarkProduct['remark']; ?></td>
                    <td>
                        <a href="update-product.php?id=<?php echo $remarkProduct["id"]; ?>" class="btn btn-primary btn-sm">Update</a>

                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <a href="index.php?delete=<?php echo $remarkProduct['id']; ?>"
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
    $('#remark-table').DataTable({});
});
</script>





<?php
include_once('footer.php');

?>