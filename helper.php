<?php
function showToast($message, $type){
    echo '<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 100;">
    <div class="toast-container position-fixed bottom-0 end-0 m-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
            <div class="toast-header">
                <span class="bg-' .$type. ' px-2 rounded">&nbsp;</span>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                '.$message.'
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".toast").toast("show");
    });
</script>';
}

// ### Create History Database
function createHistory($conn, $action, $description){
    $currentUser = $_SESSION['username'];
    $insertSql = "INSERT INTO histories (username , action, description) VALUES ('$currentUser', '$action', '$description')";
    if (mysqli_query($conn, $insertSql)) {
        header("Location: index.php");
    }
}

function getProductById($conn, $productId) {
    $productId = mysqli_real_escape_string($conn, $productId); // Sanitize input
    $query = "SELECT * FROM products WHERE id = '$productId'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        return $product;
    } else {
        return null; // Product not found
    }
}

// for history table actions
function getActionPill($action) {
    
    switch ( strtolower($action)) {
        case 'create':
            return '<span class="badge rounded-pill bg-success">'. strtoupper($action) .'</span>'; // Green
            
        case 'update':
            return '<span class="badge rounded-pill bg-primary">'. strtoupper($action) .'</span>'; // blue
        case 'delete':
            return '<span class="badge rounded-pill bg-danger">'. strtoupper($action) .'</span>'; // red
        default:
            return $action;
    }
}

?>