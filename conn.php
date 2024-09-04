<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Cconnection failed: " . $conn->connect_error);
}


?>