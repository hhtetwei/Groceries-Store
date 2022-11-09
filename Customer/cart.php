<?php
session_start();
include '../Admin/connect.php';
?>

<html>

<head>
  <title>Cart</title>
  <link rel="stylesheet" type="text/css" href="../Assets/css/bootstrap.css" />
  <script src="../Assets/jquery-3.3.1.js"></script>
  <script src="../Assets/js/bootstrap.js"></script>

  <style>

  </style>
</head>

<body>
  <?php
  include('header.php');
  ?>
  <div class="container-fluid p-4">
    <div class="row">
      <div class="col">
        <div class="card rounded-0">
          <div class="card-body">
            <h5 class="display-4">YOUR CART</h5>
            <?php
            if (!empty($_SESSION['cart'])) :
            ?>

              <table class="table table-hover">
                <thead class="bg-dark text-white">
                  <tr>
                    <td style="width: 45%;">ITEM</td>
                    <td style="width: 10%;">PRICE</td>
                    <td style="width: 15%; text-align: center">QTY</td>
                    <td style="width: 15%;">TOTAL</td>
                    <td style="width: 15%;"></td>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $q = 0;
                  $b = 50;
                  $total = 0;
                  $deliveryfee = 1500;
                  $_SESSION['deliveryfee'] = $deliveryfee;
                  foreach ($_SESSION['cart'] as $id => $qty) :
                    $q += 1;
                    $b += 1;
                    $result = mysqli_query($connection, "SELECT * FROM products WHERE product_id =$id");
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

                      <td>
                        <?php
                        if (isset($_POST[$b])) {
                          $qty = $_POST[$q];
                          $_SESSION['cart'][$id] = $qty;
                        }
                        $_SESSION['qty'] = $qty;
                        $total += $row['product_price'] * $qty;
                        $_SESSION['total'] = $total;
                        $tax = 0.07 * $total;
                        $_SESSION['tax'] = $tax;
                        $grandtotal = $total + $deliveryfee + $tax;
                        $_SESSION['grandtotal'] = $grandtotal;
                        ?>

                        <form method="post">
                          <div class="input-group input-group-sm">
                            <input type="number" min="1" name="<?php echo $q ?>" class="form-control" value="<?php echo $qty ?>">

                            <div class="input-group-append">
                              <button class="btn btn-dark btn-sm" type="submit" name="<?php echo $b; ?>">OK</button>
                            </div>
                          </div>
                        </form>
                      </td>

                      <td><?php echo $row['product_price'] * $qty ?></td>

                      <td class="text-center">
                        <a href="remove.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm rounded-0">Remove</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <a href="index.php" class="btn btn-warning rounded-0 text-white">CONTINUE SHOPPING</a>
              <a href="clear.php" class="btn btn-danger rounded-0 text-white">CLEAR CART</a>

            <?php else : ?>

              <h5 class="text-danger text-center my-5">It is empty!</h5><br>
              <p class="text-center mt-5 mb-0"><a href="index.php" class="btn btn-warning rounded-0 text-white">CLICK TO ORDER</a></p>

            <?php endif; ?>

          </div>
        </div>
      </div>

      <div class="col-3">
        <div class="card rounded-0">
          <div class="card-body">
            <h5 class="display-4">SUMMARY</h5>
            <hr style="border-color: black;">
            <div class="row">
              <div class="col-sm-8">
                <p>Subtotal</p>
                <p>Tax(7%)</p>
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
            <?php
            if (empty($_SESSION['cart'])) :
            ?>
              <a href="checkout.php dis" class="btn btn-dark rounded-0 w-100 disabled">CHECKOUT</a>
            <?php else : ?>
              <a href="checkout.php" class="btn btn-dark rounded-0 w-100">CHECKOUT</a>
            <?php endif; ?>
            <br>
            <br>
            <p>Need help?<br> Call us at + 95 9 786543201</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('footer.php');
  ?>
</body>

</html>