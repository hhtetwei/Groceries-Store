<?php
session_start();
include('connect.php');
include('function.php');
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <title>Categories</title>

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
          <h4 class="mb-3"><?php echo isset($_GET['action']) ? 'Update category' : 'Create category' ?></h4>

          <?php if (isset($_GET['action']) && $_GET['action'] == 'update') {
            $id = $_GET['cat_id'];
            $query = "select * from categories where cat_id='$id'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($result)) {
              $category = $row;
            }
          }
          ?>

          <form method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-3">
                <input type="text" class="form-control" placeholder="Name..." name="cat-name" value="<?php echo isset($category) ? $category['cat_name'] : '' ?>">
              </div>

              <div class="col-3">
                <input type="file" class="form-control" name="cat-image">
              </div>

              <div class="col">
                <button name="submit-btn" type="submit" class="btn btn-primary">Submit</button>
              </div>

              <?php
              if (isset($_POST['submit-btn'])) {
                if (!empty($_POST['cat-name'])) {
                  if (isset($_GET['action']) && $_GET['action'] == 'update') {
                    updateCategory();
                  } else {
                    createCategory();
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
                <th></th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "select * from categories";
              $result = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_array($result)) {
                $id = $row['cat_id'];
                $name = $row['cat_name'];
                $image = $row['cat_image'];

                echo "<tr>";
                echo "<td>
                  <img src='../images/{$image}' width='100px' height='100px'/>
                </td>";
                echo "<td>{$name}</td>";
                echo "<td>
                  <a class='btn btn-warning btn-sm' href='categories.php?action=update&cat_id={$id}'>Update</a>
                  <a class='btn btn-danger btn-sm' href='categories.php?action=delete&cat_id={$id}'>Remove</a>
                </td>";
              }

              if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                removeCategory();
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