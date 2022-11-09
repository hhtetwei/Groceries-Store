<?php
session_start();
if (empty($_SESSION['user'])) {
  echo "<script>window.alert('Please login first or register')</script>";
  echo "<script>window.location.href='index.php'</script>";
} else {
  $id = $_GET['id'];
  $_SESSION['cart'][$id]++; //adding items into cart doesn't work without this, it increases qty
  header("location:cart.php");
}
