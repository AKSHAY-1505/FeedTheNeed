<!DOCTYPE html>
<html>
<head>
  <title>Charities</title>
  
  <style>
  /* CSS for the navigation bar */
  *{
    font-family: "Ubuntu", Arial, sans-serif;
  }
  
  .navbar {
    background-color: #333;
    overflow: hidden;
    width: 100%;
    margin: 0;
  }
  
  .navbar a {
    float: right;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    transition: background-color 0.3s ease; /* Added transition animation */
    border-left: 1px solid white;
  }
  .navbar a:active {
    transform: translateY(2px); /* Added button press animation */
  }
  
  .navbar a:hover {
    background-color: #ddd;
    color: black;
  }

  /* CSS for the charity boxes */
  .charity-box {
    border: 1px solid #333;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f2f2f2;
    width: 100%;
    display: flex;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Added box shadow */
  }
  
  .charity-info {
    flex: 1;
  }
  
  .charity-info h3 {
    margin-top: 0;
  }
  
  .charity-info p {
    margin-bottom: 5px;
  }
  .button-container {
    display: flex;
    flex-direction: column;
  }
  .button-container .button {
    padding: 5px 10px;
    background-color: #333;
    color: white;
    text-decoration: none;
    margin-top: 10px;
    margin-bottom: 10px;
    margin-right: 250px; /* Added right margin for spacing */
    border-radius: 5px; /* Added rounded corners */
    transition: background-color 0.3s ease; /* Added transition animation */
    border: 1px solid black; /* Added black border */
  }
  
  .button-container .button:hover {
    background-color: #F7D6D6;
    color: black;
  }
  .button-container .button:active {
    transform: translateY(2px); /* Added button press animation */
  }
  body {
    margin: 0;
    background-color: #F7D6D6;
  }
</style>
</head>
<body>
  <div class="navbar">
  <a href="javascript:history.go(-1);">Log Out</a> <!-- Added Log Out button -->
  <a href="resdashboard.php?rid=<?php echo $_GET['rid']; ?>">Dashboard</a> <!-- Added Dashboard button -->
  <a href="mymessages1.php?rid=<?php echo $_GET['rid']; ?>">My Messages</a>
  </div>
  <h1>CHARITIES YOU CAN HELP</h1>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "8132";
    $dbname = "feedtheneed";
    $rid = $_GET['rid'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id,c_name, c_addr, c_phone,c_email FROM charities";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $csql = "SELECT id FROM users WHERE name = '" . $row["c_name"] . "'";
      $cresult = $conn->query($csql);
      $crow = $cresult->fetch_assoc();
      $cid = $crow['id'];

      echo '<div class="charity-box">';
      echo '<div class="charity-info">';
      echo '<h3>Name: ' . $row["c_name"] . '</h3>';
      echo '<p>Address: ' . $row["c_addr"] . '</p>';
      echo '<p>Phone: ' . $row["c_phone"] . '</p>';
      echo '<p>Email: ' . $row["c_email"] . '</p>';
      echo '</div>';
      echo '<div class="button-container">';
      echo '<a class="button" href="contactformres.php?cid=' . $cid . '&rid=' . $rid . '">Get in touch!</a>';
      echo '<a class="button" href="https://www.google.com/maps/search/' . urlencode($row["c_addr"]) . '" target="_blank">Locate on Google Map</a>';
      echo '<a class="button" href="process_food.php?cid=' . $cid . '&rid=' . $rid . '">Donate Food</a>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo "NO CHARITIES FOUND :(";
  }
    $conn->close();
  ?>
</body>
</html>
