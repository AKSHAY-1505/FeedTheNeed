<?php
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pswd'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$type = filter_input(INPUT_POST, "role", FILTER_VALIDATE_INT);
$host = 'localhost';
$db_name = 'feedtheneed';
$user = 'root';
$db_pass = '8132';
$url = 'login.html';

$conn = mysqli_connect($host,$user,$db_pass,$db_name);
if(mysqli_connect_errno()){
    die("Connection error: " . mysqli_connect_errno());
}

// Check if email already exists
$checkEmailQuery = "SELECT email FROM users WHERE email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $checkEmailQuery)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$numRows = mysqli_stmt_num_rows($stmt);

if ($numRows > 0) {
    // Email already exists, display alert and redirect
    echo '<script type="text/javascript">';
    echo 'alert("You already have an account. Please login.");';
    echo 'window.location.href = "' . $url . '";';
    echo '</script>';
    die();
}
if($type==1){
$sql = "INSERT INTO restaurants(r_name, r_email,r_phone,r_addr,r_pswd) VALUES(?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    die(mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "sssss",
                        $name,
                        $email,
                        $phone,
                        $address,
                        $pass);
mysqli_stmt_execute($stmt);
}else{
    $sql = "INSERT INTO charities(c_name,c_email,c_phone,c_addr,c_pswd) VALUES(?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "sssss",
                            $name,
                            $email,
                            $phone,
                            $address,
                            $pass);
    mysqli_stmt_execute($stmt);    
}
$sql = "INSERT INTO users(name,email,pswd,type) VALUES(?,?,?,?)";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    die(mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "sssi",
                        $name,
                        $email,
                        $pass,
                        $type);
mysqli_stmt_execute($stmt);  
echo '<script type="text/javascript">';
    echo 'alert("You have sucessfully registered");';
    echo 'window.location.href = "' . $url . '";';
    echo '</script>';
    die();