<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_user"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("Location: Dasboard.php");
    exit();
} else {
    echo "Password Salah !!";
}

$stmt->close();
$conn->close();
?>