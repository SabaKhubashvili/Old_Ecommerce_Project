

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
        if(isset($_GET['product_id'])){
            $product_id = $_GET['product_id'];
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
            $stmt->bind_param('i',$product_id);
            $stmt->execute();
            $products = $stmt->get_result();
        }
        else if(isset($_POST['product_edit_btn'])){
            $product_id = $_POST['product_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $special_offer = $_POST['special_offer'];
            $stmt = $conn-> prepare('UPDATE products SET product_name=? , product_description=?, 
                                     product_price=?,product_category = ?, product_special_offer=? WHERE product_id=?');
            $stmt->bind_param('sssssi',$title,$description,$price,$category,$special_offer,$product_id);
            if($stmt->execute()){
            header('location:products.php?massage=Product Updated Succesfully');
            }else{
            header('location:products.php?error=Something Wrong Happened');  
            }

        }
        else{
            header('products.php');
            exit();
        }

        
?>

        <section id="edit_product">
            <h1>Edit Product</h1>
            <form action="edit_product.php" method="POST">
                <div class="form-group">
                    <?php foreach($products as $product){ ?>
                        <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
                        <label for="title">Enter Name</label>
                        <input type="text" name="title" value="<?=$product['product_name']?>" required placeholder="Title">
                </div>
                <div class="form-group">
                        <label for="description">Enter Description</label>
                        <input type="text" name="description" value="<?=$product['product_description']?>"  required placeholder="Description">
                </div>
                <div class="form-group">
                        <label for="price">Enter Price</label>
                        <input type="text" name="price" value="<?=$product['product_price']?>"  required placeholder="Price">
                </div>
                <div class="form-group">
                <label for="category">Enter Category</label>
                <select  id="" class="form-select"   required name="category">
                    <option value="jacket" selected>Jacket</option>
                    <option value="pants">Pants</option>
                    <option value="watch">Watches</option>
                    <option value="shoes">Shoes</option>
                </select>
                </div>
                <div class="form-group">
                        <label for="special_offer">Special Offer/Sale</label>
                        <input type="text" name="special_offer" value="<?=$product['product_special_offer']?>"  required placeholder="Sale%">
                </div>
                <div class="form-group">
                        <button type="submit" class="Product_edit_btn" name="product_edit_btn">Submit</button>
                </div>
                <?php } ?>
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