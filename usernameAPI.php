<?php

include 'dbConnection.php';

$conn = getDatabaseConnection("theVideoGameStore");

$username = $_GET['username'];

$sql = "SELECT username FROM admin = :username";


$stmt = $conn->prepare($sql);
$stmt->execute( array(":username"=>$username));
$record = $stmt->fetch(PDO::FETCH_ASSOC);


echo json_encode($record);

?>