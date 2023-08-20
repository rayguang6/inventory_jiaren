<?php
session_start(); //start session
include 'db.php'; //include the database connection file
include 'helper.php';

// ### check if there is a session set, if not means user not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not authenticated
    exit;
}

// ### logout function
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}


// ### Read products from database
$readSql = "SELECT * FROM products";
$result = mysqli_query($conn, $readSql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);




// ### CREATE PRODUCT
if(isset($_POST['create_product'])) {
    // get product from POST data
	$name = $_POST['name'];
    $place = $_POST['place'];
    $package = $_POST['package'];
    $leadCount = $_POST['lead_count'];
    $minCount = $_POST['min_count'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'];
    $type3 = $_POST['type3'];
    $type4 = $_POST['type4'];

    // Insert data into the database (you need to modify this based on your db.php)
    $insertSql = "INSERT INTO products (name, place, package, lead_count, min_count, type1, type2, type3, type4) VALUES ('$name', '$place', '$package', '$leadCount', '$minCount' , '$type1', '$type2', '$type3', '$type4')";

    if (mysqli_query($conn, $insertSql)) {
        
        // add to action history
        $actionDescription = "Created ($name, $place, $package, $leadCount, $minCount, $type1, $type2, $type3, $type4)";
        createHistory($conn, "CREATE", $actionDescription);

        header("Location: index.php");

        // $message = $newProductDescription;
        // showToast($message, 'success');
        // TODO: Show success notification
    } else {
        // TODO: show error creating product
    }
}

// ### DELETE PRODUCT
if ($_SESSION['role'] === 'admin' && isset($_GET['delete'])) {

    $productId = $_GET['delete'];
    $deleteSql = "DELETE FROM products WHERE id = $productId";

    // get the product detail of deleted product to store it in action history
    $p = getProductById($conn, $productId);
    $name = $p['name'];
    $place = $p['place'];
    $package = $p['package'];
    $leadCount = $p['lead_count'];
    $minCount = $p['min_count'];
    $type1 = $p['type1'];
    $type2 = $p['type2'];
    $type3 = $p['type3'];
    $type4 = $p['type4'];

    
    if (mysqli_query($conn, $deleteSql)) {

        // add to action history
        $actionDescription = "Deleted ($name, $place, $package, $leadCount, $minCount, $type1, $type2, $type3, $type4)";
        createHistory($conn, "DELETE", $actionDescription);

        header("Location: index.php");
        exit;
    } else {
        $deleteError = "Error deleting product: " . mysqli_error($conn);
    }
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <!-- Include Bootstrap CSS --><link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap JS --><script defer src="bootstrap/bootstrap.bundle.min.js"></script>
    <!-- JQUERY --><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/papaparse.js"></script>
</head>
<body>

<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="@">My Inventory System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item fw-bold">
          <a class="nav-link active" aria-current="page" href="index.php">Product Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>

      <div class="d-flex"> <!-- Wrap Welcome message and Logout link in a flex container -->
        <span class="nav-link navbar-text me-3 text-white">Welcome, <?php echo $_SESSION['username']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)</span>
        <a class="nav-link fw-bold text-white" href="?logout">Logout</a>
      </div>
    </div>
  </div>
</nav>


<!-- Form to create product -->
<form id="" method="POST" class="p-4" >
    <table class="table">
        <tbody>
            <tr>
                <td><input type="text" class="form-control" placeholder="name"  name="name" required></td>
                <td><input type="text" class="form-control" placeholder="place" name="place" required></td>
                <td><input type="text" class="form-control" placeholder="package" name="package" required></td>
                <td><input type="number" class="form-control" placeholder="Lead Count" name="lead_count" required></td>
                <td><input type="number" class="form-control" placeholder="Min Count" name="min_count" required></td>
                <td><input type="text" class="form-control" placeholder="Type 1" name="type1" required></td>
                <td><input type="text" class="form-control" placeholder="Type 2" name="type2" required></td>
                <td><input type="text" class="form-control" placeholder="Type 3" name="type3" required></td>
                <td><input type="text" class="form-control" placeholder="Type 4" name="type4" required></td>     
                <td><input type="submit" class="btn btn-success" value="Create Product" name="create_product"></td>                    
            </tr>
        </tbody>
    </table>
</form>


<!-- Main Product Table -->

<div class="p-4 ">
    <div class="d-flex my-2">
        <h2>Product Table</h2>
        <button class="btn btn-primary ms-auto" id="export-product-button">Export to CSV</button>
    </div>
    <table id="product-table" class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Place</th>
                <th>Package</th>
                <th>Lead Count</th>
                <th>Min Count</th>
                <th>Status</th>
                <th>Type 1</th>
                <th>Type 2</th>
                <th>Type 3</th>
                <th>Type 4</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['place']; ?></td>
                    <td><?php echo $product['package']; ?></td>
                    <td><?php echo $product['lead_count']; ?></td>
                    <td><?php echo $product['min_count']; ?></td>
                    <td>
                        <?php 
                            if($product['lead_count'] >= $product['min_count']){
                                echo "<span class='badge bg-success'> GOOD </span>";
                            }else{
                                echo "<span class='badge bg-danger'> WARNING </span>";
                            }
                        ?>
                    </td>
                    <td><?php echo $product['type1']; ?></td>
                    <td><?php echo $product['type2']; ?></td>
                    <td><?php echo $product['type3']; ?></td>
                    <td><?php echo $product['type4']; ?></td>
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



<!-- Action HISTORY -->

<?php 
$readSql = "SELECT * FROM histories ORDER BY timestamp DESC";
$result = mysqli_query($conn, $readSql);
$histories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<div class="p-4">
    <div class="my-2 d-flex">
        <h2>Action History</h2>
        <button class="ms-auto btn btn-primary" id="export-history-button">Export History to CSV</button>

    </div>

    <table id="history-table" class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($histories as $history) : ?>
                <tr>
                    <td><?php echo $history['username']; ?></td>
                    <td><?php echo getActionPill($history['action']); ?></td>
                    
                    <td><?php echo $history['description']; ?></td>
                    <td>
                        <span class="text-small text-muted">
                            <?php echo date("Y-m-d H:i:s", strtotime($history['timestamp'])); ?>
                        </span>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

    
    
</div>




<script src="js/script.js"></script>
</body>
</html>
