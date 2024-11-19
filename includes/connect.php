<?php
date_default_timezone_set('Asia/Kolkata');
ini_set('memory_limit', '-1');

//- Time Zone -//
date_default_timezone_set('Asia/Kolkata');

if(!function_exists("conn_treasraj_pdo")) 
{
	function conn_treasraj_pdo()
	{		
		$host='10.50.81.105';
		$user='root';
		$pass='Cesc@12345';
		$port='3308';
		$db_name='treasury';
		$connection = db_connection($host,$user,$pass,$db_name,$port);
		return $connection;
	}
}

if(!function_exists("conn_treasry_pdo")) 
{
	function conn_treasry_pdo()
	{		
		$host='10.50.81.105';
		$user='root';
		$pass='Cesc@12345';
		$port='3308';
		$db_name='treasurystatus_control';
		$connection = db_connection($host,$user,$pass,$db_name,$port);
		return $connection;
	}
}

if(!function_exists("db_connection")) 
{
	function db_connection($host,$user,$pass,$db_name,$port)
	{
		try {
			$connection = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$db_name, $user, $pass);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			$connection = null;
			//die();
		}
		return $connection;
	}
}

if(!function_exists("pdo_result")) 
{
	
	function pdo_result($connpdo,$query,$param_str)
	{
		try	{
			$param_array = explode("|",$param_str);
			$param_array_count = count($param_array);
			$pck_query_result = $connpdo->prepare($query);
			for($i=0;$i<$param_array_count;$i++)
			{
				$pck_query_result->bindParam($i+1, $param_array[$i], PDO::PARAM_STR);
			}
			$pck_query_result->execute();	
			//$pck_query_result->debugDumpParams();	
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			$pck_query_result = null;
		}
		return $pck_query_result;
	}
}

if(!function_exists("pdo_count")) 
{
	function pdo_count($connpdo,$query,$paramstring)
	{
		try {
			$param_array = explode("|",$paramstring);
			$param_array_count = count($param_array);
			$pck_query_result = $connpdo->prepare($query);
			for($i=0;$i<$param_array_count;$i++)
			{
				$pck_query_result->bindParam(($i+1), $param_array[$i], PDO::PARAM_STR);
			}
			$pck_query_result->execute();
			//$pck_query_result->debugDumpParams();
			$count_val = count($pck_query_result->fetchAll(PDO::FETCH_ASSOC));
			$pck_query_result = null;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			$count_val = null;
			$pck_query_result = null;
		}
		return $count_val;
	}
}

/* Decide the primary table name(by date) -------------- */
function get_table_name_by_date($pdo_connection,$table_name,$date) {
	
	$stmt_gtnbd = $pdo_connection->prepare("SELECT * FROM `table_back_ups` WHERE `tbl_source` = ? ORDER BY `date_upto` DESC");
	$stmt_gtnbd->bindParam(1, $table_name, PDO::PARAM_STR);
	$stmt_gtnbd->execute();
	$gtnbd = $stmt_gtnbd->fetch(PDO::FETCH_ASSOC);
	$stmt_gtnbd = null;

	$table_name = ($date > $gtnbd["date_upto"]) ? $table_name : $gtnbd["tbl_backup"];
	
	return $table_name;
}

/* Decide the primary table name(by data) -------------- */
function get_table_name_by_field($pdo_connection,$table_name,$column_name,$column_data) {
	
	$stmt_get_data = $pdo_connection->prepare("SELECT * FROM `$table_name` WHERE `$column_name` = ?");
	$stmt_get_data->bindParam(1, $column_data, PDO::PARAM_STR);
	$stmt_get_data->execute();
	$get_data = $stmt_get_data->fetchAll(PDO::FETCH_ASSOC);
	$stmt_get_data = null;
	if(count($get_data) > 0){
		return $table_name;
	} else {
		$stmt_gtnbd = $pdo_connection->prepare("SELECT * FROM `table_back_ups` WHERE `tbl_source` = ? ORDER BY `date_upto` DESC");
		$stmt_gtnbd->bindParam(1, $table_name, PDO::PARAM_STR);
		$stmt_gtnbd->execute();
		$gtnbd = $stmt_gtnbd->fetchAll(PDO::FETCH_ASSOC);
		$stmt_gtnbd = null;
		
		foreach($gtnbd as $gtn){
			$table_name = $gtn['tbl_backup'];
			$stmt_get_data = $pdo_connection->prepare("SELECT * FROM `$table_name` WHERE `$column_name` = ?");
			$stmt_get_data->bindParam(1, $column_data, PDO::PARAM_STR);
			$stmt_get_data->execute();
			$get_data = $stmt_get_data->fetchAll(PDO::FETCH_ASSOC);
			$stmt_get_data = null;
			if(count($get_data) > 0){
				return $table_name;
			}
		}
	}	
	
	return '';
}

//- Get a autoincremented value(date wise) by table  -//
function get_autoincrement_value($pdo_connection, $tablename, $aicolumn, $date, $date_column, $increment = '1', $start = '1') {
	$stmt_ai = $pdo_connection->prepare("SELECT MAX(`$aicolumn`) AS aicol FROM `$tablename` WHERE DATE_FORMAT(`$date_column`,'%Y-%m-%d') = ?");
	$stmt_ai->bindParam(1, $date, PDO::PARAM_STR);
	$stmt_ai->execute();
	$ai = $stmt_ai->fetch(PDO::FETCH_ASSOC);
	$new_aival = is_numeric($ai['aicol']) ? ($ai['aicol'] + $increment) : $start;
	$stmt_ai = null;
	return $new_aival;
}

//- Get the root URL of the project  -//
function get_root_url($appened = false){
	$root_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$root_url .= "://".$_SERVER['HTTP_HOST'];
	$root_url .= "/possupportdetails/";
	if($appened){
		$root_url .= $appened;
	}
	return $root_url;
}

//- Encrypt the file name  -//
function file_name_encrypt($file_name, $cdate = false, $cntr = false, $prefix = false){
	$file_name_without_extenssion = pathinfo($file_name, PATHINFO_FILENAME);
	$file_name_arr = explode("_", $file_name_without_extenssion);
	
	$cdate_str = ($cdate && isset($file_name_arr[$cdate])) ? "_" . $file_name_arr[$cdate] : "";
	$cntr_str = ($cntr && isset($file_name_arr[$cntr])) ? "_" . $file_name_arr[$cntr] : "";
	$prefix_str = ($prefix) ? "_" . $prefix : "";
	
	return "ENCLKGDR" . $prefix_str . $cdate_str . $cntr_str . ".txt";
}


//- Set Max browser execution time to 1 hour -//
set_time_limit(999999);

$color1 = "#0360a6";
$color2 = "#4FA1BB";
$color3 = "#EEEEEE";
$color4 = "#235670";
$color5 = "#A3A3A3";
$color6 = "#cc99cc";
?>