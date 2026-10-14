<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Opps</title>

<!--link style sheet-->
<link rel="stylesheet" href="style.css">
<!-- icon-->
<link rel="icon" type="image/x-icon" href="assets/icon.png">

</head>

<body>
<?php include 'nav.php';
?>
<div class="row">
	<br>
          <div class="card">
            <div class="container">
              <h2>Opps</h2>
              <p class="title">Error Occured</p>
		<p>You will be back to home page after 5 seconds</p>
		<a href="index.php">Redirect</a>
            </div>
          </div>
</div>
<script>
         setTimeout(function(){
            window.location.href = 'index.php';
         }, 5000);
      </script>
</body>
</html>
