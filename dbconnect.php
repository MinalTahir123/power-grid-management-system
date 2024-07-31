<?php
$host = 'localhost';
$dbname = 'dept_reporting';
$username = 'root';
$password = 'minaltahir123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connected to the database successfully!';
} catch (PDOException $e) {
    echo 'Error connecting to the database: ' . $e->getMessage();
}
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>