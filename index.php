<?php

require_once("includes/connect.php");
$ip_add=$_SERVER['REMOTE_ADDR'];
//Getting the recaptcha response
session_start();

$err = isset($_POST['err']) ? $_POST['err'] : "";

/*
|-------------------------------------------------
| Form Submission
|-------------------------------------------------
*/
include "includes/xhytgp.php";

/*
|-------------------------------------------------
| HTML Template
|-------------------------------------------------
*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta Information -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Make the design scallable in all devices -->
		
		<!-- Styles -->
		<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/style-login.css" />
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<title>POS SUPPORT | Login</title>
		
		<!-- JavaScript -->
		<script src="js/jquery.min.js"></script>
		<script src="js/login-validation.js"></script>
		
	</head>
	
	<body oncontextmenu="return false">
		
		<div class="login-container">
		<h2 style="color:#106cc2; text-align: center">POS SUPPORT ENTRY SYSTEM</h2>
			<div class="login-box">				
				<!-- Logo -->
				<img class="login_logo" src="images/cesc_ltd.jpg" />
								
				<!-- Error Messages -->
				<?php if( isset($err) && $err != "" ) { ?>
					<div id="login_error_message" class="error_message"><?php echo $err; ?></div>
				<?php } else if(isset($_GET["logout"])) { ?>
					<div id="login_error_message" class="success_message">You have successfully logged out</div>
				<?php } else { ?>
					<div id="login_error_message" class="error_message" style="display:none;"></div>
				<?php } ?>
				
				<!-- Form -->
				<form method="POST" action="login_val.php" name="cesc_login_form" id="cesc_login_form" class="login-form">
					<input type="text" name="cesc_login_userid" id="cesc_login_userid" placeholder="User ID" value="<?php if(isset($cesc_login_userid)) echo $cesc_login_userid; ?>" onpaste="return false;" onKeypress="return CheckKeys(event)" />
					<input type="password" name="cesc_login_password" id="cesc_login_password" placeholder="Password" autocomplete="off" onpaste="return false;" onKeypress="return CheckKeys(event)" />
					<div id="recap" class="g-recaptcha" data-sitekey="<?php echo $site_key?>"></div>
					<button type="submit" name="cesc_login_submit" id="cesc_login_submit">login</button>
				</form>	
			</div> <!-- end of class 'login-box' -->
		</div> <!-- end of class 'login-container' -->
		<script>
		function CheckKeys(e) {
			e = (e) ? e: ((window.event) ? e: null);
			var code = (e.charCode) ? e.charCode: ((e.which) ? e.which: e.keyCode);
			//alert(e)
			if (code != 13 && code != 8 && code != 46 && (code < 65 || code > 90) && (code < 48 || code > 57) && (code < 97 || code > 122)) return false;
			return true;
		}
		</script>
	</body>
</html>
