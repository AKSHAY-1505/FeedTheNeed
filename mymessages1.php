<!DOCTYPE html>
<html>
<head>
  <title>My Messages</title>
</head>
<style>
    body{
        background-color: palegreen;
        font-family: Arial, sans-serif;
    }
    h1 {
        text-align: center;
        color: #333333;
    }
 table {
      border: 1px solid black; /* Add border to table */
      width: 100%; /* Set table width to 100% */
      height: 100%; /* Set table height to 100% */
      background-color: #FFFFE0;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black; /* Add border to table cells */
      text-align: center;
      padding: 10px;
    
    }
    tbody tr:nth-child(even) {
        background-color: lightblue;
    }
    th{
        background-color: yellow;
        text-transform: uppercase;
    }
    .small-column {
      width: 150px; /* Adjust the width of small columns as needed */
    }
    .big-column {
      width: auto; /* Let the message column take up the remaining space */
    }
    .delete-button {
      background-color: #FF0000;
      color: #FFFFFF;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }
    .delete-button:hover {
      background-color: #D60000;
    }
    .no-messages {
        text-align: center;
        font-style: italic;
        color: #888888;
    }
</style>
<body>
  <h1>MY MESSAGES</h1>
  <table>
    <thead>
      <tr>
        <th class="small-column">Sender Name</th>
        <th class="small-column">Sender Email</th>
        <th class="small-column">Sender Phone No</th>
        <th class="big-column">Message</th>
        <th class="small-column">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Retrieve the 'rid' parameter from the URL
        $url = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $rid = $params['rid'];

        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "8132";
        $dbname = "feedtheneed";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the database for the specified 'rid'
        $sql = "SELECT mid,sname, semail,phno, msg FROM messages WHERE receiver = $rid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["sname"] . "</td>";
            echo "<td>" . $row["semail"] . "</td>";
            echo "<td>" . $row["phno"] . "</td>";
            echo "<td>" . $row["msg"] . "</td>";
            echo "<td>
            <form method='post' action='deletemessage.php'>
              <input type='hidden' name='mid' value='" . $row['mid'] . "'>
              <button type='submit' class='delete-button'>Delete</button>
            </form>
          </td>"; // Delete button with form
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No messages found</td></tr>";
        }

        $conn->close();
      ?>
    </tbody>
  </table>

</body>
</html>
