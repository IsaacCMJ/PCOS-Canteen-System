<?php
require_once "db.php";

session_start();
if (isset($_SESSION['username']) == false) {
    header("Location: redirect.php");
}

// admin flag is set at login from the lists in config.php
if (empty($_SESSION["admin"])) {
     header ("Location:error.php");
     exit;}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Setting</title>

<!--link style sheet-->
<link rel="stylesheet" href="style.css">
<!-- icon-->
<link rel="icon" type="image/x-icon" href="assets/icon.png">

</head>

<body>
    <?php include 'nav.php';
?>   
    <p style="margin:20px"><strong>
    You have Updated the uppcoming meal successfully</br>
    If there isn't any errors.</strong></p>
    <h4 style="margin:20px;">System Messages:</h4>

<div class="card">
<div class="container">
<?php

$afood  = $_POST["A_food"];
$aprice = $_POST["A_price"];
$aqty   = $_POST["A_qty"];

$bfood  = $_POST["B_food"];
$bprice = $_POST["B_price"];
$bqty   = $_POST["B_qty"];


$cfood  = $_POST["C_food"];
$cprice = $_POST["C_price"];
$cqty   = $_POST["C_qty"];

$dfood  = $_POST["D_food"];
$dprice = $_POST["D_price"];
$dqty   = $_POST["D_qty"];


$efood  = $_POST["E_food"];
$eprice = $_POST["E_price"];
$eqty   = $_POST["E_qty"];


$ffood  = $_POST["F_food"];
$fprice = $_POST["F_price"];
$fqty   = $_POST["F_qty"];

$zqty  =  $_POST["Z_qty"];

$day    = $_POST["day"];
?>
<p>
<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('A','" . $afood . "','" . $day . "','" . $aprice . "','" . $aqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET A OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('A','" . $afood . "','" . $day . "','" . $aprice . "','" . $aqty . "')";
  mysqli_query($link, $sql);
  echo "     SET A Updated";
}
?>

<br>

<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('B','" . $bfood . "','" . $day . "','" . $bprice . "','" . $bqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET B OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('B','" . $bfood . "','" . $day . "','" . $bprice . "','" . $bqty . "')";
  mysqli_query($link, $sql);
  echo "     SET B Updated";
}?>

<br>

<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('C','" . $cfood . "','" . $day . "','" . $cprice . "','" . $cqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET C OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('C','" . $cfood . "','" . $day . "','" . $cprice . "','" . $cqty . "')";
  mysqli_query($link, $sql);
  echo "     SET C Updated";
}
?>
<br>

<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('D','" . $dfood . "','" . $day . "','" . $dprice . "','" . $dqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET D OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('D','" . $dfood . "','" . $day . "','" . $dprice . "','" . $dqty . "')";
  mysqli_query($link, $sql);
  echo "     SET D Updated";
}?>

<br>

<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('E','" . $efood . "','" . $day . "','" . $eprice . "','" . $eqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET E OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('E','" . $efood . "','" . $day . "','" . $eprice . "','" . $eqty . "')";
  mysqli_query($link, $sql);
  echo "     SET E Updated";
}
?>

<br>

<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('F','" . $ffood . "','" . $day . "','" . $fprice . "','" . $fqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET F OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('F','" . $ffood . "','" . $day . "','" . $fprice . "','" . $fqty . "')";
  mysqli_query($link, $sql);
  echo "     SET F Updated";
}
?>
<br>
<?php
$sql = "INSERT INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('Z','Cart Noodle','" . $day . "','24','" . $zqty . "')";
if (mysqli_query($link, $sql)) {
  echo "     SET Z OK";
} else {
  //echo "Error: " . $sql . ":-" . mysqli_error($link);
  $sql = "REPLACE INTO food_menu (menu_id,meal_name,date,food_price,number) VALUES ('Z','Cart Noodle','" . $day . "','24','" . $zqty . "')";
  mysqli_query($link, $sql);
  echo "     SET Z Updated";
}
?>


</p>
<?php
mysqli_close($link);

?>
</div>
</div>


<a href="setting.php">Go to the previous page</a>
</body>
</html>
