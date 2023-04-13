   <?php include('layouts/header.php')  ?>


  <!--Home-->
  <section id="home">
    <div class="">
      <h5>NEW ARRIVALS</h5>
      <h1><span>Best Prices</span> This Season</h1>
      <p>Eshop offers the best products for the most affordable prices</p>
      <button>Shop Now</button>
    </div>

  </section>
  
  <section id="feature" class="section-p1"> <!--FEATURES-->
    <div class="fe-box">
      <img src="/assets/imgs/features/f1.png" alt="">
      <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
     <img src="/assets/imgs/features/f2.png" alt="">
     <h6>Online Order</h6>
   </div>
   <div class="fe-box">
     <img src="/assets/imgs/features/f3.png" alt="">
     <h6>Save Money</h6>
   </div>
   <div class="fe-box">
     <img src="/assets/imgs/features/f4.png" alt="">
     <h6>Promotions</h6>
   </div>
   <div class="fe-box">
     <img src="/assets/imgs/features/f5.png" alt="">
     <h6>Happy Sell</h6>
   </div>
   <div class="fe-box">
     <img src="/assets/imgs/features/f6.png" alt="">
     <h6>F24/7 Support</h6>
   </div>
   </section>

   <!--New-->
   <section id="new" class="w-100">
    <div class="row p-0 m-0">
       <!--One-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="/assets/imgs/products/f1.jpg" alt="">
        <div class="details">
          <h2>Extremealy Awesome Shoes</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
       <!--Two-->
       <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="/assets/imgs/products/f2.jpg" alt="">
        <div class="details">
          <h2>Extremealy Awesome Jacket</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
      <!--Three-->
       <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="/assets/imgs/products/f3.jpg" alt="">
        <div class="details">
          <h2>Extremealy Awesome Jacket</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>

    </div>

   </section>

   <!--FEATURED-->
   <section id="featured" class="my-5 pb-5" >
    <div class="container text-center mt-5 py-5">
      <h3>Our Featured Products</h3>
      <hr class="mx-auto">
      <p>Here You can check our featured products</p>
    </div>

    <div class="p-row mx-auto container-fluid">

    <?php include('server/get_featured_products.php') ?>  

    <?php while($row = $featured_products->fetch_assoc() ){ ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="/assets/imgs/products/<?php echo $row['product_image'] ?>" class="img-fluid mb-3" alt="">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
      <h4 class="p-price">$<?php echo $row['product_price'] ?></h4>
      <a href="<?php  echo "single_product.php?product_id=". $row['product_id'];  ?>"><button class="buy-btn">Buy Now</button></a>
    </div>
    <?php } ?>
    </div>
   </section>

   <!--Banner-->

   <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>MID SEASON'S SALE</h4>
      <h1>Autumn Colection <br>Up to 30% OFF!</h1>
      <button class="text-uppercase">Shop Now</button>
    </div>
   
   </section>

   <!--Clothes-->
   <section id="featured" class="my-5" >
    <div class="container text-center mt-5 py-5">
      <h3>Jackets</h3>
      <hr class="mx-auto">
      <p>Here You can check our amazing clothes</p>
    </div>

    <div class="p-row mx-auto container-fluid">
    <?php include('server/get_jackets.php') ?>

    <?php while($row=$jacket_products->fetch_assoc()){ ?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="/assets/imgs/products/<?php echo $row['product_image']; ?>" class="img-fluid mb-3" alt="">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price">$<?php  echo $row['product_price']; ?></h4>
      <a href="<?php  echo "single_product.php?product_id=". $row['product_id'];  ?>"><button class="buy-btn">Buy Now</button></a>
    </div>
    <?php } ?>
    </div>
   </section>

   <!--Shoes-->
   <section id="shoes" class="my-5" >
    <div class="container text-center mt-5 py-5">
      <h3>Shoes</h3>
      <hr class="mx-auto">
      <p>Here You can check our amazing Shoes</p>
    </div>

    <div class="p-row mx-auto container-fluid">
    <?php include('server/get_shoes.php') ?>
      <?php while($row=$shoe_products->fetch_assoc()){ ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="/assets/imgs/products/<?php echo $row['product_image'] ?>" class="img-fluid mb-3" alt="">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php  echo $row['product_name'] ?></h5>
      <h4 class="p-price">$<?php echo $row['product_price']?></h4>
       <a href="<?php echo 'single_product.php?product_id='. $row["product_id"]  ?>"><button class="buy-btn">Buy Now</button></a>  
    </div>
    <?php } ?>
    </div>
   </section>

  <!--Watches-->
   <section id="watches" class="my-5" >
    <div class="container text-center mt-5 py-5">
      <h3>Best Watches</h3>
      <hr class="mx-auto">
      <p>Here You can check our amazing watches</p>
    </div>

    <div class="p-row mx-auto container-fluid">
    <?php include('server/get_watches.php')  ?>
    <?php while($row=$watch_products->fetch_assoc()){ ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="/assets/imgs/products/<?php echo $row['product_image'] ?>" class="img-fluid mb-3" alt="">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
      <h4 class="p-price">$<?php echo $row['product_price']  ?></h4>
     <a href="<?php echo'single_product.php?product_id='.$row['product_id'] ?>"> <button class="buy-btn">Buy Now</button> </a>
    </div>
   <?php } ?>
    </div>
   </section>

   <?php include('layouts/footer.php')  ?>