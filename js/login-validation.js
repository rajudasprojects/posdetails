/* Prevent Right Click */
/* document.addEventListener("contextmenu", function(e){
	e.preventDefault();
	alert("Right click is not allowed.");
}, false); */


/* Login Form Validation */
$(document).ready(function(){
	$("#cesc_login_submit").click(function(e){
		e.preventDefault();
		var cesc_login_userid = $.trim($("#cesc_login_userid").val());
		var cesc_login_password = $.trim($("#cesc_login_password").val());
		var alphanumeric_regx = /^[A-Za-z0-9]+$/;
		
		if(cesc_login_userid == ""){
			$("#login_error_message").show().html("ERROR: Please enter a User ID");
		} else if(isNaN(cesc_login_userid)){
			$("#login_error_message").show().html("ERROR: User ID must be numeric");
		} else if(cesc_login_userid.length > 7 ){
			$("#login_error_message").show().html("ERROR: User ID must be less than 7 characters");
		} else if(cesc_login_password == ""){
			$("#login_error_message").show().html("ERROR: Please enter a password");
		} else if(!alphanumeric_regx.test(cesc_login_password)){
			$("#login_error_message").show().html("ERROR: No special characters are allowed in password field");
		} else if(cesc_login_password.length > 20 ){
			$("#login_error_message").show().html("ERROR: Password must be less than 20 characters");
		} else {
			$("#login_error_message").hide().html("");
			$("#cesc_login_form").submit();
		}
	});
});



