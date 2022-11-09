<?php
session_start();
include '../Admin/connect.php';
	include'functions.php';
	if(isset($_POST['register'])){
	$user_name=$_POST['username'];
	$password=$_POST['password'];
	$comfirm_password=$_POST['confirmpassword'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$errors=array(
		/*'username'=>'',*/
		/*'password'=>'',*/
		'match_password'=>'',
	);
/*	if(strlen($user_name)<3){
		$errors['username']='Username needs to be longer';
	}*/
	if($password!=$comfirm_password){
		$errors['match_password']='Passwords do not match';
	}
/*	if(strlen($password)<3){
		$errors['password']='Password needs to be longer';
	}*/
	foreach($errors as $key=>$value){
		if(empty($value)){
			unset($errors[$key]);
		}
	}
	if(empty($errors)){
		create_accu();
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../Assets/bootstrap.css"/>
<script src="../Assets/jquery-3.3.1.js"></script>
<script src="../Assets/bootstrap.js"></script>
</head>

<body>
<?php
	include('header.php');
?>
<div class="container" style="margin-top: 80px;">
	<div class="row">
		<div class="col-sm-4 offset-4">
			<h4 class="text-center font-weight-light">Register here</h4>
			<form action="#" method="post">
				<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($user_name)){ echo $user_name;} ?>" required>
					<?php /*?><lable class="text-danger"><?php echo isset($errors['username'])? $errors['username']:'' ?> </label><?php */?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" required>
					<?php /*?><lable class="text-danger"><?php echo isset($errors['password'])? $errors['password']:'' ?> </label><?php */?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="confirmpassword" placeholder="Confirm password"  required>
					 <lable class="text-danger"><?php echo isset($errors['match_password'])? $errors['match_password']:'' ?> </label>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo isset($email)?$email:'' ?>"  required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo isset($phone)?$phone:'' ?>"  required>
				</div>
				<div class="form-group">
					<textarea type="text" name="address" value="<?php echo isset($address)?$address:'' ?>" class="form-control" placeholder="Address" rows="5" cols="40"  required/></textarea>
				</div>
				<div class="text-center">
					<button class="btn btn-success w-25 rounded-0" type="submit" name="register">Register</button>
					<button class="btn btn-danger w-25 rounded-0"  name="cancel"><a href="index.php">Cancel</a></button>
				</div>
				<small class="text-danger p-0">*Please fill all the fields</small>
			</form>
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
</body>
</html>