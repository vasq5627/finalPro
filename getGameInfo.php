<?php

   include 'dbConnection.php';

      $conn = getDatabaseConnection('theVideoGameStore');
      
      $sql = "SELECT * FROM price NATURAL JOIN genre NATURAL JOIN platform WHERE gameId = :gameId";
     
      
      $stmt = $conn->prepare($sql);  
      $stmt->execute(array(":gameId"=>$_GET['gameId']));
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      echo json_encode($record);
?>