<?php
    require_once "vendor/autoload.php";
    require_once "config.php";

    $client = new Google_Client();
    $client -> setClientId(GOOGLE_CLIENT_ID);
    $client -> setClientSecret(GOOGLE_CLIENT_SECRET);
    $client -> setRedirectUri(GOOGLE_REDIRECT_URI);
    $client -> addScope("email");
    $client -> addScope("profile");

    if (isset($_GET["code"])) {
        $token = $client -> fetchAccessTokenWithAuthCode($_GET["code"]);
        $client -> setAccessToken($token["access_token"]);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth -> userinfo -> get();
        $email = $google_account_info -> email;
        $name = $google_account_info -> name;

        session_start();
        $_SESSION["username"] = $name;
        $_SESSION["name"] = substr($name, 31);
        $_SESSION["class"] = substr($name, 0, 4);

        $_SESSION["email"] = $email;

	if (strcmp(substr($email, 2, 1),'2') == 0) {
       		 $_SESSION["stu_id"] = substr($email, 2, 8);
	} else {
		$_SESSION["stu_id"] = substr($email, 0, strpos($email, '@'));
        	$_SESSION["name"] = $name;
	//$_SESSION["stu_id"] = aaaaaa;
	}	

	// admin lists live in config.php
	$_SESSION["admin"] = in_array($_SESSION["stu_id"], ADMIN_STUDENT_IDS) || in_array($_SESSION["email"], ADMIN_EMAILS);

        header("Location: index.php");
    }

    else {
?>


<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">	
        <link rel="icon" type="image/x-icon" href="assets/icon.png">
	 <link rel="apple-touch-icon" href="assets/icon.png">
    </head>

    <body>
        <div class="container">
            <div class="center">
                <form method="post">
                    <div class="half">
		                <h1>PCOS</h1>
                        <h3>Pui Ching Ordering System</h3>
                        <br>
                        <button class="btn_login" type="submit" name="btn_faq" value="faq">FAQ</button> <br>
                        <br>
                        <button class="btn_google" type="submit" name="btn_google" value="login">Sign in with Google</button>
                    </div>
                </form>
                <div class="half2">
                    <image src="assets/FullLogoWithSlogan.png" width="200" height="250">
                </div>
            </div>
        </div>
    </body>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color:rgb(34, 42, 53);
        }

        input {
            width: 100%;
            margin: 5px 0;
            height: 55px;
            vertical-align: middle;
            font-size: 16px;
            border: 1px solid #dddfe2;
            color: #1d2129;
            padding: 0 8px;
            outline: none;
        }

        .btn_google {
            background-color: #1877f2;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            padding: 0 16px;
            color: #ffffff;
            font-weight: 700;
            line-height: 24px;
            width: 250px;
            height: 40px;
            margin-top: 5px; 
        }
        
        .btn_login {
            background-color: #42b72a;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            padding: 0 16px;
            color: #ffffff;
            font-weight: 700;
            line-height: 24px;
            width: 100%;
            height: 40px;
            margin-top: 5px; 
        }


        .half{
            flex: 1;
            color: #222a35;
        }

        .half h1{
            font-size: 40px;
            line-height: 20px;
            margin-left: -2px;
        }

        .half2{
            flex: 1;
            margin-left: 15px;
            color: whitesmoke;
        }

        .container {
            height: 99%;
            position: relative;
        }

        .center {
            border-style: solid;
            border-width: 20px;
            border-color: whitesmoke;
            border-radius: 30px;
            background-color: whitesmoke;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            display: flex;
        }
        
        @media screen and (max-width:1000px) {
            .half2{
                display: none;
            }

            .half h1{
                text-align: center;
                margin-left: px;
            }

            .half p{
                text-align: center;
            }
	   .half h3{ 
		text-align: center;
	   }
        }
    </style>

</html>

<?php
	}
        if(isset($_POST['btn_google'])) {
            $authUrl = $client->createAuthUrl();
//	    if ($_SESSION["admin"] = false){
            header('Location: ' . $authUrl);
//	    }
	}
	if(isset($_POST['btn_faq'])) {
            header('Location: FAQ.html');
        }
	
?>
