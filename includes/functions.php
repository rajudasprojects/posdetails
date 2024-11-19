<?php
require_once("functions.php");

function supp_nm($supp_prov){
	
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.support_user WHERE id = '".$supp_prov."'");
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$connpdo_trclasic_dc = null;
	$sth->execute();
	$supp_pro_nm = $result['support_user'];
	return $supp_pro_nm;
}
function suport_reqby($supp_req){
	
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.reporting_user WHERE id = '".$supp_req."'");
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$connpdo_trclasic_dc = null;
	$sth->execute();
	$supp_req_nm = $result['repo_user'];
	return $supp_req_nm;
}
function posname($machine_id){
if($machine_id == '0'){
	$posName = 'Supervisor';
	return $posName;
}else{
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("SELECT machine_code from `treasury`.`machine_co` WHERE machine_no='".$machine_id."'");
	$result_poc = $sth->fetch(PDO::FETCH_ASSOC);
	$connpdo_trclasic_dc = null;
	$sth->execute();
	$posName = $result_poc['machine_code'];
	return $posName;
}
}

function cashoffice($cashoff_id){
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("SELECT cashoffice_name from `treasury`.`cashoffice` WHERE cashoffice_no='".$cashoff_id."'");
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$connpdo_trclasic_dc = null;
	$sth->execute();
	$cassoffice=$result['cashoffice_name'];
	return $cassoffice;
}

function modulename($modid){
	$connpdo_trclasic_dc = conn_treasraj_pdo();
	$sth = $connpdo_trclasic_dc->query("SELECT * from treasurystatus_control.module_list WHERE id='".$modid."'");
	$result_md = $sth->fetch(PDO::FETCH_ASSOC);
	$connpdo_trclasic_dc = null;
	$sth->execute();
	$dep_name = $result_md['module_name'];
	return $dep_name;
}

function gettbldata1($rows){
	
	$tdarr1=[];	
	foreach($rows as $row){
		
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = null;
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		
		$tdarr1[] = [$repo_date,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr1;
}

function gettbldata2($rows){
	$tdarr2=[];	
	foreach($rows as $row){
		
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !="")
		{
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		$tdarr2[] = [$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr2;
}

function gettbldata3($rows){
	$tdarr3=[];	
	foreach($rows as $row){
		$pos_no=$row['pos_no'];
		if($pos_no !=""){
			$posno=posname($pos_no);
		}else{
			$posno="";
		}
		
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		$tdarr3[] = [$posno,$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr3;
}

function gettbldata4($rows){
	$tdarr4=[];	
	foreach($rows as $row){
		$cashoff_id=$row['co_no'];
		$cashoffice=cashoffice($cashoff_id);
		$pos_no=$row['pos_no'];
		if($pos_no !=""){
			$posno=posname($pos_no);
		}else{
			$posno="";
		}
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		$tdarr4[] = [$cashoffice,$posno,$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr4;
}

function gettbldata5($rows){
	$tdarr5=[];	
	foreach($rows as $row){
		$ven = $row['dep_name'];
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		$tdarr5[] = [$ven,$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr5;
}

function gettbldata6($rows){
	/* echo "<pre>";
	print_r($rows);exit; */
	$tdarr6=[];	
	foreach($rows as $row){
		$cashoff_id=$row['co_no'];
		$cashoffice=cashoffice($cashoff_id);
		$pos_no=$row['pos_no'];
		if($pos_no !=""){
			$posno=posname($pos_no);
		}else{
			$posno="";
		}
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		$tdarr6[] = [$cashoffice,$posno,$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr6;
}

function gettbldata7($rows){
	
	$tdarr7=[];	
	foreach($rows as $row){
		
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
			
		$tdarr7[] = [$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr7;
}

function gettbldata8($rows){
	
	$tdarr8=[];	
	foreach($rows as $row){
		$cashoff_id=$row['co_no'];
		if($cashoff_id !=""){
			$cashoffice=cashoffice($cashoff_id);
		}else{
			$cashoffice="";
		}
		
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
			
		$tdarr8[] = [$cashoffice,$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr8;
}

function gettbldata9($rows){
	/* echo "<pre>";
	print_r($rows);exit; */
	$tdarr9=[];	
	foreach($rows as $row){
		$modulNm = $row['module_id'];
		if($modulNm !=""){
			$modulenm = modulename($modulNm);
		}else{
			$modulenm = "";
		}
		
		$timestamp = strtotime($row['report_date']);
		$repo_date = date("d-m-Y", $timestamp);
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
					
		$tdarr9[] = [$modulenm,$repo_date,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr9;
}

function gettbldata10($rows){
	/* echo "<pre>";
	print_r($rows);exit; */
	$tdarr10=[];	
	foreach($rows as $row){
		$cashoff_id=$row['co_no'];
		if($cashoff_id !=""){
			$cashoffice=cashoffice($cashoff_id);
		}else{
			$cashoffice="";
		}
		
		$modulNm = $row['module_id'];
		if($modulNm !=""){
			$modulenm = modulename($modulNm);
		}else{
			$modulenm = "";
		}
		
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
					
		$tdarr10[] = [$cashoffice,$modulenm,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr10;
}

function gettbldata11($rows){
	/* echo "<pre>";
	print_r($rows);exit; */
	$tdarr11=[];	
	foreach($rows as $row){
		$ven = $row['dep_name'];
		$cashoff_id=$row['co_no'];
		if($cashoff_id !=""){
			$cashoffice=cashoffice($cashoff_id);
		}else{
			$cashoffice="";
		}
				
		$reptime = $row['report_time'];
		$supreqby=$row['support_required_by'];
		if($supreqby !=""){
			$support_required_by = suport_reqby($supreqby);
		}else{
			$support_required_by = "";
		}
		
		$support_details = $row['support_details'];
		$job_description = $row['job_description'];
		$data = $row['support_provided_by'];
		if($data !=""){
			$supportprovidedby = supp_nm($data);
		}else{
			$supportprovidedby = "";
		}
		
		$time_taken=$row['time_taken'];
		$timestart=$row['pass_revoked_start_time'];
		$timeend=$row['pass_revoked_end_time'];
		
		$tdarr11[] = [$ven,$cashoffice,$reptime,$support_required_by,$support_details,$job_description,$supportprovidedby,$time_taken,$timestart,$timeend];
	}
	return $tdarr11;
}
?>