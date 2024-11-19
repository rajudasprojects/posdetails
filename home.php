<?php
require_once("includes/connect.php");


$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';




if(isset($_POST['submit']) ? $_POST['submit'] : null)
{
	/* $suc_msg = null;
	$fail_msg = null;
	$report_dt = null;
	$report_time = null;
	$sup_require = null;
	$pos_cashoff = null;
	$sup_details = null;
	$sup_prov_by = null;
	$job_desc = null;
	$time_taken = null;
	$time_str = null;
	$time_end = null;
	$rem_status = null; */
	$report_dt = isset($_POST["date_from1"])?$_POST["date_from1"]:"";
	$report_time = isset($_POST["date_time"])?$_POST["date_time"]:"";
	$sup_require = isset($_POST["sup_require"])?$_POST["sup_require"]:"";
	$cash_off_nm = isset($_POST["cash_off_nm"])?$_POST["cash_off_nm"]:"";
	$pos_cashoff = isset($_POST["pos_cashoff"])?$_POST["pos_cashoff"]:"";
	$sup_details = isset($_POST["sup_details"])?$_POST["sup_details"]:"";
	$sup_prov_by = isset($_POST["sup_prov_by"])?$_POST["sup_prov_by"]:"";
	$job_desc = isset($_POST["job_desc"])?$_POST["job_desc"]:"";
	$time_taken = isset($_POST["time_taken"])?$_POST["time_taken"]:"";
	$time_str = isset($_POST["time_str"])?$_POST["time_str"]:"";
	$time_end = isset($_POST["time_end"])?$_POST["time_end"]:"";
	$rem_status = isset($_POST["rem_status"])?$_POST["rem_status"]:"";
	$dep_nm = isset($_POST["dep"])?$_POST["dep"]:"";
	
	$conndc = conn_treasraj_pdo();
	$query = "insert into cashoffice.cash_office_support_details(report_date,report_time,support_required_by,cash_off_nm,pos_cash_office,support_details,support_provided_by,job_description,time_taken,pass_revoked_start_time,pass_revoked_end_time,pos_status,dep_name) values('".$report_dt."','".$report_time."','".$sup_require."','".$cash_off_nm."','".$pos_cashoff."','".$sup_details."','".$sup_prov_by."','".$job_desc."','".$time_taken."','".$time_str."','".$time_end."','".$rem_status."','".$dep_nm."')";
	$sth = $conndc->prepare($query);
	if($sth->execute())
	{
		$suc_msg = "Inserted Data Successfully";
	}
	else{
		$fail_msg = "<pre>"; print_r($sth->errorInfo()); echo "</pre>"."error";
	}
    
}


?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>POS SUPPORT - HOME</title>
		
		<!-- JavaScript Code -->
		<script type="text/javascript" src="js/functions.js"></script>
		<link rel="stylesheet" href="css/style-menu.css" />
		<link rel="stylesheet" href="css/menu.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script language="JavaScript" src="calendar1.js"></script>
		<script type="text/javascript">
			<!--
			function view_details(coll_date,status,table,date_column) {
				document.frm_treasury.coll_date.value = coll_date;
				document.frm_treasury.status.value = status;
				document.frm_treasury.table.value = table;
				document.frm_treasury.date_column.value = date_column;
				document.frm_treasury.inst.value = '1';
				document.frm_treasury.action = "";
				document.frm_treasury.submit();
			}
			
			function view_monthly_mis() {
				document.frm_treasury.action = "../payment_summary_bharatpur/";
				document.frm_treasury.target = "_blank";
				document.frm_treasury.submit();
				document.frm_treasury.target = "";
			}
			//-->
		</script>
		
	</head>
	<body>
		<form method="POST" action="" name="frm_treasury" id="frm_treasury">
			<input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
			<input type="hidden" name="upwd" id="upwd" value="<?php echo $upwd; ?>">
		</form>
		
		<?php include "top.php"; ?>
		<div>
			<nav class="navbar">
				<ul class="nav-list">
				</ul>
					<ul class="nav-list">
						<li><a href="home.php">Home</a></li>
						<li><a href="initial.php">Entry</a></li>
						<li><a href="pos_view.php">View</a></li>
						<!--<li><a href="pos_update.php">Update</a></li>-->
						<li><a href="logout.php">Logout</a></li>
					</ul>
				
			</nav>
		</div>
		<div id="content">
		<div style="color:green; margin:auto; high:50px; text-align:center; padding-top:50px; font-size: 40px;">
			<?php 
				if(isset($suc_msg)){ ?>
					<div class="alert">
					  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					  <strong>Success</strong> Records saved Successfully.
					</div>
			<?php	}
			?>
		</div>
		<div style="color:red; margin-top:20px;; high:50px;">
		<?php
		if(isset($fail_msg))
		{
			echo $fail_msg;
		}
		?>
		</div>
		<div id="wel">
			<h1>Welcome in Pos Support Details.</h1>
		</div>
		
			
			
			
		<div style="float:center; text-align:center; margin-top:250px; margin-bottom:50px;">	
			<font face="verdana" size="1" color="#4FA1BB">
				<strong>Copyright &copy; 2024, Incorporation by CESC Limited</strong>
			</font>
		</div>
		</div>
	</body>
</html>