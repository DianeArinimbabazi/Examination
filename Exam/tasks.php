<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tasks Page</title>
  <style>
    /* CSS styles for the page */
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color:black;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: beige;
    }

    /* Unvisited link */
    a:link {
      color: beige;
    }

    /* Hover effect */
    a:hover {
      background-color: beige;
    }

    /* Active link */
    a:active {
      background-color: burlywood;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px;
      margin-top: 4px;
    }

    input.form-control {
      margin-left: 500px;
      padding: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Header style */
    header {
      background-color: beige;
      padding: 10px;
      text-align: center;
    }
    .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;

  }
  .dropdown-contents {
    display: none;
    position: absolute;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  </style>
</head>
<body style="background-image: url('./Images/task.jpg');background-repeat: no-repeat;background-size:cover;">
  <!-- Header section -->
  <header>
    <h1>Tasks</h1>
  </header>
  <!-- Search form -->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <!-- Navigation menu -->
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/logo.png" width="90" height="60" alt="Logo">
    </li>
    <!-- Navigation links -->
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attachments.php">Attachments</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./business_plans.php">Business_plans</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./collaborators.php">Collaborators</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./comments.php">Comments</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">Feedback</a>
    </li>  
    <li style="display: inline; margin-right: 10px;"><a href="./goals.php">Goals</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sections.php">Sections</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./tasks.php">Tasks</a>
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./templates.php">Templates</a>
    </li>
  <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

  <!-- Main content section -->
  <section>
    <!-- tasks Form -->
    <h1>Tasks Form</h1>
    <form method="post" onsubmit="return confirm('Are you sure you want to insert this record?');">
      <label for="task_id">task_id:</label>
      <input type="number" id="task_id" name="task_id"><br><br>

      <label for="plan_id">plan_id:</label>
      <input type="number" id="plan_id" name="plan_id" required><br><br>

      <label for="section_id">section_id:</label>
      <input type="number" id="section_id" name="section_id" required><br><br>

      <label for="description">description:</label>
      <input type="text" id="description" name="description"><br><br>

      <label for="due_date">due_date:</label>
      <input type="date" id="due_date" name="due_date"><br><br>

      <label for="created_at">created_at:</label>
      <input type="date" id="created_at" name="created_at"><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <!-- PHP code to insert data into database -->
    <?php
      include('database_connection.php');

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Prepare and bind parameters with appropriate data types
          $stmt = $connection->prepare("INSERT INTO tasks (task_id, plan_id, section_id, description, due_date,  created_at) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("iissss", $task_id, $plan_id , $section_id, $description, $due_date, $created_at);
          // Set parameters from POST data with validation (optional)
          $task_id = intval($_POST['task_id']); // Ensure integer for task_id
          $plan_id= intval($_POST['plan_id']); // Ensure integer for plan_id
          $section_id= intval($_POST['section_id']); // Ensure integer for section_id
          $description= htmlspecialchars($_POST['description']); // Prevent XSS
          $due_date= htmlspecialchars($_POST['due_date']); // Prevent XSS
          $created_at= htmlspecialchars($_POST['created_at']); // Prevent XSS

          // Execute prepared statement with error handling
          if ($stmt->execute()) {
              echo "New record has been added successfully!";
          } else {
              echo "Error: " . $stmt->error;
          }

          $stmt->close();
      }

      $connection->close();
    ?>

    <!-- tasks Table -->
    <h2>Tasks Table</h2>
    <table border="2">
      <tr>
        <th>task_id</th>
        <th>plan_id</th>
        <th>section_id</th>
        <th>description</th>
        <th>due_date</th>
        <th>created_at</th>
        <th>DELETE</th>
        <th>UPDATE</th>
      </tr>
      <?php
        include('database_connection.php');
        $sql = "SELECT * FROM tasks";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $task_id = $row['task_id']; // Update task_id variable
                echo "<tr>
                  <td>" . $row['task_id'] . "</td>
                  <td>" . $row['plan_id'] . "</td>
                  <td>" . $row['section_id'] . "</td>
                  <td>" . $row['description'] . "</td>
                  <td>" . $row['due_date'] . "</td>
                  <td>" . $row['created_at'] . "</td>

                  <td><a style='padding:4px' href='Delete_tasks.php?task_id=$task_id'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_tasks.php?task_id=$task_id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }

        $connection->close();
      ?>
    </table>
  </section>
  <!-- Footer section -->
  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy 2024 Designed by: @Diane ARINIMBABAZI</h2></b>
    </center>
  </footer>
</body>
</html>
