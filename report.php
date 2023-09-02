<?php
include_once('header.php');
?>

<!-- Action HISTORY -->

<?php 
$readSql = "SELECT * FROM histories ORDER BY timestamp DESC";
$result = mysqli_query($conn, $readSql);
$histories = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if ($_SESSION['role'] === 'admin') {
        $deleteCount = intval($_POST['deleteCount']); // Get the count from the form

        // Delete the oldest history records based on the $deleteCount
        $deleteSql = "DELETE FROM histories ORDER BY timestamp ASC LIMIT $deleteCount";
        if (mysqli_query($conn, $deleteSql)) {
            // Redirect back to the report page or another suitable page
            header("Location: report.php");
            exit;
        } else {
            // Handle the case where deletion fails
            echo "Error deleting history: " . mysqli_error($conn);
        }
    } else {
        // Display a message indicating that the user doesn't have permission
        echo "You don't have permission to delete history.";
    }
}
?>






<div class="p-4">

    


    <div class="my-2 d-flex justify-content-between">
        <h2>Action History</h2>
        <div class="d-flex flex-column gap-2">

            
            <button class="ms-auto btn btn-primary" id="export-history-button"><i class="bi bi-download"></i> Export History to CSV</button>
            <?php
                if ($_SESSION['role'] === 'admin') {
                // Only show the delete form to admin users
            ?>
                <form method="POST" action="">
                    <!-- Form fields to specify the number of history records to delete -->
                    <label for="deleteCount">Number of Records to Delete:</label>
                    <input class="" type="number" name="deleteCount" id="deleteCount" min="1" required>
                    <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete history records?');">Delete History</button>
                </form>

            <?php
                }
            ?>

        </div>
        
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


<script>
    $(document).ready(function() {
    $('#history-table').DataTable({
            columnDefs: [
                // { width: '20%', targets: 0 }, 
            ],
            order: [[3, 'desc']]
        });
});
</script>



<?php

include_once('footer.php');

?>








































<?php
include_once('footer.php');
?>