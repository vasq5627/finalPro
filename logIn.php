<?php
    session_start();
    include 'inc/header.php';
    
?>

<body>
        <div id="divOne">
       
        
        <form id='act' method="POST" action="loginProcess.php">
            <h1 class="display-4">Admin Login Page!</h1>

            <div class="form-group">
    <label for="username1">Username:</label>
    <input type="text" name="username" class="form-control" id="username1" aria-describedby="Help" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password:</label>
    <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password">
  </div>
  <br />
  <br />
            <input type="submit" class="btn btn-primary" name="submitForm" value="Login!" />
            
        </form>
       
    </div>
        
    </body>