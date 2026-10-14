<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }

    // connect db
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Order</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="assets/icon.png">
    </head>

<script type="text/javascript">
    function counter1(j) {
        var total = 0;
        for (var i = 0; i < document.cart_noodle.ckb1.length; i++) {
            if (document.cart_noodle.ckb1[i].checked) {
                total = total + 1;
            }
            if (total > 1) {
                alert("You can at most choose two toppings")
                document.cart_noodle.ckb1[j].checked = false;
                return false;
            }
        }
            
    }

    function counter2(j) {
        var total = 0;
        var checkbox = document.getElementsByName('ckb2[]');
        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                total = total + 1;
           }
            if (total > 2) {
                alert("You can at most choose two toppings")
                checkbox[i].checked = false;
                return false;
            }
        }
            
    }

    function validateForm() {
	document.cart_noodle.finish.disalbed = true;	
        var total = 0;
        for (var i = 0; i < document.cart_noodle.ckb2.length; i++) {
            if (document.cart_noodle.ckb2[i].checked) {
                total = total + 1;
            }
        }
  	if (total != 2) {
    		alert("You must choose two toppings");
    		return false;
    	}
     }
</script>

<body>
<?php include 'nav.php';
?>


    <form name=cart_noodle method="POST" action="finishCartNoodle.php" onsubmit="return validateForm()">
        <div class="row">
            <div class="column">
                <div class="card">
<?php
			require_once "db.php";

                        // Setup Today
                        date_default_timezone_set("Asia/Hong_Kong");
                        $day = date('l'); // Eg. Monday
                        $date = date("Y-m-d");
                        $h = date("G");
                        $m = date("i");

			$can_order = true;
                        //Block the order after 08:00 each school day ---------new@20241001 ------------
                        if (($day != "Sunday") && ($day != "Saturday")){
				if (($h >=8) && ($h<=15)){
                                        $can_order=false;
                                }
                        }

                        // Date Algorithm
                        if ($h >=8){
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

                                        echo ('<div class="container"><p> You have ordered </p><p>');
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
                                                echo ('Z : '. $o_Z. '&nbsp;&nbsp;&nbsp;');
                                        }
                                        echo ('</p></div>');
                                };
                        };
?>
		    <div class="container">
<?php                        echo "<input type='hidden' name=meal_date value='" . $date_o. "'>";
                        echo "Meal Date: " . $date . " (" . date('l', strtotime($date)) . ")";
                        echo "<br>";
			echo "Price : $30 with two toppings";
                        echo "<br>";
?>
			
		    </div>

                    <div class="container" >
                        <h2>Toppings</h2>
                    </div> 
                    <div class="container" style="overflow-y:scroll; height: 500px;">
                        <table>

<?php
    $options = array("時菜", "鹵水蛋(1隻)", "魚蛋(4粒)","雞扒","芝心丸(2粒)","芝士波腸(3粒)","火腿(2片)","香腸(2條)","午餐肉(2塊)","煎蛋(1隻)","漢堡扒(1塊)","紅腸(2塊)","芝士海鲜豆腐","雞中翼(2隻)","紫菜","白蘿蔔(4件)","芝士海鮮豆腐(2粒)","金菇","番茄肉碎","鮮腐皮","蟹柳(2條)","牛丸(2粒)","炸菜肉絲","鴨胸(3片)","五香肉丁","沙嗲牛肉","雪菜肉絲");
    for ($i = 0; $i <= 26; $i++) {
        echo "<tr><td>" . $options[$i] .
        "</td>
        <td><input type=checkbox name='ckb2[]' id='chkb2[]' value='".$options[$i]."' onclick='counter2(".$i.")';></td>
    </tr>
        ";
    }
?>
        
                        </table>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="container">
                        <table>
                            <h2>Noodles</h2>
                            <select style="border-radius: 10px" name="ckb1" id="ckb1">
                            <option style="border-radius: 10px"  value="河粉" onclick='counter1(0)';>河粉</option>
                            <option value="米粉" onclick='counter1(1)';>米粉</option>
                            <option value="米線" onclick='counter1(2)';>米線</option>
                            </select>
                        </table>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="container">
                        <h2>Order</h2>
			<?php
			/*disable function*/

			$sql_quota = "select number from food_menu where menu_id='Z' and date='".$date ."';";

			//echo $sql_quota;
                        $result_n =mysqli_query($link, $sql_quota);
			$quota = 0;
                        if(mysqli_num_rows($result_n)>0){
                                $row_n=mysqli_fetch_array($result_n);
                                $quota=$row_n['number'];
                        }
		


			$sql_count="SELECT COUNT(*) FROM orderlist WHERE food_id = '". $date_o . "Z';";
			//echo $sql_count;
                        $result_n =mysqli_query($link, $sql_count);
                        //echo "<!--";
			//$sold = intval($result_n);
			$sold=0;
                        if(mysqli_num_rows($result_n)>0){
                                $row_n=mysqli_fetch_array($result_n);
                                $sold=$row_n['COUNT(*)'];
				//echo "<!--";
                        	//$sold= intval($result_n);
			}
			
			//echo $quota ;
			//echo $sold;
			echo "<h4> Quota left : ";
                        echo ($quota-$sold);//echo ($result_n-$sold); //failed
			echo "</h4>";


			if (!$can_order){
				echo"<p> Ordering session will start at 3:35pm.</p>
				
				";
			}
                        else if(($quota-$sold)<=0){
                               echo " 
				    <input type=submit  
				    style='border-radius: 10px; border-color: transparent; background-color: #808080; color: #ffffff; font-weight:  bold;' 
				    value='Sold Out' disabled >
				    ";
                        }
			else{ ?> 
				     <input type=submit  style='border-radius: 10px; border-color: transparent; background-color: #1877f2; color: #ffffff; font-weight:  bold;' value='Order' name='finish' id='finish' onclick="this.style.display = 'none'">

			<?php
			}
			?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
