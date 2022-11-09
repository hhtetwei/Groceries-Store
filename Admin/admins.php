<?php
session_start();
include('connect.php');
include('function.php');
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <title>Admins</title>

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <?php
  include 'header.php';
  ?>

  <div class="container-fluid p-3">
    <div class="row">
      <div class="col-3">
        <?php
        include 'sidenav.php';
        ?>
      </div>

      <div class="col">
        <div>
          <h4 class="mb-3">Create admin</h4>

          <form method="POST">
            <div class="row">
              <div class="col-3">
                <input type="text" class="form-control" placeholder="Name..." name="admin-name">
              </div>

              <div class="col-3">
                <input type="email" class="form-control" placeholder="Email..." name="admin-email">
              </div>

              <div class="col-3">
                <input type="text" class="form-control" placeholder="Password..." name="admin-password">
              </div>

              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit-btn">Submit</button>
              </div>
            </div>
          </form>

          <?php
          if (isset($_POST['submit-btn'])) {
            if (!empty($_POST['admin-name']) && !empty($_POST['admin-password']) && !empty($_POST['admin-email'])) {
              createAdmin();
            }
          }
          ?>
        </div>

        <div style="height: 80vh; overflow: auto;">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "select * from admin";
              $result = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_array($result)) {
                $admin = $row;

                echo "<tr>";
                echo "<td>{$admin['adminname']}</td>";
                echo "<td>{$admin['email']}</td>";
                echo "<td><a class='btn btn-danger btn-sm' href='admins.php?action=delete&admin_id={$admin['adminid']}'>Remove</a></td>";
                echo "</tr>";
              }

              if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                removeAdmin();
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>