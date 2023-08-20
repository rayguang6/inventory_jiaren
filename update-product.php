<?php
session_start();
include 'db.php';
include 'helper.php';

// 
if (isset($_GET['id'])){
    $product = getProductById($conn, $_GET['id']);
}
else{
// no product id

}


if (isset($_POST['update_product'])) {

    // OLD Product DATA (for action history purpose)
    $old_product = getProductById($conn, $_GET['id']);

    $old_name = $old_product['name'];
    $old_place = $old_product['place'];
    $old_package = $old_product['package'];
    $old_leadCount = $old_product['lead_count'];
    $old_minCount = $old_product['min_count'];
    $old_type1 = $old_product['type1'];
    $old_type2 = $old_product['type2'];
    $old_type3 = $old_product['type3'];
    $old_type4 = $old_product['type4'];
    $old_remark = $old_product['remark'];

    // NEW DATA get from POST
    $productId = $_GET['id']; // Get the product ID from the URL
    $name = $_POST['name'];
    $place = $_POST['place'];
    $package = $_POST['package'];
    $leadCount = $_POST['lead_count'];
    $minCount = $_POST['min_count'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'];
    $type3 = $_POST['type3'];
    $type4 = $_POST['type4'];
    $remark = $_POST['remark'];

    $updateSql = "UPDATE products SET name='$name', place='$place', package='$package', lead_count='$leadCount', min_count='$minCount' , type1='$type1', type2='$type2', type3='$type3', type4='$type4', remark='$remark' WHERE id = $productId";

    if (mysqli_query($conn, $updateSql)) {

        $actionDescription = "Updated Product#$productId from ($old_name, $old_place, $old_package, $old_leadCount, $old_minCount, $old_type1, $old_type2, $old_type3, $old_type4, $old_remark) to ($name, $place, $package, $leadCount, $minCount, $type1, $type2, $type3, $type4, $remark)";
        createHistory($conn, "UPDATE", $actionDescription);

        header("Location: index.php");
        exit;
    } else {
        $updateError = "Error updating product: " . mysqli_error($conn);

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Include Bootstrap CSS --><link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap JS --><script defer src="bootstrap/bootstrap.bundle.min.js"></script>
    <!-- JQUERY --><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Edit Product Form -->
    <div class="p-4 w-50 mx-auto">
        <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
        
        <h1>Update Product</h1>

        <form id="" method="POST" class="mt-4 border border-4 p-4">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" placeholder="name" id="name" name="name" required value="<?php echo $product['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="place" class="form-label fw-bold">Place</label>
                <input type="text" class="form-control" placeholder="place" id="place" name="place" required value="<?php echo $product['place']; ?>">
            </div>
            <div class="mb-3">
                <label for="package" class="form-label fw-bold">Package</label>
                <input type="text" class="form-control" placeholder="package" id="package" name="package" required  value="<?php echo $product['package']; ?>">
            </div>
            <div class="mb-3">
                <label for="lead_count" class="form-label fw-bold">Lead Count</label>
                <input type="number" class="form-control" placeholder="Lead Count" id="lead_count" name="lead_count" required value="<?php echo $product['lead_count']; ?>">
            </div>
            <div class="mb-3">
                <label for="min_count" class="form-label fw-bold">Min Count</label>
                <input type="number" class="form-control" placeholder="Min Count" id="min_count" name="min_count" required value="<?php echo $product['min_count']; ?>">
            </div>
            <div class="mb-3">
                <label for="type1" class="form-label fw-bold">Type 1</label>
                <input type="text" class="form-control" placeholder="Type 1" id="type1" name="type1" required value="<?php echo $product['type1']; ?>">
            </div>
            <div class="mb-3">
                <label for="type2" class="form-label fw-bold">Type 2</label>
                <input type="text" class="form-control" placeholder="Type 2" id="type2" name="type2" required value="<?php echo $product['type2']; ?>">
            </div>
            <div class="mb-3">
                <label for="type3" class="form-label fw-bold">Type 3</label>
                <input type="text" class="form-control" placeholder="Type 3" id="type3" name="type3" required value="<?php echo $product['type3']; ?>">
            </div>
            <div class="mb-3">
                <label for="type4" class="form-label fw-bold">Type 4</label>
                <input type="text" class="form-control" placeholder="Type 4" id="type4" name="type4" value="<?php echo $product['type4']; ?>">
            </div>
            <div class="mb-3">
                <label for="remark" class="form-label fw-bold">Remark</label>
                <input type="text" class="form-control" placeholder="Type 4" id="type4" name="remark"  value="<?php echo $product['remark']; ?>">
            </div>
            <div class="mb-3">
                <input type="submit" class="mt-4 btn btn-success p-4 w-100 fw-bold" value="Update Product" name="update_product"> 
            </div>
        </form>
                 
    </div>
    


    
</body>
</html>
