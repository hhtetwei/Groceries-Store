<html>
  <head>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap.css" />
    <script type="text/javascript" src="assets/bootstrap.js"></script>
    <script type="text/javascript" src="assets/jquery-1.10.2.js"></script>
    <script src="https://kit.fontawesome.com/cad1445a8a.js" crossorigin="anonymous"></script>

    <style>
/* .dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
} */

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  width: 100%;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

#order-menu {
  display: block !important ;
}


</style>
  </head>

  <body>
    <nav>
    <div class="list-group">
    
      <a href="products.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <i class='fas fa-dolly-flatbed'></i>&nbsp; Products
      </a>

      <a href="supplier.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <i class='fas fa-user-friends'></i>&nbsp; Suppliers
      </a>

      <a href="categories.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <i class='fas fa-align-justify'></i>&nbsp; Categories
      </a>

      <!-- <a href="orders.php" class="list-group-item list-group-item-action d-flex align-items-center"> -->
      <div class="dropdown">
        <a href="orders.php" id="order-menu" class="list-group-item list-group-item-action align-items-center">
          <span class="d-flex justify-content-between align-items-center">
            <span>
              <i class='fas fa-archive'></i>&nbsp; Orders 
            </span>
    
            <span><i class='fas fa-angle-down'></i></span>
          </span>
        </a>

        <div class="dropdown-content">
          <a href="orders_jan.php">Orders Jan</a>
          <a href="orders_feb.php">Orders Feb</a>
          <a href="orders_march.php">Orders March</a>
          <a href="orders_april.php">Orders April</a>
        </div>
      </div>

      <!-- <div class="dropdown">
       <ul>
         <li>Orders
           <ul>
             <li> April Orders</li>
             <li> jan Orders</li>
         </ul>
         </li>
        
          </ul> -->
      <!-- <div class="dropdown">
      <span><i class='fas fa-archive'></i>&nbsp; Orders </span>
      <div class="dropdown-content">
      <p>April orders</p>
      </div>
     </div>   -->
      </a>

      <a href="users.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <i class='fas fa-user-circle'></i>&nbsp; Users
      </a>

      
    <a href="admins.php" class="list-group-item list-group-item-action d-flex align-items-center">
    <i class='fas fa-user-edit'></i>&nbsp; Admins
      </a>

    </div>
  </nav>
  </body>
</html>