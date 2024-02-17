<html>
<head>
<style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .image-container img {
            margin: 50px;
            width: 250px;
        }
    </style>
</head>
<body>
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
    
    $sql = "SELECT id FROM fruits";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<div class="image-container">';

        while ($row = $result->fetch_assoc()) {
            $audioFilePath = "./fruits/fruits audio/" . $row["id"] . ".mp3";
            $imageFilePath = "./fruits/fruits divided/" . $row["id"] . ".png";
            
            echo '<img src="' . $imageFilePath . '" alt="Image" onclick="playSound(\'' . $audioFilePath . '\')" style="cursor: pointer;">';
        }
        echo '</div>';

    }
    
    $conn->close();
    ?>

    <script>
        function playSound(audioFilePath) {
            var audio = new Audio(audioFilePath);
            audio.play();
        }
    </script>
</body>
</html>