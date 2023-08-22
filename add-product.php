<?php
include_once('header.php');

// ### CREATE PRODUCT
if(isset($_POST['create_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $productId = mysqli_real_escape_string($conn, $_POST['product_id']);
    $place = mysqli_real_escape_string($conn, $_POST['place']);
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $leadCount = mysqli_real_escape_string($conn, $_POST['lead_count']);
    $type1 = mysqli_real_escape_string($conn, $_POST['type1']);
    $type2 = mysqli_real_escape_string($conn, $_POST['type2']);
    $type3 = mysqli_real_escape_string($conn, $_POST['type3']);
    $type4 = mysqli_real_escape_string($conn, $_POST['type4']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $minQuantity = mysqli_real_escape_string($conn, $_POST['min_quantity']);
    $quantityPerSet = mysqli_real_escape_string($conn, $_POST['quantity_per_set']);
    $remark = mysqli_real_escape_string($conn, $_POST['remark']);

    $insertSql = "INSERT INTO products (name, product_id, place, package, lead_count, type1, type2, type3, type4, quantity, min_quantity, quantity_per_set, remark) VALUES ('$name', '$productId', '$place', '$package', '$leadCount', '$type1', '$type2', '$type3', '$type4', '$quantity', '$minQuantity', '$quantityPerSet', '$remark')";

    if (mysqli_query($conn, $insertSql)) {

        
        // add to action history
        $actionDescription = "Created ($name, $productId, $place, $package, $leadCount, $type1, $type2, $type3, $type4, $quantity, $minQuantity, $quantityPerSet, $remark )";
        
        createHistory($conn, "CREATE", $actionDescription);


        echo '<script>showToast("Product created successfully.", "Success");</script>';

        header("Location: index.php");

        // TODO: Show success notification
    } else {
        // TODO: show error creating product
    }
}


?>

    <!-- Create Product Form -->
    <div class="p-4 w-50 mx-auto">
        <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
        
        <h1>ADD New Product</h1>

        <form id="" method="POST" class="mt-4 border border-4 p-4">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" placeholder="name" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label fw-bold">Product ID</label>
                <input type="text" class="form-control" placeholder="product_id" id="product_id" name="product_id" required>
            </div>
            <div class="mb-3">
                <label for="place" class="form-label fw-bold">Place</label>
                <input type="text" class="form-control" placeholder="place" id="place" name="place" required>
            </div>
            <div class="mb-3">
                <label for="package" class="form-label fw-bold">Package</label>
                <input type="text" class="form-control" placeholder="package" id="package" name="package" required >
            </div>
            <div class="mb-3">
                <label for="lead_count" class="form-label fw-bold">Lead Count</label>
                <input type="number" class="form-control" placeholder="Lead Count" id="lead_count" name="lead_count" required>
            </div>
            <div class="mb-3">
                <label for="type1" class="form-label fw-bold">Type 1</label>
                <input type="text" class="form-control" placeholder="Type 1" id="type1" name="type1" required>
            </div>
            <div class="mb-3">
                <label for="type2" class="form-label fw-bold">Type 2</label>
                <input type="text" class="form-control" placeholder="Type 2" id="type2" name="type2" required>
            </div>
            <div class="mb-3">
                <label for="type3" class="form-label fw-bold">Type 3</label>
                <input type="text" class="form-control" placeholder="Type 3" id="type3" name="type3" required>
            </div>
            <div class="mb-3">
                <label for="type4" class="form-label fw-bold">Type 4</label>
                <input type="text" class="form-control" placeholder="Type 4" id="type4" name="type4">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label fw-bold">Quantity</label>
                <input type="number" class="form-control" placeholder="Quantity" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
                <label for="min_quantity" class="form-label fw-bold">Min Quantity</label>
                <input type="number" class="form-control" placeholder="Min Quantity" id="min_quantity" name="min_quantity" required>
            </div>
            <div class="mb-3">
                <label for="quantity_per_set" class="form-label fw-bold">Quantity Per Set</label>
                <input type="number" class="form-control" placeholder="Quantity Per Set" id="quantity_per_set" name="quantity_per_set" required>
            </div>
            <div class="mb-3">
                <label for="remark" class="form-label fw-bold">Remark</label>
                <textarea class="form-control" placeholder="Remark" name="remark" rows="6"></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" class="mt-4 btn btn-success p-4 w-100 fw-bold" value="Create Product" name="create_product"> 
            </div>
        </form>
                 
    </div>
    


<?php
include_once('footer.php');
?>