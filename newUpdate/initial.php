<?php
require_once("includes/connect.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';
$fail_msg = null;


if(isset($_POST['submit1']) ? $_POST['submit1'] : null)
{
	$castype1 = isset($_POST["toggle"]) ? $_POST["toggle"] : "";
	$castype = filter_var($castype1, FILTER_SANITIZE_STRING);
	
	$cash_nm1 = $_POST["dep"];
	if($cash_nm1 == null){
		$fail_msg = "Please select Cash Office";
	}
	$cash_nm = filter_var($cash_nm1, FILTER_SANITIZE_STRING);
	
	$pos_nm1 = isset($_POST["dep_no"])?$_POST["dep_no"]:"";	
	$pos_nm = filter_var($pos_nm1, FILTER_SANITIZE_STRING);
	$vendor_nm1 = $_POST["vendor_nm"];
	if($vendor_nm1 == null){
		$fail_msg = "Please select Vendor";
	}
	$vendor_nm = filter_var($vendor_nm1, FILTER_SANITIZE_STRING);
	
	$sup_require1 = $_POST["sup_require"];
	if($sup_require1 == null){
		$fail_msg = "Please select Name";
	}
	$sup_require = filter_var($sup_require1, FILTER_SANITIZE_STRING);
	
	$sup_details1 = $_POST["sup_details"];
	if($sup_details1 == null){
			$fail_msg = "Please select Issues";
		}
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
	
	if($fail_msg == null){
		$conndc = conn_treasraj_pdo();
		$query = "insert into treasurystatus_control.cash_office_support_details(dep_type, co_no, pos_no, report_date, report_time, support_required_by, support_details, support_provided_by, job_description, time_taken, pass_revoked_start_time, pass_revoked_end_time, pos_status, dep_name, type_stat) values ('".$castype."','".$cash_nm."','".$pos_nm."','".$report_dt."','".$report_time."','".$sup_require."','".$sup_details."','".$sup_prov_by."','".$job_desc."','".$time_taken."','".$time_str."','".$time_end."','".$rem_status."','".$vendor_nm."',1)";
		$sth = $conndc->prepare($query);
		if($sth->execute())
		{
			$suc_msg = "Inserted Data Successfully";
		}
	}else{
		$fail_msg = "All fields are require!";
	}
	
    
}else{
	
	if(isset($_POST['submit2']) ? $_POST['submit2'] : null)
	{
		$cash_nm2 = isset($_POST["app_cash"])?$_POST["app_cash"]:"";
		$cash_nm = filter_var($cash_nm2, FILTER_SANITIZE_STRING);
		$pos_nm2 = isset($_POST["dep_app"])?$_POST["dep_app"]:"";
		$pos_nm = filter_var($pos_nm2, FILTER_SANITIZE_STRING);
		$sup_require2 = isset($_POST["sup_require"])?$_POST["sup_require"]:"";
		$sup_require = filter_var($sup_require2, FILTER_SANITIZE_STRING);
		$sup_details2 = isset($_POST["sup_details"])?$_POST["sup_details"]:"";
		
		$sup_details2 = $_POST["sup_details"];
		if($sup_details2 == null){
			$fail_msg = "Please select Issues";
		}
		$sup_details = filter_var($sup_details2, FILTER_SANITIZE_STRING);
		$module2 = $_POST['sel_module'];
		if($module2 == null){
			$fail_msg = "Please select Module";
		}

		$module = filter_var($module2, FILTER_SANITIZE_STRING);
		$job_desc2 = isset($_POST["job_desc"])?$_POST["job_desc"]:"";
		$job_desc = filter_var($job_desc2, FILTER_SANITIZE_STRING);
		$sup_prov_by2 = isset($_POST["sup_prov_by"])?$_POST["sup_prov_by"]:"";
		$sup_prov_by = filter_var($sup_prov_by2, FILTER_SANITIZE_STRING);
		$report_dt2 = isset($_POST["date_from1"])?$_POST["date_from1"]:"";
		$report_dt = filter_var($report_dt2, FILTER_SANITIZE_STRING);
		$report_time2 = isset($_POST["date_time"])?$_POST["date_time"]:"";
		$report_time = filter_var($report_time2, FILTER_SANITIZE_STRING);
		$time_taken2 = isset($_POST["time_taken"])?$_POST["time_taken"]:"";
		$time_taken = filter_var($time_taken2, FILTER_SANITIZE_STRING);
		$time_str2 = isset($_POST["time_str"])?$_POST["time_str"]:"";
		$time_str = filter_var($time_str2, FILTER_SANITIZE_STRING);
		$time_end2 = isset($_POST["time_end"])?$_POST["time_end"]:"";
		$time_end = filter_var($time_end2, FILTER_SANITIZE_STRING);
		$rem_status2 = isset($_POST["rem_status"])?$_POST["rem_status"]:"";
		$rem_status = filter_var($rem_status2, FILTER_SANITIZE_STRING);
		
		if($fail_msg == null){
			$conndc = conn_treasraj_pdo();
			$query = "insert into treasurystatus_control.cash_office_support_details(co_no, pos_no, support_required_by, support_details, job_description, support_provided_by, report_date, report_time, time_taken, pass_revoked_start_time, pass_revoked_end_time, pos_status, type_stat, module_id) values ('".$cash_nm."','".$pos_nm."','".$sup_require."','".$sup_details."','".$job_desc."','".$sup_prov_by."','".$report_dt."','".$report_time."','".$time_taken."','".$time_str."','".$time_end."','".$rem_status."',2, '".$module."')";
			$sth = $conndc->prepare($query);
			if($sth->execute())
			{
				$suc_msg = "Inserted Data Successfully";
			}
		}else{
			$fail_msg = "Sory you can't submit a blank form";
		}
		
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
				padding: 05px 10px 8px 40px;
				margin-top: 5px;
			}
			h1{
				text-align:center;
				color:#0974c1;
				margin:0px -10px;
			}
			.form {
				display: none;
			}
			.hidden {
				display: none;
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
		<?php if(isset($suc_msg) && $suc_msg != ""){ ?>
				<script>alert("<?php echo $suc_msg; ?>");</script>
		<?php } ?>
		
		<?php if(isset($fail_msg) && $fail_msg != ""){ ?>
				<script>alert("<?php echo $fail_msg; ?>");</script>
		<?php } ?>
		
		<h1 style="font-size:18px">SUPPORT LOG ENTRY</h1>
		
		<table style="margin-top:10px; background-color: #bcebfa;" class="custom-app">
				<tr id="tr-bg">
					<td><label for="fname">Cash Office:</label></td>
					<td><input type="radio" name="formToggle" value="form1" onclick="toggleForms()"></td>
					<td><label for="fname">Software Application:</label></td>
					<td><input type="radio" name="formToggle" value="form2" onclick="toggleForms()"></td>
				</tr>
		</table>
		<div id="form1" class="form">
			
			<form method="post" >
				<table style="margin-top:20px; background-color: #bcebfa;" class="custom-select1">
					<tr>
						<th colspan="4"><h3>Cash Office</h3></th>
					</tr>
					<tr id="tr-bg">
						<td colspan="2">
							<input type="radio" name="toggle" value="pos" onclick="toggleItems()" checked>POS&nbsp;
							
							<input type="radio" name="toggle" value="sup" onclick="toggleItems()">SUPERVISOR&nbsp;
							
							<input type="radio" name="toggle" value="oth" onclick="toggleItems()">OTHER&nbsp;
						</td>
						
						<td><label>Cash Office:</label></td>
						<td>
							<select name='dep' id="dep">
								<option value="">Select</option>							
							</select>
						</td>
					</tr>
					<tr id="tr-bg">
						
						<td class="toggle1"><label for="fname">POS :</label></td>
						<td class="toggle1">
							<select name='dep_no' id="dep_no">
								<option value="">Select</option>
							</select>
						</td>
											
						<td class="toggle2 hidden"><label for="fname">POS :</label></td>
						<td class="toggle2 hidden">
							<select name='sup_id' id="sup_id">
								<option value="0">Supervisor</option>
							</select>
						</td>
						
						<td><label>Vendor:</label></td>
						<td>
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
						<td><label for="fname">Name:</label></td>
						<td>
							<select name='sup_require' id="sup_require">
								<option value="">Select</option>
								<?php
								$conn_treasry_pdo = conn_treasry_pdo();
								$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.reporting_user");
								$rows = $sth->fetchAll();
								foreach($rows as $row ){
								?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['repo_user']; ?>
								</option>
								<?php
								}
								?>
							</select>
						</td>
						<td><label>Issues:</label></td>
						<td>
							<select name='sup_details'>
								<option value="">Select</option>
								<?php
								$conn_treasry_pdo = conn_treasry_pdo();
								$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.issue_list where type=1");
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
					</tr>
					<tr id="tr-bg">
							<td><label for="fname">Job&nbsp;Descriptions:</label></td>
							<td>
								<textarea  type="text" name="job_desc" id="job_desc" rows="3" cols="30"></textarea>
							</td>
							<td><label for="fname">Support&nbsp;Provided&nbsp;By:</label></td>
							<td>
								<select name='sup_prov_by' id="sup_prov_by">
								<option value="">Select</option>
								<?php
								$conn_treasry_pdo = conn_treasry_pdo();
								$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.support_user");
								$rows = $sth->fetchAll();
								foreach($rows as $row ){
								?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['support_user']; ?>
								</option>
								<?php
								}
								?>
							</select>
							</td>
					</tr >
					<tr id="tr-bg">
						<td><label for="fname">Report Date:</label></td>
						<td>
							<INPUT type="date" name="date_from1" id="date_from1" class="datepicker-toggle1">
						</td>
						<td><label for="fname">Report Time:</label></td>
						<td>
							<INPUT type="time" name="date_time" id="date_time" class="datepicker-toggle1" >
						</td>
					</tr>
					<tr id="tr-bg">
						
						<td><label for="fname">Time Start:</label></td>
						<td>
							<INPUT type="time" name="time_str" id="time_str" class="datepicker-toggle1">
						</td>
						<td><label for="fname">Time End:</label></td>
						<td>
							<INPUT type="time" name="time_end" id="time_end" class="datepicker-toggle1">
						</td>
					</tr>
					<tr id="tr-bg">
						
						<td><label for="fname">Time Taken:</label></td>
						<td>
							<INPUT type="time" name="time_taken" id="time_taken" class="datepicker-toggle1">
						</td>
						<td><label for="fname">Status:</label></td>
						<td>
							<INPUT type="text" name="rem_status" id="rem_status" class="datepicker-toggle1">
						</td>
					</tr>
					
					<tr id="tr-bg"><td colspan="4" style="text-align:center;"><input type="submit" name="submit1" class="button1" value="SUBMIT"></td></tr>
				</table>
			</form>
		</div>

		<div id="form2" class="form">
			<form method="post">
				<table style="margin-top:20px; background-color: #bcebfa;" class="custom-select1 rrr-ent">
					<tr>
						<th colspan="4"><h3>Application Software</h3></th>
					</tr>
					<tr id="tr-bg">
						
						<td><label>Cash Office:</label></td>
						<td>
							<select name='app_cash' id="app_cash">
								<option value="">Select</option>							
							</select>
						</td>
						<td><label for="fname">POS :</label></td>
						<td>
							<select name='dep_app' id="dep_app">
								<option value="">Select</option>
							</select>
						</td>
					</tr>
					
					<tr id="tr-bg">
						<td><label for="fname">Name:</label></td>
						<td>
							<select name='sup_require' id="sup_require">
								<option value="">Select</option>
								<?php
								$conn_treasry_pdo = conn_treasry_pdo();
								$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.reporting_user");
								$rows = $sth->fetchAll();
								foreach($rows as $row ){
								?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['repo_user']; ?>
								</option>
								<?php
								}
								?>
							</select>
						</td>
						<td><label>Issues:</label></td>
						<td>
							<select name='sup_details'>
								<option value="">Select</option>
								<?php
								$conn_treasry_pdo = conn_treasry_pdo();
								$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.issue_list where type=2");
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
					</tr>
					<tr id="tr-bg">
							<td><label for="fname">Module:</label></td>
							<td>
								<select name='sel_module'>
									<option value="">Select</option>
									<?php
									$conn_treasry_pdo = conn_treasry_pdo();
									$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.module_list");
									$rows_issue = $sth->fetchAll();
									foreach($rows_issue as $row_issues ){
									?>
									<option value="<?php echo $row_issues['id']; ?>">
										<?php echo $row_issues['module_name']; ?>
									</option>
									<?php
									}
									?>
								</select>
							</td>
							<td><label for="fname">Support&nbsp;Provided&nbsp;By:</label></td>
							<td>
								<select name='sup_prov_by' id="sup_prov_by">
								<option value="">Select</option>
								<?php
								$conn_treasry_pdo = conn_treasry_pdo();
								$sth = $conn_treasry_pdo->query("SELECT * from treasurystatus_control.support_user");
								$rows = $sth->fetchAll();
								foreach($rows as $row ){
								?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['support_user']; ?>
								</option>
								<?php
								}
								?>
							</select>
							</td>
					</tr >
					<tr id="tr-bg">
							<td><label for="fname">Job&nbsp;Descriptions:</label></td>
							<td colspan="4">
								<textarea  type="text" name="job_desc" id="job_desc" rows="3" cols="50"></textarea>
							</td>
					</tr>		
					<tr id="tr-bg">
						<td><label for="fname">Report Date:</label></td>
						<td>
							<INPUT type="date" name="date_from1" id="date_from1" class="datepicker-toggle1">
						</td>
						<td><label for="fname">Report Time:</label></td>
						<td>
							<INPUT type="time" name="date_time" id="date_time" class="datepicker-toggle1" >
						</td>
					</tr>
					<tr id="tr-bg">
						
						<td><label for="fname">Time Start:</label></td>
						<td>
							<INPUT type="time" name="time_str" id="time_str" class="datepicker-toggle1">
						</td>
						<td><label for="fname">Time End:</label></td>
						<td>
							<INPUT type="time" name="time_end" id="time_end" class="datepicker-toggle1">
						</td>
					</tr>
					<tr id="tr-bg">
						
						<td><label for="fname">Time Taken:</label></td>
						<td>
							<INPUT type="time" name="time_taken" id="time_taken" class="datepicker-toggle1">
						</td>
						<td><label for="fname">Status:</label></td>
						<td>
							<INPUT type="text" name="rem_status" id="rem_status" class="datepicker-toggle1">
						</td>
					</tr>
					
					<tr id="tr-bg"><td colspan="4" style="text-align:center;"><input type="submit" name="submit2" class="button1" value="SUBMIT"></td></tr>
				</table>
			</form>
		</div>
		
			
			
			
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
			$(document).ready(function(){
				function loaddetails(type="", cs_id){
					$.ajax({
						url : "app_load.php",
						type : "POST",
						data:{tp:type, id:cs_id},
						success : function(data){
							//alert(data);
							if(type == 1){
								$("#dep_app").html(data);
							}else{
								$("#app_cash").append(data);
							}
							
						}
					});
				}
				
				loaddetails();
				
				$("#app_cash").on("change",function(){
					var depId = $("#app_cash").val();
					loaddetails(1, depId);
				});
			});
			function toggleForms() {
				const form1 = document.getElementById('form1');
				const form2 = document.getElementById('form2');

				if (document.querySelector('input[name="formToggle"]:checked').value === 'form1') {
					form1.style.display = 'block';
					form2.style.display = 'none';
				} else {
					form1.style.display = 'none';
					form2.style.display = 'block';
				}
			}
			function toggleItems() {
				const toggle1 = document.querySelectorAll('.toggle1');
				const toggle2 = document.querySelectorAll('.toggle2');
				const show = document.querySelector('input[name="toggle"]:checked').value === 'sup';
				if (show) {
					toggle1.forEach(td => td.classList.add('hidden'));
					toggle2.forEach(td => td.classList.remove('hidden'));
				} else {
					toggle1.forEach(td => td.classList.remove('hidden'));
					toggle2.forEach(td => td.classList.add('hidden'));
				}
			}
		</script>
	</body>
</html>