<?php
/*
|-------------------------------------------------
| BEDL Treasury - Check Access
|-------------------------------------------------
| @ Summary: Authinticate a logged in user.
| @ Developped By: Saptarshi Banerjee
| @ Version: 1.0.0
|-------------------------------------------------
*/

/* Base URL */
if( ! defined( 'BASE_URL' ))
	define('BASE_URL', 'http://10.50.81.105/possupportdetails/');

/*
|-------------------------------------------------
| Collect and decode the user ID and Password.
|-------------------------------------------------
*/
$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';

/*
|-------------------------------------------------
| Check and provide aythentication.
|-------------------------------------------------
*/
$sysdate = @date('Y-m-d');
$connpdo = conn_treasraj_pdo();
$sqls_login_check = "SELECT * FROM cashoffice.login_user_entry WHERE user_name = ? AND temp_passwrd = ? AND user_type = '1'";
$param_string = $uid."|".$upwd;
$count_login_check = pdo_count($connpdo,$sqls_login_check,$param_string);
$param_string = "";
$connpdo = null;

if(strpos($_SERVER['HTTP_REFERER'], BASE_URL) === false ){
	?>
	<center><font face="vardana" size="3" color="red"><b>[ERROR:CA01]AUTHENTICATION FAILED. YOU NEED TO LOGIN ONCE AGAIN.<BR>PLEASE <a href="<?php echo BASE_URL; ?>index.php" target="_top" style="color:#FF0000;">CLICK HERE TO LOG IN.</a></b></font></center>
	<script id="clientEventHandlersJS" LANGUAGE="javascript">
	<!--
	window.close();
	//-->
	</script>	
	<?php 
	exit();
} else if(!empty($_GET)){
	?>
	<center><font face="vardana" size="3" color="red"><b>[ERROR:CA02]AUTHENTICATION FAILED. YOU NEED TO LOGIN ONCE AGAIN.<BR>PLEASE <a href="<?php echo BASE_URL; ?>index.php" target="_top" style="color:#FF0000;">CLICK HERE TO LOG IN.</a></b></font></center>
	<script id="clientEventHandlersJS" LANGUAGE="javascript">
	<!--
	window.close();
	//-->
	</script>	
	<?php 
	exit();
} else if( $count_login_check == 0 ) { 
	?>
	<center><font face="vardana" size="3" color="red"><b>[ERROR:CA03]AUTHENTICATION FAILED. YOU NEED TO LOGIN ONCE AGAIN2.<BR>PLEASE <a href="<?php echo BASE_URL; ?>index.php" target="_top" style="color:#FF0000;">CLICK HERE TO LOG IN.</a></b></font></center>
	<script id="clientEventHandlersJS" LANGUAGE="javascript">
	<!--
	window.close();
	//-->
	</script>	
	<?php 
	exit();
} else { 
	$connpdo = conn_treasraj_pdo();
	$sqls_login_check = "SELECT * FROM cashoffice.login_user_entry WHERE user_name = ? AND temp_passwrd = ?";
	$param_string = $uid."|".$upwd;
	$login_data_rss = pdo_result($connpdo,$sqls_login_check,$param_string);
	$login_data = $login_data_rss->fetch(PDO::FETCH_ASSOC);
	$login_data_rss = null;
	$param_string = "";
	$connpdo = null;
	//$user_typ = $login_data['user_type'];
}
?>