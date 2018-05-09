<?php

   include '../dbConnection.php';

      $conn = getDatabaseConnection('theVideoGameStore');
      
      $sql = "SELECT COUNT(gameId) as c FROM price";
     
      
      $stmt = $conn->prepare($sql);  
        $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      echo json_encode($record);
?>