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
                <th>Drawing ID</th>
                <th>Part ID</th>
                <th>Type</th>
                <th>Package</th>
                <th>Type1</th>
                <th>Type2</th>
                <th>Type3</th>
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
            <?php foreach ($remarkProducts as $remarkProduct) : ?>
                <tr>
                    <td><?php echo $remarkProduct['name']; ?></td>
                    <td><?php echo $remarkProduct['drawing_id']; ?></td>
                    <td><?php echo $remarkProduct['part_id']; ?></td>
                    <td><?php echo $remarkProduct['type']; ?></td>
                    <td><?php echo $remarkProduct['package']; ?></td>
                    <td><?php echo $remarkProduct['type1']; ?></td>
                    <td><?php echo $remarkProduct['type2']; ?></td>
                    <td><?php echo $remarkProduct['type3']; ?></td>
                    <td><?php echo $remarkProduct['cost']; ?></td>
                    <td><?php echo $remarkProduct['location']; ?></td>
                    <td><?php echo $remarkProduct['quantity']; ?></td>
                    <td><?php echo $remarkProduct['min_quantity']; ?></td>
                    <td><?php echo $remarkProduct['quantity_per_set']; ?></td>
                    <td><?php echo $remarkProduct['remark']; ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="update-product.php?id=<?php echo $remarkProduct["id"]; ?>" class="btn btn-primary btn-sm">Update</a>
    
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <a href="index.php?delete=<?php echo $remarkProduct['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                                <span class="delete-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                                </span>
                            </a>
                            <?php endif; ?>
                        </div>

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