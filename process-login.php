<?php
$email = $_POST['email'];
$pass = $_POST['pswd'];
$host = 'localhost';
$db_name = 'feedtheneed';
$user = 'root';
$db_pass = '8132';
$url = 'login.html';

$conn = mysqli_connect($host, $user, $db_pass, $db_name);
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
}

// Check if email already exists
$checkEmailQuery = "SELECT id, email, pswd, type FROM users WHERE email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $checkEmailQuery)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$numRows = mysqli_stmt_num_rows($stmt);

if ($numRows > 0) {
    // Email exists, check password
    $checkPasswordQuery = "SELECT id, pswd, type FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkPasswordQuery)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $numRows = mysqli_stmt_num_rows($stmt);

    if ($numRows > 0) {
        mysqli_stmt_bind_result($stmt, $fetchedId, $fetchedPassword, $type);
        mysqli_stmt_fetch($stmt);

        if ($pass === $fetchedPassword) {
            // Password correct, redirect based on type
            if ($type == 1) {
                // Pass the ID to charities.php
                header("Location: charities.php?rid=$fetchedId");
                exit();
            } elseif ($type == 2) {
                // Pass the ID to restaurants.php
                header("Location: restaurants.php?cid=$fetchedId");
                exit();
            } else {
                // Handle other types or invalid values
            }
        } else {
            // Incorrect password
            echo '<script type="text/javascript">';
            echo 'alert("Email/Password Incorrect!");';
            echo 'window.location.href = "' . $url . '";';
            echo '</script>';
            die();
        }
    } else {
        // Password not found
        echo '<script type="text/javascript">';
        echo 'alert("Email/Password Incorrect!");';
        echo 'window.location.href = "' . $url . '";';
        echo '</script>';
        die();
    }
} else {
    // Email not found
    echo '<script type="text/javascript">';
    echo 'alert("Email/Password Incorrect!");';
    echo 'window.location.href = "' . $url . '";';
    echo '</script>';
    die();
}
?>
