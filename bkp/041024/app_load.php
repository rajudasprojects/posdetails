<?php
require_once("includes/connect.php");

if($_POST['tp']==""){
	$connpdo_treasry = conn_treasry_pdo();
	$query = $connpdo_treasry->prepare("select cashoffice_no,cashoffice_code,cashoffice_name,cashoffice_sup_ip,cashoffice_sup_pass,co_tel,cashoffice_address,co_switch_ip_1,co_switch_ip_2 from `treasury`.`cashoffice` where cashoffice_no is not null order by cashoffice_name");
	$query->execute();
	$result = $query -> fetchAll();
	$connpdo_treasry = null;
	$str="";
	foreach($result as $row_list ){
		$str .= "<option value='{$row_list['cashoffice_no']}'>{$row_list['cashoffice_name']}</option>";
	}
}else if($_POST['tp']==1){
	$post_id = $_POST['id'];
	$connpdo_treasry = conn_treasry_pdo();
	$query = $connpdo_treasry->prepare("select * from treasury.machine_co where cashoffice_no = $post_id order by machine_code");
	$query->execute();
	$result_cs = $query -> fetchAll();
	$connpdo_treasry = null;
	$str="<option value='0'>Select</option>";
	foreach($result_cs as $row_cs ){
		$pos_no = trim($row_cs['machine_no']);
		$pos_code = trim($row_cs['machine_code']);
		
		$str .= "<option value='{$pos_no}'>{$pos_code}</option>";
	}
}


echo $str;
?>