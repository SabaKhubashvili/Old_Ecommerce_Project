<?php 
session_start();

if( !empty($_SESSION['cart'])){
  //Let User In

  
}

else{
  header('location:index.php');
}


?>


<?php include('layouts/header.php')  ?>
  <!--Checkout-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bald">Checkout</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form action="server/place_order.php" method="POST" id="checkout-form">
        <p class="text-center" style="color:red"><?php if(isset($_GET['massage'])){ echo $_GET['massage']; } ?></p>
        <div class="form-group checkout-small-element">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="checkout-name" placeholder="Name" required>
          </div>
        <div class="form-group checkout-small-element">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="checkout-email" placeholder="Email" required>
        </div>
        <div class="form-group checkout-small-element">
          <label for="phone">Phone</label>
          <input type="tel" name="phone" class="form-control" id="checkout-phone" placeholder="Phone" required>
        </div>
        <div class="form-group checkout-small-element">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" id="checkout-city" placeholder="City" required>
          </div>
        <div class="form-group checkout-large-element">
            <label for="adress">Adress</label>
            <input type="text" name="adress" class="form-control" id="checkout-adress" placeholder="Adress" required>
          </div>
        <div class="form-group checkout-btn-container">
          <p>Total Amount:  $<?php  echo $_SESSION['total'] ?></p>
          <input type="submit"  class="btn" id="checkout-btn" name="place_order" value="Place Order">
        </div>
      </form>
    </div>
    
  </section>







   <?php include('layouts/footer.php')  ?>