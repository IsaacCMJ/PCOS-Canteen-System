<?php
require_once "db.php";

// get the date
$search_date = $_POST['select_day'];
// find the data in database
$sql = "select * from food_menu where date = '".$search_date."'";
$result = mysqli_query($link, $sql);

// prepare the data to arra
$rows = array();

// make it to json
while($r = mysqli_fetch_array($result)) {
     	$rows['os'][] = $r;
}
print json_encode($rows);

mysqli_close($link);
?>
