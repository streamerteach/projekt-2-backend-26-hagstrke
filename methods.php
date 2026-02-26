<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Starts a session for every user
session_start();

// Input sanitation
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// If timezone cookie exists, sets default timezone to it
if (!empty($_COOKIE['timezone'])) {
    date_default_timezone_set($_COOKIE['timezone']);
}

// Path for the project folder
$path = "/home/h/hagstrke/html/backend/projekt-1-backend-26-hagstrke/";

$visitors = fopen($path . "visitors.txt", "a+") or die("Error: Unable to open file!");

// Checks if user has visited before and adds their IP to file
if (!preg_match('/' . $_SERVER['REMOTE_ADDR'] . '/', fread($visitors, filesize($path . "visitors.txt") + 1))) {
    fwrite($visitors, $_SERVER['REMOTE_ADDR'] . "\n");
}

fclose($visitors);

$servername = "localhost";
$dbname   = "hagstrke";
$username = "hagstrke";
$password = "DFzmk7g6zG";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
