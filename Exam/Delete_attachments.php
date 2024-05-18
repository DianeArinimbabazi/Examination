<?php
include('database_connection.php');
// Check if attachment_id is set
if(isset($_REQUEST['attachment_id'])) {
    $attachment_id = $_REQUEST['attachment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM attachments WHERE attachment_id=?");
    $stmt->bind_param("i", $attachment_id); // Corrected binding parameter
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
            <input type="hidden" name="attachment_id" value="<?php echo $attachment_id; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='attachments.php'>OK</a>";
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
    echo "attachments is not set.";
}

$connection->close();
?>