<?php
require_once("includes/connect.php");

$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';
$report_pos_dt = date("Y-m-d");
$appStat=0;
$type = array('1'=>'Cashoffice','2'=>'Application Software');
//echo print_r($_POST);exit;
if((isset($_POST['dtsearch1']))){
	
	//echo $_POST;exit;
	$result_count = 0;
	$postVall =0;
	$from_dt = isset($_POST['fr_date']) ? $_POST['fr_date'] : "";
	$to_dt = isset($_POST['to_date']) ? $_POST['to_date'] : "";
	$cashoff_name = isset($_POST['cashoff_name']) ? $_POST['cashoff_name'] : "";
	$vendor_nm = isset($_POST['vendor_nm']) ? $_POST['vendor_nm'] : "";
	$postVall = ['1'=>$cashoff_name, '2'=>$vendor_nm, '3'=>$from_dt, '4'=>$to_dt];
	$constr = "";
	
	if($vendor_nm != null){
		$constr .= " and dep_name = '$vendor_nm' ";
	}
	if($from_dt != null && $to_dt != null){
		$constr .= " and report_date >= '$from_dt' AND report_date <= '$to_dt' ";
	}
	if($cashoff_name != null){
		$constr .= " and co_no = '$cashoff_name' ";
	}
	
	if($constr != NULL){
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		/* $sq="SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 $constr ORDER BY report_date DESC LIMIT 50";
		echo $sq;exit; */
		$sth = $connpdo_trclasic_dc->query("SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 $constr ORDER BY report_date DESC LIMIT 50");
		$rows = $sth->fetchAll();
		$connpdo_trclasic_dc = null;
		$sth->execute();
		$result_count = count($rows);
	}else{
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		$sth = $connpdo_trclasic_dc->query("SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 and type_stat = '1' ORDER BY report_date DESC LIMIT 50");
		$rows = $sth->fetchAll();
		$connpdo_trclasic_dc = null;
		$sth->execute();
		$result_count = count($rows);
	}
	
	
}elseif((isset($_POST['dtsearch2']))){
	
	$result_count = 0;
	$postVal2 = 0;
	$from_dt = isset($_POST['fr_date2']) ? $_POST['fr_date2'] : "";
	$to_dt = isset($_POST['to_date2']) ? $_POST['to_date2'] : "";
	$cashoff_name = isset($_POST['cashoff_name2']) ? $_POST['cashoff_name2'] : "";
	$module_nm = isset($_POST['module_nm']) ? $_POST['module_nm'] : "";
	$postVal2 = ['1'=>$cashoff_name, '2'=>$module_nm, '3'=>$from_dt, '4'=>$to_dt];
	$constr = "";
	if($module_nm != null){
		$constr .= " and module_id = '$module_nm' ";
	}
	if($from_dt != null && $to_dt != null){
		$constr .= " and report_date >= '$from_dt' AND report_date <= '$to_dt' ";
	}
	if($cashoff_name != null){
		$constr .= " and co_no = '$cashoff_name' ";
	}
	
	if($constr !=null){
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		/* $sth = "SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 $constr ORDER BY report_date DESC LIMIT 50";
		echo $sth;exit; */
		$sth = $connpdo_trclasic_dc->query("SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 $constr ORDER BY report_date DESC LIMIT 50");
		$rows = $sth->fetchAll();
		$connpdo_trclasic_dc = null;
		$sth->execute();
		
		$result_count = count($rows);
	}else{
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		/* $sth = "SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 $constr ORDER BY report_date DESC LIMIT 50";
		echo $sth;exit; */
		$sth = $connpdo_trclasic_dc->query("SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 and type_stat = '2' ORDER BY report_date DESC LIMIT 50");
		$rows = $sth->fetchAll();
		$connpdo_trclasic_dc = null;
		$sth->execute();
		
		$result_count = count($rows);
	}
	
	$appStat=1;
}else{
	/* $param_string=null;
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("select * from treasurystatus_control.cash_office_support_details WHERE report_date >= '$report_pos_dt' order by report_date DESC LIMIT 50");
	$rows = $sth->fetchAll();
	$connpdo_trclasic_dc = null;
	$sth->execute();
	$result_count = count($rows); */
	$result_count = 0;
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
		<style>
			.form {
				display: none;
			}
			h1 {
				text-align: center;
				color: #0974c1;
				margin: 0px -10px;
				font-size:18px;
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
		<div style="color:green; margin:auto; high:50px; text-align:center;">
			<?php 
				if(isset($suc_msg)){
					echo $suc_msg;
				}
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
		<h1>VIEW ENTRY LOG SEARCH</h1>
		<div>
			<table style="margin-top:10px;" class="custom-app">
				<tr>
					<td><label for="fname">Cash Office :</label></td>
					<td><input type="radio" name="formToggle" value="form1" onclick="toggleForms()"></td>
					<td><label for="fname">Application Software</label></td>
					<td><input type="radio" name="formToggle" value="form2" onclick="toggleForms()"></td>
				</tr>
			</table>
		</div>
		<div id="searcform" >
			<div id="form1" class="form flex-container rrt">
				<form method="post">
					<table class="rrt">
						<tr>
							<td><label>Vendor:</label></td>
							<td>
								<select name='vendor_nm' id='vendor_nm'>
									<option value="">--- Select ---</option>
									<?php
									$connpdo_trclasic_dc = conn_treasraj_pdo();
									$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.vendor_list");
									$rows_ven = $sth->fetchAll();
									foreach($rows_ven as $row_list ){
										if($_POST['vendor_nm'] == $row_list['vname']){
											?>
											<option selected value="<?php echo $row_list['vname']; ?>">
												<?php echo $row_list['vname']; ?>
											</option>
											<?php
										}else{
											
									?>
											<option value="<?php echo $row_list['vname']; ?>">
												<?php echo $row_list['vname']; ?>
											</option>
											<?php
										}
									}
									?>
								</select>
							</td>
							<td><label>Cash&nbsp;Office:</label></td>
							<td>
								<select name='cashoff_name' id='cashoff_name'>
									<option value="">--- Select ---</option>
									<?php
									$connpdo_trclasic_dc = conn_treasraj_pdo();
									$sth = $connpdo_trclasic_dc->query("select cashoffice_no,cashoffice_code,cashoffice_name,cashoffice_sup_ip,cashoffice_sup_pass,co_tel,cashoffice_address,co_switch_ip_1,co_switch_ip_2 from `treasury`.`cashoffice` where co_op_status ='1' and cashoffice_no is not null order by cashoffice_name");
									$rows_ven = $sth->fetchAll();
									foreach($rows_ven as $row_list ){
										if($_POST['cashoff_name'] == $row_list['cashoffice_no']){
											?>
											<option selected value="<?php echo $row_list['cashoffice_no']; ?>">
												<?php echo $row_list['cashoffice_name']; ?>
											</option>
											<?php
										}else{
											
									?>
											<option value="<?php echo $row_list['cashoffice_no']; ?>">
												<?php echo $row_list['cashoffice_name']; ?>
											</option>
											<?php
										}
									}
									?>
								</select>
							</td>
						</tr>
							<tr>
								<td><label for="fname">From&nbsp;Date:</label></td>
								<td><input type="date" name="fr_date" id="fr_date" class="datepicker-toggle"></td>
								<td><label for="fname">To&nbsp;Date:</label></td>
								<td><input type="date" name="to_date" id="to_date" class="datepicker-toggle"></td>
							</tr>
					</table>
						<input type="submit" name="dtsearch1" class="button" value="Search">
				</form>
			</div>
			<div id="form2" class="form flex-container rrt">
				<form method="post">
					<table class="rrt">
						<tr>
							<td><label>Module:</label></td>
							<td>
								<select name='module_nm' id='module_nm'>
									<option value="">--- Select ---</option>
									<?php
									$connpdo_trclasic_dc = conn_treasraj_pdo();
									$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.module_list");
									$rows_ven = $sth->fetchAll();
									foreach($rows_ven as $row_list ){
										if($_POST['module_nm'] == $row_list['id']){
											?>
											<option selected value="<?php echo $row_list['id']; ?>">
												<?php echo $row_list['module_name']; ?>
											</option>
											<?php
										}else{
											
									?>
											<option value="<?php echo $row_list['id']; ?>">
												<?php echo $row_list['module_name']; ?>
											</option>
											<?php
										}
									}
									?>
								</select>
							</td>
							<td><label>Cash&nbsp;Office:</label></td>
							<td>
								<select name='cashoff_name2' id='cashoff_name2'>
									<option value="">--- Select ---</option>
									<?php
									$connpdo_trclasic_dc = conn_treasraj_pdo();
									$sth = $connpdo_trclasic_dc->query("select cashoffice_no,cashoffice_code,cashoffice_name,cashoffice_sup_ip,cashoffice_sup_pass,co_tel,cashoffice_address,co_switch_ip_1,co_switch_ip_2 from `treasury`.`cashoffice` where co_op_status !='1' and cashoffice_no is not null order by cashoffice_name");
									$rows_ven = $sth->fetchAll();
									foreach($rows_ven as $row_list ){
										if($_POST['cashoff_name2'] == $row_list['cashoffice_no']){
											?>
											<option selected value="<?php echo $row_list['cashoffice_no']; ?>">
												<?php echo $row_list['cashoffice_name']; ?>
											</option>
											<?php
										}else{
											
									?>
											<option value="<?php echo $row_list['cashoffice_no']; ?>">
												<?php echo $row_list['cashoffice_name']; ?>
											</option>
											<?php
										}
									}
									?>
								</select>
							</td>
						</tr>
							<tr>
								<td><label for="fname">From&nbsp;Date:</label></td>
								<td><input type="date" name="fr_date2" id="fr_date2" class="datepicker-toggle"></td>
								<td><label for="fname">To&nbsp;Date:</label></td>
								<td><input type="date" name="to_date2" id="to_date2" class="datepicker-toggle"></td>
							</tr>
					</table>
						<input type="submit" name="dtsearch2" class="button" value="Search">
				</form>
			</div>
		</div>	
		<form name="frm_view" id="frm_entry" method="post" action="">
		
			<?php
			if(!empty($rows))
			{	
				if($appStat == 1){
					$th = "<th>Module Name</th>";
				}else{
					$th = "<th>Vendor</th>";
				}
			?>
			<div>
				<u>
				<h1 style="margin:20px 0px 0px 0px; font-size:25px;font-weight:bold;">
					<?php 
						$values="";
						$cashoff = "";
						$headval ="";
						$thstat=1;
						if(isset($postVall) ? $postVall : ""){
							$cashoff = isset($postVall[1]) ? $postVall[1] : "";
							$vendorNm = isset($postVall[2]) ? $postVall[2] : "";
							$frmDt = isset($postVall[3]) ? $postVall[3] : "";
							$toDt = isset($postVall[4]) ? $postVall[4] : "";
							
							if($cashoff){
								$connpdo_trclasic_dc = conn_treasraj_pdo();
								$sth = $connpdo_trclasic_dc->query("SELECT cashoffice_name from `treasury`.`cashoffice` WHERE cashoffice_no='".$cashoff."'");
								$result = $sth->fetchAll();
								$cashoff =$result[0]['cashoffice_name'];
							}
							//print_r($cashoff);exit;
							if($cashoff !=null){
								$headval .= "Cash Office : ".$cashoff.", ";
							}
							if($vendorNm !=null){
								$headval .="Vendor : ".$vendorNm.", ";
							}
							if($frmDt !=null){
								$headval .="From Date : ".date("d-m-Y", strtotime($frmDt)).", ";
							}
							if($toDt !=null){
								$headval .= "To Date : ".date("d-m-Y", strtotime($toDt));
							}
							echo $headval;
						}else{
							if(isset($postVal2) ? $postVal2 : ""){
								$cashoff1=isset($postVal2[1]) ? $postVal2[1] : "";
								$vendorNm = isset($postVal2[2]) ? $postVal2[2] : "";
								$frmDt = isset($postVal2[3]) ? $postVal2[3] : "";
								$toDt = isset($postVal2[4]) ? $postVal2[4] : "";
								
								if($cashoff1){
									$connpdo_trclasic_dc = conn_treasraj_pdo();
									$sth = $connpdo_trclasic_dc->query("SELECT cashoffice_name from `treasury`.`cashoffice` WHERE cashoffice_no='".$cashoff1."'");
									$result = $sth->fetchAll();
									$cashoff1 =$result[0]['cashoffice_name'];
								}
								
								if($vendorNm){
									$connpdo_trclasic_dc = conn_treasraj_pdo();
									$sth = $connpdo_trclasic_dc->query("SELECT module_name from treasurystatus_control.module_list WHERE id='".$vendorNm."'");
									$result = $sth->fetchAll();
									$vendorNm =$result[0]['module_name'];
								}
								
								if($cashoff1 !=null){
									$headval .= "Cash Office : ".$cashoff1.", ";
								}
								if($vendorNm !=null){
									$headval .="Module : ".$vendorNm.", ";
								}
								if($frmDt !=null){
									$headval .="From Date : ".date("d-m-Y", strtotime($frmDt)).", ";
								}
								if($toDt !=null){
									$headval .= "To Date : ".date("d-m-Y", strtotime($toDt));
								}
								echo $headval;
							}
						}
					?>
				</h1>
				</u>
			</div>
			<table style="margin-top:20px; width:95%; font-size:12px;" id="test">
				
				<tr id="th-bg">
					<th>Report Date</th>
					<th>Report Time</th>
					<?php
						if($thstat == 2){
							
						}else{
							echo $th; 
						}
						
					?>
					<th>Support Require By</th>
					<th>Cash Office Name</th>
					<th>POS No</th>
					<th>Support Details</th>
					<th>Support Provided By</th>
					<th>Job Descriptions</th>
					<th>Time Taken</th>
					<th>Time Start</th>
					<th>Time End</th>
					<th>Status</th>
				</tr>
				<?php	
				
					foreach($rows as $row)
					{
						$cashoff_id = $row['co_no'];
						$machine_id = $row['pos_no'];
						$module_id = $row['module_id'];
						$supp_req = $row['support_required_by'];
						$supp_prov = $row['support_provided_by'];
						
						if($supp_prov){
							$connpdo_trclasic_dc = conn_treasraj_pdo();
							$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.support_user WHERE id = '".$supp_prov."'");
							$result = $sth->fetch(PDO::FETCH_ASSOC);
							$connpdo_trclasic_dc = null;
							$sth->execute();
							$supp_pro_nm = $result['support_user'];
						}
						
						if($supp_req){
							$connpdo_trclasic_dc = conn_treasraj_pdo();
							$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.reporting_user WHERE id = '".$supp_req."'");
							$result = $sth->fetch(PDO::FETCH_ASSOC);
							$connpdo_trclasic_dc = null;
							$sth->execute();
							$supp_req_nm = $result['repo_user'];
						}
						
						if($module_id){
							$connpdo_trclasic_dc = conn_treasraj_pdo();
							$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.module_list");
							$result_md = $sth->fetch(PDO::FETCH_ASSOC);
							$connpdo_trclasic_dc = null;
							$sth->execute();
							$dep_name = $result_md['module_name'];
						}else{
							$dep_name = $row['dep_name'];
						}
						
						$connpdo_trclasic_dc = conn_treasraj_pdo();
						$sth = $connpdo_trclasic_dc->query("SELECT cashoffice_name from `treasury`.`cashoffice` WHERE cashoffice_no='".$cashoff_id."'");
						$result = $sth->fetch(PDO::FETCH_ASSOC);
						$connpdo_trclasic_dc = null;
						$sth->execute();
						
						if($machine_id == '0'){
							$posName = 'Supervisor';
						}else{
							$connpdo_trclasic_dc = conn_treasraj_pdo();
							$sth = $connpdo_trclasic_dc->query("SELECT machine_code from `treasury`.`machine_co` WHERE machine_no='".$machine_id."'");
							$result_poc = $sth->fetch(PDO::FETCH_ASSOC);
							$connpdo_trclasic_dc = null;
							$sth->execute();
							$posName = $result_poc['machine_code'];
						}
						
						
						
						
				?>
				<tr id="tr-bg" class="tr-br">
					<td><?php 
					$timestamp = strtotime($row['report_date']);
					$new_date = date("d-m-Y", $timestamp);
					echo $new_date;
					?></td>
					<td><?php echo $row['report_time']; ?></td>
					<td><?php echo $dep_name ?></td>
					<td><?php echo $supp_req_nm; ?></td>
					<td><?php echo $result['cashoffice_name']; ?></td>
					<td><?php echo $posName ?></td>
					<td><?php echo $row['support_details']; ?></td>
					<td><?php echo $supp_pro_nm; ?></td>
					<td><?php echo $row['job_description']; ?></td>
					<td><?php echo $row['time_taken']; ?></td>
					<td><?php echo $row['pass_revoked_start_time']; ?></td>
					<td><?php echo $row['pass_revoked_end_time']; ?></td>
					<td><?php echo $row['pos_status']; ?></td>
				</tr>
				
			<?php
				}
				
				
			}else{
				echo "<h1 style='text-align:center; color:red; margin-top:50px; font-size:30px;'>"."Sorry No Records"."</h1>";
			}				
			?>
			
			<?php
			if($result_count > 0){?>
			
				<tr>
					<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					<td style="font-weight: bold; color:green;">Total Count:</td><td style="font-weight: bold;"><?php echo $result_count; ?></td>
				</tr>
			<?php }?>	
			</table>
		</form>
		
					
			
		<div style="float:center; text-align:center; margin-top:50px; margin-bottom:50px;">	
			<font face="verdana" size="1" color="#4FA1BB">
				<strong>Copyright &copy; 2024, Incorporation by CESC Limited</strong>
			</font>
		</div>
		</div>
		<script>
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

		</script>
	</body>
</html>