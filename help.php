<?php
    require_once "config.php";
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Help</title>
<link rel="icon" type="image/x-icon" href="assets/icon.png">
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:a1acba">
<?php include 'nav.php';
?>

<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Report Bug</h2>
              <p>If you find a bug, Please report it via this link.</p>
              <a href="https://docs.google.com/forms/d/e/1FAIpQLSfcJtORpsBSkoH4ni0eLiiRmLki7Jr41IrD8XemHqCkUZoT9w/viewform?usp=pp_url&entry.1768179687=Bug+Report">Report Bug</a>
            </div>
          </div>
        </div>
      
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>FAQ</h2>
              <p>If you have a problem, Click the link below.</p>
              <a href="FAQ.php">FAQ</a>
	     <!-- <p>This page is now in maintenance. Please try it later</p> -->
            </div>
          </div>
        </div>
      </div>
</div>
<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Having problem</h2>
              <p>Having a problem which isn't answered in FAQ? You can ask the developers or fill in the google form.</p>
              <a href="mailto:<?php echo SUPPORT_EMAIL; ?>?subject=PCOS%20problem%20solving">Ask the developer</a>
	      <a href="https://docs.google.com/forms/d/e/1FAIpQLSfcJtORpsBSkoH4ni0eLiiRmLki7Jr41IrD8XemHqCkUZoT9w/viewform?usp=pp_url&entry.1768179687=Ask+for+help">Link to Google Form </a>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Get any advice?</h2>
              <p>Every piece of advice is valuable for us. Please share them via this link.</p>
              <a href="https://docs.google.com/forms/d/e/1FAIpQLSfcJtORpsBSkoH4ni0eLiiRmLki7Jr41IrD8XemHqCkUZoT9w/viewform?usp=pp_url&entry.1768179687=Advice+/+Feedback">Share your ideas</a>
            </div>
          </div>
        </div>

</div>

</body>
</html>
