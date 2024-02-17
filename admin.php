<html>
<head>
  <title>ADMIN</title>
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

    .search-bar {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }

    .search-input {
      padding: 10px;
      font-size: 18px;
      border: none;
      border-radius: 20px;
      margin-right: 10px;
      width: 300px;
    }

    ::placeholder {
      font-size: 14px;
    }

    .search-button {
      padding: 10px 20px;
      font-size: 18px;
      background-color: burlywood;
      border: none;
      border-radius: 20px;
      cursor: pointer;
    }

    .table-list {
      margin-top: 20px;
      list-style-type: none;
      padding: 0;
    }

    .table-list-item {
      margin-bottom: 10px;
    }

    .table-list-item a {
      display: block;
      padding: 10px;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 4px;
      text-decoration: none;
      color: #333;
    }

    .table-list-item a:hover {
      background-color: #e6e6e6;
    }

    .add-button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 18px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 20px;
      text-decoration: none;
      cursor: pointer;
    }

    .add-button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Tables in the database:</h1>
    <ul class="table-list">
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
        while ($row = mysqli_fetch_row($result)) {
          echo '<li class="table-list-item"><a href="searchADMIN.php?search=' . $row[0] . '">' . $row[0] . '</a></li>';
        }
      }

      $conn->close();
      ?>
    </ul>

    <form action="searchADMIN.php" method="get" class="search-bar">
      <input type="text" class="search-input" name="search" placeholder="Enter table name">
      <input type="submit" class="search-button" value="Search">
    </form>

    <?php
    if (isset($_GET['search'])) {
      $table = $_GET['search'];
      echo '<a href="add.php?search=' . $table . '" class="add-button">Add new record</a>';
    }
    ?>
  </div>
</body>
</html>

