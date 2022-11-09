<?php
session_start();
include '../Admin/connect.php';
?>

<html>

<head>
  <title>Bon Appetit</title>
  <link rel="stylesheet" type="text/css" href="../Assets/css/bootstrap.css" />
  <script src="../Assets/js/bootstrap.js"></script>
  <style>
    html,
    body {
      padding: 0 !important;
      margin: 0;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      margin: 0 !important;
    }

    .category {
      position: relative;
      height: 100px;
      margin: .5rem;
    }

    .center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 18px;
      font-weight: bold;
      color: white;
      text-shadow: 4px 4px 8px gray;
    }

    .image {
      width: 100%;
      height: 100px;
      opacity: 0.7;
      border-radius: 8px;
      object-fit: cover;
    }

    .carousel-item img {
      object-fit: cover;
    }

    .slides {
      position: relative;
    }

    .list-group-item {
      border: 1px solid rgba(0, 0, 0, 0.125) !important;
    }

    h3 {
      font-weight: lighter !important;
      font-size: 2rem !important;
    }

    .banner-text {
      z-index: 100;
      font-size: 3rem !important;
      font-weight: 400 !important;
      text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.8) !important;
    }
  </style>
</head>

<body>
  <?php
  include('header.php');
  ?>

  <section class="slides">
    <h3 class="center banner-text">The grocery store you need</h3>

    <div id="demo" class="carousel" data-bs-ride="carousel">

      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../Images/slide1.jpg" alt="Los Angeles" class="d-block w-100 h-75">
        </div>

        <div class="carousel-item">
          <img src="../Images/slide2.jpg" alt="Chicago" class="d-block w-100 h-75">
        </div>

        <div class="carousel-item">
          <img src="../Images/slide3.jpg" alt="New York" class="d-block w-100 h-75">
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section>

  <section class="categories mb-5 mt-3">
    <h3 class="text-center mb-5">Categories</h3>

    <div class="row">
      <?php
      $query = "select * from categories";
      $result = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_array($result)) {
        $id = $row['cat_id'];
        $name = $row['cat_name'];
        $image = $row['cat_image'];

        echo "<div class='col-3'>";
        echo "<div class='category'>";
        echo "<img class='image' src='../Images/{$image}'>";
        echo "<div class='center'>{$name}</div>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
  </section>

  <section class="best-selling mb-4 p-4" style="background-color: whitesmoke;">
    <h3 class="text-center mb-5">Our besting selling items</h3>

    <div class="row text-center">
      <?php
      $query = "select * from products order by rand() limit 5";
      $result = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_array($result)) {
        $id = $row['product_id'];
        $name = $row['product_name'];
        $image = $row['product_image'];
        $price = $row['product_price'];

        echo "<div class='col'>";
        echo "<div class='card mb-4' style='height: 370px;'>";
        echo "<img class='card-img-top' style='object-fit: fill;' src='../Images/{$image}' width='200px' height='200px'>";
        echo "<div class='card-body'>";
        echo "<p class='card-title' style='font-weight: bold;'>{$name}</p>";
        echo "<p class='card-text'>{$price} KS</p>";
        echo "<a href='addtocart.php?id={$id}' class='btn btn-primary'>Add to cart</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
  </section>

  <section class="products mb-4">
    <h3 class="text-center mb-5">Browse our products</h3>

    <div class="row">
      <div class="col-3">
        <nav>
          <div class="list-group" role="tablist">
            <?php
            $query = "select * from categories";
            $categories = mysqli_query($connection, $query);

            while ($cat = mysqli_fetch_array($categories)) {
              $name = $cat['cat_name'];

              echo "<a href='#{$name}' class='list-group-item list-group-item-action' role='tab' data-toggle='tab'>";
              echo "{$name}";
              echo "</a>";
            }
            ?>

            <a href='#all' class='list-group-item list-group-item-action active' role='tab' data-toggle='tab'>Show all items</a>
          </div>
        </nav>
      </div>

      <div class="col">
        <div class="tab-content" id="nav-tabContent">
          <?php
          $query = "select * from categories";
          $category = mysqli_query($connection, $query);

          while ($cat = mysqli_fetch_array($category)) {
            $catId = $cat['cat_id'];
            $catName = $cat['cat_name'];

            $products = mysqli_query($connection, "select * from products where category_id=" . $catId);

            echo "<div class='tab-pane' id='{$catName}'>";
            echo "<div class='row text-center'>";

            while ($prod = mysqli_fetch_array($products)) {
              $id = $prod['product_id'];
              $name = $prod['product_name'];
              $image = $prod['product_image'];
              $price = $prod['product_price'];

              echo "<div class='col-3'>";
              echo "<div class='card mb-4' style='width:220px; height: 370px;'>";
              echo "<img class='card-img-top' style='object-fit: fill;' src='../Images/{$image}' width='200px' height='200px'>";
              echo "<div class='card-body'>";
              echo "<p class='card-title' style='font-weight: bold;'>{$name}</p>";
              echo "<p class='card-text'>{$price} KS</p>";
              echo "<a href='addtocart.php?id={$id}' class='btn btn-primary'>Add to cart</a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }

            echo "</div>";
            echo "</div>";
          }
          ?>

          <div class="tab-pane active" id="all">
            <div class="row text-center">
              <?php
              $products = mysqli_query($connection, "select * from products");

              while ($prod = mysqli_fetch_array($products)) {
                $id = $prod['product_id'];
                $name = $prod['product_name'];
                $image = $prod['product_image'];
                $price = $prod['product_price'];

                echo "<div class='col-3'>";
                echo "<div class='card mb-4' style='width:220px; height: 370px;'>";
                echo "<img class='card-img-top' style='object-fit: fill;' src='../Images/{$image}' width='200px' height='200px'>";
                echo "<div class='card-body'>";
                echo "<p class='card-title' style='font-weight: bold;'>{$name}</p>";
                echo "<p class='card-text'>{$price} KS</p>";
                echo "<a href='addtocart.php?id={$id}' class='btn btn-primary'>Add to cart</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('footer.php');
  ?>
</body>

</html>