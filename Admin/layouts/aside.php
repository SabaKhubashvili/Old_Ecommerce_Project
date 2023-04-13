<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="./style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->

</head>
<body>
    <div class="aside_container">
        <!--==============================Aside End ==============================-->
<aside>
            <div class="top">
                <div class="logo">
                    <img src="/assets/imgs/logo.png" alt=""> 
                </div>
            
            <div class="close" id="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <div class="sidebar">
            <a href="./index.php" class="<?php if($page =='dashboard'){ echo 'active'; } ?>"><i class="fa-solid fa-chart-line"></i>
            <h3>Dashboard</h3>
        </a>
            <a href=""><i class="fa-regular fa-user"></i>
            <h3>Customers</h3>
        </a>
            <a href="./orders.php" class="<?php if($page =='orders'){ echo 'active'; } ?>"a><i class="fa-solid fa-newspaper"></i>
            <h3>Orders</h3>
        </a>
            <a href=""><i class="fa-solid fa-chart-simple"></i>
            <h3>Analytics</h3>
        </a>
            <a href=""><i class="fa-regular fa-envelope"></i>
            <h3>Messages</h3>
            <span class="message-count">26</span>
        </a>
            <a href="products.php" class="<?php if($page =='products'){ echo 'active'; } ?>" ><i class="fa-solid fa-boxes-stacked"></i>
            <h3>Products</h3>
        </a>
            <a href=""><i class="fa-solid fa-bug"></i>
            <h3>Reports</h3>
        </a>
            <a href="accaunt.php" class="<?php if($page =='settings'){ echo 'active'; } ?>"><i class="fa-solid fa-gear"></i>
            <h3>Settings</h3>
        </a>
            <a href="add_product.php"><i class="fa-solid fa-plus"></i>
            <h3>Add Product</h3>
        </a>
            <a href="logout.php?logout=1"><i class="fa-solid fa-arrow-right-from-bracket"></i>
            <h3>Logout</h3>
        </a>

        </div>
        </aside>

        <script src="https://kit.fontawesome.com/913ecb1161.js" crossorigin="anonymous"></script>