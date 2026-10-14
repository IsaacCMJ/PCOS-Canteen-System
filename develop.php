<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
    // admin flag is set at login from the lists in config.php
    if (empty($_SESSION["admin"])) {header("Location:error.php"); exit;}

    function isRealDate($date) {

        if (false === strtotime($date)) {
        
        return false;
        
        }
    }
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
<title>Status</title>

<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">

</head>
<body style="background-color:#a1acba;">
	<?php include 'nav.php';
?>


    <form action="develop.php" method="post">
    <label for="day">Select Date:</label>
    <input type="date" id="day" name="day" required="">
    <button>Submit</button>

	<div class="row">
		<div class="column">
		    <h1> Order List</h1>
			<div id="print-content">
  			<input type="button" onclick="printDiv()" value="print a div!"/>
			</div>
            <div class="card">
                <div class="container">
                <table>
                <tr>
                    <th>Student ID</th>
                    <th>Meal</th>
		    <th>Meal name</th>
		    <th>Taken</th>
                    </tr>
                <?php
                    require_once "db.php";

                    if (isset($_POST["day"]) == false) $day = date("Y-m-d",strtotime("today"));
                    else $day = $_POST["day"];
                    $newDate = date("Ymd", strtotime($day));

                    // Table
                    $sql = 'SELECT * FROM orderlist WHERE food_id LIKE "%'. $newDate. '%" order by food_id,order_num;';
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
				$jsonarray = array();
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . substr($row['food_id'],8) . "</td>";
                                        echo "<td>" . $row['food_name'] . "</td>";
					echo "<td>" . $row['taken'] . "</td>";
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
		    //$jsonarray = json_encode($jsonarray, JSON_FORCE_OBJECT);
		    $jsonarray = json_encode($jsonarray);
		    echo '<script type="text/javascript">
			function printDiv() {
				var data = ' . $jsonarray . ';
				//var json_upload = "json_name=" + JSON.stringify({name:"John Rambo", time:"2pm"});
				var json_upload = "json_name=" + JSON.stringify(data);
				//var data64 = btoa(json_upload);
				//var link = "http://172.16.100.67/billy/web2/canteen_print.php?" + data64;
				console.log(link); 
				//window.open(link,"winname","directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350");
				var link = "http://172.16.100.67/billy/web2/canteen_print.php?" + json_upload;
				console.log(link); 
				window.open(link,"winname","directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350");
			}
			</script>
		    ';
		    //echo json_encode($jsonarray);
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
                        $sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id LIKE "%'. $newDate. '%" and food_id LIKE "%' .$c . '";';

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
		$sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id LIKE "%'. $newDate. '%" and food_id LIKE "%Z";';

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

