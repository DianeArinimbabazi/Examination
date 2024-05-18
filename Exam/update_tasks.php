<?php
// Include database connection
include('database_connection.php');

// Check if task_id is set in the request
if(isset($_REQUEST['task_id'])) {
    // Get task_id from the request
    $task_id = $_REQUEST['task_id'];
    
    // Prepare and execute SQL query to select tasks data by task_id
    $stmt = $connection->prepare("SELECT * FROM tasks WHERE task_id=?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if tasks data is found
    if($result->num_rows > 0) {
        // Fetch tasks data
        $row = $result->fetch_assoc();
        $task_id = $row['task_id']; // Store task_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $section_id = $row['section_id']; // Store 'section_id'
        $description = $row['description']; // Store 'description'
        $due_date = $row['due_date']; // Store 'due_date'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "tasks not found.";
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
    <!-- Update tasks form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="section_id">section_id:</label>
        <!-- Display section_id from database -->
        <input type="number" name="section_id" value="<?php echo isset($section_id) ? $section_id : ''; ?>">
        <br><br> 

        <label for="description">description:</label>
        <!-- Display description from database -->
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>

        <label for="due_date">due_date:</label>
        <!-- Display due_date from database -->
        <input type="date" name="due_date" value="<?php echo isset($due_date) ? $due_date : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store task_id -->
        <input type="hidden" name="task_id" value="<?php echo isset($task_id) ? $task_id : ''; ?>">
        <!-- Submit button to update tasks -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from tasks form
    $created_at = $_POST['created_at'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $section_id = $_POST['section_id'];
    $plan_id = $_POST['plan_id'];
    $task_id = $_POST['task_id']; 
    
    // Update the tasks in the database
    $stmt = $connection->prepare("UPDATE feedback SET created_at=?, due_date, description=?, section_id=?, plan_id=? WHERE task_id=?");
    $stmt->bind_param("sssssi", $created_at, $due_date, $description, $section_id, $plan_id, $task_id);
    $stmt->execute();
    
    // Redirect to tasks.php
    header('Location: tasks.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


