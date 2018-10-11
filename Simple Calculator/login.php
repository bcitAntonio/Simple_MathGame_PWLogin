<?php
session_start();

if(isset($_SESSION['use'])){
    header("Location:home.php");
}
    
    $message= "";
    if (isset($_GET["message"])){
        $message= $_GET["message"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Math Game</title>
<link href="styles/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="styles/math.css">
</head>
<body>
    <div class="basic-wrapper">
<form action="loginvalidation.php" method="post" class="form-horizontal">    
    
    <div class="center">
        <h3> Please Login to enjoy our math game.</h3><br />
                
        <div class="form-inline">
            <div class="form-group">
                <label id="email" > Email:</label>
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>   
        </div> 
        
        <div class="form-inline">
            <div class="form-group">
                <label for="password"> Password:</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Password">
            </div>
        </div> 
        
        <div id="message">
        <?php
            if (isset($message)){
            echo $message;
            }
        ?>
        </div> <br />
        

        <div class="form-group">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
        </div>
</form>
    </div>
</body>
</html>