<?php

// Create connection
$hostname = "localhost";
$database = "batch";
$username = "root";
$password = "";

try {
    $connection = new PDO("mysql:host=$hostname;dbname=$database;", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected Successfully!";
} catch (PDOException $e) {
    echo "Connection Failed:" . $e->getMessage();
}


// Used input count
function emailCount($col, $value)
{
    global $connection;
    $stm = $connection->prepare("SELECT $col FROM login WHERE $col=?");
    $stm->execute(array($value));
    $emailNew = $stm->rowCount();
    return $emailNew;
}
