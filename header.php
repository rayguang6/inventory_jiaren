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
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item ms-4 fs-5">
          <a class="nav-link <?php if($currentPage === 'index') echo 'active fw-bold'; ?>" href="index.php">Product Dashboard</a>
        </li>
        <li class="nav-item ms-4 fs-5">
          <a class="nav-link <?php if($currentPage === 'add-product') echo 'active fw-bold'; ?>" href="add-product.php">Add Product</a>
        </li>
        <li class="nav-item ms-4 fs-5">
          <a class="nav-link <?php if($currentPage === 'status') echo 'active fw-bold'; ?>" href="status.php">Status</a>
        </li>
        <li class="nav-item ms-4 fs-5">
          <a class="nav-link <?php if($currentPage === 'remark') echo 'active fw-bold'; ?>" href="remark.php">Remark</a>
        </li>
        <li class="nav-item ms-4 fs-5">
          <a class="nav-link <?php if($currentPage === 'report') echo 'active fw-bold'; ?>" href="report.php">Report</a>
        </li>
      </ul>

      <div class="d-flex"> <!-- Wrap Welcome message and Logout link in a flex container -->
        <span class="nav-link navbar-text me-3 text-white">Welcome, <?php echo $_SESSION['username']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)</span>
        <a class="nav-link fw-bold text-white" href="?logout">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
          </svg>  
        Logout</a>
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