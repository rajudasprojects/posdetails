<?php
require_once("includes/connect.php");
//Getting the recaptcha response
//echo print_r($_POST);exit;
if(isset($_POST['g-recaptcha-response']))
{
	$captcha=$_POST['g-recaptcha-response'];
}

if(!$captcha)
{
	echo "<BR><BR><BR><CENTER><FONT FACE=VERDANA SIZE=2 COLOR=RED><B>INCORRECT CAPTCHA</B></FONT></CENTER><BR>";
	echo "<CENTER><FONT FACE=VERDANA SIZE=2 COLOR=RED><B>SORRY, YOU CANNOT PROCEED.</B></FONT></CENTER>";
	exit();
}


include "includes/xhytgp.php";

$secretKey = $secret_key;

//post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);

$loginsuccess = "0";
if( isset( $_POST['cesc_login_userid'] ) ) {
	/* Collecting form submit information */
	$cesc_login_userid = htmlspecialchars(stripslashes(trim($_POST["cesc_login_userid"])));
	$cesc_login_password = htmlspecialchars(stripslashes(trim($_POST["cesc_login_password"])));
	
	/* Server Side(PHP)Validation  */
	$err = '';
	if( empty( $cesc_login_userid ) ) {
		$err = 'ERROR: Please enter a User ID';
	} elseif( ! is_numeric( $cesc_login_userid ) ) {
		$err = 'ERROR: User ID must be numeric';
	} elseif( strlen( $cesc_login_userid ) > 7 ) {
		$err = 'ERROR: User ID must be less than 7 characters';
	}elseif( empty( $cesc_login_password ) ) {
		$err = 'ERROR: Please enter a password';
	} elseif( ! ctype_alnum( $cesc_login_password ) ) {
		$err = 'ERROR: No special characters are allowed in password field';
	} elseif( strlen( $cesc_login_password ) > 20 ) {
		$err = 'ERROR: Password must be less than 20 characters';
	} else {
		$connpdo = conn_treasraj_pdo();
		if(isset($connpdo) && $connpdo) {
			$sqls_login = "SELECT * FROM treasurystatus_control.login_user_entry WHERE user_name = ? AND user_pass = ? AND user_type = '1'";
			$param_string = $cesc_login_userid."|".$cesc_login_password;
			$count_login = pdo_count($connpdo,$sqls_login,$param_string);
			$param_string = "";
			if($count_login > 0) {
				$user_type = "1";
				$temp_passwrd = rand(1000, 1000000);
				$sqls_update_tmppass = "UPDATE treasurystatus_control.login_user_entry SET login_ip = '$ip_add', temp_passwrd ='$temp_passwrd' WHERE user_name = '$cesc_login_userid' AND user_pass = '$cesc_login_password' AND user_type = '$user_type'";				
				$sth = $connpdo->prepare($sqls_update_tmppass);
				$sth->execute();
				
				$loginsuccess = "1";
			} else {
				$err = 'Invalid User ID or password. Please try again';
			}
		} else {
			$err = 'There is a temporary problem in the database server. Please check back in sometime or contact administrator.';
		}
		$connpdo = null;
	}
}


/*
|-------------------------------------------------
| Redirect After Log In.
|-------------------------------------------------
*/
if( $loginsuccess == "1" && $responseKeys["success"] ) {?>
<!DOCTYPE html>
<html>
	<head>
		<script id=clientEventHandlersJS language=javascript>
		<!--
		function page_redirect() {
			document.frm_treasury.action = "home.php";
			document.frm_treasury.submit();
			return true;
		}
		//-->
		</script>
	</head>
<?php } else {?>
	<script id=clientEventHandlersJS language=javascript>
		<!--
		function page_redirect() {
			document.frm_treasury.action = "index.php";
			document.frm_treasury.submit();
			return true;
		}
		//-->
	</script>
<?php
}
?>
	<body onload="page_redirect()">
		<form method="POST" action="" name="frm_treasury" id="frm_treasury">
		<input type="hidden" name="err" id="err" value="<?php echo $err; ?>">
			<input type="hidden" name="uid" id="uid" value="<?php echo $cesc_login_userid; ?>">
			<input type="hidden" name="upwd" id="upwd" value="<?php echo $temp_passwrd; ?>">
		</form>
	</body>
</html>
