<?php 

session_start();

// echo("Bro");

  $wrong_psw='';
  $no_username='';

  include("connection.php");
  include("functions.php");


  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted
    $email = $_POST['email'];
    $password = $_POST['psw'];
    // echo("Bro");



    //read from database
    $query = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if($result)
    {
      if($result && mysqli_num_rows($result) > 0)
      {

        $user_data = mysqli_fetch_assoc($result);
        
        if($user_data['password'] === $password)
        {

          $_SESSION['user_id'] = $user_data['user_id'];
          // echo("hello");
          header("Location: MyAccountPage.html");
          // die;
        }
        else{
          $wrong_psw = "Incorrect password entered";
        }
      }
      else{
        $no_username = "No such account with that email found";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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
  background-color: #04AA6D;
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
              <a class="active" href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Account</a> -->
          </div>
    </div>


<form method="post">
  <div style="position: absolute; margin-left: auto; margin-right: auto; left: 0; right: 0; text-align: center;" class="container">
    <h1>Login</h1>
    <p>If you already have an account, please log in</p>
    <hr>
    <label for="uname"><b>Email Address</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>
    <span style="color:red;"><?php echo $no_username; ?></span>
    <span style="color:red"><?php echo $wrong_psw; ?></span>
      
    <button type="submit">Login</button>
    <br>
    <br>
    <!-- <span class="psw">Forgot <a style="color:#B77682" href="#">password?</a></span><br><br> -->
    <p>If you don't have an account, please signup</p>
    <a style="color:#B77682" href="signup.php">Signup</a>
  </div>
</form>

</body>
</html>
