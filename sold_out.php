<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order</title>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">
</head>
<body style="background-color:a1acba">
<?php include 'nav.php';
?>

                <div class="column" style="width:100%" >
                    <div class="card">
                        <div class="container">
                        <h2>Sorry. The meal you chose was sold out. Please choose another one. Thanks</h2>
			<h3>You will be back to order page after seconds.</h3>
			<a href="order.php">Redirect</a>
                        </div>
                    </div>
                </div>
</div>
<script>
         setTimeout(function(){
            window.location.href = 'order.php';
         }, 5000);
      </script>
</body>
</html>
