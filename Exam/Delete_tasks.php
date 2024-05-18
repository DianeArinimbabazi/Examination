<?php
include('database_connection.php');
// Check if plan_id is set
if(isset($_REQUEST['task_id'])) {
    $task_id = $_REQUEST['task_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM tasks WHERE task_id=?");
    $stmt->bind_param("i", $task_id); // Corrected binding parameter
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='tasks.php'>OK</a>";
            } else {
                echo "Error deleting data: " . $stmt->error;
            }
        }
        ?>
    </body>
    </html>
    <?php
    $stmt->close();
} else {
    echo "task_id is not set.";
}

$connection->close();
?>