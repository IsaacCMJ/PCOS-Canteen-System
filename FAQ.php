<?php
    session_start();
    if (isset($_SESSION['username']) == false) {
        header("Location: redirect.php");
    }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQ</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="image/x-icon" href="assets/icon.png">
</head>
<body style="background-color:a1acba">
<?php include 'nav.php';
?>

<h1 style="margin: 20px">FAQ</h1>




<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q1: Can I login into PCOS without using puiching email?</h2>
              <p class="title">A: No, the PCOS can only be accessed via puiching gmail. We are sorry for the inconvenience.</p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q2: What should I do when I encounter a bug?</h2>
              <p class="title">A: You may report it via our <a href="https://docs.google.com/forms/d/e/1FAIpQLSfcJtORpsBSkoH4ni0eLiiRmLki7Jr41IrD8XemHqCkUZoT9w/viewform?usp=pp_url&entry.1768179687=Bug+Report">Report Bug</a> form, so our developers can deal with it. Thank you. </p>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q3: Can I propose any ideas?</h2>
              <p class="title">Suggestions are always welcome. Feel free to give your advice <a href = "https://docs.google.com/forms/d/e/1FAIpQLSfcJtORpsBSkoH4ni0eLiiRmLki7Jr41IrD8XemHqCkUZoT9w/viewform?usp=pp_url&entry.1768179687=Advice+/+Feedback">here</a>.</p><br>
            </div>
          </div>
        </div>


        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q4: What will happen if I don't pay for my lunch? </h2>
              <p class="title">A: You should pay for your lunch to avoid the risks of receiving penalties. Your lunch will NOT be canceled and you will still need to pay for your lunch afterward.<br></p>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q5: Is there any handling fee?</h2>
              <p class="title">A: No, there isn't any handling fee.<br><br><br></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q6: Which payment methods can be used? </h2>
              <p class="title">A: You can pay for your meal during lunchtime. You are kindly reminded that you can pay with cash or Octopus if you order your lunch via PCOS.<br>*Please prepare excact fare if you choose to use cash for the payment.</p>
            </div>
          </div>
        </div>
      </div>

<div class="row">
        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q7: Can I order lunches for my team? </h2>
              <p class="title">A: PCOS now supports multiple purchases at a time. You can purchase at most 4 lunches in a single order.</p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <div class="container">
              <h2>Q8: Who has access to my order history?</h2>
              <p class="title">A: Only developers, canteen staff and yourself can access your ordering history.</p>
            </div>
          </div>
        </div>
      </div>

</body>
</html>

