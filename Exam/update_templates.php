<?php
// Include database connection
include('database_connection.php');


// Check if template_id is set in the request
if(isset($_REQUEST['template_id'])) {
    // Get template_id from the request
    $template_id = $_REQUEST['template_id'];
    
    // Prepare and execute SQL query to select templates data by template_id
    $stmt = $connection->prepare("SELECT * FROM templates WHERE template_id=?");
    $stmt->bind_param("i", $template_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if templates data is found
    if($result->num_rows > 0) {
        // Fetch templates data
        $row = $result->fetch_assoc();
        $template_id = $row['template_id']; // Store template_id
        $name = $row['name']; // Store 'name'
        $description = $row['description']; // Store 'description'
        $created_at = $row['created_at']; // Store 'created_at'
        $updated_at = $row['updated_at']; // Store 'updated_at'

    } else {
        echo "templates not found.";
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
    <!-- Update templates form -->
    <form method="POST">
        <label for="name">name:</label>
        <!-- Display name from database -->
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>
        <label for="description">description:</label>
        <!-- Display description from database -->
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br> 

        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <label for="updated_at">updated_at:</label>
        <!-- Display updated_at from database -->
        <input type="date" name="updated_at" value="<?php echo isset($updated_at) ? $updated_at : ''; ?>">

        <!-- Hidden input field to store template_id -->
        <input type="hidden" name="template_id" value="<?php echo isset($template_id) ? $template_id : ''; ?>">
        <!-- Submit button to update templates -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from templates form
    $updated_at = $_POST['updated_at'];
    $created_at = $_POST['created_at'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $template_id = $_POST['template_id']; 
    
    // Update the templates in the database
    $stmt = $connection->prepare("UPDATE attachments SET updated_at=?, created_at=?,  description=?, name=? WHERE template_id=?");
    $stmt->bind_param("ssssi", $updated_at,  $created_at, $description, $name, $template_id);
    $stmt->execute();
    
    // Redirect to templates.php
    header('Location: templates.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


