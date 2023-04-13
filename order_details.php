<?php 



include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST   ['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status=$_POST['order_status'];

    $stmt =  $conn->prepare('SELECT * FROM order_items WHERE order_id = ?');

    $stmt->bind_param('i',$order_id);

    $stmt->execute();
    $order_details = $stmt->get_result();

    $order_total_price   = calculateTotalOrderPrice($order_details);
}
else{
    header('location:accaunt.php');
    exit;
}

function calculateTotalOrderPrice($order_details){  //!CALC ORDER DETAILS TOTAL
    $total = 0;

    foreach($order_details as $row){ 
        $product_price =   $row['product_price'] ;
        $product_quantity =  $row['product_quantity'] ;
        $total = $total + ($product_price * $product_quantity);
    }   
    return $total;
}

?>
 <?php include('layouts/header.php')  ?>

  <!--Orders Details-->
  <section id="orders" class="orders mx-5 my-5 py-5">
    <div class="mt-5">
        <h2 class="font-weight-bolde text-center">Order details</h2>
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Product</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
        </tr>
        <?php foreach($order_details as $row){ ?>
        <tr>

            <td>
                <div class="product-info">
                <img src="/assets/imgs/products/<?php echo $row['product_image'];  ?>" alt="">                
                <div>
                    <p class="mt-3"><?php echo $row['product_name'];  ?></p>
                </div>
            </div>
            </td>


            <td>
           
              <span>$<?php echo $row['product_price'];  ?></span>
           
            </td>

            <td>
            
               <span><?php echo $row['product_quantity'];  ?></span>
            
            </td>


            
        </tr>
        <?php } ?>

      
    </table>
    <?php
    if($order_status == 'Not paid'){?>
     <form action="/payment.php" style="float:right;" method="POST">
        <input type="hidden" name="order_id" value="<?=$order_id?>">
        <input type="hidden" name="order_total_price"  value="<?=$order_total_price; ?>" >
        <input type="hidden" name="order_status"  value="<?=$order_status; ?>" >
        <input  type="hidden" value="1"  name="order_pay_btn" >
        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>

    <?php }  ?>

</section>




<?php include('layouts/footer.php')  ?>