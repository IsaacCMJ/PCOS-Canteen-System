<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About</title>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">
</head>
<body style="background-color: a1acba">
<?php include 'nav.php';
?>
<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Mr. Law Yan Ming (Billy Sir)</h2>
              <p class="title">Instructor and System Analyst</p>
	      <p>- Instructing<br>- Techincal Advice<br>- Hardware  Management</p>
              <p><a href="mailto:pc-billy@puiching.edu.hk">pc-billy@puiching.edu.hk</a></p>
            </div>
          </div>
        </div>


        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Lam Cheuk Hay</h2>
              <p class="title">System Manager</p>
		<p>- System Management<br>- Website Draft and Structure<br>- Testing</p>
              <p>House of Serenity 2025</p>
            </div>
          </div>
        </div>

</div>
<div class="row">      
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Ho Legolas Baggio</h2>
              <p class="title">Art Instructor and Main Designer</p>
		<p>- Page Designing<br>- Logo Designing<br>- Advertisement Designing</p>
		<p>House of Serenity 2025</p>
            </div>
          </div>
        </div>
     

        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Yip Hoi Shun</h2>
              <p class="title">Database Designer and Website Tester</p>
		<p>- Database Designing<br>- Page Development<br>- PHP Development</p>
		<p>House of Serenity 2025</p>
            </div>
          </div>
        </div>
</div> <div class="row">      
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Kwok Tsz Kai Jevons</h2>
              <p class="title">Techincal Support and Debugging</p>
		<p>- PHP Development<br>- Database Designing<br>- Testing and Debugging</p>
              <p>House of Grace 2024</p>
            </div>
          </div>
        </div>
      

        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Choi Man Jit Isaac</h2>
              <p class="title">Database Designer and Customer Service Rep</p>
		<p>- Database Designing<br>- Page Development<br>- PHP Development<br></p>
		<p>House of Serenity 2025</p>
            </div>
          </div>
        </div>
</div>
</body>
</html>
