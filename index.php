<?php

if(isset($_POST['login']))
{
	//start of try block

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			echo "Username is required!";
			
		}
		if(empty($_POST['password'])){
			echo "Password is required!";
			
		}
		//establishing connection with db and things
		include ('connect.php');
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$type = $_POST['type'];
		//checking login info into database
		$sql = "SELECT * from `admininfo` where 1";
		$result= mysqli_query($conn, $sql);
		
		$row= mysqli_num_rows($result);

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>MCA Attendance Management System By Kuldeep Kaware</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" href="styles.css" >
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<center>

<header>

  <h1>MCA Attendance Management System</h1>

</header>

<h1>Login</h1>

<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
?>


<div class="content">
	<div class="row">

		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">Username</label>
			    <div class="col-sm-7">
			      <input type="text" name="username"  class="form-control" id="input1" placeholder="your username" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-7">
			      <input type="password" name="password"  class="form-control" id="input1" placeholder="your password" />
			    </div>
			</div>


			<div class="form-group" class="radio">
			<label for="input1" class="col-sm-3 control-label">Role</label>
			<div class="col-sm-7">
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
			  </label>
			  	  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
			  </label>
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
			  </label>
			</div>
			</div>


			<input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Login" name="login" />
		</form>
	</div>
</div>



<br><br>
<p><strong>Have forgot your password? <a href="reset.php">Reset here.</a></strong></p>
<p><strong>If you don't have any account, <a href="signup.php">Signup</a> here</strong></p>

</center>
</body>
</html>