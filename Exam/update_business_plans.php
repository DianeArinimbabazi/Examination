<?php
// Include database connection
include('database_connection.php');

// Check if plan_id is set in the request
if(isset($_REQUEST['plan_id'])) {
    // Get plan_id from the request
    $plan_id = $_REQUEST['plan_id'];
    
    // Prepare and execute SQL query to select business_plans data by plan_id
    $stmt = $connection->prepare("SELECT * FROM business_plans WHERE plan_id=?");
    $stmt->bind_param("i", $plan_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if business_plans data is found
    if($result->num_rows > 0) {
        // Fetch business_plans data
        $row = $result->fetch_assoc();
        $plan_id = $row['plan_id']; // Store plan_id
        $title = $row['title']; // Store 'title'
        $created_at = $row['created_at']; // Store 'created_at'
        $updated_at = $row['updated_at']; // Store 'updated_at'

    } else {
        echo "business_plans not found.";
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
    <!-- Update business_plans form -->
    <form method="POST">
        <label for="title">title:</label>
        <!-- Display title from database -->
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br>
        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br> 

        <label for="updated_at">updated_at:</label>
        <!-- Display updated_at from database -->
        <input type="date" name="updated_at" value="<?php echo isset($updated_at) ? $updated_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store plan_id -->
        <input type="hidden" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <!-- Submit button to update business_plans -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from business_plans form
    $updated_at = $_POST['updated_at'];
    $created_at = $_POST['created_at'];
    $title = $_POST['title'];
    $plan_id = $_POST['plan_id']; 
    
    // Update the business_plans in the database
    $stmt = $connection->prepare("UPDATE business_plans SET updated_at=?, created_at=?, title=? WHERE plan_id=?");
    $stmt->bind_param("sssi", $updated_at, $created_at, $title, $plan_id);
    $stmt->execute();
    
    // Redirect to business_plans.php
    header('Location: business_plans.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


