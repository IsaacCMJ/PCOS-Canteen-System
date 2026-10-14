<?php
session_start();
if (isset($_SESSION['username']) == false){
    header("Location:redirect.php");
}

// Process delete operation after confirmation
//echo $_POST["food_id"];
if(isset($_GET["food_id"]) && !empty($_GET["food_id"])){
    // Include config file
    require_once "db.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM orderlist WHERE user_id = '" . $_SESSION['stu_id'] . "' AND food_id = '" . $_GET["food_id"] . "' and order_id = '" . $_GET["order_id"] . "';";
    mysqli_query($link, $sql);
    //echo $sql;
    
} /*else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}*/
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Opps</title>

<!--link style sheet-->
<link rel="stylesheet" href="style.css">
<!-- icon-->
<link rel="icon" type="image/x-icon" href="assets/icon.png">

</head>

<body>

<?php include 'nav.php';
?>
<br>

<div class="row"><div class="column" style="width:100%"><div class="card"><div class="container">
              <h2>Order Cancelled</h2>
                <p>You will be redirected to home page after 5 seconds.<br>Or you can 
                <a href="index.php">click here to redirect</a> manually. </p>
</div></div></div></div>
<script>
    setTimeout(function(){
       window.location.href = 'index.php';
    }, 5000);
 </script>
</body>
</html>
