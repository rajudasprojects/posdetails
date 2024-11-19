<?php
require_once("includes/connect.php");
//include "includes/chk_access.php";

$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';

$report_pos_dt = date("Y-m-d");

if((isset($_POST['dtsearch']) ? $_POST['dtsearch'] : null) && (isset($_POST['fr_date']))){
	
	$from_dt = $_POST['fr_date'];
	$to_dt = $_POST['to_date'];
	$param_string=null;
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("SELECT * from cashoffice.cash_office_support_details WHERE report_date >= '$from_dt' AND report_date <= '$to_dt'");
	$rows = $sth->fetchAll();
	$connpdo_trclasic_dc = null;
	$sth->execute();
}else{
	$param_string=null;
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("select * from cashoffice.cash_office_support_details order by report_date DESC LIMIT 50");
	$rows = $sth->fetchAll();
	$connpdo_trclasic_dc = null;
	$sth->execute();
}
	//count of pos for the day
	$param_string=null;
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("select * from cashoffice.cash_office_support_details WHERE report_date >= '$report_pos_dt' order by report_date");
	$rows_count = $sth->fetchAll();
	$connpdo_trclasic_dc = null;
	$sth->execute();
	
	$result_count = count($rows_count);
	//echo $result_count;
	
	/* echo "<pre>";
	print_r($rows); */
	/* if()
	{
		$suc_msg = "Inserted Data Successfully";
	}
	else{
		$fail_msg = "No Records";
	} */
    



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
		<form name="frm_search" id="frm_entry" method="post" action="">
		<table>
			<tr>
				<td></td>
				<td></td>
				<td>
					<label for="fname">From Date:</label>
					<input type="date" name="fr_date" id="fr_date" ><br><br>
				</td>
				<td>
					<label for="fname">To Date:</label>
					<input type="date" name="to_date" id="to_date" ><br><br>
				</td>
				<td><input type="submit" name="dtsearch" class="button" value="Search"></td>
			</tr>
			
		</table>
		</form>
		<div style="width: 20%; margin: auto; float:center; background-color: #0dc1de; padding:3px;"><h2>Today Count of POS: <?php echo $result_count; ?></h2></div>
		<form name="frm_view" id="frm_entry" method="post" action="">
		
			<?php
			if(!empty($rows))
			{
			?>
		
			<table style="margin-top:50px;">
				
				<tr id="th-bg">
					<th>Report Date</th>
					<th>Report Time</th>
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
						
				?>
				<tr id="tr-bg" class="tr-br">
					<td><?php 
					$timestamp = strtotime($row['report_date']);
					$new_date = date("d-m-Y", $timestamp);
					echo $new_date;
					?></td>
					<td><?php echo $row['report_time']; ?></td>
					<td><?php echo $row['support_required_by']; ?></td>
					<td><?php echo $row['cash_off_nm']; ?></td>
					<td><?php echo $row['pos_cash_office']; ?></td>
					<td><?php echo $row['support_details']; ?></td>
					<td><?php echo $row['support_provided_by']; ?></td>
					<td><?php echo $row['job_description']; ?></td>
					<td><?php echo $row['time_taken']; ?></td>
					<td><?php echo $row['pass_revoked_start_time']; ?></td>
					<td><?php echo $row['pass_revoked_end_time']; ?></td>
					<td><?php echo $row['pos_status']; ?></td>
				</tr>
			<?php
				}
				
			}else{
				echo "<h1 style='text-align:center; color:red;'>"."Sorry No Records found"."</h1>";
			}				
			
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