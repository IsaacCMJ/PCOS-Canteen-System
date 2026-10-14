<?php
    require_once "vendor/autoload.php";
    require_once "config.php";

    session_start();

    $client = new Google_Client();
    $client -> setClientId(GOOGLE_CLIENT_ID);
    $client -> setClientSecret(GOOGLE_CLIENT_SECRET);
    $client -> setRedirectUri(GOOGLE_REDIRECT_URI);

    $client -> revokeToken($_SESSION["access_token"]);

    unset ($_SESSION["access_token"]);

    session_destroy();

    header('Location: redirect.php');
?>
<html>
<body onload="myFunction()">

<script>
function myFunction() {
  if (confirm("Do you wish to logout your google account at the same time?\n")) {
    window.open("https://mail.google.com/mail/logout", "_blank");
  }
}
</script>
</html>
