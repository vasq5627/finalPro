<?php

session_start();

include 'inc/header.php';
include 'dbConnection.php';

     $conn = getDatabaseConnection("theVideoGameStore");

function displayPlatform(){
        global $conn;
        
        $sql = "SELECT DISTINCT Platform FROM platform ORDER BY Platform";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["Platform"]."' >" . $record["Platform"] . "</option>";
            
        }
        
    }
    function displayGenre(){
        global $conn;
        
        $sql = "SELECT DISTINCT Genre FROM genre ORDER BY Genre";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["Genre"]."' >" . $record["Genre"] . "</option>";
            
        }
        
    }
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>"; 
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM price NATURAL JOIN genre NATURAL JOIN platform WHERE 1";
            
            if (!empty($_GET['gameName'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Title LIKE :Title";
                 $namedParameters[":Title"] = "%" . $_GET['gameName'] . "%";
            }
                  
                  
             if (!empty($_GET['genre'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Genre = :genre";
                 $namedParameters[":genre"] =  $_GET['genre'];
             }
             
             if (!empty($_GET['platform'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Platform = :platform";
                 $namedParameters[":platform"] =  $_GET['platform'];
             }
            
             if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND gamePrice >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
             }
             
             if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND gamePrice <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
             }
            
            if(isset($_GET['orderBy'])) {
                
                if($_GET['orderBy'] == "price") {
                    $sql .= " ORDER BY gamePrice";
                }   
                else {
                      $sql .= " ORDER BY gameTitle";
                 } 
               
                 
            }
           
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            echo "<table>";
            
            foreach ($records as $record) {
                $gameID = $record["Id"];
                $gameTitle = $record["gameTitle"];
                $gameGenre = $record["Genre"];
                $gamePlatform = $record['Platform'];
                $gamePrice = $record["gamePrice"];
                $gameImage = $record["gameImage"];
                
        
                echo "<table class='table table-striped table-dark'>";
                echo "<thead>"; 
                echo "<tr>";
                echo "<td><img src='$gameImage' width='100' height='100'></td>";
                //echo "<td><a href=gameInfo.php?gameID=".$gameID."'>More Info</a></td>";
                echo "<td><h4><a href='#' class='gameLink' gameid='".$record['gameId']. "'> " . $record['gameTitle'] . " </a> <h4><br></td>";
                echo "<td><h4>$gameGenre</h4></td>";
                echo "<td><h4>$gamePlatform</h4></td>";
                echo "<td><h4>$gamePrice</h4></td>";
                 
                echo "</tr>";
            }
            echo "</table>";
        }
        
    }
    


?>

       <body>
           <br />
           <br />
           <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/csumb.png" height="350" width="100" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://thumbor.forbes.com/thumbor/960x0/https%3A%2F%2Fblogs-images.forbes.com%2Finsertcoin%2Ffiles%2F2018%2F04%2Ffortnite-season-4-new.jpg" height="350" width="100" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://www.windowscentral.com/sites/wpcentral.com/files/styles/xlarge/public/field/image/2018/01/pubg%20screen.jpg?itok=oJpxG3Lx" height="350" width="100" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/farcry5.jpg" height="350" width="100" alt="Fourth slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br />
<br />

        <form id="act">
             <h1 class="display-4">Video Game Store</h1>
           <h3> Title: </h3><br />
            <input type="text" placeholder="Title"class="form-control" name="gameName" /><br /><br />
            <br />
           <h3>Genre:</h3> <br />
                <select name="piece" class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="genre">
                    <option value=""> Select One </option>
               <?=displayGenre()?>
                </select>
            <br /><br />
            <br />
            <br />
            <h3>Platform:</h3> <br />
                <select class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="platform">
                    <option value=""> Select One </option>
                   <?= displayPlatform() ?>
                </select>
            <br /><br /><br />
            
         
        <h3> Price: </h3>
<div class="form-row">
 
    <div class="col">
      From<input type="text" class="form-control" placeholder="Min" name="priceFrom"> 
    </div>
     <br />
    <div class="col">
      To<input type="text" class="form-control" placeholder="Max" name="priceTo"> <br />
    </div>
  </div>
                    
            <br /><br />
            
             <h3>Order By:</h3>
             <br />
    
             <div class="btn-group-vertical btn-group-toggle " c data-toggle="buttons">
  <label class="btn btn-dark btn-lg">
    <input type="radio" name="orderBy"  value="price" autocomplete="off"> Prices
  </label>
  <label class="btn btn-success btn-lg">
    <input type="radio" name="orderBy"  value="name"  autocomplete="off"> Name
  </label>
  
  
  
</div>
             <br /><br />
             <input type="submit" class="btn btn-primary" value="Search" name="searchForm" />
             
        </form>
        
        <br />
        <hr>
       <form id='act'>
           
        <?= displaySearchResults() ?>
      
        </form>
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