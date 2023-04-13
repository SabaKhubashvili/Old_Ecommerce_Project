<?php
include('layouts/header.php');
    
if(isset($_POST['add_to_cart'])){
    
    //if  user already has added a product to cart
  if(isset($_SESSION['cart'])){
    //if product is already in cart or not
    $products_array_ids = array_column($_SESSION['cart'],"product_id");

    //if product isn't in cart
    if( !in_array($_POST['product_id'],  $products_array_ids) ){ 

       $product_id = $_POST['product_id'];

       $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' =>$_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' =>$_POST['product_quantity']
                );
                $_SESSION['cart'][$product_id] = $product_array;
    }
    //Product already is in cart
    else{
  echo '<script>alert("Product Is Already In Cart");</script>';
}
//if cart is not empty

} 


else{
  $product_id=$_POST['product_id'];
  $product_name=$_POST['product_name'];
  $product_price=$_POST['product_price'];
  $product_image=$_POST['product_image'];
  $product_quantity=$_POST['product_quantity'];

  $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity 
  );
  $_SESSION['cart'][$product_id] = $product_array;
}

//Update calculate total
    calculatetotalcart();

//remove product
}else if(isset($_POST['remove_product'])){
    $product_id= $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculatetotalcart(); //Calculate Total
}
else if(isset($_POST['edit_quantity'])){
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity']; //New Product Quantity
    $product_array = $_SESSION['cart'][$product_id];
    $product_array['product_quantity'] = $product_quantity; // OLD PRODUCT CUANTITY TO NEW
    $_SESSION['cart'][$product_id] = $product_array;
    calculatetotalcart(); //Calculate Total
}

else{
// header('location:index.php');  
}

function calculatetotalcart(){
    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price']; 
        $quantity = $product['product_quantity'];
        $total_price = $total_price + ($price * $quantity); 
        $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}

?>



    <!--Cart-->

    <section class="cart mx-5 my-5 py-5">
        <div class="mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php  foreach($_SESSION['cart'] as $key => $value) {  ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="/assets/imgs/products/<?php echo  $value['product_image'] ?>" alt="">
                        <div>
                            <p><?php echo  $value['product_name']  ?></p>
                            <small><span>$</span><?php echo  $value['product_price']  ?></small><br>

                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                            </form>

                        </div>
                    </div>
                </td>
                <td>
                  
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                        <input type="number" name="product_quantity"  min="1" max="20" value="<?php echo  $value['product_quantity'];  ?>" >
                        <input type="submit" class="edit-btn" name="edit_quantity" value="Edit" />
                    </form>
                </td>
                <td>
                    <span>$</span>
                    <span class="product-price"><?php echo  $value['product_quantity'] * $value['product_price'];  ?></span>
                </td>
            </tr>
            <?php }  ?>
         
        </table>

        <div class="cart-total my-5">
            <table>
                <!-- <tr>
                    <td>Subtotal</td>
                    <td>$155</td>
                </tr> -->
                <tr>
                    <td>Total</td>
                    <td>$<?php echo $_SESSION['total'];  ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form action="checkout.php" method="POST">
            <input type="submit" name="checkout" class="btn checkout-btn" value="Check out" />
        </form>
        </div>
    </section>

    <?php include('layouts/footer.php')  ?>