<?php
require_once("includes/connect.php");
//include "includes/chk_access.php";

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
	$castype1 = isset($_POST["castype"])?$_POST["castype"]:"";
	$castype = filter_var($castype1, FILTER_SANITIZE_STRING);
	$cash_nm1 = isset($_POST["dep"])?$_POST["dep"]:"";
	$cash_nm = filter_var($cash_nm1, FILTER_SANITIZE_STRING);
	$pos_nm1 = isset($_POST["dep_no"])?$_POST["dep_no"]:"";
	$pos_nm = filter_var($pos_nm1, FILTER_SANITIZE_STRING);
	$vendor_nm1 = isset($_POST["vendor_nm"])?$_POST["vendor_nm"]:"";
	$vendor_nm = filter_var($vendor_nm1, FILTER_SANITIZE_STRING);
	$sup_require1 = isset($_POST["sup_require"])?$_POST["sup_require"]:"";
	$sup_require = filter_var($sup_require1, FILTER_SANITIZE_STRING);
	$sup_details1 = isset($_POST["sup_details"])?$_POST["sup_details"]:"";
	$sup_details = filter_var($sup_details1, FILTER_SANITIZE_STRING);
	$job_desc1 = isset($_POST["job_desc"])?$_POST["job_desc"]:"";
	$job_desc = filter_var($job_desc1, FILTER_SANITIZE_STRING);
	$sup_prov_by1 = isset($_POST["sup_prov_by"])?$_POST["sup_prov_by"]:"";
	$sup_prov_by = filter_var($sup_prov_by1, FILTER_SANITIZE_STRING);
	$report_dt1 = isset($_POST["date_from1"])?$_POST["date_from1"]:"";
	$report_dt = filter_var($report_dt1, FILTER_SANITIZE_STRING);
	$report_time1 = isset($_POST["date_time"])?$_POST["date_time"]:"";
	$report_time = filter_var($report_time1, FILTER_SANITIZE_STRING);
	$time_taken1 = isset($_POST["time_taken"])?$_POST["time_taken"]:"";
	$time_taken = filter_var($time_taken1, FILTER_SANITIZE_STRING);
	$time_str1 = isset($_POST["time_str"])?$_POST["time_str"]:"";
	$time_str = filter_var($time_str1, FILTER_SANITIZE_STRING);
	$time_end1 = isset($_POST["time_end"])?$_POST["time_end"]:"";
	$time_end = filter_var($time_end1, FILTER_SANITIZE_STRING);
	$rem_status1 = isset($_POST["rem_status"])?$_POST["rem_status"]:"";
	$rem_status = filter_var($rem_status1, FILTER_SANITIZE_STRING);
	
	
	$conndc = conn_treasraj_pdo();
	//$query = "insert into treasurystatus_control.cash_office_support_details(report_date,report_time,support_required_by,cash_off_nm,pos_cash_office,support_details,support_provided_by,job_description,time_taken,pass_revoked_start_time,pass_revoked_end_time,pos_status,dep_name) values('".$report_dt."','".$report_time."','".$sup_require."','".$cash_off_nm."','".$pos_cashoff."','".$sup_details."','".$sup_prov_by."','".$job_desc."','".$time_taken."','".$time_str."','".$time_end."','".$rem_status."','".$dep_nm."')";
	$query = "insert into treasurystatus_control.cash_office_support_details(dep_type, co_no, pos_no, report_date, report_time, support_required_by, support_details, support_provided_by, job_description, time_taken, pass_revoked_start_time, pass_revoked_end_time, pos_status, dep_name) values ('".$castype."','".$cash_nm."','".$pos_nm."','".$report_dt."','".$report_time."','".$sup_require."','".$sup_details."','".$sup_prov_by."','".$job_desc."','".$time_taken."','".$time_str."','".$time_end."','".$rem_status."','".$vendor_nm."')";
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
		<style>
			td, th{
				text-align: left;
				padding: 10px 20px 8px 40px;
				margin-top: 25px;
			}
			h1{
				text-align:center;
				color:#0974c1;
				margin:0px -10px;
			}
		</style>
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
		<div style="color:red; margin-top:0px; high:50px;">
		<?php
		if(isset($fail_msg))
		{
			echo $fail_msg;
		}
		?>
		</div>
		<h1 style="font-size:18px">SUPPORT LOG ENTRY</h1>
		<form name="frm_entry" id="frm_entry" method="post" action="initial.php">
			<table style="margin-top:50px;" class="custom-select1">
			<tr id="tr-bg"><td></td><td></td><td></td><td></td></tr>
				<tr id="tr-bg">
				
					<td>
						<label for="fname">Type:</label>
						<select name="castype" id="castype">
						  <option value="">Select</option>
						  <option value="Cashoffice">Cashoffice</option>
						  <option value="Treasury">Treasury</option>
						  <option value="Network">Network</option>
						</select>
					</td>
					<td>
						<label>Cash Office:</label>
						<select name='dep' id="dep">
							<option value="">Select</option>							
						</select>
					</td>
					<td>
						<label for="fname">POS :</label>
						<select name='dep_no' id="dep_no">
							<option value="">Select</option>
						</select>
					</td>
					
					<td>
						<label>Vendor</label>
						<select name='vendor_nm'>
							<option value="">Select</option>
							<?php
							$connpdo_trclasic_dc = conn_treasraj_pdo();
							$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.vendor_list");
							$rows_ven = $sth->fetchAll();
							foreach($rows_ven as $row_list ){
							?>
							<option value="<?php echo $row_list['vname']; ?>">
								<?php echo $row_list['vname']; ?>
							</option>
							<?php
							}
							?>
						</select>
					</td>				
										
				</tr>
				<tr id="tr-bg">
					
					<td>
						<label for="fname">Name:</label>
						<INPUT type="text" name="sup_require" id="sup_require" ><br><br>
					</td>
					
					<td>
						<label>Issues:</label>
						<select name='sup_details'>
							<option value="">Select</option>
							<?php
							$conn_treasry_pdo = conn_treasry_pdo();
							$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.issue_list");
							$rows_issue = $sth->fetchAll();
							foreach($rows_issue as $row_issues ){
							?>
							<option value="<?php echo $row_issues['issue_nm']; ?>">
								<?php echo $row_issues['issue_nm']; ?>
							</option>
							<?php
							}
							?>
						</select>
					</td>
					<td>
						<label for="fname">Job Descriptions:</label>
						<textarea  type="text" name="job_desc" id="job_desc" ></textarea><br><br>
					</td>													
					<td>
						<label for="fname">Support Provided By:</label>
						<INPUT type="text" name="sup_prov_by" id="sup_prov_by" ><br><br>
					</td>
				</tr >
				<tr id="tr-bg">
				
					<td style="padding-right:20px;">
						<label for="fname">Report Date:</label>
						<INPUT type="date" name="date_from1" id="date_from1" class="datepicker-toggle1"><br><br>
					</td>
					
					<td>
						<label for="fname">Report Time:</label>
						<INPUT type="time" name="date_time" id="date_time" class="datepicker-toggle1" ><br><br>
					</td>
					
					<td>
						<label for="fname">Time Taken:</label>
						<INPUT type="time" name="time_taken" id="time_taken" class="datepicker-toggle1"><br><br>
					</td>
					
					<td>
						<label for="fname">Time Start:</label>
						<INPUT type="time" name="time_str" id="time_str" class="datepicker-toggle1"><br><br>
					</td>
									
					
				</tr>
				<tr id="tr-bg">
				<td>
					<label for="fname">Time End:</label>
					<INPUT type="time" name="time_end" id="time_end" class="datepicker-toggle1"><br><br>
				</td>
				<td>
					<label for="fname">Status:</label>
					<INPUT type="text" name="rem_status" id="rem_status" class="datepicker-toggle1"><br><br>
				</td>
				<td></td>
				<td></td>
				</tr>
				<tr id="tr-bg"><td></td><td></td><td><input type="submit" name="submit" class="button1" value="SUBMIT"></td><td></td></tr>
			<table>
		</form>
		
			
			
			
		<div style="float:center; text-align:center; margin-top:50px; margin-bottom:50px;">	
			<font face="verdana" size="1" color="#4FA1BB">
				<strong>Copyright &copy; 2024, Incorporation by CESC Limited</strong>
			</font>
		</div>
		</div>
		
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				function loaddetails(type="", cs_id){
					$.ajax({
						url : "load-cs.php",
						type : "POST",
						data:{tp:type, id:cs_id},
						success : function(data){
							//alert(data);
							if(type == 1){
								$("#dep_no").html(data);
							}else{
								$("#dep").append(data);
							}
							
						}
					});
				}
				
				loaddetails();
				
				$("#dep").on("change",function(){
					var depId = $("#dep").val();
					loaddetails(1, depId);
				});
			});
		</script>
	</body>
</html>