<!DOCTYPE html>
<html>
<head>
  <title>Charity Dashboard</title>
  <style>
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f7f7f7;
    }
    
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    
    h2 {
      margin-bottom: 10px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }
    
    th {
      background-color: #f2f2f2;
    }
    
    button {
      padding: 5px 10px;
      border-radius: 4px;
      border: none;
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
      margin-bottom: 5px;
    }
    
    button:hover {
      background-color: #45a049;
    }
    
    .no-orders {
      text-align: center;
      font-style: italic;
      color: #888;
    }
  </style>
  </style>
</head>
<body>

  <!-- Heading -->
  <h1>Welcome to the Dashboard</h1>

  <!-- Orders Received -->
  <h2>My Food Requests</h2>

  <!-- Table for Orders Received -->
  <table border="1">
    <thead>
      <tr>
        <th>Restaurant Name</th>
        <th>Food Needed</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "8132";
        $dbname = "feedtheneed";
        $url = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $cid = $params['cid'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        
        // Fetch data from the "status" table
        $sql = "SELECT request_id, rid, cid, items, status FROM status where cid=$cid";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // Output each row as a table row
          while ($row = $result->fetch_assoc()) {
            $id = $row["rid"];
            $q = "select name from users where id = $id";
            $nameResult = $conn->query($q);
            $nameRow = $nameResult->fetch_assoc();
            $name = $nameRow['name'];
            echo '<tr>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $row["items"] . '</td>';
            echo '<td>' . $row["status"] . '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="4">No requests made</td></tr>';
        }
        
        $conn->close();
      ?>
    </tbody>
  </table>
    </body>
  </html>

