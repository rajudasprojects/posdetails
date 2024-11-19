<?php



require_once("includes/connect.php");
//include "includes/chk_access.php";

$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';

$update_val = 0;
$report_pos_dt = date("Y-m-d");

	if(isset($_POST['search']) ? $_POST['search'] : null)
	{
		$search_date = $_POST['search'];
		
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		$sth = $connpdo_trclasic_dc->query("select * from cashoffice.cash_office_support_details WHERE report_date = '$report_pos_dt' AND pos_cash_office LIKE '%$search_date%'");
		$rows = $sth->fetchAll();
		if(empty($rows)){
			$fail_msg = "Sorry record is not in corrent date!";
		}
		$connpdo_trclasic_dc = null;
		$update_val = 1;
	}else{
		
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		$sth = $connpdo_trclasic_dc->query("select * from cashoffice.cash_office_support_details WHERE report_date = '$report_pos_dt' order by report_date DESC LIMIT 1");
		$rows = $sth->fetchAll();
		$connpdo_trclasic_dc = null;
		if(empty($rows)){
			$fail_msg = "Sorry no records found for the day!";
		}
	}
	
	
	if(isset($_POST["update"]) ? $_POST["update"] : null)
	{
		
		$suc_msg = null;
		$fail_msg = null;
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
		$pos_status = isset($_POST["rem_status"])?$_POST["rem_status"]:"";
		
		$conndc = conn_treasraj_pdo();
		$sqls_update = "UPDATE cashoffice.cash_office_support_details SET report_date = '$report_dt', report_time = '$report_time', support_required_by = '$sup_require', cash_off_nm = '$cash_off_nm', pos_cash_office = '$pos_cashoff', support_details = '$sup_details', support_provided_by = '$sup_prov_by', job_description = '$job_desc', time_taken = '$time_taken', pass_revoked_start_time = '$time_str', pass_revoked_end_time = '$time_end', pos_status = '$pos_status'  WHERE pos_cash_office = '$pos_cashoff'";
		$sth = $conndc->prepare($sqls_update);
		
		if($sth->execute())
		{
			$suc_msg = "Update Data Successfully";
		}
		else{
			$fail_msg = "error";
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
		<script language="JavaScript" src="calendar1.js"></script>
		<script type="text/javascript">
			<!--
			
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
						<li><a href="initial.php">Entry</a></li>
						<li><a href="pos_view.php">View</a></li>
						<!--<li><a href="pos_update.php">Update</a></li>-->
						<li><a href="logout.php">Logout</a></li>
					</ul>
				
			</nav>
		</div>
		<div id="content">
		
		<div style="color:green; margin:auto; high:50px; text-align:center; padding-top:50px;">
			<?php 
				if(isset($suc_msg)){?>
					<div class="alert">
					  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					  <strong>Success</strong> Records updated Successfully.
					</div>
			<?php	}
			
			?>
		</div>
		<div style="color:red; margin-top:20px;; high:50px;">
		<?php 
				if(isset($fail_msg)){?>
					<div class="alert2">
					  <span class="closebtn2" onclick="this.parentElement.style.display='none';">&times;</span> 
					  <strong><?php echo $fail_msg; ?></strong> 
					</div>
			<?php	
				exit;
				}
			?>
		</div>
		<form name="frm_entry" id="frm_entry" method="post" action="">
			<table style="margin-top:50px;">
			<div class="search">
				<form action="#">
					<input type="text" placeholder="Search POS No & Update" name="search">
					<button>
						<i class="fa fa-search">Search</i>
					</button>
				</form>
			</div>
			<?php	
			if(isset($rows) > 0)
			{
				foreach($rows as $row)
				{
					
			?>
				<tr id="tr-bg">
					<td>
						<label for="fname">Report Date:</label>
						<INPUT type="date" name="date_from1" id="date_from1" value="<?php echo $row['report_date']?>"><br><br>
					</td>
					<td>
						<label for="fname">Report Time:</label>
						<INPUT type="time" name="date_time" id="date_time" value="<?php echo $row['report_time']?>" ><br><br>
					</td>
					<td>
						<label for="fname">Support Require By:</label>
						<INPUT type="text" name="sup_require" id="sup_require" value="<?php echo $row['support_required_by']?>" ><br><br>
					</td>
					
					<td>
						<label for="fname">Cash Office Name:</label>
						<INPUT type="text" name="cash_off_nm" id="cash_off_nm" value="<?php echo $row['cash_off_nm']?>" ><br><br>
					</td>
					
										
				</tr>
				<tr id="tr-bg">
					<td>
						<label for="fname">POS No:</label>
						<INPUT type="text" name="pos_cashoff" id="pos_cashoff" value="<?php echo $row['pos_cash_office']?>"><br><br>
					</td>
				
					<td>
						<label for="fname">Support Details:</label>
						<INPUT type="text" name="sup_details" id="sup_details" value="<?php echo $row['support_details']?>" ><br><br>
					</td>
					
					<td>
						<label for="fname">Support Provided By:</label>
						<INPUT type="text" name="sup_prov_by" id="sup_prov_by" value="<?php echo $row['support_provided_by']?>"><br><br>
					</td>
					
					<td>
						<label for="fname">Job Descriptions:</label>
						<INPUT type="text" name="job_desc" id="job_desc" value="<?php echo $row['job_description']?>"><br><br>
					</td>
					
					
					
				</tr >
				<tr id="tr-bg">
					<td>
						<label for="fname">Time Taken:</label>
						<INPUT type="time" name="time_taken" id="time_taken" value="<?php echo $row['time_taken']?>" ><br><br>
					</td>
					<td>
						<label for="fname">Time Start:</label>
						<INPUT type="time" name="time_str" id="time_str" value="<?php echo $row['pass_revoked_start_time']?>" ><br><br>
					</td>
					
					<td>
						<label for="fname">Time End:</label>
						<INPUT type="time" name="time_end" id="time_end" value="<?php echo $row['pass_revoked_end_time']?>"><br><br>
					</td>
					
					<td>
						<label for="fname">Status:</label><br>
						<INPUT type="text" name="rem_status" id="rem_status" value="<?php echo $row['pos_status']?>"><br><br>
					</td>
				</tr>
				
			<?php
				}
				
			}				
			
			?>
			<?php
				if($update_val == 1){ ?>
					<tr id="tr-bg"><td></td><td></td><td><input type="submit" name="update" class="button" value="UPDATE"></td><td></td></tr>
			<?php	}
			?>
				
			<table>
			
		</form>
			
			
			
		<div style="float:center; text-align:center; margin-top:50px; margin-bottom:50px;">	
			<font face="verdana" size="1" color="#4FA1BB">
				<strong>Copyright &copy; 2024, Incorporation by CESC Limited</strong>
			</font>
		</div>
		</div>
	</body>
</html>