<?php
session_start();
include('connect.php');
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <title>DoorDash : Users</title>

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
        <div style="height: 80vh; overflow: auto;">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "select * from user";
              $result = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_array($result)) {
                $user = $row;

                echo "<tr>";
                echo "<td>{$user['username']}</td>";
                echo "<td>{$user['phone']}</td>";
                echo "<td>{$user['email']}</td>";
                echo "<td>{$user['address']}</td>";
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