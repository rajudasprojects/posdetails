<?php

include "includes/connect.php";
include "includes/chk_access.php";

$uid = '987654';

$connpdo = conn_treasraj_pdo();
$sqls_update_tmppass = "UPDATE cashoffice.login_user_entry SET temp_passwrd = '' WHERE user_id = '$uid'";
$param_string = $uid;
$update_tmppass = pdo_result($connpdo,$sqls_update_tmppass,$param_string);
$connpdo = null;
header('Location: ' . BASE_URL);
exit();
?>