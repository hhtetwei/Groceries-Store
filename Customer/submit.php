<?php
session_start();
include '../connectDb.php';

$user_id = $_SESSION['userId'];
$payment_method = $_POST['payment'];
$total_amount = $_SESSION['total'];

$_SESSION['payment_method'] = $payment_method;

$query1 = "insert into orders(date, user_id, status, total_amount, payment_method) values(now(), '$user_id', 'pending', '$total_amount', '$payment_method')";
mysqli_query($connection, $query1);

$order_id = mysqli_insert_id($connection);

foreach ($_SESSION['cart'] as $id => $qty) {
  $qty = $_SESSION['qty'];

  $result = mysqli_query($connection, "select * from products where product_id='$id'");

  while ($row = mysqli_fetch_array($result)) {
    $price = $row['product_price'];
  }

  $amount = $price * $qty;
  $query = "insert into order_details(order_id, product_id, quantity, amount) values('$order_id','$id','$qty','$amount')";

  mysqli_query($connection, $query);
}
$_SESSION['orderid'] = $order_id;
// unset($_SESSION['cart']);
header("location:success.php");
