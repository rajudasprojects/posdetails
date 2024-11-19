<?php
set_time_limit(50000000000);
ini_set('memory_limit', '20000M');

require_once("includes/connect.php");
echo "Execution Start date/time = ".@date('Y-m-d h:i:s')."<br>";
$count = 0;
$suc =0;
$param_string=null;
$connpdo_trclasic_dc = conn_treasraj_pdo();
$sth = $connpdo_trclasic_dc->query("select m.cashoffice_no,m.machine_no,m.machine_code,c.cashoffice_name from machine_co m, cashoffice c where m.cashoffice_no = c.cashoffice_no order by cashoffice_name");
$rows = $sth->fetchAll();
$connpdo_trclasic_dc = null;

/* echo "<pre>";
print_r($rows);exit; */

foreach($rows as $row){
	$cashoffice_no_r = $row['cashoffice_no'];
	$machine_no_r = $row['machine_no'];
	$pos_code_r = $row['machine_code'];
	$cashoffice_name_r = $row['cashoffice_name'];
	//echo $cashoffice_no_r."-".$machine_no_r."-".$pos_code_r."-".$cashoffice_name_r;exit;
	$conndc = conn_treasraj_pdo();
	$sqls_update = "UPDATE cashoffice.treasury_tran_batch SET cash_office_name = '$cashoffice_name_r', pos_name = '$pos_code_r' WHERE cashoffice_no = '$cashoffice_no_r' AND pos_no = '$machine_no_r'";
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

echo $suc."-".$count."<br>";
echo "Execution End date/time = ".@date('Y-m-d h:i:s')."<br>";
?>