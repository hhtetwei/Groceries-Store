<?php
session_start();
include '../connectDb.php';

$userId = $_SESSION['userId'];
$order_id = $_SESSION['orderid'];
$total = $_SESSION['total'];
$tax = $_SESSION['tax'];
$deliveryfee = $_SESSION['deliveryfee'];
$grandtotal = $_SESSION['grandtotal'];
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../Assets/css/bootstrap.css" />
  <script src="../Assets/js/bootstrap.js"></script>

  <style>
    html,
    body {
      padding-right: 0 !important;
    }
  </style>
</head>

<body>
  <?php
  include 'header.php'
  ?>

  <div class="container-fluid p-4">
    <div class="row">
      <div class="col-sm-12">
        <div class="w-75 text-center mx-auto mb-4 mt-1">
          <h2 class="text-success font-weight-light">
            <strong>Thank You!</strong> Your order has been placed!
          </h2>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="row">
          <div class="col-sm-12">
            <div class="card rounded-0 mb-3 p-3">
              <div class="card-body">
                <h5 class="card-title">This order will be shipped to:</h5>

                <?php
                $query = "select * from user where userid='$userId'";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($result)) {
                  $username = $row['username'];
                  $phone = $row['phone'];
                  $address = $row['address'];
                }
                ?>

                <p class="card-text">
                  <?php echo $username; ?><br>
                  <?php echo $phone; ?><br>
                  <?php echo $address; ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="card rounded-0 mb-3 p-3">
              <div class="card-body">
                <h5 class="card-title">Payment Method</h5>
                <p class="card-text"><?php echo $_SESSION['payment_method']?></p>
              </div>
            </div>

            <a href="continueshopping.php" class="btn btn-success rounded-0">CONTINUE SHOPPING</a>
          </div>
        </div>
      </div>

      <div class="col-sm-8">
        <div class="card rounded-0 mb-3 p-0">
          <div class="card-body">
            <h5 class="card-title">Order Summary</h5>

            <table class="table table-hover table-sm">
              <thead class="bg-dark text-white">
                <tr>
                  <td style="width: 55%;">ITEM</td>
                  <td style="width: 15%;">PRICE</td>
                  <td style="width: 15%;">QTY</td>
                  <td style="width: 15%;">TOTAL</td>
                </tr>
              </thead>

              <tbody>
                <?php
                foreach ($_SESSION['cart'] as $id => $qty) :
                  $result = mysqli_query($connection, "SELECT * FROM products WHERE product_id ='$id'");
                  $row = mysqli_fetch_assoc($result);
                ?>

                  <tr>
                    <td>
                      <div class="row">
                        <div class="col-sm-3">
                          <img src="../Images/<?php echo $row['product_image'] ?>" width="100" height="100" class="img-fluid" />
                        </div>

                        <div class="col">
                          <p><?php echo $row['product_name'] ?></p>
                        </div>
                      </div>
                    </td>

                    <td>
                      <p><?php echo $row['product_price'] ?></p>
                    </td>

                    <td><?php echo $qty ?></td>

                    <td><?php echo $row['product_price'] * $qty ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="row">
              <div class="col-sm-6 w-100">
              </div>

              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card-text">
                      <p>Subtotal</p>
                      <p>Tax(5%)</p>
                      <p>Delivery fees</p>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="card-text">
                      <p><?php echo $total; ?> KS</p>
                      <p><?php echo $tax; ?> KS</p>
                      <p><?php echo $deliveryfee; ?> KS</p>
                    </div>
                  </div>
                </div>

                <hr style="border-color: black;" class="w-100">

                <div class="row">
                  <div class="col-sm-6">
                    <h5>TOTAL</h5>
                  </div>

                  <div class="col-sm-6">
                    <h5><?php echo $grandtotal; ?> KS</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include 'footer.php'
  ?>
</body>

</html>