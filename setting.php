<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
	
	// check the if date is posted
	// select data from DB
	// if find , display 
	// else enable the text box
	
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Setting</title>

<!--link style sheet-->
<link rel="stylesheet" href="style.css">
<!-- icon-->
<link rel="icon" type="image/x-icon" href="assets/icon.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
//alert("Please wait after pressing the submit button, the system need time to process.");
function flag(lol){
    
    var ok = true;
    var a,aa,aaa,b,bb,bbb,c,cc,ccc,d,dd,ddd,e,ee,eee,f,ff,fff;
    var xa = false,xb = false,xc = false,xd = false,xe = false, xf =false;

    if (document.getElementById("A_food").value  === "") { a=false;   }
    if (document.getElementById("A_qty").value   === "") { aa=false;  }
    if (document.getElementById("A_price").value === "") { aaa=false; }
    
    if (document.getElementById("B_food").value  === "") { b=false;   }
    if (document.getElementById("B_qty").value   === "") { bb=false;  }
    if (document.getElementById("B_price").value === "") { bbb=false; }
    
    if (document.getElementById("C_food").value  === "") { c=false;   }
    if (document.getElementById("C_qty").value   === "") { cc=false;  }
    if (document.getElementById("C_price").value === "") { ccc=false; }
    
    if (document.getElementById("D_food").value  === "") { d=false;   }
    if (document.getElementById("D_qty").value   === "") { dd=false;  }
    if (document.getElementById("D_price").value === "") { ddd=false; }
    
    if (document.getElementById("E_food").value  === "") { e=false;   }
    if (document.getElementById("E_qty").value   === "") { ee=false;  }
    if (document.getElementById("E_price").value === "") { eee=false; }
    
    if (document.getElementById("F_food").value  === "") { f=false;   }
    if (document.getElementById("F_qty").value   === "") { ff=false;  }
    if (document.getElementById("F_price").value === "") { fff=false; }

    if(allEqual(a,aa,aaa)) { xa=true; }
    else{ ok=false; }
    
    if(allEqual(b,bb,bbb)) { xb=true; }
    else{ ok=false; }
    
    if(allEqual(c,cc,ccc)) { xc=true; }
    else{ ok=false; }
    
    if(allEqual(d,dd,ddd)) { xd=true; }
    else{ ok=false; }
    
    if(allEqual(e,ee,eee)) { xe=true; }
    else{ ok=false; }
    
    if(allEqual(f,ff,fff)) { xf=true; }
    else{ ok=false; }
    
    if (ok){
            document.getElementById("action_form").submit();
    }
    else{
        alert("Something went wrong.")
        return;
    }
    
    //alert("try to search how to submit from in javascript");
}

</script>

</head>

<body>   
	<?php include 'nav.php';	
	

    // admin flag is set at login from the lists in config.php
    if (empty($_SESSION["admin"])) {header("Location:error.php"); exit;}
    ?>

   <div class="column" style="width:100%;">
        <h3>Field with * must be filled in, If there isn't any meal provide, please fill in 'N/A' in food name and '0' in the price field.</h3>
        <h4>Thanks for your attention again</h4>
    </div>


    <form action="setting_action.php" method="post" id="action_form" onsubmit="flag();">
        <label for="day">* Select Date:</label>
        <input type="date" id="day" name="day" onblur="get_data();" required>

<!-- using ajax to get data from server -->
<script>
    function get_data(){
	    var select_op=$('#day').val();
	    // using ajax to call the php to get the data
	    $.ajax({
	        url: "setting_ajax.php",
	        data: {select_day: select_op},
	        type:"POST",
	        success: function(data){
			// parse the return data to JSON
			data = JSON.parse(data);
			// iterate the data and update the text field
			var arr = ['A','B','C','D','E','F','Z']; // var arr = ['A','B','C','D','E','F'];
			$.each(arr, function(index, value){
				$('#'+value+"_food").val('N/A');
				$('#'+value+"_price").val(0);
				$('#'+value+"_qty").val(0);
			});


			for(var key in data.os) {
     				menu_id=data.os[key].menu_id;
				$('#'+menu_id+"_food").val(data.os[key].meal_name);
				$('#'+menu_id+"_price").val(data.os[key].food_price);
				$('#'+menu_id+"_qty").val(data.os[key].number);
			}
	        },

	        error:   function(jqXHR, textStatus, errorThrown){ 
	            alert(errorThrown); 
	        }
	    });
    }
