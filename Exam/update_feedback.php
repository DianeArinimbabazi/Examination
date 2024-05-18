<?php
// Include database connection
include('database_connection.php');

// Check if feedback_id is set in the request
if(isset($_REQUEST['feedback_id'])) {
    // Get feedback_id from the request
    $feedback_id = $_REQUEST['feedback_id'];
    
    // Prepare and execute SQL query to select feedback data by feedback_id
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE feedback_id=?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if feedback data is found
    if($result->num_rows > 0) {
        // Fetch feedback data
        $row = $result->fetch_assoc();
        $feedback_id = $row['feedback_id']; // Store feedback_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $section_id = $row['section_id']; // Store 'section_id'
        $rating = $row['rating']; // Store 'rating'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "feedback not found.";
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
    <!-- Update feedback form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="section_id">section_id:</label>
        <!-- Display section_id from database -->
        <input type="number" name="section_id" value="<?php echo isset($section_id) ? $section_id : ''; ?>">
        <br><br> 

        <label for="rating">rating:</label>
        <!-- Display rating from database -->
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store feedback_id -->
        <input type="hidden" name="feedback_id" value="<?php echo isset($feedback_id) ? $feedback_id : ''; ?>">
        <!-- Submit button to update feedback -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from feedback form
    $created_at = $_POST['created_at'];
    $rating = $_POST['rating'];
    $section_id = $_POST['section_id'];
    $plan_id = $_POST['plan_id'];
    $feedback_id = $_POST['feedback_id']; 
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET created_at=?, rating=?, section_id=?, plan_id=? WHERE feedback_id=?");
    $stmt->bind_param("ssssi", $created_at, $rating, $section_id, $plan_id, $feedback_id);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


