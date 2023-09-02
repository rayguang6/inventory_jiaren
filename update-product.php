<?php
include_once('header.php');

// 
if (isset($_GET['id'])){
    $product = getProductById($conn, $_GET['id']);
}
else{
// no product id
}

// handle post form submit
if (isset($_POST['update_product'])) {

    // OLD Product DATA (for action history purpose)
    $old_product = getProductById($conn, $_GET['id']);

    $old_name = $old_product['name'];
    $old_drawingId = $old_product['drawing_id'];
    $old_partId = $old_product['part_id'];
    $old_type = $old_product['type'];
    $old_package = $old_product['package'];
    $old_type1 = $old_product['type1'];
    $old_type2 = $old_product['type2'];
    $old_type3 = $old_product['type3'];
    $old_cost = $old_product['cost'];
    $old_location = $old_product['location'];
    $old_quantity = $old_product['quantity'];
    $old_minQuantity = $old_product['min_quantity'];
    $old_quantityPerSet = $old_product['quantity_per_set'];
    $old_remark = $old_product['remark'];

    // NEW DATA get from POST
    $id = $_GET['id']; // Get the product ID from the URL
    $name = $_POST['name'];
    $drawingId = $_POST['drawing_id'];
    $partId = $_POST['part_id'];
    $type = $_POST['type'];
    $package = $_POST['package'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'];
    $type3 = $_POST['type3'];
    $cost = $_POST['cost'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];
    $minQuantity = $_POST['min_quantity'];
    $quantityPerSet = $_POST['quantity_per_set'];
    $remark = $_POST['remark'];

    // compare old value with new value to see which field has changed
    // then add them to array and only display those
    $changedFields = array();
    if ($name !== $old_name) {
        $changedFields[] = "Name: $old_name => $name";
    }
    if ($drawingId !== $old_drawingId) {
        $changedFields[] = "Drawing ID: $old_drawingId => $drawingId";
    }
    if ($partId !== $old_partId) {
        $changedFields[] = "Drawing ID: $old_partId => $partId";
    }
    if ($type !== $old_type) {
        $changedFields[] = "Type 4: $old_type => $type";
    }
    if ($package !== $old_package) {
        $changedFields[] = "Package: $old_package => $package";
    }
    
    if ($type1 !== $old_type1) {
        $changedFields[] = "Type 1: $old_type1 => $type1";
    }
    if ($type2 !== $old_type2) {
        $changedFields[] = "Type 2: $old_type2 => $type2";
    }
    if ($type3 !== $old_type3) {
        $changedFields[] = "Type 3: $old_type3 => $type3";
    }
    if ($cost !== $old_cost) {
        $changedFields[] = "Cost: $old_cost => $cost";
    }
    if ($location !== $old_location) {
        $changedFields[] = "Location: $old_location => $location";
    }
    if ($quantity !== $old_quantity) {
        $changedFields[] = "Quantity: $old_quantity => $quantity";
    }
    if ($minQuantity !== $old_minQuantity) {
        $changedFields[] = "Min Quantity: $old_minQuantity => $minQuantity";
    }
    if ($quantityPerSet !== $old_quantityPerSet) {
        $changedFields[] = "Quantity Per Set: $old_quantityPerSet => $quantityPerSet";
    }
    if (trim($remark) !== trim($old_remark)) {
        $changedFields[] = "Remark: $old_remark => $remark";
    }

    // Prepare the update SQL statement using placeholders
    $updateSql = "UPDATE products SET name=?, drawing_id=?, part_id=?, type=?, package=?, type1=?, type2=?, type3=?, cost=?, location=?, quantity=?, min_quantity=?, quantity_per_set=?, remark=? WHERE id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $updateSql);

    // Bind parameters to the prepared statement
    //! REMEMBER to CHANGE THE Data Type when changing order or adding fields,  the ssssis means string, integer
    mysqli_stmt_bind_param($stmt, "ssssssssisiiisi", $name, $drawingId, $partId, $type, $package, $type1, $type2, $type3, $cost, $location, $quantity, $minQuantity, $quantityPerSet, $remark, $id);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $actionDescription = "Updated product: ($old_name, $old_partId). Changes made to: " . implode(", ", $changedFields);
        createHistory($conn, "UPDATE", $actionDescription);

        echo '<script>window.history.go(-2);</script>';

        // header("Location: index.php");
        exit;
    } else {
        $updateError = "Error updating product: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

?>

    <!-- Edit Product Form -->
    <div class="p-4 w-50 mx-auto">
        <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
        
        <h1>Update Product</h1>

        <form id="" method="POST" class="mt-4 border border-4 p-4">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" placeholder="name" id="name" name="name" value="<?php echo $product['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="drawing_id" class="form-label fw-bold">Drawing ID</label>
                <input type="text" class="form-control" placeholder="Drawing ID" id="drawing_id" name="drawing_id" value="<?php echo $product['drawing_id']; ?>">
            </div>
            <div class="mb-3">
                <label for="part_id" class="form-label fw-bold">Part ID</label>
                <input type="text" class="form-control" placeholder="Part ID" id="part_id" name="part_id" value="<?php echo $product['part_id']; ?>">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label fw-bold">Type</label>
                <input type="text" class="form-control" placeholder="Type" id="type" name="type" value="<?php echo $product['type']; ?>">
            </div>
            <div class="mb-3">
                <label for="package" class="form-label fw-bold">Package</label>
                <input type="text" class="form-control" placeholder="package" id="package" name="package"  value="<?php echo $product['package']; ?>">
            </div>
            <div class="mb-3">
                <label for="type1" class="form-label fw-bold">Type 1</label>
                <input type="text" class="form-control" placeholder="Type 1" id="type1" name="type1" value="<?php echo $product['type1']; ?>">
            </div>
            <div class="mb-3">
                <label for="type2" class="form-label fw-bold">Type 2</label>
                <input type="text" class="form-control" placeholder="Type 2" id="type2" name="type2" value="<?php echo $product['type2']; ?>">
            </div>
            <div class="mb-3">
                <label for="type3" class="form-label fw-bold">Type 3</label>
                <input type="text" class="form-control" placeholder="Type 3" id="type3" name="type3" value="<?php echo $product['type3']; ?>">
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label fw-bold">Cost</label>
                <input type="number" class="form-control" placeholder="Cost" id="cost" name="cost" value="<?php echo $product['cost']; ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label fw-bold">Location</label>
                <input type="text" class="form-control" placeholder="location" id="location" name="location" value="<?php echo $product['location']; ?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label fw-bold">Quantity</label>
                <input type="number" class="form-control" placeholder="Quantity" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>">
            </div>
            <div class="mb-3">
                <label for="min_quantity" class="form-label fw-bold">Min Quantity</label>
                <input type="number" class="form-control" placeholder="Min Quantity" id="min_quantity" name="min_quantity" value="<?php echo $product['min_quantity']; ?>">
            </div>
            <div class="mb-3">
                <label for="quantity_per_set" class="form-label fw-bold">Quantity Per Set</label>
                <input type="number" class="form-control" placeholder="Quantity Per Set" id="quantity_per_set" name="quantity_per_set" value="<?php echo $product['quantity_per_set']; ?>">
            </div>
            <div class="mb-3">
                <label for="remark" class="form-label fw-bold">Remark</label>
                <textarea class="form-control" placeholder="Remark" name="remark" rows="6"><?php echo $product['remark']; ?></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" class="mt-4 btn btn-success p-4 w-100 fw-bold" value="Update Product" name="update_product"> 
            </div>
        </form>
    </div>


<?php
include_once('footer.php');
?>



