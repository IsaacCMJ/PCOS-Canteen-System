<?php

    require_once "vendor/autoload.php";
    require_once "config.php";

    function email_notification($usr,$meal,$num,$date){

	if (is_numeric(substr($usr, 0, 1))){
        	$email = 'pc'.$usr.'@'.SCHOOL_EMAIL_DOMAIN;
	}else{
        	$email = $usr.'@'.SCHOOL_EMAIL_DOMAIN;
	}


        $output = '<p style="margin:20px; background-color: white; border-radius: 15px; font-size: 20px;">';
        $output .= '<strong>';
        $output .= 'You have placed an order successfully!<br>';
        $output .= 'Your order number is ' . $num . '<br>';
        $output .= 'Remember to go to the canteen on ' . substr($date,0,8);
	$output .= ' to pay!';
        $output .= '</strong></p><hr>';
	$output .= '<p style="font-size: 13px">*This email is sent automatically as you have successfully ordered one or more meal(s) in PCOS. Should you have any enquries, please';
	$output .= ' <a href="mailto:'.SUPPORT_EMAIL.'"> email '.SUPPORT_EMAIL.'</a>.';
	$output .= '<br>*If you want to cancel the order(s), please go to';
	$output .= ' <a href="'.SITE_URL.'/history.php">history page</a> to cancel the order(s) you want.</p>';

        $body = $output;
        $subject = "=?utf-8?B?" . base64_encode("PCOS " . substr($date,0,8) . "   "  . substr($date,8,1) . "餐點餐確認") . "?=";

        $email_to = $email;
        $fromserver = MAIL_FROM;
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = SMTP_PORT;
        $mail->IsHTML(true);
        $mail->From = MAIL_FROM;
        $mail->FromName = MAIL_FROM_NAME;
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        if(!$mail->Send()){
        //        echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
  //              echo "<div class='error'>
    //            <p>An email has been sent to you with instructions on how to reset your password.</p>
      //          </div><br /><br /><br />";
        }
    }

    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
    // connect db
    // check if the data vaild
    // insert into student_order

