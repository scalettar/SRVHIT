<?php
require_once 'dbconfig.php';
try {
    //$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn = mysqli_connect("localhost", "root", "", "test");
    echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>
