<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>business_plans page</title>
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
<body style="background-image: url('./Images/ab.jpg');background-repeat: no-repeat;background-size:cover;">
  <!-- Header section -->
  <header>
    <h1>Business_Plans</h1>
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
      <a href="#" style="padding: 10px; color:white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
    <!-- business_plans Form -->
    <h1>Business_plans Form</h1>
    <form method="post" onsubmit="return confirm('Are you sure you want to insert this record?');">
      <label for="plan_id">plan_id:</label>
      <input type="number" id="plan_id" name="plan_id"><br><br>

      <label for="title">title:</label>
      <input type="text" id="title" name="title" required><br><br>

      <label for="created_at">created_at:</label>
      <input type="date" id="created_at" name="created_at"><br><br>

      <label for="updated_at">updated_at:</label>
      <input type="date" id="updated_at" name="updated_at"><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <!-- PHP code to insert data into database -->
    <?php
      include('database_connection.php');

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Prepare and bind parameters with appropriate data types
          $stmt = $connection->prepare("INSERT INTO business_plans (plan_id, title, created_at, updated_at) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("isss", $plan_id, $title, $created_at, $updated_at);

          // Set parameters from POST data with validation (optional)
          $plan_id = intval($_POST['plan_id']); // Ensure integer for plan_id
          $title= intval($_POST['title']); // Ensure integer for title
          $created_at= htmlspecialchars($_POST['created_at']); // Prevent XSS
          $updated_at= htmlspecialchars($_POST['updated_at']); // Prevent XSS

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

    <!-- Attachments Table -->
    <h2>Business_Plans Table</h2>
    <table border="2">
      <tr>
        <th>PLAN_ID</th>
        <th>TITLE</th>
        <th>CREATED_AT</th>
        <th>UPDATED_AT</th>
        <th>DELETE</th>
        <th>UPDATE</th>
      </tr>
      <?php
        include('database_connection.php');

        $sql = "SELECT * FROM business_plans";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $plan_id = $row['plan_id']; // Update plan_id variable
                echo "<tr>
                  <td>" . $row['plan_id'] . "</td>
                  <td>" . $row['title'] . "</td>
                  <td>" . $row['created_at'] . "</td>
                  <td>" . $row['updated_at'] . "</td>

                  <td><a style='padding:4px' href='Delete_business_plans.php?plan_id=$plan_id'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_business_plans.php?plan_id=$plan_id'>Update</a></td> 
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
