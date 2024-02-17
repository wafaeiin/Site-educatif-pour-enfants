<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      font-family: "Comic Sans MS", cursive, sans-serif;
      background-color: #f1f8ff;
      padding: 20px;
      text-align: center;
    }

    h1 {
      font-size: 28px;
      color: #ff4081;
    }

    p {
      font-size: 18px;
      color: #333;
    }

    form {
      display: inline-block;
      margin-top: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 10px;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      width: 200px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #ff4081;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #ff80ab;
    }
  </style>
</head>
<body>
  <h1>Login</h1>
  <?php
  session_start();
  echo $_POST["user"];
  echo $_POST["pass"];

  $host = "localhost";
  $logindb = "root";
  $passdb = "";
  $dbname = "wafaboudrar";

  // Create connection
  $conn = new mysqli($host, $logindb, $passdb, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
  echo "<br>";

  $sql = "SELECT username, password FROM users";
  $result = $conn->query($sql);

  $connected = false;
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
         if ($row["username"] == $_POST["user"] && $row["password"] == $_POST["pass"]) {
          $_SESSION["logged_user"] = $row["username"];
          $connected = true;
         }
      }
    } else {
      echo "0 results";
    }

    if ($connected == true) {
      if ($_SESSION["logged_user"] == "admin") {
        header('Location: admin.php');
      } else {
        header('Location: php.html');
      }
    } else {
      echo "<p>Login was unsuccessful</p>";
      header('Location: reconnexion.html');
    }
  ?>
  <form method="POST" action="login.php">
    <label for="user">Username:</label>
    <input type="text" name="user" required>
    <br>
    <label for="pass">Password:</label>
    <input type="password" name="pass" required>
    <br>
    <input type="submit" value="Login">
  </form>
</body>
</html>
