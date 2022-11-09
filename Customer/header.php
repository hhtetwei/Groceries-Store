<?php

include '../Admin/connect.php';

if (isset($_POST['loginbutton'])) {
  $name = $_POST['uname'];
  $password = $_POST['pass'];
  $hpass = md5($password);

  $query = "select * from user WHERE username='{$name}' AND password='{$hpass}'";

  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);

  if ($count == 0) {
    echo "<script>window.alert('Invalid password or username')</script>";
  } else {
    while ($row = mysqli_fetch_array($result)) {
      $_SESSION['user'] = $name;
      $_SESSION['userId'] = $row['userid'];
  
      header('location:index.php');
    }
  }
}

?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Untitled Document</title>
  <link rel="stylesheet" type="text/css" href="../Assets/css/bootstrap.css" />
  <script src="../Assets/js/bootstrap.js"></script>
  <style>
    .login_modal_tabs {
      padding: 0 0 20px 0;
    }

    .login_modal_tabs li {
      width: 100%;
      text-align: center;
      font-size: 18px;
      color: #333333;
      background-color: #fff;
      border: 1px solid #b5b5b5;
    }

    .login_modal_tabs li a {
      padding: 50px;
      text-decoration: none;
      color: #333333;
    }

    .login_modal_tabs li.active {
      color: #333333;
      background-color: white;
    }

    .login_modal_tabs li.active a {
      color: black;
    }

    nav {
      border-bottom: 1px solid lightgray;
    }

    .brand {
      font-weight: lighter;
      font-size: 1.6rem;
    }
  </style>
</head>

<body>
  <?php
  if (empty($_SESSION['user'])) :
  ?>
    <nav class="navbar navbar-expand-sm" style="height: 65px;">
      <a href="index.php" class="navbar-brand">
        <div class="d-flex align-items-center">
          <img src="../Images/logo.jpg" alt="logo" style="width:50px; height: 50px; border-radius: 50%; object-fit: cover;">
          &nbsp;
          <span class="brand">Bon Appetit</span>
        </div>
      </a>

      <button type="button" class="navbar-toggler border-0" data-toggle="collapse" data-target="#collapsibalnavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="collapsibalnavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-black" href="#acc" data-toggle="modal">Login</a>
          </li>

          <li>
            <a class="nav-link text-black" href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </nav>
  <?php else : ?>
    <nav class="navbar navbar-expand-sm" style="height: 65px;">
      <a href="index.php" class="navbar-brand">
        <div class="d-flex align-items-center">
          <img src="../Images/logo.jpg" alt="logo" style="width:50px; height: 50px; border-radius: 50%; object-fit: cover;">
          &nbsp;
          <span class="brand">Bon Appetit</span>
        </div>
      </a>

      <button type="button" class="navbar-toggler border-0" data-toggle="collapse" data-target="#collapsibalnavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="collapsibalnavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-black" href="cart.php">
              <span><img src="../Images/cart.png" width="30px" height="30px" style="object-fit: cover;"></span>&nbsp;Cart
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-2">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="cursor: pointer;" id="navbarDropdownMenuLink-4" data-toggle="dropdown">
              <img src="../Images/img_avatar.png" style="width: 35px; height: 35px;" class="rounded-circle" alt="avatar image">
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
              <a class="dropdown-item" href="logout.php">Log out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  <?php endif; ?>

  <!--login/register-->
  <div class="modal fade" id="acc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body p-4">

          <div class="row">

            <div class="col-sm-12">

              <ul class="nav nav-tabs login_modal_tabs" role="tablist">
                <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
              </ul>
              <div class="tab-content mt-3">
                <div class="tab-pane active" id="login">
                  <form action="#" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control" name="uname" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="pass" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                      <p>Don't have an account? <a href="register.php">Register here!</a></p>
                    </div>
                    <div class="text-center">
                      <button class="btn btn-success w-25 rounded-0" type="submit" name="loginbutton">Login</button>
                      <button class="btn btn-danger w-25 rounded-0" data-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>