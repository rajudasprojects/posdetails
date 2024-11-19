<?php
set_time_limit(50000000000);
ini_set('memory_limit', '20000M');

require_once("includes/connect.php");

echo "Execution start date/time = ".@date('Y-m-d h:i:s')."<br>";

$count = 0;
$suc =0;
$param_string=null;
$connpdo_trclasic_dc = conn_treasraj_pdo();
$sth = $connpdo_trclasic_dc->query("select pos_date,pos_no,batch_no, count(*) AS count_t from cashoffice.treasury_tran_batch WHERE typ_tranc ='1' AND pos_date >= '2024-07-12' AND pos_date <= '2024-07-19' AND st_status = '0' group by pos_date,pos_no,batch_no having count_t > 1");
$rows = $sth->fetchAll();
$connpdo_trclasic_dc = null;

/* echo "<pre>";
print_r($rows);exit; */

foreach($rows as $row){
	$pos_no_r = $row['pos_no'];
	$batch_no_r = $row['batch_no'];
	$pos_date_r = $row['pos_date'];
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

echo $suc."-".$count."<br>";

echo "Execution End date/time = ".@date('Y-m-d h:i:s')."<br>";
?>