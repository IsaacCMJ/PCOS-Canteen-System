<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
?>

<html>
<head>
<meta name="viewprt" content="width=device-width, initial-scale=1.0">
<titla>Home</title>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">

</head>

<body style="background-color:#a1acba;">
	<?php include 'nav.php';
?>	

	<div class="row">
		<div class="column">
		<h2>Error 404 </h2> 
		<p font-size:15px>Page not found<br><br><br><br></p>
		<a href="idex.php">Maybe you want to go to home page?</a>
		</div>
	</div>

</body>
</html>

