<?php 
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Home</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

  <!--NavBar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container-fluid">
      <img src="./assets/imgs/logo.png" alt="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">

        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         
          <li class="nav-item">
            <a class="nav-link"  href="/index.php" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact.php  ">Contact Us</a>
          </li>

          <li class="nav-item">
            <a href="/cart.php"><i class="fa-solid fa-bag-shopping icon">
              
              <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){ ?>
                <span class="cart_quantity"><?=$_SESSION['quantity']?></span>
              <?php } ?>
            </i></a>
           <a href="/accaunt.php"> <i class="fa-solid fa-user icon"></i></a>
          </li>
          
        </ul>
       
      </div>
    </div>
  </nav>
