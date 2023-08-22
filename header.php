<?php

session_start(); //start session
include_once('db.php');
include_once('helper.php');


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

// to check current page is what, then assign active to the nav button
$currentPage = basename($_SERVER['PHP_SELF'], ".php");

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
    <link rel="stylesheet" href="datatables/datatables.css">
    <script src="js/papaparse.js"></script>
</head>
<body>

<!-- top navigation bar -->
<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark w-100 bg-success px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">My Inventory System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item fw-bold">
          <a class="nav-link <?php if($currentPage === 'index') echo 'active'; ?>" href="index.php">Product Dashboard</a>
        </li>
        <li class="nav-item fw-bold">
          <a class="nav-link <?php if($currentPage === 'add-product') echo 'active'; ?>" href="add-product.php">Add Product</a>
        </li>
        <li class="nav-item fw-bold">
          <a class="nav-link <?php if($currentPage === 'status') echo 'active'; ?>" href="status.php">Status</a>
        </li>
        <li class="nav-item fw-bold">
          <a class="nav-link <?php if($currentPage === 'remark') echo 'active'; ?>" href="remark.php">Remark</a>
        </li>
        <li class="nav-item fw-bold">
          <a class="nav-link <?php if($currentPage === 'report') echo 'active'; ?>" href="report.php">Report</a>
        </li>
      </ul>

      <div class="d-flex"> <!-- Wrap Welcome message and Logout link in a flex container -->
        <span class="nav-link navbar-text me-3 text-white">Welcome, <?php echo $_SESSION['username']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)</span>
        <a class="nav-link fw-bold text-white" href="?logout">Logout</a>
      </div>
    </div>
  </div>
</nav>


<!-- toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

<script>
function showToast(message, type) {
    const toast = $(`<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                      <div class="toast-header">
                        <strong class="me-auto">${type}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                      <div class="toast-body">
                        ${message}
                      </div>
                    </div>`);

    $('.toast-container').append(toast);

    toast.toast('show');
}

function goalert(msg){
  alert(msg)
}
</script>