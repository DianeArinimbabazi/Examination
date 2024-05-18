<?php
// Include database connection
include('database_connection.php');
// Check if goal_id is set in the request
if(isset($_REQUEST['goal_id'])) {
    // Get goal_id from the request
    $goal_id = $_REQUEST['goal_id'];
    
    // Prepare and execute SQL query to select goals data by goal_id
    $stmt = $connection->prepare("SELECT * FROM goals WHERE goal_id=?");
    $stmt->bind_param("i", $goal_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if goals data is found
    if($result->num_rows > 0) {
        // Fetch goals data
        $row = $result->fetch_assoc();
        $goal_id = $row['goal_id']; // Store goal_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $description = $row['description']; // Store 'description'
        $target_date = $row['target_date']; // Store 'target_date'
        $status = $row['status']; // Store 'status'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "goals not found.";
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
    <!-- Update goals form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="description">description:</label>
        <!-- Display description from database -->
        <input type="number" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br> 

        <label for="target_date">target_date:</label>
        <!-- Display target_date from database -->
        <input type="date" name="target_date" value="<?php echo isset($target_date) ? $target_date : ''; ?>">
        <br><br>

        <label for="status">status:</label>
        <!-- Display status from database -->
        <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store goal_id -->
        <input type="hidden" name="goal_id" value="<?php echo isset($goal_id) ? $goal_id : ''; ?>">
        <!-- Submit button to update goals -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from goals form
    $created_at = $_POST['created_at'];
    $status = $_POST['status'];
    $target_date = $_POST['target_date'];
    $description = $_POST['description'];
    $plan_id = $_POST['plan_id'];
    $goal_id = $_POST['goal_id']; 
    
    // Update the goals in the database
    $stmt = $connection->prepare("UPDATE feedback SET created_at=?, status, target_date=?, description=?, plan_id=? WHERE goal_id=?");
    $stmt->bind_param("sssssi", $created_at, $status, $target_date, $description, $plan_id, $goal_id);
    $stmt->execute();
    
    // Redirect to goals.php
    header('Location: goals.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


