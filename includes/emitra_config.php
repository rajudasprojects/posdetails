<?php

/* Emitra Configuration File For BHARATPUR =============================================== */

if(!defined("FRANCHISE_NAME")) define("FRANCHISE_NAME","Bharatpur");

if(!defined("FRANCHISE_NUMBER")) define("FRANCHISE_NUMBER","2");

if(!defined("COMPANY_NAME")) define("COMPANY_NAME","BESL");

if(!defined("COMPANY_NAME_FULL")) define("COMPANY_NAME_FULL","Bharatpur Electricity Services Limited");

if(!defined("SERVICE_PROVIDER")) define("SERVICE_PROVIDER","Emitra");

if(!defined("PAYMENT_INFO_URL")) define("PAYMENT_INFO_URL","http://cescrajasthan.co.in/jascnaesr/emitra/bharatpur/paymentinfo.php");

if(!defined("POST_URL")) define("POST_URL","http://cescrajasthan.co.in/jascnaesr/emitra/bharatpur/ekpost.php");

if(!defined("POST_CANCEL_URL")) define("POST_CANCEL_URL","http://cescrajasthan.co.in/jascnaesr/emitra/bharatpur/ekpost_cancel.php");

if(!defined("PAYMENT_INFO_SERVICE")) define("PAYMENT_INFO_SERVICE","serviceknopaymentdet");

if(!defined("POST_AUTH_KEY")) define("POST_AUTH_KEY","BESLEMITRA5289");

if(!defined("POST_CANCEL_AUTH_KEY")) define("POST_CANCEL_AUTH_KEY","BESLEMITRACANCEL5290");

if(!defined("SUPPORTED_KNO")) define("SUPPORTED_KNO","2102110,2102120");

if(!defined("MAIN_TABLE")) define("MAIN_TABLE","bharatpur_emitra");

if(!defined("TABLE_SAVE_POST_RAW")) define("TABLE_SAVE_POST_RAW","bharatpur_emitra_rawdata");

if(!defined("IT_TRACKING_TABLE")) define("IT_TRACKING_TABLE","it_inform_tracking");

if(!defined("IT_PAYMENT_MODE")) define("IT_PAYMENT_MODE","11");

if(!defined("IT_INSTANT_URL")) define("IT_INSTANT_URL","http://10.40.16.26:8084/rdfcommws/payment_insert_cis.jsp?service=service_kno_instant_pmnt_insert/");

if(!defined("SMS_API")) define("SMS_API","http://rajtreasury1/cescrajasthan/kedl/co_online/smsapi/send_sms_api_kedl.php");

/* Information needed for MIS file section =============================================== */
if(!defined("MIS_FILE_FORMAT")) define("MIS_FILE_FORMAT","BHARATPUREMITRA_YYYYMMDD.txt");

if(!defined("MIS_FILE_KEY")) define("MIS_FILE_KEY","BHARATPUREMITRA");

if(!defined("MIS_FILE_KEYLENGTH")) define("MIS_FILE_KEYLENGTH","15");

if(!defined("MIS_CANCEL_FILE_FORMAT")) define("MIS_CANCEL_FILE_FORMAT","BHARATPUREMITRACANCEL_YYYYMMDD.txt");

if(!defined("MIS_CANCEL_FILE_KEY")) define("MIS_CANCEL_FILE_KEY","BHARATPUREMITRACANCEL");

if(!defined("MIS_CANCEL_FILE_KEYLENGTH")) define("MIS_CANCEL_FILE_KEYLENGTH","21");

if(!defined("IT_GET_PAYMENT_INFO")) define("IT_GET_PAYMENT_INFO","http://www.cesc.co.in/newcopybill/service_kno_paymentDet_cis.jsp?kno=");

if(!defined("IT_GET_MOBILE_NO")) define("IT_GET_MOBILE_NO","http://www.cesc.co.in/newcopybill/getMob.jsp");

if(!defined("IT_CONFIRM_URL")) define("IT_CONFIRM_URL","http://10.40.16.26:8084/rdfcommws/payment_auth_cis.jsp");

if(!defined("SUMMARY_TABLE")) define("SUMMARY_TABLE","bharatpur_emitra_summary");

if(!defined("CANCEL_TABLE")) define("CANCEL_TABLE","bharatpur_emitra_cancel");

if(!defined("ONLINE_TABLE")) define("ONLINE_TABLE","bharatpur_emitra_online");

if(!defined("BANK_ACCOUNT_NAME")) define("BANK_ACCOUNT_NAME","Bharatpur Electricity Services Limited");
if(!defined("BANK_ACCOUNT_BANK_NAME")) define("BANK_ACCOUNT_BANK_NAME","ICICI Bank");
if(!defined("BANK_ACCOUNT_BRANCH")) define("BANK_ACCOUNT_BRANCH","");
if(!defined("BANK_ACCOUNT_NUMBER")) define("BANK_ACCOUNT_NUMBER","");
if(!defined("BANK_ACCOUNT_IFSC")) define("BANK_ACCOUNT_IFSC","");
?>