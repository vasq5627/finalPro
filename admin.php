<?php

session_start();
include 'inc/header.php';
include 'dbConnection.php';
$conn = getDatabaseConnection("theVideoGameStore");

function displayAllProducts(){
    global $conn;
    $sql="SELECT * FROM price";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    return $records;
}

function generateSum(){
    global $conn;
    
    $sql ="SELECT SUM(gamePrice) FROM price";
    
    $stmt = $conn ->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

function generateAverage(){
     global $conn;
    
    $sql ="SELECT AVG(gamePrice) FROM price";
    
    $stmt = $conn ->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

function generateCount(){
     global $conn;
    
    $sql ="SELECT COUNT(gameId) FROM price";
    
    $stmt = $conn ->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
        <style>
            
            form {
                display: inline;
            }
            
        </style>
        
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete it?");
                
            }
            
        </script>
        
    </head>
    <body>


       <div id="border">
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['adminName']?>! </h3>
        
        <br />
        <form action="addProducts.php">
            <input type="submit" class="btn btn-success" name="addproduct" value="Add Product"/>
        </form>
        
        <form action="logout.php">
            <input type="submit"  class="btn btn-success"value="Logout"/>
        </form>
        <br >
        <br >
        <button type="button" class="btn btn-dark game">Sum of Prices</button>
        <br>  <br>
        <button type="button" class="btn btn-info">Average of Prices</button>
        <br> <br> 
        <button type="button" class="btn btn-dark">Count of Games</button>
        <br> <br>
        <br /> <br />
       
        <strong> Products: </strong> <br />
        
        <?php $records=displayAllProducts();
            foreach($records as $record) {
                 echo '<br>';
                echo $record['gameTitle'];
                 echo '<br>';
                echo "<a class='btn btn-primary' href='updateProduct.php?gameId=".$record['gameId']." '>Update</a>";
                echo "<form action='deleteGames.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='gameId' value= " . $record['gameId'] . " />";
                echo "<input type='submit' class='btn btn-danger'  value='Remove'>";
                echo "</form>";
                echo '<br>';
                 echo '<br>';
        
                echo '<br>';
            }
        
        ?>
        </div>
        <script>
            
    $(document).ready(function(){
    
            
            $(".gameLink ").click(function(){
                
            
                
                $('#gameModal').modal("show");
               
                
                $.ajax({

                    type: "GET",
                    url: "getGameInfo.php",
                    dataType: "json",
                    data: { "gameId": $(this).attr("gameId")},
                    success: function(data,status) {
                       $("#gameModalLabel").html("<h2>" + data.gameTitle +"</h2>");
                       $("#gameInfo").html("");
                       $("#gameInfo").append("Description:" + data.gameDescription + "<br><br>");
                        $("#gameInfo").append("Price:" + data.gamePrice + "<br><br>");
                        $("#gameInfo").append("Platform:" + data.Platform + "<br><br>");
                         $("#gameInfo").append("Genre:" +data.Genre + "<br> <br>");
                        $("#gameInfo").append("<img src='" + data.gameImage + "' width='150'");
                       
                       
                    
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    
                    }
                    
                });//ajax
                
                
            });
        
        
    }); //document ready
    
        </script>
        <div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gameModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
        <div id="gameInfo"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    </body>
</html>