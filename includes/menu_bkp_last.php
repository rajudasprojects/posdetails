<?php
$curpage = basename($_SERVER["PHP_SELF"]);

if($curpage == 'chng_pass.php' || $curpage == 'home.php' || $curpage == 'logout.php' || $curpage == 'neft_registrations.php' || $curpage == 'certification_exceptions.php' || $curpage == 'daily_update.php' || $curpage == 'knumber_search.php' || $curpage == 'delete_payment.php'  || $curpage == 'knumber_search_ne.php'){
	$root = '';
} else {
	$root = '../';
}
?>
<div class="navmenu noPrint">
	<ul class="main-navigation">
	  <li <?php if($curpage == "home.php") echo 'class="active"'; ?>><a onclick="page_redirect('<?php echo $root; ?>home.php');" href="javascript:void(0);">Home</a></li>
	  <li <?php if(strpos($curpage, 'ileupload')  != false) echo 'class="active"'; ?>><a href="javascript:void(0);">Data File Upload <span>&#9660;</span></a>
		<ul>
			<li><a href="javascript:void(0);">Billdesk</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>billdesk/fileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>billdesk/fileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>billdesk/fileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">Paytm</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>paytm/bedlfileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>paytm/bedlfileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>paytm/bedlfileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">NEFT/RTGS</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/bedlfileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/bedlfileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/bedlfileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/icici_fileupload_rejection.php');" href="javascript:void(0);">Rejection File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/bedl_manual_neft.php');" href="javascript:void(0);">Manual NEFT</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">EMITRA</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_fileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_fileupload_summary.php');" href="javascript:void(0);">Confirm Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_fileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_fileupload_cancel.php');" href="javascript:void(0);">Cancel Data</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_fileupload_summary_cancel.php');" href="javascript:void(0);">Confirm Cancel</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">EBPP</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>ebpp/fileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>ebpp/fileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>ebpp/fileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">BBPS</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatbill/fileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatbill/fileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatbill/fileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">Non Energy</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/fileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/fileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/fileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">Razorpay</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>razorpay/fileupload.php');" href="javascript:void(0);">File Upload</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>razorpay/fileupload_summary.php');" href="javascript:void(0);">Confirm File</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>razorpay/fileupload_rollback.php');" href="javascript:void(0);">Rollback</a></li>
				</ul>
			</li>
		</ul>
		
	  </li>
	  <li <?php if(strpos($curpage, 'missing_add_new') !== false || strpos($curpage, 'missing_unprocessed') !== false || strpos($curpage, 'missing_edit') !== false || strpos($curpage, 'missing_process_payment') !== false) echo 'class="active"'; ?>><a href="javascript:void(0);">Missing Payments<span>&#9660;</span></a>
		<ul>
			<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_add_new.php');" href="javascript:void(0);">Add Missing Payment ( Single )</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_add_new_bulk.php');" href="javascript:void(0);">Add Missing Payment ( bulk )</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_process_payment_bulk.php');" href="javascript:void(0);">Process Payment ( bulk )</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_unprocessed.php');" href="javascript:void(0);">Payment List</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_rollback.php');" href="javascript:void(0);">Roll Back</a></li>			
		</ul>
	  </li>
	  <?php if(isset($user_typ) && $user_typ == "A"){  ?>
	  <li <?php if(strpos($curpage, 'bill_certify') !== false) echo 'class="active"'; ?>><a href="javascript:void(0);">Bill Certify <span>&#9660;</span></a>
		<ul>
			<li><a onclick="page_redirect('<?php echo $root; ?>billdesk/bill_certify.php');" href="javascript:void(0);">Billdesk</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>paytm/bill_certify.php');" href="javascript:void(0);">Paytm</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/bill_certify.php');" href="javascript:void(0);">NEFT/RTGS</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_bill_certify.php');" href="javascript:void(0);">EMITRA</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_bill_certify_cancel.php');" href="javascript:void(0);">EMITRA CANCEL</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>ebpp/bill_certify.php');" href="javascript:void(0);">EBPP</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>bharatbill/bill_certify.php');" href="javascript:void(0);">BBPS</a></li>
			<!--<li><a onclick="page_redirect('<?php echo $root; ?>onlineclub/bill_certify.php');" href="javascript:void(0);">ONLINE CLUB</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>bharatqr/bill_certify.php');" href="javascript:void(0);">BHARAT QR</a></li>-->
			<li><a onclick="page_redirect('<?php echo $root; ?>cash_counter/bill_certify_cash_counter.php');" href="javascript:void(0);">Cash Counter</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/besl_neftman_bill_certify.php');" href="javascript:void(0);">NEFT/RTGS MANUAL</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_bill_certify.php');" href="javascript:void(0);">Missing</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/bill_certify.php');" href="javascript:void(0);">Non Energy</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>razorpay/bill_certify.php');" href="javascript:void(0);">Razorpay</a></li>
		</ul>
	  </li>
	  <?php } ?>
	  <li <?php if(strpos($curpage, 'transfer_data') !== false) echo 'class="active"'; ?>><a href="javascript:void(0);">Transfer Data<span>&#9660;</span></a>
		  <ul>
			<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/transfer_data.php');" href="javascript:void(0);">Non Energy</a></li>
		  </ul>
	  </li>
	  <li <?php if($curpage == "certification_exceptions.php" || $curpage == "daily_update.php") echo 'class="active"'; ?>><a href="javascript:void(0);">Certification Status <span>&#9660;</span></a>
		<ul>
			<li><a onclick="page_redirect('<?php echo $root; ?>certification_exceptions.php');" href="javascript:void(0);">Certification Exceptions</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>daily_update.php');" href="javascript:void(0);">Check Status</a></li>
		</ul>
	  </li>
	  <li <?php if(strpos($curpage, 'mis_') !== false || (strpos($curpage, 'search') !== false && strpos($curpage, 'knumber_search') === false) || strpos($curpage, 'cancel_report') !== false) echo 'class="active"'; ?>><a href="javascript:void(0);">MIS <span>&#9660;</span></a>
		<ul>
			<li><a href="javascript:void(0);">Billdesk</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>billdesk/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>billdesk/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">Paytm</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>paytm/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>paytm/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">NEFT/RTGS</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/search.php');" href="javascript:void(0);">Search</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/icici_mis_rejection.php');" href="javascript:void(0);">Rejection</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">EMITRA</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_search.php');" href="javascript:void(0);">Search</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_cancel_report.php');" href="javascript:void(0);">Cancel(IT)</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>emitra/emitra_cancel_report_direct.php');" href="javascript:void(0);">Cancel(Direct)</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">EBPP</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>ebpp/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>ebpp/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">BBPS</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatbill/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatbill/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<!--<li><a href="javascript:void(0);">ONLINE CLUB</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>onlineclub/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>onlineclub/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>-->
			<!--<li><a href="javascript:void(0);">BHARAT QR</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatqr/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>bharatqr/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>-->
			<li><a href="javascript:void(0);">NEFT/RTGS MANUAL</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/manual_mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>neftrtgs/manual_search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">MISSING</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>missing/missing_search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">NON ENERGY</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>nonenergy/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a href="javascript:void(0);">Razorpay</a>
				<ul>
					<li><a onclick="page_redirect('<?php echo $root; ?>razorpay/mis_report.php');" href="javascript:void(0);">Report</a></li>
					<li><a onclick="page_redirect('<?php echo $root; ?>razorpay/search.php');" href="javascript:void(0);">Search</a></li>
				</ul>
			</li>
			<li><a onclick="page_redirect('<?php echo $root; ?>cash_counter/cash_counter_mis_report.php');" href="javascript:void(0);">Cash Counter</a></li>
		</ul>
	  </li>
	  
	  <li <?php if($curpage == "knumber_search.php" || $curpage == "knumber_search_ne.php") echo 'class="active"'; ?>><a href="javascript:void(0);">Search <span>&#9660;</span></a>
		<ul>
			<li><a onclick="page_redirect('<?php echo $root; ?>knumber_search.php');" href="javascript:void(0);">Knumber Search</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>knumber_search_ne.php');" href="javascript:void(0);">REQUEST ID SEARCH</a></li>
		</ul>
	  </li>
	  
	  <li <?php if($curpage == "cashofficecard_multimode_payments.php" || $curpage == "summary_report.php"  || $curpage == "kno_wise_report.php"  || $curpage == "non_energy_report.php"  || $curpage == "sms_report.php"  || $curpage == "non_cash_dclr_report.php") echo 'class="active"'; ?>><a href="javascript:void(0);">Report <span>&#9660;</span></a>
		<ul>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/cashofficecard_multimode_payments.php');" href="javascript:void(0);">Cashoffice Multimode Payments</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/summary_report.php');" href="javascript:void(0);">Summary Report</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/kno_wise_report.php');" href="javascript:void(0);">KNO Wise Report</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/non_energy_report.php');" href="javascript:void(0);"> Cash Office Non Energy Payments</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/sms_report.php');" href="javascript:void(0);">SMS Report</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/non_cash_dclr_report.php');" href="javascript:void(0);">Non Cash DCLR Report</a></li>
			<li><a onclick="page_redirect('<?php echo $root; ?>reports/cash_dclr_report.php');" href="javascript:void(0);">Cash DCLR Report</a></li>
			<li><a href="javascript:page_redirect('<?php echo $root; ?>reports/gtway_summary_report.php');">Reconciliation Report</a></li>
			<li><a href="javascript:page_redirect('<?php echo $root; ?>reports/inc_summary_report.php');">INC GOV Report</a></li>
		</ul>
	  </li>
	  
	  <li <?php if($curpage == "delete_payment.php") echo 'class="active"'; ?>><a onclick="page_redirect('<?php echo $root; ?>delete_payment.php');" href="javascript:void(0);">Delete Payment</a></li>
	  
	  <li <?php if($curpage == "chng_pass.php") echo 'class="active"'; ?>><a onclick="page_redirect('<?php echo $root; ?>chng_pass.php');" href="javascript:void(0);">Change Password</a></li>
	  
	  <li class="rightmenu"><a onclick="page_redirect('<?php echo $root; ?>logout.php');" href="javascript:void(0);">Logout</a></li>
	</ul>
</div>
<script type="text/javascript">
	<!--
	function page_redirect(action){
		document.frm_treasury.action = action;
		document.frm_treasury.submit();
	}
	//-->
</script>