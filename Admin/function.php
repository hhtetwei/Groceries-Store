<?php

function createAdmin()
{
  global $connection;
  $user_name = $_POST['admin-name'];
  $password = $_POST['admin-password'];
  $email = $_POST['admin-email'];

  $hpass = md5($password);
  $query = "select * from admin where adminname='$user_name' and password='$hpass'";
  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);

  if ($count > 0) {
    echo "<script>window.alert('Admin already exists')</script>";
  } else {
    $query = "insert into admin(adminname,password,email)values('$user_name','$hpass','$email')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("QUERY FAILED" . mysqli_error($connection));
    } else {
      echo "<script>window.alert('Admin created')</script>";
    }
  }
}

// function createstaff()
// {
//   global $connection;
//   global $user_name;

//   global $phone;


//   $query = "select * from staff where staffname='$user_name'";
//   $user_query = mysqli_query($connection, $query);
//   $count = mysqli_num_rows($user_query);
//   if ($count > 0) {
//     echo "<script>window.alert('Already Existed')</script>";
//   } else {
//     $query = "insert into staff(staffname,phone)values('$user_name','$phone')";
//     $go_query = mysqli_query($connection, $query);
//     if (!$go_query) {
//       die("QUERY FAILED" . mysqli_error($connection));
//     } else {
//       echo "<script>window.alert('you successfully created an account')</script>";
//       header("location:dashboard.php");
//     }
//   }
// }

function insert_category()
{
  global $connection;
  $cat_name = $_POST['cat_name'];
  if ($cat_name == "") {
    echo "<script>window.alert('enter name')</script>";
  } elseif ($cat_name != "") {
    $query = "select * from category where catname='$cat_name'";
    $ch_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($ch_query);
    if ($count > 0) {
      echo "<script>window.alert('already exists')</script>";
    } else {
      $query = "insert into category(catname)values('$cat_name')";
      $go_query = mysqli_query($connection, $query);
      if (!$go_query) {
        die("QUERY FAILED" . mysqli_error($connection));
      } else {
        echo "<script>window.alert('successfully inserted')</script>";
      }
    }
  }
}

function update_category()
{
  global $connection;
  $cat_name = $_POST['cat_name'];
  $cat_id = $_GET['c_id'];
  $query = "update category set catname='$cat_name' where catid='$cat_id'";
  $go_query = mysqli_query($connection, $query);
  if (!$go_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
  header("location:shop.php");
}

function del_category()
{
  global $connection;
  $c_id = $_GET['c_id'];
  $query = "delete from category where catid='$c_id'";
  $go_query = mysqli_query($connection, $query);
  header("location:shop.php");
}

function add_dish()
{
  global $connection;
  $product_name = $_POST['product_name'];
  $cat_id = $_POST['category_id'];
  $price = $_POST['price'];
  $photo = $_FILES['photo']['name'];
  if (is_numeric($price) == false) {
    echo "<script>window.alert('Price must be numeric value')</script>";
  } elseif ($photo == "") {
    echo "<script>window.alert('Choose the photo you want to submit')</script>";
  } elseif ($product_name != "" && $photo != "") {
    $query = "select * from dish where dishname='$product_name'";
    $ch_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($ch_query);
    if ($count > 0) {
      echo "<script>window.alert('This dish already exists')</script>";
    } else {
      $query = "insert into dish(dishname,catid,price,photo) values ('$product_name','$cat_id','$price','$photo')";
      $go_query = mysqli_query($connection, $query);
      if (!$go_query) {
        die("QUERY FAILED" . mysqli_error($connection));
      } else {
        echo "<script language=\"javascript\">window.alert('Successfully submitted')</script>";
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $photo);
        header("location:dishlist.php");
      }
    }
  }
}

function del_dish()
{
  global $connection;
  $dish_id = $_GET['p_id'];
  $query = "delete from dish where dishid='$dish_id'";
  $go_query = mysqli_query($connection, $query);
  header("location:dishlist.php");
}


function update_dish()
{
  global $connection;
  $product_id = $_GET['p_id'];
  $product_name = $_POST['product_name'];
  $cat_id = $_POST['category_id'];
  $price = $_POST['price'];
  $photo = $_FILES['photo']['name'];
  if (!$photo) {
    $query = "update dish set dishname='$product_name',catid='$cat_id',price='$price' where dishid='$product_id'";
  } else {
    $query = "update dish set dishname='$product_name',catid='$cat_id',price='$price',photo='$photo' where dishid='$product_id'";
  }
  $go_query = mysqli_query($connection, $query);
  if (!$go_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    move_uploaded_file($_FILES['photo']['tmp_name'], '../photo/' . $photo);
  }
  header("location:dishlist.php");
}

