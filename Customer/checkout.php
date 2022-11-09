<?php
session_start();
include '../connectDb.php';

if (!empty($_SESSION['user'])) {
  $user_name = $_SESSION['user'];
  $query = "select * from user where username='$user_name'";
  $result = mysqli_query($connection, $query);

  while ($out = mysqli_fetch_array($result)) {
    $user_id = $out['userid'];
    $user_name = $out['username'];
    $email = $out['email'];
    $phone = $out['phone'];
    $address = $out['address'];
  }
}

$total = $_SESSION['total'];
$tax = $_SESSION['tax'];
$deliveryfee = $_SESSION['deliveryfee'];
$grandtotal = $_SESSION['grandtotal'];
?>

<html>

<head>
  <title>Checkout</title>
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
  include 'header.php';
  ?>

  <div class="container-fluid p-4">
    <div class="row">
      <div class="col-9">
        <div class="card rounded-0">
          <div class="card-body">
            <form action="submit.php" method="POST">
              <h5 class="display-4">CHECKOUT</h5>

              <hr class="w-100" style="border-color: black;">

              <div class="card rounded-0 mb-3 p-3">
                <div class="card-body">
                  <h5 class="card-title">This order will be shipped to</h5>

                  <p class="card-text">
                    <?php echo $user_name; ?><br>
                    <?php echo $phone; ?><br>
                    <?php echo $address; ?></p>
                </div>
              </div>

              <div class="card rounded-0 mb-3 p-3">
                <div class="card-body">
                  <h5 class="card-title">Choose payment method</h5>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="Cash on delivery" name="payment" id="cod" checked>
                    <label class="form-check-label" for="cod">
                      Cash on delivery
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="KBZ Pay" name="payment" id="kpay">
                    <label class="form-check-label" for="kpay">
                      KBZ Pay
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="Wave Pay" name="payment" id="wave">
                    <label class="form-check-label" for="wave">
                      Wave Pay
                    </label>
                  </div>

                  <div class="mt-3">
                    <small>For KBZ Pay and Wave Pay options, please transfer to the following phone number.</small>
                    <br>
                    <small>09-987654321</small>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-success rounded-0 text-white">SUBMIT ORDER</button>
              <!-- <a href="submit.php" class="btn btn-success rounded-0 text-white">SUBMIT ORDER</a> -->
            </form>
          </div>
        </div>
      </div>

      <div class="col-3">
        <div class="card rounded-0">
          <div class="card-body">
            <h2 class="font-weight-light">CART SUMMARY</h2>

            <hr style="border-color: black;">

            <div class="row">
              <div class="col-sm-8">
                <p>Subtotal</p>
                <p>Tax(5%)</p>
                <p>Delivery fees</p>
              </div>

              <div class="col-sm-4 text-right">
                <?php
                if (!empty($_SESSION['cart'])) :
                ?>
                  <p><?php echo $total; ?> KS</p>
                  <p><?php echo $tax; ?> KS</p>
                  <p><?php echo $deliveryfee; ?> KS</p>
                <?php endif; ?>
              </div>
            </div>

            <hr style="border-color: black;">

            <div class="row">
              <div class="col-sm-8">
                <h5>TOTAL</h5>
              </div>

              <div class="col-sm-4 text-right">
                <?php
                if (!empty($_SESSION['cart'])) :
                ?>
                  <p><?php echo $grandtotal; ?> KS</p>
                <?php endif; ?>
              </div>
            </div>

            <hr style="border-color: black;">

            <p>Need help?<br> Call us at 09-987654321</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>
</body>

</html>