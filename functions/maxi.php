<?php

   include '../dbConnection.php';

      $conn = getDatabaseConnection('theVideoGameStore');
      
      $sql = "SELECT SUM(gamePrice) FROM price";
     
      
      $stmt = $conn->prepare($sql);  
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      echo json_encode($record);
?>