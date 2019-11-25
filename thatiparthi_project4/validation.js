function validateLogin() {
  var uname = document.forms["login"]["username"];
  var pass = document.forms["login"]["password"];

  	if (uname.value == "") {
    document.getElementById("username").innerHTML="**Please enter your Username";
    return false;
	}
	if (uname.length<3) {
	document.getElementById("username").innerHTML="Username must be atleast of 3 characters";
	}
	if (pass.value == "") {
    document.getElementById("passwords").innerHTML="**Please enter your password ";
    return false;
	}
	if (pass.value.length>=3 || pass.value.length<20 ){
		document.getElementById("passwords").innerHTML="**Password should be more than 3 characters and less than 20";
    return false;
	}
	
}	


function validateContact() {
  var uname = document.forms["contact"]["name"];
  var email = document.forms["contact"]["email"];
  var msg = document.forms["contact"]["msg"];

  	if (uname.value == "") {
    document.getElementById("name").innerHTML="**Please enter your Name";
    return false;
	}
	else{
	document.getElementById("name").innerHTML="";
    return false;
	}
	if (uname.value < 3) {
    document.getElementById("name").innerHTML="**Name must be atleast 3 characters";
    return false;
	}
	else{
	document.getElementById("name").innerHTML="";
    return false;
	}
	if (email.value == "") {
    document.getElementById("email").innerHTML="**Please enter your email";
    return false;
	}
	if (email.value.indexOf('@') <= 0) {
    document.getElementById("email").innerHTML="**invalid email";
    return false;
	}
	if ((email.value.charAt(email.value.length-4)!='.') && (email.value.charAt(email.value.length-3)!='.')) {
    document.getElementById("email").innerHTML="**invalid domain";
    return false;
	}
	if (msg.value == "") {
    document.getElementById("msg").innerHTML="**Please enter your message";
    return false;
	}
	if (msg.value < 3) {
    document.getElementById("msg").innerHTML="**Message should have more than three characters";
    return false;
	}
	else{
	document.getElementById("msg").innerHTML="";
    return false;
	}
}
function validateSignup() {
  var uname = document.forms["signup"]["username"];
  var email = document.forms["signup"]["email"];
  var pass = document.forms["signup"]["password"];
	
  	if (uname.value == "") {
    document.getElementById("username").innerHTML="**Please enter your Username";
    return false;
	}
	if (uname.length<3) {
	document.getElementById("username").innerHTML="Username must be atleast of 3 characters";
	}
	if (email.value == "") {
	document.getElementById("email").innerHTML="**Please enter your email";
	return false;
	}
	if (email.value.indexOf('@') <= 0) {
	document.getElementById("email").innerHTML="**invalid email";
	return false;
	}
	if ((email.value.charAt(email.value.length-4)!='.') && (email.value.charAt(email.value.length-3)!='.')) {
	document.getElementById("email").innerHTML="**invalid domain";
	return false;
	}
	if (pass.value == "") {
    document.getElementById("passwords").innerHTML="**Please enter your password ";
    return false;
	}
	else{
	document.getElementById("passwords").innerHTML="";
    return false;
	}
	if (pass.value.length>=3 || pass.value.length<20 ){
		document.getElementById("passwords").innerHTML="**Password should be more than 3 characters and less than 20";
    return false;
	}
	else{
	document.getElementById("passwords").innerHTML="";
    return false;
	}
	
}


	
