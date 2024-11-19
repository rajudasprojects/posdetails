<?php
/* Save table data before rollback */
function save_data_before_rollback($connpdo, $source_record, $destination_table){
	
	$table_fields = array_keys($source_record);
	$table_fields = implode(",",$table_fields);
	$param_array = array_values($source_record);
	$question_marks = implode(",",array_fill(0, count($param_array), "?"));
	
	$sql = "INSERT INTO `treasrajonl`.`$destination_table`($table_fields) VALUES($question_marks)";
	$stmt = $connpdo->prepare($sql);
	$stmt->execute($param_array);
	$stmt = null;	
}

/* Remove information from IT */
function remove_info_from_it($it_receipt_no){
	$it_confirm_url = "http://10.40.16.26:8084/rdfcommws/payment_auth_cis.jsp";
	$it_confirm_postdata = array(
		'jsondataauth' => json_encode(
			array(
				"AUTHPAYMENTDATA" => array(
					array(
						"RECEIPTNO" => $it_receipt_no,
						"kno" => "X",
						"ACTION" => "DELETE",
						"NEWAMOUNT" => "0",
						"NEWMODE" => "X",
						"NEWKNO" => "X"
					)
				),
				"TOTALPAYMENTRECORDS" => "1",
				"TOTALAMOUNT" => "0"
			)
		)
	);
	$ch_it_confirm = curl_init();
	curl_setopt($ch_it_confirm,CURLOPT_URL,$it_confirm_url);
	curl_setopt($ch_it_confirm,CURLOPT_POST,1);
	curl_setopt($ch_it_confirm,CURLOPT_POSTFIELDS,http_build_query($it_confirm_postdata));
	curl_setopt($ch_it_confirm,CURLOPT_RETURNTRANSFER, true);
	$ch_itinstant_response = curl_exec($ch_it_confirm);
	curl_close($ch_it_confirm);
}

/* Check if information removed from IT */
function if_removed_from_it($it_receipt_no){
	$ch = curl_init();
	$url_instant = "http://10.40.16.26:8084/rdfcommws/payment_instant_tran_cis.jsp?rcptno=" . $it_receipt_no;
	curl_setopt($ch, CURLOPT_URL, $url_instant);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response_instant = json_decode(curl_exec($ch),true);
	curl_close($ch);
	if( isset($response_instant["RESPONSE"]) && $response_instant["RESPONSE"] == "RECEIPT_NO_FOUND") {
		return false;
	} else {
		return true;
	}
}

/* Update rollback table data */
function update_rollback_table_data($connpdo,$it_receipt_no,$table_name){
	$pending_data_query = pdo_result(
		$connpdo,
		"UPDATE treasrajonl.`$table_name` SET `rollback_status` = '1' WHERE `it_receipt_no` = ?",
		$it_receipt_no
	);
	$pending_data_query = null;
}


/* IT inform table update */
function delete_it_inform_table($connpdo,$it_receipt_no,$table_name){
	$it_track_del = pdo_result(
		$connpdo,
		"DELETE FROM treasrajonl.`$table_name` WHERE `it_receipt_no` = ?",
		$it_receipt_no
	);
	$it_track_del = null;
}


/* Check if rollback data available */
function check_if_rollback_pending($connpdo, $table_name){
	$rollback_pending_query = pdo_result(
		$connpdo,
		"SELECT * FROM treasrajonl.`$table_name` WHERE `rollback_status` = '0'",
		''
	);
	$rollback_pending_data = $rollback_pending_query->fetchAll(PDO::FETCH_ASSOC);
	$rollback_pending_query = null;
	if(!empty($rollback_pending_data)){
		return $rollback_pending_data;
	} else {
		return false;	
	}
}
?>