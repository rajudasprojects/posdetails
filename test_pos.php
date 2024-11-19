<?php
set_time_limit(50000000000);
ini_set('memory_limit', '20000M');

require_once("includes/connect.php");

$count = 0;
$suc =0;
$param_string=null;
$connpdo_trclasic_dc = conn_treasraj_pdo();
$sth = $connpdo_trclasic_dc->query("select m.cashoffice_no,m.machine_no,m.machine_code,c.cashoffice_name from machine_co m, cashoffice c where m.cashoffice_no = c.cashoffice_no order by cashoffice_name LIMIT 10");
$rows = $sth->fetchAll();
$connpdo_trclasic_dc = null;

echo "<pre>";
print_r($rows);exit;

foreach($rows as $row){
	$cashoffice_no_r = $row['cashoffice_no'];
	$machine_no_r = $row['machine_no'];
	$machine_code_r = $row['machine_code'];
	$cashoffice_name_r = $row['cashoffice_name'];
	//echo $pos_no_r."-".$batch_no_r."-".$pos_date_r;exit;
	$conndc = conn_treasraj_pdo();
	$sqls_update = "UPDATE cashoffice.treasury_tran_batch SET st_status = '1' WHERE pos_no = '$pos_no_r' AND batch_no = '$batch_no_r' AND pos_date = '$pos_date_r' AND st_status = '0'";
	$sth = $conndc->prepare($sqls_update);
	if($sth->execute())
		{
			$suc ++;
		}
		else{
			$fail_msg = "<pre>"; print_r($sth->errorInfo()); echo "</pre>"."error";
		}
	$count ++;
}

echo $suc."-".$count;
?>