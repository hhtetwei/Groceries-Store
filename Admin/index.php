<?php
session_start();
include('function.php');
include('connect.php');

if (isset($_POST['btnlogin'])) { {
    global $connection;
    $name = $_POST['adminname'];
    $password = $_POST['password'];
    $hpass = md5($password);
    $query = "select * from admin WHERE adminname='{$name}' AND password='{$hpass}'";
    
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
      echo "<script>window.alert('Invalid password or name')</script>";
    } else {
      while ($row = mysqli_fetch_array($result)) {
        $_SESSION['admin'] = $name;
    
        header('location:products.php');
      }
    }
  }
}
?>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <title>Login</title>
</head>

<body>
  <div class="container p-5">
    <div class="row">
      <div class="col text-center">
        <img src="../Images/logo.jpg" class="" height="200px" width="200px" style="border: 1px solid lightgray; border-radius: 50%;">
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
      <div class="col">
        <div style="width: 400px; margin: auto">
          <form method="post">
            <label>Username</label>
            <input name="adminname" type="text" class="form-control" />
            <label>Password</label>
            <input name="password" type="password" class="form-control" />
            <br />
            <input name="btnlogin" type="submit" value="Login" class="btn btn-success" />
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>