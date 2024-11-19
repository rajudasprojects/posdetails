<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("includes/connect.php");
require_once("includes/functions.php");


$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';
$report_pos_dt = date("Y-m-d");
$appStat=0;
$type = array('1'=>'Cashoffice','2'=>'Application Software');
$tbldetail="treasurystatus_control.support_user";

if((isset($_POST['dtsearch1']))){
	
	$result_count = 0;
	$postVall =0;
	$tharr =0;
	$from_dt = isset($_POST['fr_date']) ? $_POST['fr_date'] : "";
	$to_dt = isset($_POST['to_date']) ? $_POST['to_date'] : "";
	$vendor_nm = isset($_POST['vendor_nm']) ? $_POST['vendor_nm'] : "";
	$pos_nm = isset($_POST["dep_app"])?$_POST["dep_app"]:"";
	$cash_nm = isset($_POST["dep"])?$_POST["dep"]:"";
	$postVall = ['1'=>$cash_nm, '2'=>$vendor_nm,'3'=>$pos_nm, '4'=>$from_dt, '5'=>$to_dt];
	$constr = "";
	$conn=$connpdo_trclasic_dc = conn_treasraj_pdo();
	if($vendor_nm !=NULL && $pos_nm !=NULL && $cash_nm !=NULL && $from_dt !=NULL && $to_dt !=NULL){
		$tharr = [
				'1'=>'Report Time', '2'=>'Support Require By', '3'=>'Support Details', 
				'4'=>'Job Descriptions', '5'=>'Support Provided By', '6'=>'Time Taken',
				'7'=>'Time Start', '8'=>'Time End'
		];
		$setval = 1;
	}
	elseif($vendor_nm !=NULL && $cash_nm !=NULL && $pos_nm !=NULL){
		$tharr = [
				'1'=>'Report Date', '2'=>'Report Time', '3'=>'Support Require By', '4'=>'Support Details', 
				'5'=>'Job Descriptions', '6'=>'Support Provided By', '7'=>'Time Taken',
				'8'=>'Time Start', '9'=>'Time End'
		];
		$setval = 2;
	}elseif($vendor_nm !=NULL && $cash_nm !=NULL && $pos_nm ==0 && $from_dt==NULL && $to_dt ==NULL){
		$tharr = [
				'1'=>'POS No', '2'=>'Report Date', '3'=>'Report Time', 
				'4'=>'Support Require By', '5'=>'Support Details', '6'=>'Job Descriptions', 
				'7'=>'Support Provided By', '8'=>'Time Taken', '9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 3;
	}elseif($vendor_nm !=NULL && $cash_nm ==NULL && $pos_nm ==0 && $from_dt==NULL && $to_dt ==NULL){
		$tharr = [
				'1'=>'Cashoffice', '2'=>'POS No', '3'=>'Report Date', '4'=>'Report Time', 
				'5'=>'Support Require By', '6'=>'Support Details', '7'=>'Job Descriptions', 
				'8'=>'Support Provided By', '9'=>'Time Taken', '10'=>'Time Start', '11'=>'Time End'
		];
		$setval = 4;
	}elseif($cash_nm !=NULL && $pos_nm !=NULL && $from_dt==NULL && $to_dt ==NULL){
		$tharr = [
				'1'=>'Vendor','2'=>'Report Date', '3'=>'Report Time', '4'=>'Support Require By', 
				'5'=>'Support Details', '6'=>'Job Descriptions', '7'=>'Support Provided By', 
				'8'=>'Time Taken', '9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 5;
	}elseif($from_dt !=NULL && $to_dt !=NULL && $cash_nm ==NULL && $pos_nm ==NULL ){
		$tharr = [
				'1'=>'Vendor','2'=>'Cashoffice', '3'=>'Report Time', '4'=>'Support Require By', 
				'5'=>'Support Details', '6'=>'Job Descriptions', '7'=>'Support Provided By', 
				'8'=>'Time Taken', '9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 11;
	}else{
		$tharr = [
				'1'=>'Cashoffice', '2'=>'POS No', '3'=>'Report Date', '4'=>'Report Time', 
				'5'=>'Support Require By', '6'=>'Support Details', '7'=>'Job Descriptions', 
				'8'=>'Support Provided By', '9'=>'Time Taken', '10'=>'Time Start', '11'=>'Time End'
		];
		$setval = 6;
	}
	
	if($vendor_nm != null){
		$constr .= " and dep_name = '$vendor_nm' ";
	}
	if($from_dt != null && $to_dt != null){
		$constr .= " and report_date >= '$from_dt' AND report_date <= '$to_dt' ";
	}
	if($cash_nm != null){
		$constr .= " and co_no = '$cash_nm' ";
	}
	
	if($pos_nm != null){
		$constr .= " and pos_no = '$pos_nm' ";
	}
	
	if($constr != NULL){
		$param_string=null;
		$connpdo_trclasic_dc = conn_treasraj_pdo();
		$sth = $connpdo_trclasic_dc->query("SELECT * from `treasurystatus_control`.`cash_office_support_details` WHERE co_no > 0 $constr ORDER BY report_date DESC LIMIT 50");
		$rows = $sth->fetchAll();
		$connpdo_trclasic_dc = null;
		$sth->execute();
		$result_count = count($rows);
		
		if($setval ==1){
			$tdarr = gettbldata1($rows);
		}elseif($setval ==2){
			$tdarr = gettbldata2($rows);
		}elseif($setval ==3){
			$tdarr = gettbldata3($rows);
		}elseif($setval ==4){
			$tdarr = gettbldata4($rows);
		}elseif($setval ==5){
			$tdarr = gettbldata5($rows);
		}elseif($setval ==6){
			$tdarr = gettbldata6($rows);
		}elseif($setval ==11){
			$tdarr = gettbldata11($rows);
		}
		
	}else{
		$result_count = 0;;
	}
	
	
}elseif((isset($_POST['dtsearch2']))){
	//echo print_r($_POST);exit;
	$result_count = 0;
	$postVal2 = 0;
	$module_nm = isset($_POST['module_nm']) ? $_POST['module_nm'] : "";
	$cashoff_name = isset($_POST['cashoff_name2']) ? $_POST['cashoff_name2'] : "";
	$from_dt = isset($_POST['fr_date2']) ? $_POST['fr_date2'] : "";
	$to_dt = isset($_POST['to_date2']) ? $_POST['to_date2'] : "";
	$postVal2 = ['1'=>$cashoff_name, '5'=>$module_nm, '3'=>$from_dt, '4'=>$to_dt];
	$constr = "";
	
	$conn=$connpdo_trclasic_dc = conn_treasraj_pdo();
	if($module_nm !=NULL && $cashoff_name !=NULL && $from_dt !=NULL && $to_dt !=NULL){
		$tharr = [
				'1'=>'Report Time', '2'=>'Support Require By', '3'=>'Support Details', 
				'4'=>'Job Descriptions', '5'=>'Support Provided By', '8'=>'Time Taken',
				'9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 7;
	}
	elseif($module_nm !=NULL && $cashoff_name ==NULL && $from_dt ==NULL && $to_dt ==NULL){
		$tharr = [
				'1'=>'Cashoffice','2'=>'Report Date', '3'=>'Report Time', '4'=>'Support Require By', '5'=>'Support Details', 
				'6'=>'Job Descriptions', '7'=>'Support Provided By', '8'=>'Time Taken',
				'9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 8;
	}elseif($cashoff_name !=NULL && $module_nm ==NULL &&  $from_dt ==NULL && $to_dt ==NULL){
		//echo $cashoff_name;exit;
		$tharr = [
				'1'=>'Module','2'=>'Report Date', '3'=>'Report Time', '4'=>'Support Require By', '5'=>'Support Details', 
				'6'=>'Job Descriptions', '7'=>'Support Provided By', '8'=>'Time Taken',
				'9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 9;
	}elseif($from_dt !=NULL && $to_dt !=NULL && $cashoff_name ==NULL && $module_nm ==NULL){
		//echo $from_dt."-".$to_dt;exit;
		$tharr = [
				'1'=>'Cashoffice','2'=>'Module', '3'=>'Report Time', '4'=>'Support Require By', '5'=>'Support Details', 
				'6'=>'Job Descriptions', '7'=>'Support Provided By', '8'=>'Time Taken',
				'9'=>'Time Start', '10'=>'Time End'
		];
		$setval = 10;
	}
	
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
		
		if($setval ==7){
			$tdarr = gettbldata7($rows);
		}elseif($setval ==8){
			$tdarr = gettbldata8($rows);
		}elseif($setval ==9){
			$tdarr = gettbldata9($rows);
		}elseif($setval ==10){
			$tdarr = gettbldata10($rows);
		}
		
	}else{
		$result_count = 0;
	}
	
	$appStat=1;
}else{
	
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
							<td><label>Cash Office:</label></td>
						<td>
							<select name='dep' id="dep">
								<option value="">Select</option>							
							</select>
						</td>
						
						</tr>
						<tr>
							<td colspan="2"><label for="fname">POS :</label></td>
							<td colspan="2">
								<select name='dep_app' id="dep_app">
									<option value="">&nbsp;&nbsp;&nbsp;Select&nbsp;&nbsp;&nbsp;</option>
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
		
		<div>
				<u>
				<h1 style="margin:10px 0px 10px 0px; font-size:25px;font-weight:bold;">
					<?php 
						$values="";
						$cashoff = "";
						$headval ="";
						$thstat=1;
						if(isset($postVall) ? $postVall : ""){
							$cashoff = isset($postVall[1]) ? $postVall[1] : "";
							$vendorNm = isset($postVall[2]) ? $postVall[2] : "";
							$posno = isset($postVall[3]) ? $postVall[3] : "";
							$frmDt = isset($postVall[4]) ? $postVall[4] : "";
							$toDt = isset($postVall[5]) ? $postVall[5] : "";
							if($posno !=""){
								$pos_no=posname($posno);
							}else{
								$pos_no="";
							}
							
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
							if($pos_no !=null){
								$headval .="POS : ".$pos_no.", ";
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
		<?php
			
		/* echo "<pre>";
		print_r($tdarr);exit; */
		
			if(!empty($tharr) && !empty($tdarr)){
			
			echo "<table style='margin:auto; width:95%; font-size:12px;'>";
					foreach($tharr as $key => $values){
						echo "<th style='text-align:center'>";
						echo $values;
						echo "</th>";
					}
					
					
					foreach($tdarr as $tdarrs){
						echo "<tr>";
						foreach($tdarrs as $col){
							echo "<td style='text-align:center'>";
								echo $col;
							echo "</td>";
						}
						echo "</tr>";
					}
					
			echo "</table>";
			echo "<div class='totalst'>TOTAL: $result_count</div>";
		 }else{
			echo "<h1 style='text-align:center; color:red; margin-top:50px; font-size:30px;'>"."Sorry No Records"."</h1>";
		 }
		?>
		
					
			
		<div style="float:center; text-align:center; margin-top:50px; margin-bottom:50px;">	
			<font face="verdana" size="1" color="#4FA1BB">
				<strong>Copyright &copy; 2024, Incorporation by CESC Limited</strong>
			</font>
		</div>
		</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
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
			$(document).ready(function(){
				function loaddetails(type="", cs_id){
					//alert(cs_id);
					$.ajax({
						url : "load-cs.php",
						type : "POST",
						data:{tp:type, id:cs_id},
						success : function(data){
							//alert(data);
							if(type == 1){
								$("#dep_app").html(data);
							}else{
								$("#dep").append(data);
							}
							
						}
					});
				}
				
				loaddetails();
				
				$("#dep").on("change",function(){
					var depId = $("#dep").val();
					//alert(depId);
					loaddetails(1, depId);
				});
			});
		</script>
	</body>
</html>