<?php
include('database_connection.php');
// Check if comment_id is set
if(isset($_REQUEST['comment_id'])) {
    $comment_id = $_REQUEST['comment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM comments WHERE comment_id=?");
    $stmt->bind_param("i", $comment_id); // Corrected binding parameter
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
            <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='comments.php'>OK</a>";
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
    echo "comment_id is not set.";
}

$connection->close();
?>