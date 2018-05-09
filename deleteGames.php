<?php

 include 'dbConnection.php';
    
 $conn = getDatabaseConnection("theVideoGameStore");
    
 $sql = "DELETE FROM price WHERE gameId =  " . $_GET['gameId'];
 $stmt = $conn->prepare($sql);
 $stmt->execute();
 
 
 header("Location: admin.php");
?>