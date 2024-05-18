<?php
// Include database connection
include('database_connection.php');

// Check if section_id is set in the request
if(isset($_REQUEST['section_id'])) {
    // Get section_id from the request
    $section_id = $_REQUEST['section_id'];
    
    // Prepare and execute SQL query to select sections data by section_id
    $stmt = $connection->prepare("SELECT * FROM sections WHERE section_id=?");
    $stmt->bind_param("i", $section_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if sections data is found
    if($result->num_rows > 0) {
        // Fetch sections data
        $row = $result->fetch_assoc();
        $section_id = $row['section_id']; // Store section_id
        $plan_id = $row['plan_id']; // Store 'plan_id'
        $title = $row['title']; // Store 'title'
        $order_index = $row['order_index']; // Store 'order_index'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "sections not found.";
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
    <!-- Update sections form -->
    <form method="POST">
        <label for="plan_id">plan_id:</label>
        <!-- Display plan_id from database -->
        <input type="number" name="plan_id" value="<?php echo isset($plan_id) ? $plan_id : ''; ?>">
        <br><br>
        <label for="title">title:</label>
        <!-- Display title from database -->
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br> 

        <label for="order_index">order_index:</label>
        <!-- Display order_index from database -->
        <input type="number" name="order_index" value="<?php echo isset($order_index) ? $order_index : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store section_id -->
        <input type="hidden" name="section_id" value="<?php echo isset($section_id) ? $section_id : ''; ?>">
        <!-- Submit button to update sections -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from sections form
    $created_at = $_POST['created_at'];
    $order_index = $_POST['order_index'];
    $title = $_POST['title'];
    $plan_id = $_POST['plan_id'];
    $section_id = $_POST['section_id']; 
    
    // Update the sections in the database
    $stmt = $connection->prepare("UPDATE attachments SET created_at=?, order_index=?, title=?, plan_id=? WHERE section_id=?");
    $stmt->bind_param("ssssi", $created_at, $order_index, $title, $plan_id, $section_id);
    $stmt->execute();
    
    // Redirect to sections.php
    header('Location: sections.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


