<?php
include('database_connection.php');

// Check if the query parameter is set
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'attachments' => "SELECT file_name FROM attachments WHERE file_name LIKE '%$searchTerm%'",
        'business_plans' => "SELECT title FROM business_plans WHERE title LIKE '%$searchTerm%'",
        'collaborators' => "SELECT collaboration_id FROM collaborators WHERE collaboration_id LIKE '%$searchTerm%'",
        'comments' => "SELECT comment_text FROM comments WHERE comment_text LIKE '%$searchTerm%'",
        'feedback' => "SELECT created_at FROM feedback WHERE created_at LIKE '%$searchTerm%'",
        'goals' => "SELECT goal_id FROM goals WHERE goal_id LIKE '%$searchTerm%'",
        'sections' => "SELECT title FROM sections WHERE title LIKE '%$searchTerm%'",
        'tasks' => "SELECT due_date FROM tasks WHERE due_date LIKE '%$searchTerm%'",
        'templates' => "SELECT template_id FROM templates WHERE template_id LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>


