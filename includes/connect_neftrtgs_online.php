<?php
if(!function_exists("conn_treasraj_nro")) 
{
	function conn_treasraj_nro()
	{
		$conn = mysql_connect("rajtreasury2","kedlcouser","bodmas");
		//$conn = mysql_connect("localhost","root","");
		mysql_select_db("kedl",$conn);
		
		return $conn;
	}
}
if(!function_exists("conn_close_nro")) 
{
	function conn_close_nro($conn)
	{
		@mysql_close($conn);
	}
}
if(!function_exists("conn_treasraj_pdo_nro")) 
{
	function conn_treasraj_pdo_nro()
	{
		//live connection variables
		$host='rajtreasury2';
		$user='kedlcouser';
		$pass='bodmas';
		/*$host='localhost';
		$user='root';
		$pass='';*/
		
		$db_name='kedl';
		$connection = db_connection_nro($host,$user,$pass,$db_name);
		return $connection;
	}
}
if(!function_exists("db_connection_nro")) 
{
	function db_connection_nro($host,$user,$pass,$db_name)
	{
		try {
			$connection = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $pass);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			$connection = null;
			//die();
		}
		return $connection;
	}
}

if(!function_exists("pdo_result_nro")) 
{
	function pdo_result_nro($connpdo,$query,$param_str)
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
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			$pck_query_result = null;
		}
		return $pck_query_result;
	}
}

if(!function_exists("pdo_count_nro")) 
{
	function pdo_count_nro($connpdo,$query,$paramstring)
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
$color1 = "#0360a6";
$color2 = "#4FA1BB";
$color3 = "#EEEEEE";
$color4 = "#235670";
$color5 = "#A3A3A3";
$color6 = "#cc99cc";
?>