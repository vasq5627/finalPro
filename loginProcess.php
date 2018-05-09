<?php

    session_start();
    include 'dbConnection.php';
    $conn = getDatabaseConnection("theVideoGameStore");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT * 
            FROM admin
            WHERE username = '$username'
            AND   password = '$password'";
      
    $sql = "SELECT * 
            FROM admin
            WHERE username = :username
            AND   password = :password";    
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); 
    
  
    if (empty($record)) {
        $_SESSION['wrong'] = "Wrong username or password.";
        header("Location:logIn.php");
       
    } else {
        
        
            
            $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
            header("Location:admin.php");
        
    }

?>