function createProduct()
{
  global $connection;

  $name = $_POST['product-name'];
  $cat_id = $_POST['category-id'];
  $price = $_POST['product-price'];
  $image = $_FILES['product-image']['name'];

  if ($name == "") {
    echo "<script>window.alert('Name cannot be empty')</script>";
  } elseif ($price == "") {
    echo "<script>window.alert('Price cannot be empty')</script>";
  } elseif ($image == "") {
    echo "<script>window.alert('Image cannot be empty')</script>";
  } else {
    $query = "select * from products where product_name='$name'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
      echo "<script>window.alert('Product already exists')</script>";
    } else {
      $query = "insert into products(product_name, category_id, product_price, product_image) values ('$name','$cat_id','$price','$image')";
      $go_query = mysqli_query($connection, $query);

      if (!$go_query) {
        die("QUERY FAILED" . mysqli_error($connection));
      } else {
        echo "<script>window.alert('Product created')</script>";
        move_uploaded_file($_FILES['product-image']['tmp_name'], '../images/' . $image);
      }
    }
  }
}

function updateProduct()
{
  global $connection;

  $id = $_GET['product_id'];
  $name = $_POST['product-name'];
  $cat_id = $_POST['category-id'];
  $price = $_POST['product-price'];
  $image = $_FILES['product-image']['name'];

  if (!$image) {
    $query = "update products set product_name = '$name', category_id = '$cat_id', product_price = '$price' where product_id = '$id'";
  } else {
    $query = "update products set product_name = '$name', category_id = '$cat_id', product_price = '$price', product_image = '$image' where product_id = '$id'";
  }

  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    move_uploaded_file($_FILES['product-image']['tmp_name'], '../images/' . $image);
    echo ("<script>location.href = 'products.php';</script>");
  }
}

function removeProduct()
{
  global $connection;

  $id = $_GET['product_id'];
  $query = "delete from products where product_id='$id'";

  mysqli_query($connection, $query);
  echo ("<script>location.href = 'products.php';</script>");
}

function createCategory()
{
  global $connection;

  $name = $_POST['cat-name'];
  $image = $_FILES['cat-image']['name'];

  if ($name == "") {
    echo "<script>window.alert('Name cannot be empty')</script>";
  } elseif ($image == "") {
    echo "<script>window.alert('Image cannot be empty')</script>";
  } else {
    $query = "select * from categories where cat_name='$name'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
      echo "<script>window.alert('Category already exists')</script>";
    } else {
      $query = "insert into categories(cat_name, cat_image) values ('$name', '$image')";
      $result = mysqli_query($connection, $query);

      if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
      } else {
        echo "<script>window.alert('Category created')</script>";
        move_uploaded_file($_FILES['cat-image']['tmp_name'], '../images/' . $image);
      }
    }
  }
}

function updateCategory()
{
  global $connection;

  $id = $_GET['cat_id'];
  $name = $_POST['cat-name'];
  $image = $_FILES['cat-image']['name'];

  if (!$image) {
    $query = "update categories set cat_name = '$name' where cat_id = '$id'";
  } else {
    $query = "update categories set cat_name = '$name', cat_image = '$image' where cat_id = '$id'";
  }

  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    move_uploaded_file($_FILES['cat-image']['tmp_name'], '../images/' . $image);
    echo ("<script>location.href = 'categories.php';</script>");
  }
}

function removeCategory()
{
  global $connection;

  $id = $_GET['cat_id'];
  $query = "delete from categories where cat_id='$id'";

  mysqli_query($connection, $query);
  echo ("<script>location.href = 'categories.php';</script>");
}

function completeOrder()
{
  global $connection;

  $id = $_GET['order_id'];

  $query = "update orders set status = 'completed' where order_id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    echo ("<script>location.href = 'orders.php';</script>");
  }
}
function completeOrderJan()
{
  global $connection;

  $id = $_GET['order_id'];

  $query = "update orders set status = 'completed' where order_id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    echo ("<script>location.href = 'orders_jan.php';</script>");
  }
}
function completeOrderFeb()
{
  global $connection;

  $id = $_GET['order_id'];

  $query = "update orders set status = 'completed' where order_id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    echo ("<script>location.href = 'orders_feb.php';</script>");
  }
}
function completeOrderMarch()
{
  global $connection;

  $id = $_GET['order_id'];

  $query = "update orders set status = 'completed' where order_id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    echo ("<script>location.href = 'orders_march.php';</script>");
  }
}


function completeOrderApril()
{
  global $connection;

  $id = $_GET['order_id'];

  $query = "update orders set status = 'completed' where order_id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  } else {
    echo ("<script>location.href = 'orders_april.php';</script>");
  }
}


function removeAdmin()
{
  global $connection;

  $id = $_GET['admin_id'];
  $query = "delete from admin where adminid='$id'";

  mysqli_query($connection, $query);
  echo ("<script>location.href = 'admins.php';</script>");
}

function createSupplier()
{
  global $connection;
  $supplier_name = $_POST['supplier_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];


  $query = "select * from supplier where supplier_name='$supplier_name'";
  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);

  if ($count > 0) {
    echo "<script>window.alert('Supplier already exists')</script>";
  } else {
    $query = "insert into supplier(supplier_name,email,phone,address)values('$supplier_name','$email','$phone','$address')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("QUERY FAILED" . mysqli_error($connection));
    } else {
      echo "<script>window.alert('Supplier created')</script>";
    }
  }
}
function removeSupplier()
{
  global $connection;

  $id = $_GET['supplier_id'];
  $query = "delete from supplier where supplier_id='$id'";

  mysqli_query($connection, $query);
  echo ("<script>location.href = 'supplier.php';</script>");
}