<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
    // copy the db setting code

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order</title>
<link rel="stylesheet" href="style.css">
<style> tr:hover {background-color: transparent;}   </style>
<link rel="icon" type="image/x-icon" href="assets/icon.png">

</head>
<body style="background-color:a1acba">

	<?php include 'nav.php';
?>	


        <div class="row">
                <div class="column">
                    <div class="card">
                        <div class="container">
                        <h2>Order your meal</h2>
                        <form action="finish.php" method="post">

                        <?php
                        require_once "db.php";



                        /*
                        date_default_timezone_set("Asia/Shanghai");
                        $d=strtotime("tomorrow");
                        $date=date("Y-m-d",$d);
                        */

                        // Setup Today
                        date_default_timezone_set("Asia/Hong_Kong");
                        $day = date('l'); // Eg. Monday
                        $date = date("Y-m-d");
                        $h = date("G");
                        $m = date("i");

			$can_order = true;

			//Block the order after 08:00 each school day
			if (($day != "Sunday") && ($day != "Saturday")){
				if (($h >=8) && ($h<=15)){
					$can_order=false;
				}
			}

                        // Date Algorithm
			/*
                        if ($day == "Friday" || $day == "Saturday" || $day == "Sunday") {
                            $date = date("Y-m-d", strtotime("next tuesday"));
                        }elseif ($day == "Thursday") {
                            $date = date("Y-m-d", strtotime("next monday"));
			}
                        else {
                            $date = date("Y-m-d", strtotime("+2 days"));
                        }*/

                        // Date Algorithm
			if ($h >=8){ // after 1000
                        if ($day == "Friday" || $day == "Saturday") {
                            $date = date("Y-m-d", strtotime("next monday"));
			    $date_o = date("Ymd", strtotime("next monday"));
			}
                        else {
                            $date = date("Y-m-d", strtotime("tomorrow"));
			    $date_o = date("Ymd", strtotime("tomorrow")); 
                        }
			}
			else
			{
                        	if ($day == "Saturday" || $day == "Sunday") {
                            		$date = date("Y-m-d", strtotime("next monday"));
			    		$date_o = date("Ymd", strtotime("next monday"));
				}else{
                            		$date = date("Y-m-d");
			    		$date_o = date("Ymd");
				} 
			}


			/* new idea for order more than once  @ 20230319 */

			$sql = 'SELECT * FROM orderlist WHERE food_id LIKE "%'. $date_o . '%" and user_id LIKE "%' . $_SESSION['stu_id'] . '";';
                        $o_A = 0;
                        $o_B = 0;
                        $o_C = 0;
                        $o_D = 0;
                        $o_E = 0;
                        $o_F = 0;
                        $o_Z = 0;

			$ordered = false;

    			if($result = mysqli_query($link, $sql)){
        			if(mysqli_num_rows($result) > 0){
					$ordered = true;
            				while ($row = mysqli_fetch_array($result)){
						$ordered = 'o_'.substr($row['food_id'],-1);
						$$ordered = $$ordered + 1;
					};

					echo ('<p> You have ordered </p><p>');
					if ($o_A > 0){
						echo ('A : '. $o_A . '&nbsp;&nbsp;&nbsp;');
					}
					if ($o_B > 0){
						echo ('B : '. $o_B . '&nbsp;&nbsp;&nbsp;');
					}
					if ($o_C > 0){
						echo ('C : '. $o_C . '&nbsp;&nbsp;&nbsp;');
					}
					if ($o_D > 0){
						echo ('D : '. $o_D . '&nbsp;&nbsp;&nbsp;');
					}
					if ($o_E > 0){
						echo ('E : '. $o_E . '&nbsp;&nbsp;&nbsp;');
					}
					if ($o_F > 0){
						echo ('F : '. $o_F . '&nbsp;&nbsp;&nbsp;');
					}
					if ($o_Z > 0){
						echo ('Z : '. $o_Z . '&nbsp;&nbsp;&nbsp;');
					}
					echo ('</p>');
				};
			};


			echo "<input type='hidden' name=meal_date value='" . $date_o. "'>";
                        echo "Meal Date: " . $date . " (" . date('l', strtotime($date)) . ")";

			//echo"<br>";
			//$time_tmp = date('h:i:s'); //if time between 1100-1500 show notice

			//if ("11:00:00"<$time_tmp && $time_tmp < "15:35:00"){
    			//	echo"*Ordering session will start at 3:35 pm.";
			//}
			
                        echo "<br>";

                        $A = "A";
                        $B = "B";
                        $C = "C";
                        $D = "D";
                        $E = "E";
                        $F = "F";

                        $food_name = array();
                        $food_price = array();
        
                        /*
                                for me
                                $sql = "SELECT * from food_menu where date='".$date."'";
                                if ......
                                        while ...........
                                        echo '<input .... id="' . $row['menu ......
                                        echo '<label for ="' . $row

                                finish :P
                        */
                        $Meal_A = "SELECT * FROM food_menu WHERE menu_id = '" . $A . "' AND date = '" . $date . "' AND food_name<>'N/A';";
                        $Meal_A = "SELECT * FROM food_menu WHERE date = '" . $date . "' and meal_name <>'N/A' and menu_id<>'Z' order by menu_id;" ;
                        

			echo "<table>";
                        if($result = mysqli_query($link, $Meal_A)){
                            while($row = mysqli_fetch_array($result)){
                                //array_push($food_name,$row['meal_name']);
				echo "<tr>";

                                $food_name[$row['menu_id']] = $row['meal_name'];
                                $food_price[$row['menu_id']] = $row['food_price'];

				$sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id = "'. $date_o . $row['menu_id'] . '";';
                		$result_n = mysqli_query($link, $sql);
				$sold=0;
                		if (mysqli_num_rows($result_n)>0){
					$row_n=mysqli_fetch_array($result_n);
				 	$sold = $row_n['COUNT(*)'];
				}

				echo "<th>";

                                echo '<input type="radio" id="' .$row['menu_id'] . '" name="fav_language" value="' . $row['menu_id'] . '" onchange="EnableDisableAmount(\'Amount' . $row['menu_id'] . '\')" ';
				if (($row['number']-$sold)<=0){
					echo ("disabled");
				}
				echo ('>');

                                //echo '<th><label for="'. $row['menu_id']. '">' .$row['menu_id'].' '.$row['meal_name'].' $'.$row['food_price'].' Quota left: '.($row['number']-$sold).'</label><br>';//'Name: ' .$row['meal_name'] .'Price:'. $row['food_price'] . '</label><br>';
                                echo '<label for="'. $row['menu_id']. '">' .$row['menu_id'].' '.$row['meal_name'].' $'.$row['food_price'].' Quota left: '.($row['number']-$sold).'</label></th>';
				//'Name: ' .$row['meal_name'] .'Price:'. $row['food_price'] . '</label><br>';
				echo "<th>";
				echo '<label for="Amount' . $row['menu_id'] . '">Amount:</label><input type="number" id="Amount' .$row['menu_id'] . '" name="Amount'.$row['menu_id'].'" value="1" min=1 max=';

				if (($row['number']-$sold)<=4){
                                        echo (($row['number']-$sold));
                                }else{
					echo ('4');
				}

				echo ' disabled>';
				echo "</th>";
				echo "</th>";

				echo "</tr>";

                            }
                        }
			echo "</table>";

                        $_SESSION["food_name"] = $food_name;
                        $_SESSION["food_price"] = $food_price;
                        mysqli_close($link);
                        ?>
                        <!-- better default choose place check html radio checked-->
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="container">
                            <h2>Size</h2>
                                    <input type="radio" id="nsn" name="size" value="N" checked>
                                    <label for="ns">Normal</label><br>
                                    <input type="radio" id="nsl" name="size" value="L">
                                    <label for="nsl">More Rice</label><br>
			</div>
		    </div>
		    <br>
                    <div class="card">
                        <div class="container">
                            <h2>Pick Up Place</h2>
                                   <!-- <input type="radio" id="EE" name="place" value="E" disabled>
                                    <label for="EE">Block E</label><br>-->
                                    <input type="radio" id="CC" name="place" value="C" checked>
                                    <label for="CC">Canteen</label><br>
    <?php
                if (!$can_order){
			echo "<p>Ordering session will start from 3:35pm.</p>";
		}
		
		//      add if clause if there is no record , not show
		if ($can_order){
		if ($ordered){
    ?>
                            <input type=submit value="Order" style="border-radius: 10px; border-color: transparent; background-color: #1877f2; color: #ffffff; font-weight:  bold;" onClick='return confirmSubmit()'>
    <?php
		}else{
    ?>
                            <input type=submit value="Order" style="border-radius: 10px; border-color: transparent; background-color: #1877f2; color: #ffffff; font-weight:  bold;" onclick="this.style.display = 'none'" >
    <?php
		}
		} // can_order
    ?>
                            <input type="reset" style="border-radius: 10px; border-color: transparent; background-color: #42b72a; color: #ffffff; font-weight:  bold;" >
<script LANGUAGE="JavaScript">
// ask to confirm order or cancel  new@20230319
function confirmSubmit()
{
var agree=confirm("you have placed an order already, order more than one?");
if (agree)
 return true ;
else{
	window.location.href = 'history.php';
	return false;
}
}
    function EnableDisableAmount(opt) {
/*
var inputs = document.getElementsByTagName("input"); 
    for (var i = 0; i < inputs.length; i++) { 
        inputs[i].disabled = true;
    }*/

	var amounts = document.querySelectorAll('[id^="Amount"]');

	for (var i = 0; i < amounts.length; i++) { 
        	amounts[i].disabled = true;
    	}

	document.getElementById(opt).disabled = false;
    }
</script>

                            </form>
                        </div>
                    </div>
                </div>
        </div>
</body>
</html>
<?php
        // remeber to close the DB connection
?>
