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
    $old_productId = $old_product['product_id'];
    $old_place = $old_product['place'];
    $old_package = $old_product['package'];
    $old_leadCount = $old_product['lead_count'];
    $old_type1 = $old_product['type1'];
    $old_type2 = $old_product['type2'];
    $old_type3 = $old_product['type3'];
    $old_type4 = $old_product['type4'];
    $old_quantity = $old_product['quantity'];
    $old_minQuantity = $old_product['min_quantity'];
    $old_quantityPerSet = $old_product['quantity_per_set'];
    $old_remark = $old_product['remark'];

    // NEW DATA get from POST
    $id = $_GET['id']; // Get the product ID from the URL
    $name = $_POST['name'];
    $productId = $_POST['product_id'];
    $place = $_POST['place'];
    $package = $_POST['package'];
    $leadCount = $_POST['lead_count'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'];
    $type3 = $_POST['type3'];
    $type4 = $_POST['type4'];
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
    if ($productId !== $old_productId) {
        $changedFields[] = "Product ID: $old_productId => $productId";
    }
    if ($place !== $old_place) {
        $changedFields[] = "Place: $old_place => $place";
    }
    if ($package !== $old_package) {
        $changedFields[] = "Package: $old_package => $package";
    }
    if ($leadCount !== $old_leadCount) {
        $changedFields[] = "Lead Count: $old_leadCount => $leadCount";
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
    if ($type4 !== $old_type4) {
        $changedFields[] = "Type 4: $old_type4 => $type4";
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
    if ($remark !== $old_remark) {
        $changedFields[] = "Remark: $old_remark => $remark";
    }


    

    // Prepare the update SQL statement using placeholders
    $updateSql = "UPDATE products SET name=?, product_id=?, place=?, package=?, lead_count=?, type1=?, type2=?, type3=?, type4=?, quantity=?, min_quantity=?, quantity_per_set=?, remark=? WHERE id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $updateSql);

    // Bind parameters to the prepared statement
    //! REMEMBER to CHANGE THE Data Type when changing order or adding fields,  the ssssis means string, integer
    mysqli_stmt_bind_param($stmt, "ssssissssiiisi", $name, $productId, $place, $package, $leadCount, $type1, $type2, $type3, $type4, $quantity, $minQuantity, $quantityPerSet, $remark, $id);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // ... (your action history and redirect code)
        // $actionDescription = "Updated from ($old_name, $old_productId, $old_place, $old_package, $old_leadCount, $old_type1, $old_type2, $old_type3, $old_type4, $old_quantity, $old_minQuantity, $old_quantityPerSet, $old_remark) to ($name, $productId, $place, $package, $leadCount, $type1, $type2, $type3, $type4, $quantity, $minQuantity, $quantityPerSet, $remark)";
        // $actionDescription = "Updated ($name) - " . implode("   ,   ", $changedFields);
        $actionDescription = "Updated product: $name. Changes made to: " . implode(", ", $changedFields);
        createHistory($conn, "UPDATE", $actionDescription);

        header("Location: index.php");
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
                <input type="text" class="form-control" placeholder="name" id="name" name="name" required value="<?php echo $product['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label fw-bold">product_id</label>
                <input type="text" class="form-control" placeholder="product_id" id="product_id" name="product_id" required value="<?php echo $product['product_id']; ?>">
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
                <label for="quantity" class="form-label fw-bold">Quantity</label>
                <input type="number" class="form-control" placeholder="Quantity" id="quantity" name="quantity" required value="<?php echo $product['quantity']; ?>">
            </div>
            <div class="mb-3">
                <label for="min_quantity" class="form-label fw-bold">Min Quantity</label>
                <input type="number" class="form-control" placeholder="Min Quantity" id="min_quantity" name="min_quantity" required value="<?php echo $product['min_quantity']; ?>">
            </div>
            <div class="mb-3">
                <label for="quantity_per_set" class="form-label fw-bold">Quantity Per Set</label>
                <input type="number" class="form-control" placeholder="Quantity Per Set" id="quantity_per_set" name="quantity_per_set" required value="<?php echo $product['quantity_per_set']; ?>">
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