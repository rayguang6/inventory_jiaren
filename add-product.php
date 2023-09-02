<?php
include_once('header.php');

// ### CREATE PRODUCT
if(isset($_POST['create_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $drawingId = mysqli_real_escape_string($conn, $_POST['drawing_id']);
    $partId = mysqli_real_escape_string($conn, $_POST['part_id']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $type1 = mysqli_real_escape_string($conn, $_POST['type1']);
    $type2 = mysqli_real_escape_string($conn, $_POST['type2']);
    $type3 = mysqli_real_escape_string($conn, $_POST['type3']);
    $cost = mysqli_real_escape_string($conn, $_POST['cost']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $minQuantity = mysqli_real_escape_string($conn, $_POST['min_quantity']);
    $quantityPerSet = mysqli_real_escape_string($conn, $_POST['quantity_per_set']);
    $remark = trim(mysqli_real_escape_string($conn, $_POST['remark']));

    $insertSql = "INSERT INTO products (name, drawing_id, part_id, type, package, type1, type2, type3, cost, location, quantity, min_quantity, quantity_per_set, remark) VALUES ('$name', '$drawingId', '$partId', '$type', '$package', '$type1', '$type2', '$type3', '$cost', '$location', '$quantity', '$minQuantity', '$quantityPerSet', '$remark')";

    if (mysqli_query($conn, $insertSql)) {

        // add to action history

        $actionDescription = "Created ($name, $drawingId, $partId, $type, $package, $type1, $type2, $type3, $cost, $location, $quantity, $minQuantity, $quantityPerSet, $remark)";
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
                <label for="drawing_id" class="form-label fw-bold">Drawing ID</label>
                <input type="text" class="form-control" placeholder="Drawing ID" id="drawing_id" name="drawing_id">
            </div>
            <div class="mb-3">
                <label for="part_id" class="form-label fw-bold">Part ID</label>
                <input type="text" class="form-control" placeholder="Part ID" id="part_id" name="part_id">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label fw-bold">Type</label>
                <input type="text" class="form-control" placeholder="Type" id="type" name="type">
            </div>
            <div class="mb-3">
                <label for="package" class="form-label fw-bold">Package</label>
                <input type="text" class="form-control" placeholder="package" id="package" name="package" >
            </div>
            <div class="mb-3">
                <label for="type1" class="form-label fw-bold">Type 1</label>
                <input type="text" class="form-control" placeholder="Type 1" id="type1" name="type1">
            </div>
            <div class="mb-3">
                <label for="type2" class="form-label fw-bold">Type 2</label>
                <input type="text" class="form-control" placeholder="Type 2" id="type2" name="type2">
            </div>
            <div class="mb-3">
                <label for="type3" class="form-label fw-bold">Type 3</label>
                <input type="text" class="form-control" placeholder="Type 3" id="type3" name="type3">
            </div>
            
            <div class="mb-3">
                <label for="cost" class="form-label fw-bold">Cost</label>
                <input type="number" class="form-control" placeholder="Cost" id="cost" name="cost">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label fw-bold">Location</label>
                <input type="text" class="form-control" placeholder="Location" id="location" name="location">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label fw-bold">Quantity</label>
                <input type="number" class="form-control" placeholder="Quantity" id="quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="min_quantity" class="form-label fw-bold">Min Quantity</label>
                <input type="number" class="form-control" placeholder="Min Quantity" id="min_quantity" name="min_quantity">
            </div>
            <div class="mb-3">
                <label for="quantity_per_set" class="form-label fw-bold">Quantity Per Set</label>
                <input type="number" class="form-control" placeholder="Quantity Per Set" id="quantity_per_set" name="quantity_per_set">
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