<?php
        session_start();
        if (isset($_SESSION['username']) == false){
                header("Location:redirect.php");
        }
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">
</head>
<body style="background-color:a1acba">
    <?php include 'nav.php';
?>	


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4 mb-3 clearfix">
                        <h2 class="pull-left"><strong>History<strong></h2>
                    </div>

                    <?php
                    /*session_start();*/

                    require_once "db.php";
                       // Setup Today
                    date_default_timezone_set("Asia/Hong_Kong");
                    $day = date('l'); // Eg. Monday
                    $date = date("Y-m-d");

                    // Date Algorithm
                    if ($day == "Friday" || $day == "Saturday" || $day == "Sunday") {
                        $date = date("Y-m-d", strtotime("next tuesday"));
                    }elseif ($day == "Thursdayday") {
                        $date = date("Y-m-d", strtotime("next monday"));
                    }
                    else {
                        $date = date("Y-m-d", strtotime("+2 days"));
                    }
                    
                    $id = $_SESSION['stu_id'];

		    $hr = date('H');
		    if ($hr>=8){
			$enddate = date("Ymd",strtotime("+1 day"));
		    }
		    else{
			$enddate = date("Ymd");
		    }

                    $stack = "";
                    // Table
                    $sql = "SELECT * FROM orderlist WHERE user_id ='$id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
			   echo '<div style="overflow-y:scroll; height: 500px;">';
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        //echo "<th>#</th>";
                                        echo "<th>Food</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Order Number</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    $str = "";

				    $orderNum = substr($row["food_id"] .  str_pad($row['order_num'],2,'0',STR_PAD_LEFT),-3);
                                    $orderNum = substr($row["food_id"],-1).$row["order_num"]; //.  str_pad($row['order_num'],2,'0',STR_PAD_LEFT),-3);

					$str .= "<tr>";
                                        //echo "<td>" . $row['order_id'] . "</td>";
                                        $str .= "<td>" . $row['food_name'] . "</td>";
                                        $str .= "<td>" . $row['tran_dt'] . "</td>";
                                        $str .= "<td>" . $row['price'] . "</td>";
                                        $str .= "<td>" . $orderNum . "</td>";
					if (substr($row["food_id"],0,8) >= $enddate) {
                                        	$str .= '<td><a href="cancel_order.php?food_id='. $row['food_id'] .'&order_id=' . $row['order_id'] . '">Cancel Order</a></td>';
					}else{
                                        	if ($row['taken'] == 1){
						  $str .= '<td>Taken</td>';
						}
						else {$str .= '<td>&nbsp;</td>';}
					}
                                        $str .= "</tr>";

                                    $stack = $str . $stack;
                                }
                                echo $stack;
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    mysqli_close($link);
                    ?>
                </div>
		</div>
            </div>        
        </div>
    </div>
   <br>
</body>
</html>
