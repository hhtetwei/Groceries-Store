<?php
session_start();
include('connect.php');
include('function.php');
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <title>Orders</title>

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
        
        <?php  
        
        $total = mysqli_query($connection, "select sum(`total_amount`) AS total_amount from orders WHERE date BETWEEN '2022-03-01' AND '2022-03-30'");
        $row=mysqli_fetch_array($total);
        $total_amount=$row['total_amount'];
        echo "TOTAL AMOUNT: " . $total_amount;

        ?>
          <table class="table">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Items</th>
                <th>Ordered date</th>
                <th>Total amount</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <?php
              $orders = mysqli_query($connection, "select * from orders WHERE date BETWEEN '2022-03-01' AND '2022-03-30' order by date desc");
              $total = mysqli_query($connection, "select sum(`total_amount`) AS total_amount from orders WHERE date BETWEEN '2022-03-01' AND '2022-03-30'");
              $row=mysqli_fetch_array($total);
              $total_amount=$row['total_amount'];
              
              while ($order = mysqli_fetch_array($orders)) {
                $orderId = $order['order_id'];
                $userId = $order['user_id'];

                $userResult = mysqli_query($connection, "select * from user where user.userid = $userId");

                while ($user = mysqli_fetch_array($userResult)) {
                  $username = $user['username'];
                  $userPhone = $user['phone'];
                }

                $orderDetails = mysqli_query($connection, "select order_details.*, products.* from order_details left join products on order_details.product_id = products.product_id where order_details.order_id='$orderId'");

                echo "<tr>";

                echo "<td>
                  <div>{$username}</div>
                  <small style='color: gray; font-weight: 500'>Ph: {$userPhone}</small>
                </td>";

                echo "<td>";
                echo "<ul>";

                while ($detail = mysqli_fetch_array($orderDetails)) {
                  echo "<li>" . $detail['product_name'] . " x " . $detail['quantity'] . "</li>";
                }

                echo "</ul>";
                echo "</td>";

                echo "<td>{$order['date']}</td>";
                echo "<td>{$order['total_amount']}</td>";
                echo "<td>{$order['status']}</td>";

                if ($order['status'] == 'pending') {
                  echo "<td><a class='btn btn-success btn-sm' href='orders_april.php?action=update&order_id={$order['order_id']}'>Complete</a></td>";
                } else {
                  echo "<td><button class='btn btn-success btn-sm' disabled>Complete</button></td>";
                }

                echo "</tr>";
              }

              if (isset($_GET['action']) && $_GET['action'] == 'update') {
                completeOrderMarch();
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