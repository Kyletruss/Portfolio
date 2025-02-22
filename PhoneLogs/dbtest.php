<?php

$host = "localhost";
$username = "phonelogsapp";
$password = "mypassword";
$dbName = "phonelogsapp";


$conn = new mysqli($host, $username, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br><br><br><br>");
}
else{
    echo("Connection sucessfull");
}
