<!DOCTYPE html>
<html>
<head>
  <title>Search Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .table-list {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .table-list li {
      margin-bottom: 10px;
    }

    .table-list li a {
      display: block;
      padding: 10px;
      background-color: #f2f2f2;
      color: #333;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    .table-list li a:hover {
      background-color: #e2e2e2;
    }

    .search-form {
      display: flex;
      margin-bottom: 20px;
    }

    .search-input {
      flex-grow: 1;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .search-button {
      padding: 10px 15px;
      font-size: 16px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-button:hover {
      background-color: #45a049;
    }

    .search-results {
      margin-bottom: 20px;
    }

    .search-results h2 {
      margin-bottom: 10px;
    }

    .search-results .record {
      padding: 10px;
      background-color: #f2f2f2;
      margin-bottom: 10px;
      border-radius: 4px;
    }

    .search-results .record .delete-btn {
      background-color: #f44336;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 5px 10px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-results .record .delete-btn:hover {
      background-color: #d32f2f;
    }

    .add-link {
      display: block;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Search Page</h1>
    
    <?php
    $host = "localhost";
    $logindb = "root";
    $passdb = "";
    $dbname = "wafaboudrar";

    // Create connection
    $conn = new mysqli($host, $logindb, $passdb, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<ul class='table-list'>";
      echo "<li><h2>Tables in the database:</h2></li>";
      while ($row = mysqli_fetch_row($result)) {
        echo "<li><a href='search.php?search=" . $row[0] . "'>" . $row[0] . "</a></li>";
      }
      echo "</ul>";
    }

    if (isset($_GET['search'])) {
      $table = $_GET['search'];

      // Query the database with the search term as the table name
      $sql = "SELECT * FROM `$table`";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          echo "<div class='search-results'>";
          echo "<h2>Search results for table '$table':</h2>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='record'>";
            foreach ($row as $column => $value) {
              echo "$column: $value<br>";
            }
            echo "<button class='delete-btn' onclick=\"deleteRecord('$table', '{$row['id']}')\">Delete</button>";
            echo "</div>";
          }
          echo "</div>";
        } else {
          echo "<p>No records found for table '$table'.</p>";
        }
      } else {
        echo "Error: " . mysqli_error($conn);
      }

      // Add link to the Add page
      echo '<a class="add-link" href="add.php?search=' . $table . '">Add New Record</a>';
    }

    $conn->close();
    ?>
  </div>

  <script>
    function deleteRecord(table, id) {
      if (confirm("Are you sure you want to delete this record?")) {
        window.location.href = `delete.php?table=${table}&id=${id}`;
      }
    }
  </script>
</body>
</html>
