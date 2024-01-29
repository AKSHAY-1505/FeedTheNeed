<?php
$servername = "localhost";
$username = "root";
$password = "8132";
$dbname = "feedtheneed";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form input values

    $food = $_POST['food'] ?? '';

    $rid = isset($_POST['rid']) ? $_POST['rid'] : '';
    $cid = isset($_POST['cid']) ? $_POST['cid'] : '';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO status (rid, cid, items, status) VALUES (?, ?, ?, ?)");
    $status = "Requested";
    // Bind parameters to the statement
    $stmt->bind_param("iiss", $rid, $cid, $food, $status);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <style>
                *{
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: 'poppins',sans-serif;
                }
                .container{
                    width: 100%;
                    height: 100vh;
                    background: #001660;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                form{
                    background: #fff;
                    display: flex;
                    flex-direction: column;
                    padding: 2vw 4vw;
                    width: 90%;
                    max-width: 600px;
                    border-radius: 10px;

                }
                form h3{
                    color: #555;
                    font-weight: 800;
                    margin-bottom: 20px;
                }
                form input,form textarea{
                    border: 0;
                    margin: 10px 0;
                    padding: 20px;
                    outline: none;
                    background: #f5f5f5;
                    font-size: 16px;
                }
                form button{
                    padding: 15px;
                    background: #ff5361;
                    color: #fff;
                    font-size: 18px;
                    border:0;
                    outline: none;
                    cursor: pointer;
                    width: 150px;
                    margin: 20px auto 0;
                    border-radius: 30px;
                }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h3>GET IN TOUCH</h3>
            <input type="hidden" name="rid" value="<?php echo isset($_GET['rid']) ? $_GET['rid'] : ''; ?>">
            <input type="hidden" name="cid" value="<?php echo isset($_GET['cid']) ? $_GET['cid'] : ''; ?>">
            <textarea name="food" rows="4" placeholder="Enter your Food Items" required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>