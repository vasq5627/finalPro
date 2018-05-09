<?php
session_start();
include "inc/header.php";
include "dbConnection.php";

$conn = getDatabaseConnection("theVideoGameStore");

    if (isset($_GET['submitGame'])) {
    $gameTitle = $_GET['gameTitle'];
    $gameImage = $_GET['gameImage'];
    $gamePrice = $_GET['gamePrice'];
    $gameDescription = $_GET['gameDescription'];
   
    
    $sql = "INSERT INTO price
            ( `gameTitle`, `gamePrice`, `gameDescription`, `gameImage`) 
             VALUES (:gameTitle,:gamePrice, :gameDescription, :gameImage)";
     
    $np = array();
    $np[':gameTitle'] = $gameTitle;
    $np[':gamePrice'] = $gamePrice;
    $np[':gameDescription'] = $gameDescription;
    $np[':gameImage'] = $gameImage;
     $stmt = $conn->prepare($sql);
    $stmt->execute($np);
}
    

 
?>
<div id='border'>
<h1> Add a product</h1>
        <form>
            Game Title: <input type="text" name="gameTitle"><br>
            Price: <input type="text" name="gamePrice"><br>
            Description: <textarea name="gameDescription" cols = 20 rows = 4></textarea><br>
            Set Image Url: <input type = "text" name = "gameImage"><br>
            <input type="submit" class="btn btn-success" name="submitGame" value="Add Product">
            
        </form>
  </div>   
     