?>
<?php
require_once("db.php");
if(isset($_POST["fav_language"]) && isset($_POST["place"])) {
			// Setup Today
                        date_default_timezone_set("Asia/Hong_Kong");
                        $day = date('l'); // Eg. Monday
                        $date = date("Y-m-d");
                        $h = date("G");
                        $m = date("i");


			$finish_message = ' ';
                       // Date Algorithm
/*
                        if ($day == "Friday" || $day == "Saturday" || $day == "Sunday") {
                            $date = date("Ymd", strtotime("next tuesday"));
                        }elseif ($day == "Thursday") {
                            $date = date("Ymd", strtotime("next monday"));
                        }
                        else {
                            $date = date("Ymd", strtotime("+2 days"));
                        }
*/
                        // Date Algorithm
                        $h = date("G");
                        $m = date("i");

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
                        if ($h >=8){
                        if ($day == "Friday" || $day == "Saturday") {
                            $date = date("Y-m-d", strtotime("next monday"));
                            $date = date("Ymd", strtotime("next monday"));
                        }
                        else {
                            $date = date("Y-m-d", strtotime("tomorrow"));
                            $date = date("Ymd", strtotime("tomorrow"));
                        }
                        }
                        else
                        {
			    if ($day=="Saturday" || $day=="Sunday"){
                            $date = date("Y-m-d", strtotime("next monday"));
                            $date = date("Ymd", strtotime("next monday"));
			    }else{
                            $date = date("Y-m-d");
                            $date = date("Ymd");
			    }
                        }


/*
                        if ($day == "Friday" || $day == "Saturday") {
                            $date = date("Ymd", strtotime("next monday"));
                        }
                        else {
                            $date = date("Ymd", strtotime("tomorrow"));
                        }*/

    //$Choice = $_POST["fav_language"];
    //$d=strtotime("tomorrow");
       // $date=date("Ymd", $d);
    $date = $_POST["meal_date"];
    $choice = $_POST["fav_language"];
    $food_id = $date . $choice;
    $place  = $_POST["place"];
    $amount_id = "Amount".$choice;
    $size = $_POST["size"];

    $amount = intval($_POST[$amount_id]);

    if ($amount > 4) {
	$amount = 4;
    }
    if ($amount <1) {
        $amount = 1;
    }


$can_order=true;


for ($i=0;$i<$amount;$i++){
    $dt = date("Y-m-d H:i:s");
    $quantity = 0;
    $sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id LIKE "%'. $date. '%" and user_id LIKE "%' . $_SESSION['stu_id'] . '";';

    if ( ($result = mysqli_query($link, $sql)) && $can_order ){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
//            if ($row['COUNT(*)'] > 0) {
            if (false) {
		echo '<script>alert("You have already ordered a meal before!")</script>';
    //header("location: order.php");
	    echo" <script>setTimeout(function(){window.location.href = 'history.php';}, 0);</script>";
               // header("location: history.php");
               // echo "You have already ordered.";
            }
            else {
                // Check quantity
                $sql = 'SELECT number FROM food_menu WHERE date = ' . $date . ' and menu_id = "' . $choice . '";';
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $quantity = intval($row["number"]);
                    }
                }

                //mysqli_free_result($result);

                // Check if sold out
                $sql = 'SELECT COUNT(*) FROM orderlist WHERE food_id = "'. $date . $choice . '";';
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        if ($row['COUNT(*)'] >= $quantity) {
                            //header("location: sold_out.php");
			    $finish_message = $finish_message . " sold out ";
                        }
                        else {
			   // add by billy to add the order number per day
			    $sql = "SELECT COUNT(*) FROM orderlist WHERE food_id like '". $date . "%';";
			    $sql = "SELECT max(order_num) as o_n FROM orderlist WHERE food_id like '". $date . "%';";
				//echo ($sql);
			    $result_no = mysqli_query($link, $sql);
			    $row_no = mysqli_fetch_array($result_no);
			    if (is_numeric($row_no['o_n'])){
				$next_num = $row_no['o_n']+1;
			    }
			    else{
				$next_num = 1;
			    }
			    /*if(mysqli_num_rows($result_no) > 0){
				$row_no = mysqli_fetch_array($result_no);
			    	$next_num = $row_no['COUNT(*)']+1;
			   }else{
				$next_num = 1;
				}*/

                            $sql = "INSERT INTO orderlist (user_id, food_name, food_id, tran_dt, price, place, order_num, size) VALUES ('" . $_SESSION['stu_id'] . "','" . $_SESSION["food_name"][$choice] . "','" . $food_id . "','" . $dt . "','" . $_SESSION["food_price"][$choice] .  "','" . $place . "'," . $next_num . ",'".$size."');";

			    if ($_SESSION['stu_id'] == ''){
				$finish_message = $finish_message . " error ";
		            } else {
                            mysqli_query($link, $sql);
			    $finish_message = $finish_message . " " . ($choice.str_pad($next_num, 3, '0', STR_PAD_LEFT)) . " ";
			    // email notification

			    email_notification($_SESSION['stu_id'], $_SESSION["food_name"][$choice],$choice.str_pad($next_num, 3, '0', STR_PAD_LEFT),$food_id);


			    }
                        }
                    }
                }
                //mysqli_free_result($result);
            }
                
            // Free result set
            //mysqli_free_result($result);
        } else{
            //echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
    } else{
        //echo "Oops! Something went wrong. Please try again later.";
        $finish_message = $finish_message . " something went wrong " ;
    }
} // end of for loop
    /*echo $sql;
    if($result = mysqli_query($link, $sql)) {
        if(mysqli_num_rows($result) > 0){
            echo $row['COUNT(*)'];
            //header("location: history.php");
        }else {

            //$sql = "INSERT INTO orderlist (user_id, tran_dt, price, place) VALUES ('" . $_SESSION['stu_id'] . "'" . $afood . "','" . $day . "','" . $aprice . "','" . $aqty . "')";
            $sql = "INSERT INTO orderlist (user_id, food_name, food_id, tran_dt, place) VALUES ('" . $_SESSION['stu_id'] . "','" . $_SESSION["food_name"][$choice] . "','" . $food_id . "','" . $dt . "','"$
            mysqli_query($link, $sql);
        }
    }*/


    mysqli_close($link);
}else {
    echo '<script>alert("Please select both meal and location!")</script>';
    //header("location: order.php");
    echo" <script>setTimeout(function(){window.location.href = 'order.php';}, 0);</script>";
}
?>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Finished Ordering</title>
<link rel="icon" type="image/x-icon" href="assets/icon.png">
<link rel="stylesheet" href="style.css">
</head>
<body  style="background-color:#a1acba;"> 
	<?php include 'nav.php';
?>
	<div class="column" style="width:100%">
	<div class="card">
	<div class="container">
        <p style="font-size: 18px;">
        <strong>
        You have placed an order successfully!<br>
	<!--Your order number is <?php //echo ($choice.str_pad($next_num, 2, '0', STR_PAD_LEFT));?><br> -->
	Your order number / status is <?php echo ($finish_message);?><br> 
        Remember to go to the canteen on
    <script>
        var nextDay = new Date();
        var time = nextDay.getHours();
        nextDay.setDate(nextDay.getDate() + 1);
        if(nextDay.getDay() == 6) {nextDay.setDate(nextDay.getDate() + 2)}
        else if(nextDay.getDay() == 0) {nextDay.setDate(nextDay.getDate() + 1)}
        else if(time < 8) {nextDay.setDate(nextDay.getDate() - 1)};
        var m = nextDay.getMonth() + 1;
        var d = nextDay.getDate();
        var y = nextDay.getFullYear();
                if (m < 10) { m = "0" + m } 
        if (d < 10) { d = "0" + d }
        document.write("<b>" + y + "/" + m + "/" + d + "</b>");
        </script>
    to pay!
        </strong></p></div></div></div>
</body>
</html>

