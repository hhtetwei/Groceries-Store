<?php
session_start();
include('connect.php');
include('function.php');
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <title>Products</title>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

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
          <h4 class="mb-3"><?php echo isset($_GET['action']) ? 'Update product' : 'Create product' ?></h4>

          <?php if (isset($_GET['action']) && $_GET['action'] == 'update') {
            $id = $_GET['product_id'];
            $query = "select * from products where product_id='$id'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($result)) {
              $product = $row;
            }
          }
          ?>

          <form method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" placeholder="Name..." name="product-name" value="<?php echo isset($product) ? $product['product_name'] : '' ?>">
              </div>

              <div class="col">
                <select class="form-select" name="category-id">
                  <?php
                  $query = "select * from categories";
                  $result = mysqli_query($connection, $query);

                  while ($row = mysqli_fetch_array($result)) {
                    $categoryName = $row['cat_name'];
                    $categoryId = $row['cat_id'];

                    if (isset($product) && $categoryId == $product['category_id']) {
                      echo "<option value='{$categoryId}' selected>{$categoryName}</option>";
                    } else {
                      echo "<option value='{$categoryId}'>{$categoryName}</option>";
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="col">
                <input type="number" class="form-control" placeholder="Price..." name="product-price" value="<?php echo $product['product_price'] ?>">
              </div>

              <div class="col">
                <input type="file" class="form-control" name="product-image">
              </div>

              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit-btn">Submit</button>
              </div>

              <?php
              if (isset($_POST['submit-btn'])) {
                if (!empty($_POST['product-name'])) {
                  if (isset($_GET['action']) && $_GET['action'] == 'update') {
                    updateProduct();
                  } else {
                    createProduct();
                  }
                }
              }
              ?>
            </div>
          </form>
        </div>

        <div style="height: 65vh; overflow: auto;">
          <table class="table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "select products.*, categories.* from products, categories where products.category_id = categories.cat_id order by products.product_id desc";
              $result = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_array($result)) {
                $id = $row['product_id'];
                $name = $row['product_name'];
                $price = $row['product_price'];
                $category = $row['cat_name'];
                $image = $row['product_image'];

                echo "<tr>";
                echo "<td>
                  <img src='../images/{$image}' width='100px' height='100px'/>
                </td>";
                echo "<td>{$name}</td>";
                echo "<td>{$category}</td>";
                echo "<td>{$price}</td>";
                echo "<td>
                  <a class='btn btn-warning btn-sm' href='products.php?action=update&product_id={$id}'>Update</a>
                  <a class='btn btn-danger btn-sm' href='products.php?action=delete&product_id={$id}'>Remove</a>
                </td>";
              }

              if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                removeProduct();
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