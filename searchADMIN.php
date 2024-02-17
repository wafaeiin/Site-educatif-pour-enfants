<html>
<head>
  <title>Delete Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      margin-top: 0;
    }

    .record {
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: #f9f9f9;
    }

    .record p {
      margin: 0;
    }

    .delete-button {
      background-color: #e74c3c;
      color: #fff;
      padding: 5px 10px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .delete-button:hover {
      background-color: #c0392b;
    }

    .add-button {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .add-button:hover {
      background-color: #2980b9;
    }

    .add-link {
      margin-top: 20px;
      text-align: center;
    }

    .add-link a {
      color: #3498db;
      text-decoration: none;
    }

    .add-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    // Check if the table name is provided via GET parameter
    if (isset($_GET['search'])) {
      $table = $_GET['search'];

      $host = "localhost";
      $logindb = "root";
      $passdb = "";
      $dbname = "wafaboudrar";

      // Create connection
      $conn = new mysqli($host, $logindb, $passdb, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Select all records from the specified table
      $sql = "SELECT * FROM `$table`";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<h1>Records in table '$table':</h1>";

        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='record'>";
          foreach ($row as $column => $value) {
            echo "<p>$column: $value</p>";
          }
          ?>
          <form method="POST" action="delete.php">
            <input type="hidden" name="table" value="<?php echo $table; ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="submit" class="delete-button" value="Delete" onclick="return confirm('Are you sure you want to delete this record?')">
          </form>
          <?php
          echo "</div>";
        }
      } else {
        echo "<p>No records found in table '$table'.</p>";
      }

      $conn->close();
    } else {
      echo "<p>Table name not provided.</p>";
    }
    echo '<div class="add-link"><a href="add.php?search=' . $table . '"><button class="add-button">Add New Record</button></a></div>';

    ?>
  </div>

</body>
</html>
