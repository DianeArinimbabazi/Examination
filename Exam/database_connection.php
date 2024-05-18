<?php
// Database credentials
$servername = "localhost";
$username = "Diannah";
$password = "222014124";
$database = "business_plan_builder_tool";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
