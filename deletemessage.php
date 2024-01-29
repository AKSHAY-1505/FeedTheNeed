<?php
// delete_message.php

// Retrieve the message ID from the form submission
$mid = $_POST['mid'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "8132";
$dbname = "feedtheneed";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Delete the message with the specified ID from the database
$sql = "DELETE FROM messages WHERE mid = $mid";

if ($conn->query($sql) === TRUE) {
  // Deletion successful
  echo "MESSAGE DELETED SUCCESFULLY";
  
} else {
  // Deletion failed
  echo "Error deleting message: " . $conn->error;
}

$conn->close();
?>
