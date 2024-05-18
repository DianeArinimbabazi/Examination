<?php
// Include database connection
include('database_connection.php');
// Check if collaboration_id is set in the request
if(isset($_REQUEST['collaboration_id'])) {
    // Get collaboration_id from the request
    $collaboration_id = $_REQUEST['collaboration_id'];
    
    // Prepare and execute SQL query to select collaborators data by collaboration_id
    $stmt = $connection->prepare("SELECT * FROM collaborators WHERE collaboration_id=?");
    $stmt->bind_param("i", $collaboration_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if collaborators data is found
    if($result->num_rows > 0) {
        // Fetch collaborators data
        $row = $result->fetch_assoc();
        $collaboration_id = $row['collaboration_id']; // Store collaboration_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $role = $row['role']; // Store 'role'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "collaborators not found.";
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
    <!-- Update collaborators form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="role">role:</label>
        <!-- Display role from database -->
        <input type="text" name="role" value="<?php echo isset($role) ? $role : ''; ?>">
        <br><br> 

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br> 


        <!-- Hidden input field to store collaboration_id -->
        <input type="hidden" name="collaboration_id" value="<?php echo isset($collaboration_id) ? $collaboration_id : ''; ?>">
        <!-- Submit button to update collaborators -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from collaborators form
    $created_at = $_POST['created_at'];
    $role = $_POST['role'];
    $plan_id = $_POST['plan_id'];
    $collaboration_id = $_POST['collaboration_id']; 
    
    // Update the collaborators in the database
    $stmt = $connection->prepare("UPDATE collaborators SET created_at=?,role=?, plan_id=? WHERE collaboration_id=?");
    $stmt->bind_param("sssi", $created_at, $role, $plan_id, $collaboration_id);
    $stmt->execute();
    
    // Redirect to collaborators.php
    header('Location: collaborators.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


