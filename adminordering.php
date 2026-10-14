<?php
    session_start();
    if (isset($_SESSION['username']) == false) {header("Location: redirect.php");}

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
            <div class="card">
                <div class="container">
                <table>
                <tr>
                    <th>Student ID</th>
                    <th>Meal</th>
                    </tr>
                <?php
                    require_once "db.php";

                    if (isset($_POST["day"]) == false) $day = date("Y-m-d",strtotime("today"));
                    else $day = $_POST["day"];
                    $newDate = date("Ymd", strtotime($day));

                    // Table
                    $sql = 'SELECT * FROM orderlist WHERE food_id LIKE "%'. $newDate. '%";';
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . substr($row['food_id'],8) . "</td>";
                                }
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            //echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

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

