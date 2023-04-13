

<?php 
        $page = 'products';
        include('layouts/aside.php');
        include('../server/connection.php');
        if(isset($_SESSION['admin_logged-in']) == false ){
            header('location:login.php');
            exit();
          }
?>

<?php 

        
?>

        <section id="edit_product">
            <h1>Add Product</h1>
            <form action="create_product.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                        <label for="product_name">Enter Name</label>
                        <input type="text" name="product_name" value="" required placeholder="Title">
                </div>
                <div class="form-group">
                        <label for="product_description">Enter Description</label>
                        <input type="text" name="product_description" value=""  required placeholder="Description">
                </div>
                <div class="form-group">
                        <label for="product_price">Enter Price</label>
                        <input type="text" name="product_price" value=""  required placeholder="Price">
                </div>
                <div class="form-group">
                <label for="product_category">Enter Category</label>
                <select  id="" class="form-select"   required name="product_category">
                    <option value="jacket" selected>Jacket</option>
                    <option value="pants">Pants</option>
                    <option value="watch">Watches</option>
                    <option value="shoes">Shoes</option>
                </select>
                </div>
                <div class="form-group">
                        <label for="product_special_offer">Special Offer/Sale</label>
                        <input type="text" name="product_special_offer" value=""  required placeholder="Sale%">
                </div>
                <div class="form-group">
                        <label for="product_color">Color</label>
                        <input type="text" name="product_color" value=""  required placeholder="Color">
                </div>
                <div class="form-group">
                        <label for="product_image">Image 1</label>
                        <input type="file" name="product_image_1" value=""  required>
                </div>
                <div class="form-group">
                        <label for="product_image">Image 2</label>
                        <input type="file" name="product_image_2" value=""  required>
                </div>
                <div class="form-group">
                        <label for="product_image">Image 3</label>
                        <input type="file" name="product_image_3" value=""  required>
                </div>
                <div class="form-group">
                        <label for="product_image">Image 4</label>
                        <input type="file" name="product_image_4" value=""  required>
                </div>
                <div class="form-group">
                        <button type="submit" class="product_add_btn" name="product_add_btn">Submit</button>
                </div>

            </form>
        </section>


        <div class="right">
            <div class="top">
                <button id="menu-btn"><i class="fa-solid fa-bars"></i></button>
            
                    <div class="theme-toggler">
                        <i class="fa-regular fa-sun active"></i>
                        <i class="fa-solid fa-moon "></i>
                    </div>
                    <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Name</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/profile-1.jpg" >
                    </div>
                    </div>
            </div>
        </div>
<script src="script.js"></script>