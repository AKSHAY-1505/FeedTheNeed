<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "8132";
$dbname = "feedtheneed";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the necessary query parameters are present
if (isset($_GET['request_id']) && isset($_GET['action'])) {
  // Sanitize and validate the input
  $requestId = $_GET['request_id'];
  $action = $_GET['action'];
  
  // Update the status in the database
  if ($action == 1) {
    $status = "Order Confirmed";}
    else if($action == 2){
        $status = "Out For Delivery";
    }
    else{
        $status = "Delivered";
    }
    
    $sql = "UPDATE status SET status = '$status' WHERE request_id = $requestId";
    if ($conn->query($sql) === TRUE) {
      echo "Status updated successfully";
    } else {
      echo "Error updating status: " . $conn->error;
    }

} else {
  echo "Missing request ID or action parameter";
}

$conn->close();
?>