<html>
<head>
  <title>Add Record</title>
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

    h2 {
      font-size: 24px;
      margin-top: 0;
    }

    form {
      margin-top: 20px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="file"] {
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      width: 100%;
    }

    input[type="submit"] {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #2980b9;
    }

    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
  
    if (isset($_GET['search'])) {
      $table = $_GET['search'];

      $host = "localhost";
      $logindb = "root";
      $passdb = "";
      $dbname = "wafaboudrar";

     
      $conn = new mysqli($host, $logindb, $passdb, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $value = $_POST['value'];

      
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

       
        $directory = $_POST['directory'];
        $uploadDir = './' . $directory . '/'; // 

       
        $filePath = $uploadDir . $fileName;

        if ($fileError === 0) {
          if (move_uploaded_file($fileTmpName, $filePath)) {
         
            $sql = "INSERT INTO `$table` (`value`, `file`) VALUES ('$value', '$fileName')";
            if ($conn->query($sql) === TRUE) {
              echo "<p>Value added successfully.</p>";
            } else {
              echo "<p class='error-message'>Error adding value: " . $conn->error . "</p>";
            }
          } else {
            echo "<p class='error-message'>Error uploading file.</p>";
          }
        } else {
          echo "<p class='error-message'>Error uploading file: " . $fileError . "</p>";
        }
      }
    ?>
    <h2>Add Value to Table '<?php echo $table; ?>'</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
      <input type="hidden" name="table" value="<?php echo $table; ?>">
      <label for="value">Value:</label>
      <input type="text" name="value" required>
      <br>
      <label for="file">Image File:</label>
      <input type="file" name="file" accept="image/*" required>
      <br>
      <label for="audio">Audio File:</label>
      <input type="file" name="audio" accept="audio/*" required>
      <br>
      <label for="directory">Upload Directory:</label>
      <input type="text" name="directory" required>
      <br>
      <input type="submit" value="Add">
    </form>
    <?php
      $conn->close();
    } else {
      echo "<p>Table name not provided.</p>";
    }
    ?>
  </div>
</body>
</html>