</script>

<?php   // add a input type=hidden name=action value=insert/update 
       // and then check the post value is setting_action.php need insert or update
      // then set a variable call $disable = "disabled"/""
	$disable = "disabled";
?>
	    <ul class="navv" style="border-radius:15px 15px 0 0;" > 
	        <li><h2>Set A</h2></li><br>
	 
	        <li>
		    <label for="A_food">Food name:</label>
	            <input type="text" id="A_food" name="A_food">
	        </li>
	  
	        <li>
	            <label for="A_price">Price:</label>
	            <input type="number" id="A_price" name="A_price" min="0" max="200" step=".1">
	        </li>

	        <li>
	            <label for="A_qty">Quantity:</label>
	            <input type="number" id="A_qty" name="A_qty" min="0" max="500" step="1">
	        </li>
	    </ul>

	    <ul class="nav"> 
	        <li><h2>Set B</h2></li><br>
	  
	        <li>
	            <label for="B_food">Food name:</label>
	            <input type="text" id="B_food" name="B_food">
	        </li>
	  
	        <li>
	            <label for="B_price">Price:</label>
	            <input type="number" id="B_price" name="B_price" min="0" max="200" step=".1">
	        </li>

		<li>
	            <label for="B_qty">Quantity:</label>
	            <input type="number" id="B_qty" name="B_qty" min="0" max="500" step="1">
	        </li>

	    </ul>

	   <ul class="navv"> 
	        <li><h2>Set C</h2></li><br>
	  
	        <li>
	            <label for="C_food">Food name:</label>
	            <input type="text" id="C_food" name="C_food">
	        </li>
  
	        <li>
	            <label for="C_price">Price:</label>
	            <input type="number" id="C_price" name="C_price" min="0" max="200" step=".1">
	        </li>

		<li>
	            <label for="C_qty">Quantity:</label>
	            <input type="number" id="C_qty" name="C_qty" min="0" max="500" step="1" >
	        </li>

	    </ul>

	    <ul class="nav"> 
	        <li><h2>Set D</h2></li><br>
	  
	        <li>
	            <label for="D_food">Food name:</label>
	            <input type="text" id="D_food" name="D_food">
	        </li>
	  
	        <li>
	            <label for="D_price">Price:</label>
	            <input type="number" id="D_price" name="D_price" min="0" max="200" step=".1">
	        </li>

		<li>
	            <label for="D_qty">Quantity:</label>
	            <input type="number" id="D_qty" name="D_qty" min="0" max="500" step="1">
	        </li>

	    </ul>

	   <ul class="navv"> 
	        <li><h2>Set E</h2></li><br>
	  
	        <li>
	            <label for="E_food">Food name:</label>
	            <input type="text" id="E_food" name="E_food">
	        </li>
  
	        <li>
	            <label for="E_price">Price:</label>
	            <input type="number" id="E_price" name="E_price" min="0" max="200" step=".1">
	        </li>

		<li>
	            <label for="E_qty">Quantity:</label>
	            <input type="number" id="E_qty" name="E_qty" min="0" max="500" step="1">
	        </li>

	    </ul>

	   <ul class="nav"> 
	        <li><h2>Set F</h2></li><br>
	  
	        <li>
	            <label for="F_food">Food name:</label>
	            <input type="text" id="F_food" name="F_food">
	        </li>
  
	        <li>
	            <label for="F_price">Price:</label>
	            <input type="number" id="F_price" name="F_price" min="0" max="200" step=".1">
	        </li>

		<li>
	            <label for="F_qty">Quantity:</label>
	            <input type="number" id="F_qty" name="F_qty" min="0" max="500" step="1">
	        </li>

	    </ul>

	    <ul class="navv">
		<li><h2>Cart Noodles</h2></li><br>

 		<li>
                    <label for="Z_qty">Quantity:</label>
                    <input type="number" id="Z_qty" name="Z_qty" min="0" max="500" step="1">
                </li>

	    </ul>

	    <ul class="nav" style="border-radius:0 0 15px 15px;">
	        <li><input type="reset" value="Reset"></li>
	        <li><input type="submit" value="Submit"></li>
	    </ul>
	
	</form>



</body>
</html>
