<?php
include_once('header.php');
?>

<!-- Action HISTORY -->

<?php 
$readSql = "SELECT * FROM histories ORDER BY timestamp DESC";
$result = mysqli_query($conn, $readSql);
$histories = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<div class="p-4">
    <div class="my-2 d-flex">
        <h2>Action History</h2>
        <button class="ms-auto btn btn-primary" id="export-history-button"><i class="bi bi-download"></i> Export History to CSV</button>
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