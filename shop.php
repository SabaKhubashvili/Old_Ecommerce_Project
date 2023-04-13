<?php
include('server/connection.php');
if(isset($_POST['search'])){ 
  //!USE SEARCH
  $category = $_POST['category'];
  $price = $_POST['price'];

  if($_POST['category'] == 'all'){
    $stmt = $conn->prepare('SELECT * FROM products WHERE  product_price<=? ');
    $stmt->bind_param('i',$price);
    $stmt->execute();
    $shop_products = $stmt->get_result();
  }
  else{
    $stmt = $conn->prepare('SELECT * FROM products WHERE product_category=? AND  product_price<=? ');
    $stmt->bind_param('si',$category,$price);
    $stmt->execute();
    $shop_products = $stmt->get_result();
  }

  



}else{
  include('server/get_shop_products.php'); //!RETURN ALL PRODUCTS
}


 ?>

<?php include('layouts/header.php')  ?>

<style>
.product img {
    width: 100%;
    height: auto;
    box-sizing: border-box;
    object-fit: cover;

}

.pagination {
    margin-left: 60px;
}

.pagination a {
    color: coral;
    padding: 15px;
}

.pagination li:hover a {
    color: white;
    background-color: coral;
}
</style>
<div class="conn">
    <section id="search" class="my-5 py-5 ms-2 ">
        <div class="container mt-5 py-5 text-center">
            <p style="font-size: 1.5rem; font-weight: 500;;">Search Products</p>
            <hr class="mx-auto">
        </div>
        <form action="shop.php" method="POST" oninput="val.value=parseInt(CustomRange2.value)">
            <div class="row mx-auto container my-4">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Category</p>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="all"  name="category" checked id="category_one" <?php if(isset($category) && $category =='all'){ echo 'checked'; } ?> >
                        <label class="form-check-label" for="flexRadioDefault1">All</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="shoes" name="category" id="category_two" <?php if(isset($category) && $category =='shoes'){ echo 'checked'; } ?> >
                        <label class="form-check-label" for="flexRadioDefault2">Shoes</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="jacket" name="category" id="category_two" <?php if(isset($category) && $category =='jacket'){ echo 'checked'; } ?> >
                        <label class="form-check-label" for="flexRadioDefault2">Jackets</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="watch" name="category" id="category_two" <?php if(isset($category) && $category =='watch'){ echo 'checked'; } ?> >
                        <label class="form-check-label" for="flexRadioDefault2">Watches</label>
                    </div>
                </div>
            </div>

            <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Enter price:</p>
                    <input type="range" class="form_range w-50" name="price" value="<?php if(isset($price)){ echo $price; } else{ echo '100'; } ?>" min="1" max="1000"
                        id="CustomRange2">
                        <output name="val" for="price"> 0</output>
                        <div class="w-50">
                        <label for="price" style="float:left">1</label>
                        <label for="price" style="float:right">1000</label>
                        </div>
                    
                </div>
            </div>
            <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
        </form>

    </section>

    <section id="shop" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Products</h3>
            <hr class="mx-auto">
            <p>Here You can check our amazing clothes</p>
        </div>
        <div class="p-row mx-auto container-fluid">
            <?php if($shop_products->num_rows <= 0) { ?>
                <img src="./assets/imgs/error/product_not_found.png" class="mx-auto" alt="">
            <?php }
          
          while($row=$shop_products->fetch_assoc()){ 
             ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="/assets/imgs/products/<?php echo $row['product_image']; ?>" class="img-fluid mb-3" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?=$row['product_name'] ?></h5>
                <h4 class="p-price">$<?=$row['product_price'] ?></h4>
                <a href="<?php  echo "single_product.php?product_id=".$row['product_id'];  ?>"><button
                        class="buy-btn">Buy Now</button></a>
            </div>
            <?php  } ?>

            <!-- <nav aria-label="Page navigation example" class="mx-auto">
              <ul class="pagination">
                <li class="page-item"><a href="#" class="page-link">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
              </ul>
            </nav>
             -->
        </div>
    </section>
</div>

<?php include('layouts/footer.php')  ?>