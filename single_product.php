<?php
include('server/connection.php');

if(isset($_GET['product_id'])){
   $produt_id = $_GET['product_id'];
   $stmt = $conn->prepare('SELECT * FROM products WHERE product_id=?');
   $stmt->bind_param("i",$produt_id);
   $stmt->execute();

   $product = $stmt->get_result();

//no product id was given
}
else{
  header('location:index.php');
}

?>


<?php include('layouts/header.php')?>

    <section class="single-product my-5 mx-4 pt-5">
        <div class="row mt-5">
            <?php while($row=$product->fetch_assoc()){ ?>

            <div class="col-lg-5 col-md-6 col-md-12">
                <img src="/assets/imgs/products/<?php echo $row['product_image'] ?>" class="img-fluid w-100 pb-1"
                    id="mainImg" alt="">
                <div class="small-image-group">
                    <div class="small-image-col">
                        <img src="/assets/imgs/products/<?php echo $row['product_image'] ?>" class="small-img"
                            width="100%" alt="">
                    </div>
                    <div class="small-image-col">
                        <img src="/assets/imgs/products/<?php echo $row['product_image2'] ?>" class="small-img"
                            width="100%" alt="">
                    </div>
                    <div class="small-image-col">
                        <img src="/assets/imgs/products/<?php echo $row['product_image3'] ?>" class="small-img"
                            width="100%" alt="">
                    </div>
                    <div class="small-image-col">
                        <img src="/assets/imgs/products/<?php echo $row['product_image4'] ?>" class="small-img"
                            width="100%" alt="">
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-12 col-md-sm12 description">
                <h6>Men/Shoes/</h6>
                <h3 class="py-4"><?php echo $row['product_name'] ?></h3>
                <h2>$<?php echo $row['product_price'] ?></h2>
                <form action="cart.php" method="POST">
                      <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                      <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>">
                      <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
                      <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">
                      <input type="number" max="10" min="1" value="1" name="product_quantity" id="">
                      <button class="buy-button" type="submit" name="add_to_cart">Add to cart</button>
                </form>
                    
                    <h4 class="my-5">Product Details</h4>
                    <span><?php echo $row['product_description'] ?></span>
            </div>
         
            <?php } ?>
        </div>
    </section>



    <section id="related-products" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr class="mx-auto">
            <p>Here You can check our amazing clothes</p>
        </div>

        <div class="p-row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="/assets/imgs/products/f1.jpg" class="img-fluid mb-3" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="/assets/imgs/products/f2.jpg" class="img-fluid mb-3" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="/assets/imgs/products/f3.jpg" class="img-fluid mb-3" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="/assets/imgs/products/f4.jpg" class="img-fluid mb-3" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>

    
    <?php include('layouts/footer.php')  ?>
    