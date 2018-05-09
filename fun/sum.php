<?php

   include '../dbConnection.php';

      $conn = getDatabaseConnection('theVideoGameStore');
      
      $sql = "SELECT SUM(gamePrice) as s FROM price";
     
      
      $stmt = $conn->prepare($sql);  
        $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      echo json_encode($record);
?>