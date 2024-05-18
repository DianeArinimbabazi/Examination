<?php
// Include database connection
include('database_connection.php');

// Check if comment_id is set in the request
if(isset($_REQUEST['comment_id'])) {
    // Get comment_id from the request
    $comment_id = $_REQUEST['comment_id'];
    
    // Prepare and execute SQL query to select comments data by comment_id
    $stmt = $connection->prepare("SELECT * FROM comments WHERE comment_id=?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if comments data is found
    if($result->num_rows > 0) {
        // Fetch comments data
        $row = $result->fetch_assoc();
        $comment_id = $row['comment_id']; // Store comment_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $section_id = $row['section_id']; // Store 'section_id'
        $comment_text = $row['comment_text']; // Store 'comment_text'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "comments not found.";
    }
}
?>

<html>
<head>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update comments form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="section_id">section_id:</label>
        <!-- Display section_id from database -->
        <input type="number" name="section_id" value="<?php echo isset($section_id) ? $section_id : ''; ?>">
        <br><br> 

        <label for="comment_text">comment_text:</label>
        <!-- Display comment_text from database -->
        <input type="text" name="comment_text" value="<?php echo isset($comment_text) ? $comment_text : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store comment_id -->
        <input type="hidden" name="comment_id" value="<?php echo isset($comment_id) ? $comment_id : ''; ?>">
        <!-- Submit button to update comments -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from comments form
    $created_at = $_POST['created_at'];
    $comment_text = $_POST['comment_text'];
    $section_id = $_POST['section_id'];
    $plan_id = $_POST['plan_id'];
    $comment_id = $_POST['comment_id']; 
    
    // Update the comments in the database
    $stmt = $connection->prepare("UPDATE comments SET created_at=?, comment_text=?, section_id=?, plan_id=? WHERE comment_id=?");
    $stmt->bind_param("ssssi", $created_at, $comment_text, $section_id, $plan_id, $comment_id);
    $stmt->execute();
    
    // Redirect to comments.php
    header('Location: comments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


