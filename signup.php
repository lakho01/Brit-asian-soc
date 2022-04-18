<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['psw'];
		$uni = $_POST['uni'];
		// echo ($first_name);
		// echo ($last_name);
		// echo ($email);
		// echo ($password);

		if(!empty($email) && !empty($password))
		{

			//save to database
			$user_id = random_num(20);
			// echo ($user_id);
			$query = "insert into registration (user_id,first_name,last_name,email,password, University) values ('$user_id','$first_name','$last_name','$email','$password','$uni')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    @import url('https://fonts.googleapis.com/css2?family=Amatic+SC&family=Fredoka:wght@300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Fredoka&display=swap');
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(255, 255, 255);
  display:block;
  margin:0px;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  width:500px!important;
  height:500px!important;
  margin-right: auto;
  margin-left: auto;
  /* padding: 16px; */
  background-color: white;
}
.login-container{
  width:500px!important;
  height:80px!important;
  margin-right: auto;
  margin-left: auto;
  /* padding: 16px; */
  background-color: white;
}


/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

input[type="email" i] {
    /*padding: 1px 2px;*/
    border: 1px solid #ccc;
    outline: none;
    width: 100%;
    padding: 12px 20px;
    margin: 5px 0 22px 0;
    display: inline-block;
    /*border: none;*/
    background: #f1f1f1;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #B77682;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  padding-left: 40px;
  padding-bottom: 60%;
  background-color: #ffffff;
  text-align: center;
}
.topnav{
      overflow: hidden;
      background-color: #333;
}
.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 25px 16px;
    text-decoration: none;
    font-size: 17px;
}
.topnav a:hover {
    background-color: #e0a1ad;
    color: black;
}

.topnav a.active {
    background-color: #B77682;
    color: white;
}

.topnav-right {
    float: right;
}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color:#B77682;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  /* width: auto; */
  margin-right: auto;
  margin-left: auto;
  /* padding: 10px 18px; */
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  /* float: left; */
  margin-left: 150px;
  padding-top: 50px;
  /* padding-right: 180px; */
  /* padding-left: 200px; */
}

.login{
  /* margin-right: 150px;
  padding-top: 50px; */
  /* padding-bottom: 500px; */
  width:500px!important;
  /* height:500px!important; */
  /* margin-left: 875px; */
  /* margin-left: auto; */
  background-color: white;
}

.vertline1{
  border-left: 6px solid green;
  height: 500px;
  position: absolute;
  left: 50%;
  margin-left: -3px;
  top: 130px;
}


span.psw {
  float: left;
  /* padding-top: 6px; */
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}
/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 4% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}
/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "\2713";
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "X";
}

#fullname {
  display: grid;
  grid-template-columns: auto auto;
}
#fullname > div {
  padding: 0 2px;
}

</style>
</head>
<body>
    <div class="topnav">
        <img src="images/logo_bas.jpg" style="width:100px;height:100px;" >
          <div class="topnav-right">
          <!-- <a href="./">Home</a>
          <a href="../store/store.php">Flat Finder</a>
          <a href="../flatmate-finder/rommate_finder.php">Flat Share</a>
          <a href="../about-us/aboutUs.php">About</a>
          <a class="active" href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Account</a>
          </div> -->
    </div>
<form method="post">
  <div style="position: absolute; margin-left: auto; margin-right: auto; left: 0; right: 0; text-align: center;" class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <div id="fullname">
      <!-- First Name -->
      <div>
        <label id="firstLabel1" for="fname">First Name</label>
        <!-- <span id="firstError1" class="Error">*</span> -->
        <input type="text" id="fname" name="firstname" placeholder="e.g. Imran" required />
      </div>

      <!-- Last Name -->
      <div>
        <label id="lastLabel1" for="lname">Last Name</label>
        <!-- <span id="lastError1" class="Error">* <?php echo $lnameErr;?></span> -->
        <input type="text" id="lname" name="lastname" placeholder="e.g. Khan" required />
      </div>
    </div>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" id="email" required>
    <br>

    <label for="uni"><b>University</b></label>
    <input type="text" placeholder="Enter Name of Your University" name="uni" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <div id="message">
      <h3>Password must contain the following:</h3>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>

    <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->


    <label for="psw_repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw_repeat" id="psw_repeat" required>
    <hr>
    <!-- <p>By creating an account you agree to our <a style="color:#B77682" href="./Privacy_Policy.pdf" target = "_blank">Privacy Policy</a> and <a style="color:#B77682" href="./Terms.pdf" target = "_blank">Terms & Conditions</a>.</p> -->
    <button type="submit" name="submit" class="registerbtn">Register</button>

    <p>If you already have an account, please login</p>
    <a style="color:#B77682; padding-bottom: 30px;" href="login.php">Login</a>
  </div>
</form>

<script>
// Repeat Password Verify
var password = document.getElementById("psw")
  , confirm_password = document.getElementById("psw_repeat");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

// End of repeat password verification


password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

</body>
</html>

<!-- <!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html> -->
