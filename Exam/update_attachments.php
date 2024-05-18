<?php
// Include database connection
include('database_connection.php');

// Check if attachment_id is set in the request
if(isset($_REQUEST['attachment_id'])) {
    // Get attachment_id from the request
    $attachment_id = $_REQUEST['attachment_id'];
    
    // Prepare and execute SQL query to select attachments data by attachment_id
    $stmt = $connection->prepare("SELECT * FROM attachments WHERE attachment_id=?");
    $stmt->bind_param("i", $attachment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if attachments data is found
    if($result->num_rows > 0) {
        // Fetch attachments data
        $row = $result->fetch_assoc();
        $attachment_id = $row['attachment_id']; // Store attachment_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $section_id = $row['section_id']; // Store 'section_id'
        $file_name = $row['file_name']; // Store 'file_name'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "attachments not found.";
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
    <!-- Update attachments form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="section_id">section_id:</label>
        <!-- Display section_id from database -->
        <input type="number" name="section_id" value="<?php echo isset($section_id) ? $section_id : ''; ?>">
        <br><br> 

        <label for="file_name">file_name:</label>
        <!-- Display file_name from database -->
        <input type="text" name="file_name" value="<?php echo isset($file_name) ? $file_name : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store attachment_id -->
        <input type="hidden" name="attachment_id" value="<?php echo isset($attachment_id) ? $attachment_id : ''; ?>">
        <!-- Submit button to update attachments -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from attachments form
    $created_at = $_POST['created_at'];
    $file_name = $_POST['file_name'];
    $section_id = $_POST['section_id'];
    $plan_id = $_POST['plan_id'];
    $attachment_id = $_POST['attachment_id']; 
    
    // Update the attachments in the database
    $stmt = $connection->prepare("UPDATE attachments SET created_at=?, file_name=?, section_id=?, plan_id=? WHERE attachment_id=?");
    $stmt->bind_param("ssssi", $created_at, $file_name, $section_id, $plan_id, $attachment_id);
    $stmt->execute();
    
    // Redirect to attachments.php
    header('Location: attachments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


