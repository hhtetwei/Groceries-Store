<?php
session_start();
include('connect.php');
include('function.php');
?>

<html>

<head> 
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

  <title>DoorDash : Admins</title>

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
        <i class="fa-thin fa-circle-user"></i>
          <h4 class="mb-3">Create Supplier</h4>

          <form method="POST">
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" placeholder="Name..." name="supplier_name">
              </div>

              <div class="col">
                <input type="email" class="form-control" placeholder="Email..." name="email">
              </div>

              <div class="col">
                <input type="phone" class="form-control" placeholder="Phone..." name="phone">
              </div>

              <div class="col">
                <input type="address" class="form-control" placeholder="Address..." name="address">
              </div>

              
              <div class="col">
                <button type="submit" class="btn btn-primary ml-auto" name="submit-btn">Submit</button>
              </div>
            </div>
          </form>

          <?php
          if (isset($_POST['submit-btn'])) {
            if (!empty($_POST['supplier_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address'])) {
              createSupplier();
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
                <th>Phone</th>
                <th>Address</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "select * from supplier";
              $result = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_array($result)) {
                $supplier = $row;

                echo "<tr>";
                echo "<td>{$supplier['supplier_name']}</td>";
                echo "<td>{$supplier['email']}</td>";
                echo "<td>{$supplier['phone']}</td>";
                echo "<td>{$supplier['address']}</td>";
                echo "<td><a class='btn btn-danger btn-sm' href='supplier.php?action=delete&supplier_id={$supplier['supplier_id']}'>Remove</a></td>";
                echo "</tr>";
              }

              if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                removeSupplier();
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