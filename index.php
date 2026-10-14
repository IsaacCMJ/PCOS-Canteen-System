<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
    //if (!($_SESSION["admin"])){ header("Location: logout.php");}//redirect.php");}
    // connect db
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">

<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


</head>
<body style="background-color:#a1acba;">
	
	<?php include 'nav.php';
	?>

	<div class="row">
		<div style="margin-left: 15px;">
		<h2> Welcome <?php echo($_SESSION["name"]);?> </h2>
		
		<!-- NOTICE
		<p>Cart Noodles are finally launched on PCOS!</p><a href="cart_noodle.php">Order Cart noodles now!</a>		
		-->
		<marquee width="100%" height="30px" direction="left" height="100px" scrollamount="7">
			<strong>To order from another account, you need to <a href="https://mail.google.com/">logout your gmail account </a>. &nbsp&nbsp&nbsp </strong>
			*Please wait patiently after you order your meal, and DO NOT refresh the page when the system is loading. Thank you.
		</marquee>


		</div>
		
	</div>

	<div class="row">
	<div class="column">
        <div class="card">
	<div class="container">
                        <?php
                                //connect DB
                                // exciute the sql
                                // select * from food_menu where date= ......

                                // use while loop to get teh data
                                // mysqli_fetch_array
                                // https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php
                                // check from Creating the Landing Page         
                        ?>

		<?php
                    /*session_start();*/
                    require_once "db.php";
                    $date = "20" . date('y-m-d');
                    /*$date=DATE_ADD($date, INTERVAL 10 DAY);*/
                    //$d=strtotime("tomorrow");
                    //$date=date("Y-m-d", $d);
		    $date = date('Y-m-d', strtotime($date . ' +2 days'));

		    $date_monday = date('Y-m-d');
		    $date_friday = date('Y-m-d', strtotime(" +5 days"));

                    	$h = date("G");
			if ($h <9){
				$date_start = date('Y-m-d', strtotime("yesterday"));
			}else{
				$date_start = date('Y-m-d');
			}
		while (strtotime($date_monday) <= strtotime($date_friday)){
		    $date = $date_monday;
                    $A ="A";
                    $B ="B";
                    $C ="C";
                    $D ="D";
                    $E ="E";
		    $F ="F";


		    // select * from food_menu where date = CURDATE() + INTERVAL 1 DAY
		    // now using php is ok also
                    $sql = "SELECT * FROM food_menu WHERE date = '" . $date . "'" . ";";
                    if($result = mysqli_query($link, $sql)){

			if ($date_start< $date){
                        if(mysqli_num_rows($result) > 0){                  
            	    		echo ('<h2>'.$date.' ' . date('l', strtotime($date))  . ' meal</h2>'."\n");
                                /*echo "<p>Set A:</p>";*/
                                $Meal_A = "SELECT * FROM food_menu WHERE menu_id = '" . $A . "' AND date = '" . $date . "' and meal_name<>'N/A';";
                                if($result = mysqli_query($link, $Meal_A)){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<p>Set A: ". $row['meal_name'] . " Price: " . $row['food_price']. "</p>";
					//echo "<tr>";
                                        //echo "<td>Set A:</td><td>". $row['meal_name'] . "</td><td>Price:</td><td>" . $row['food_price']. "</td>";
					//echo "</tr>";
                                        /*echo "<p>Price: </p>";
                                        echo "<p>" .$row['food_price']. "</p>";*/
                                    }
                                }
                                $Meal_B = "SELECT * FROM food_menu WHERE menu_id = '" . $B . "' AND date = '" . $date . "' and meal_name<>'N/A';";
                                if($result = mysqli_query($link, $Meal_B)){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<p>Set B: ". $row['meal_name'] . " Price: " . $row['food_price']. "</p>";
					//echo "<tr>";
                                        //echo "<td>Set B:</td><td>". $row['meal_name'] . "</td><td>Price:</td><td>" . $row['food_price']. "</td>";
					//echo "</tr>";
                                        /*echo "<p>Price: </p>";
                                        echo "<p>" .$row['food_price']. "</p>";*/
                                    }
                                }
                                
                                $Meal_C = "SELECT * FROM food_menu WHERE menu_id = '" . $C . "' AND date = '" . $date . "' and meal_name<>'N/A';";
                                if($result = mysqli_query($link, $Meal_C)){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<p>Set C: ". $row['meal_name'] . " Price: " . $row['food_price']. "</p>";
					//echo "<tr>";
                                        //echo "<td>Set C:</td><td>". $row['meal_name'] . "</td><td>Price:</td><td>" . $row['food_price']. "</td>";
					//echo "</tr>";
                                        /*echo "<p>Price: </p>";
                                        echo "<p>" .$row['food_price']. "</p>";*/
                                    }
                                }
                                /*echo "<p>Set D:</p>";*/
                                $Meal_D = "SELECT * FROM food_menu WHERE menu_id = '" . $D . "' AND date = '" . $date . "' and meal_name<>'N/A';";
                                if($result = mysqli_query($link, $Meal_D)){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<p>Set D: ". $row['meal_name'] . " Price: " . $row['food_price']. "</p>";
					//echo "<tr>";
                                        //echo "<td>Set D:</td><td>". $row['meal_name'] . "</td><td>Price:</td><td>" . $row['food_price']. "</td>";
					//echo "</tr>";
                                        /*echo "<p>Price: </p>";
                                        echo "<p>" .$row['food_price']. "</p>";*/
                                    }
                                }
                                /*echo "<p>Set E:</p>";*/
                                $Meal_E = "SELECT * FROM food_menu WHERE menu_id = '" . $E . "' AND date = '" . $date . "' and meal_name<>'N/A';";
                                if($result = mysqli_query($link, $Meal_E)){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<p>Set E: ". $row['meal_name'] . " Price: " . $row['food_price']. "</p>";
					//echo "<tr>";
                                        //echo "<td>Set E:</td><td>". $row['meal_name'] . "</td><td>Price:</td><td>" . $row['food_price']. "</td>";
					//echo "</tr>";
                                        /*echo "<p>Price: </p>";
                                        echo "<p>" .$row['food_price']. "</p>";*/
                                    }
                                }
				$Meal_F = "SELECT * FROM food_menu WHERE menu_id = '" . $F . "' AND date = '" . $date . "' and meal_name<>'N/A';";
                                if($result = mysqli_query($link, $Meal_F)){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<p>Set F: ". $row['meal_name'] . " Price: " . $row['food_price']. "</p>";
                                        //echo "<tr>";
                                        //echo "<td>Set B:</td><td>". $row['meal_name'] . "</td><td>Price:</td><td>" . $row['food_price']. "</td>";
                                        //echo "</tr>";
                                        /*echo "<p>Price: </p>";
                                        echo "<p>" .$row['food_price']. "</p>";*/
                                    }
                                }
	
				echo ('</table>');
                            // Free result set line 70
                            //mysqli_free_result($result);
                        }
			}//end of date
	            }
                    else{
                        echo '<div class="alert alert-danger"><em>ERROR please wait.</em></div>';
                    }   
		    $date_monday = date ("Y-m-d", strtotime("+1 days", strtotime($date_monday)));
		}
		
		//echo "<h2>Data Updating </h2>" ;
		
                mysqli_close($link);
                ?>
        </div>        
	</div>
	</div>
	<div class="column">
        <div class="card">
	<div class="container">
            <h2>Process</h2> 
            <p font-size:15px>1. Order a meal here.<br>2. A confirmation email will be sent to you.<br>3. Pick up the meal with your student card, and pay at lunchtime by Octopus or cash.<br>&nbsp&nbsp&nbsp *Please prepare excact fare if you wish to pay via cash for faster payment.</p>
        </div>
	</div>
	</div>
    </div>



</body>
</html>
<?php
        //mysqli_close($link);
	//remember to close mysql
?>
