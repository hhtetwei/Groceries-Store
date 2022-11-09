<?php
	include 'YOUR DB CONNECTION FILE';

	if(isset($_POST['loginbutton'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
    $hpass = md5($password);
    $email_err = $password_err = "";

		if ($email == '') {
			$email_err = 'Email cannot be empty';
		}

		if($password == '') {
			$password_err = 'Password cannot be empty';
		}

    if($password && strlen($password) < 8) {
      $password_err = 'Password must be at least 8 characters';
    }

    if(empty($email_err) && empty($password_err)) {
      $query = "select * from user where email='{$email}' and password='{$hpass}'";
      $go_query = mysqli_query($connection,$query);

      while($out = mysqli_fetch_array($go_query)) {
        $db_email = $out['email'];
        $db_password = $out['password'];

        if($db_email == $email && $db_password == $password) {
          echo"<script>window.alert('Now you are logged in')</script>";
        } else {
          echo"<script>window.alert('Invalid Email or Password')</script>";
        }
      }
    }
	}
?>

<!doctype html>
<html>
<head>
  <title>Login</title>

  <style>
    .error-text {
      color: red;
    }
  </style>
</head>

<body>
  <form action="#" method="post">
      <input type="email" name="email" placeholder="Email">
      <p class="error-text"><?php echo $email_err; ?></p>

      <input type="password" name="password" placeholder="Password">
      <p class="error-text"><?php echo $password_err; ?></p>

      <button type="submit" name="loginbutton">Login</button>
  </form>
</body>
</html>