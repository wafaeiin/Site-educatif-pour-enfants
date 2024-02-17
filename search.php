
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
    
    $sql = "SELECT id FROM countries";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
       
        while ($row = $result->fetch_assoc()) {
            if ($row["id"]=$_GET["search"]){
                $imageFilePath = "./countries/" . $row["id"] . ".png";
            
                echo '<img class = "center" src="' . $imageFilePath . '" alt="We could not find the country you re looking for , maybe check the spelling !"';
            }
           
        }
    }
    

    ?>
    
<!DOCTYPE html>
<html>
<head>
  <title>Story time</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <style>
    body {
      background-color: #f68dff;
      font-size: x-large;
      background-image: url(geoBG.png);
      min-height: 100%;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
    }

    .container {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      text-align: center;
      font-size: 3em;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      animation: colorChange 2s infinite; /* Animation to change colors */
      
    }

    h2 {
      text-align: center;
      font-size: 2em;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      color: #000000;
      font-weight: bold;
    }

    .home-icon {
      position: absolute;
      top: 30px;
      left: 90px;
      font-size: 40px;
      color: #000000d6;
    }

    @keyframes colorChange {
      0% { color: #ff0000; } /* Red */
      33% { color: #00ff00; } /* Green */
      66% { color: #0000ff; } /* Blue */
      100% { color: #ff00ff; } /* Magenta */
    }
    .center {
      display: flex;
      height: 100%;
      width: 80%;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 100px;
      padding-left: 10%;
    }

    .image {
      width: 500px;
      height: 450px;
      background-image: url('earth.png'); 
      background-size: cover;
      background-position: center;
      margin-bottom: 20px;
    }
    
    .search-bar {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 50px;
    }

    .search-input {
      padding: 10px;
      font-size: 2em;
      font-size: larger;
    }

    ::placeholder {
      font-size: 0.8em;
    }

    .search-button {
      padding: 10px 10px;
      font-size: 1.2em;
      background-color: #00ff00;
      border: none;
      border-radius: 20px;
      margin-left: 10px;
      
    }

    .image-text-container {
      position: relative;
      padding-top: 5%;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }
  

    .image-text-container img {
      padding-left: 30%;
      position: absolute;
      background-position: center;
      top: 0;
      left: 0;
      transition: visibility 0s;
    }

    .image-text-container:hover img {
      visibility: hidden;
    }

    .image-text-container:hover::after {
      content: "";
      display: block;
      width: 800px;
      height: 450px;
      background-image: url('CN.gif');
      background-size: cover;
      background-position: center;
      border-radius: 5px;
      transform: scale(1.1);
      
    }
    .text-between {
      font-size: 50px;
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      animation: color 4s infinite;
    }
    @keyframes color {
      0% { color: #ED1B24; } 
      16% { color: #5BC4BF; } 
      30% { color: #8CC63E; } 
      44% { color: #FFCD52; }
      58% { color: #29AAE4; }
      72% { color: #009345; }
      100% { color: #F88F15; } 
    }

    .video-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }

    .video-text {
      font-size: 150%;
      margin-bottom: 10px;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      color: #571fffef;
      text-align: center;
      font-weight: bold;
      
    }

    .video {
      width: 850px;
      height: 500px;
    }

    .left-bar,
    .right-bar {
      width: 80px;
      height: 100vh;
      position: fixed;
      top: 0;
      z-index: 1;
      overflow: hidden;
    }

    .left-bar {
      left: 0;
    }

    .right-bar {
      right: 0;
    }

    .bar-image-container {
      position: relative;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .bar-image {
      width: 100%;
      height: auto;
      margin-bottom: 0px;
      animation: slideImages 20s linear infinite;
    }

    @keyframes slideImages {
      0% {
        transform: translateY(0);
      }
      100% {
        transform: translateY(-100%);
      }
    }

  </style>
</head>
<body>
  <div>
    <a href="contenu.html" class="home-icon">
      <i class="fas fa-home"></i>
    </a>
    <div class="center">
      <div class="image"></div>
      <form action="search.php" method="get">
        <div class="search-bar">
          <input type="text" class="search-input" name="search" placeholder="Which country do you want to know about...">
         <input type="submit" class ="search-button" value="Search"></a>
        </div>
      </form>
      <div class="video-container">
        <div class="video-text">Let's go on an exciting journey to discover the countries of the world!<br> And guess what?<br> We can even watch a fun video about it together!</div>
        <iframe class="video" src="vid.mp4" frameborder="0" allowfullscreen></iframe>
      <div class="left-bar">
        <div class="bar-image-container">
          <img class="bar-image" src="flag1.png" alt="Photo 1">
          <img class="bar-image" src="flag2.png" alt="Photo 2">
          <img class="bar-image" src="flag1.png" alt="Photo 1">
          
        </div>
      </div>
      <div class="right-bar">
        <div class="bar-image-container">
          <img class="bar-image" src="flag1.png" alt="Photo 1">
          <img class="bar-image" src="flag2.png" alt="Photo 2">    
          <img class="bar-image" src="flag1.png" alt="Photo 1">
        </div>
      </div>
    
    </div>
  </div>
</body>
</html>