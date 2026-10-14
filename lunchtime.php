<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<title>Lunchtime Config</title>
<link rel="icon" type="image/x-icon" href="assets/icon.png">


<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>

<link rel="stylesheet" href="style.css"> 
<link rel="icon" type="image/x-icon" href="assets/icon.png">

<script>
window.onload = function() {
  document.getElementById("user_id").focus();
};
</script>

</head>

<div id="header">
    <h1 style="text-align:center"><br><strong>Pui Ching Ordering System</strong></h1>
</div>
<header>
    <nav>
        <div class="nav-right">
            <ul></ul><ul>
                <li><a href="index.php">Home</a></li>
	   </ul>
	</div>
   </nav>
</header>

<?php
    session_start();
    //if (isset($_SESSION['username']) == false) {
    //    header("Location: redirect.php");
    //}
    //if  ($_SESSION["admin"] == False) {header("Location:error.php"); }

    function isRealDate($date) {

        if (false === strtotime($date)) {
        
        return false;
        
        }
    }

?>

<body style="background-color:#a1acba;">
    <form action="lunchtime.php" method="post">
    <div style="margin:10px 10px 0px 10px;">
	<?php  if($_SESSION['admin'] == true) {echo (' <a href="javascript:history.back()">Go Back</a> <br>');} ?>

	<label for="user_id">Please scan your id card on the reader:</label>
    	<input type="text" id="user_id" name="user_id" placeholder="Scan here" autofocus>
    	<!-- //<input type="date" id="day" name="day" required=""> -->
    	<button>Submit</button>
    </div>
	<div class="row">
		<div class="column">
		    <h1> Order List</h1>
			
            <div class="card">
                <div class="container">
                <table>
                <tr>
                    <th>Meal</th>
		    <th>Meal name</th>
		    <th>Price </th>
		    <th>Taken</th>
                     
		</tr>
                <?php
                    require_once "db.php";
		    $total_price = 0;

		    date_default_timezone_set("Asia/Hong_Kong");
                    $newDate = date("Ymd");
		    //$newDate = "20230911"; //DEBUGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG MSGG
		    $user_id = $_POST["user_id"];

                    // Table
                    $sql = 'SELECT * FROM orderlist WHERE food_id LIKE "%'. $newDate. '%" AND user_id ="' .$user_id .'" ORDER BY food_id;'  ;
		    if (substr($user_id,0,1) == "2"){
		        if($user_id <10000000 || $user_id > 99999999) {echo '<h3>ERROR OCCURED. PLEASE TRY AGAIN. </h3>'; $user_id = 1;}
			else { echo '<h3>USER :' .$user_id .' </h3>';}
		    }
		    else { echo '<h3>USER :' .$user_id .' </h3>';}

		    //echo $sql;
		    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
				$jsonarray = array();
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        //echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . substr($row['food_id'],8) . str_pad($row["order_num"], 3, '0', STR_PAD_LEFT) .  "</td>";
                                        echo "<td>" . $row['food_name'] . "</td>";
					echo "<td>" . $row['price'] . "</td>";
					echo "<td>" . $row['taken'] . "</td>";
					//echo "<td></td>";
					$total_price += $row['price'];
                                    echo "</tr>";
					$jsonarray[] = $row;
                                }
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            //echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
		    echo "<h3>Total price = " . $total_price ."</h3>";
                    echo '</table>
                    </div>
                </div>
            </div>
            <div class="column">
                <h1> Conclusion</h1> 
                <div class="card">
                    <div class="container">
                    <table>
                    <tbody>
                        <tr>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>E</th>
                        <th>F</th>
			<th>Z</th>
                        </tr>
                        <tr>
                        ';

                    for ($c = 'A'; $c <= 'F'; $c++) {
                        $sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id LIKE "%'. $newDate.$c. '%" AND user_id ="' .$user_id .'";';

                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<td>".$row['COUNT(*)']."</td>";
                                    }
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                //echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }

                        // Free result set
                    }
		//meal Z
		//$sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id LIKE "%'. $newDate. '%" and food_id LIKE "%Z";';
        	$sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id LIKE "%'. $newDate. 'Z%" AND user_id ="' .$user_id .'";';

                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<td>".$row['COUNT(*)']."</td>";
                                    }
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                //echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }


                    echo '</tr>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>';
                    
                    mysqli_close($link);
                    ?>
	</div>
    </form>
</body>
</html>

