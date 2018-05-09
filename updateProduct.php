<?php
    include 'dbConnection.php';
    include 'inc/header.php';
    $conn = getDatabaseConnection("theVideoGameStore");
    
    function getProductInfo()
    {
        global $conn;
        $sql = "SELECT * FROM price WHERE gameId = " . $_GET['gameId'];
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return $record;
    }
    
    if (isset($_GET['updateGame'])) {
        
        $sql = "UPDATE price 
                SET gameTitle = :gameTitle,
                    gameImage = :gameImage,
                    gamePrice = :gamePrice,
                    gameDescription = :gameDescription
                WHERE gameId = :gameId";
                
        $np = array();
        $np[":gameTitle"] = $_GET['gameTitle'];
        $np[":gamePrice"] = $_GET['gamePrice'];
        $np[":gameDescription"] = $_GET['gameDescription'];
         $np[":gameImage"] = $_GET['gameImage'];
        $np[":gameId"] = $_GET['gameId'];
                
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);        

        
    }
     if(isset ($_GET['gameId']))
    {
        $game = getProductInfo();
    }
    
    
    

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Product </title>
    </head>
    <body>
        <br >
         <br >
          <br >
        <div id='border'>
        <h1>Update Product</h1>
        <form>
            <input type="hidden" name="gameId" value= "<?=$game['gameId']?>"/>
            Game Title: <input type="text" value = "<?=$game['gameTitle']?>" name="gameTitle"><br> 
             <br >
            Price: <input type="text" name="gamePrice" value = "<?=$game['gamePrice']?>"><br>
             <br >
            Description:   <textarea name="gameDescription" cols = 50 rows = 4><?=$game['gameDescription']?></textarea><br>
             <br >
            
            Set Image Url: <input type = "text" name = "gameImage" value = "<?=$game['gameImage']?>"><br>
            <input type="submit"  class="btn btn-success" name="updateGame" value="Update Game">
             <br >
        </form>
        </div>
    </body>
</html>