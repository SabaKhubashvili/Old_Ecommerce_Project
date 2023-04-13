<?php 
session_start();
include('server/connection.php');

if(!isset($_SESSION['logged-in'])){
  header('location:login.php');
  exit;
}
if(isset($_GET['log-out'])){
  if(isset($_SESSION['logged-in'])){
    unset($_SESSION['logged-in']);
    unset($_SESSION['user-name']);
    unset($_SESSION['user-email']);
    header('location:login.php');
    exit; 
  }
}
if(isset($_POST['change_password'])){

  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];
  $user_email = $_SESSION['user_email'];
  //!IF PASSWORD DONT MATCH

  if($password !== $confirmPassword){
    header('location:accaunt.php?error=Passwords Dont Match');
  }
  //! IF PASSWORD IS SMALLER THAN 6 CHARACTERS
  else if(strlen($password) < 6)
  {
   header('location:accaunt.php?error=Password must be at least 6 charracters');
  }
  else{
    $stmt = $conn-> prepare('UPDATE users SET user_password=? WHERE user_email=?');
    $stmt->bind_param('ss',md5($password),$user_email);

   if($stmt->execute()){
    header('location:accaunt.php?massage=Password Has Been Updated Succesfully');
   }
   else{
    header('location:accaunt.php?error=Couldn`t Update Password');
   }

  }

}

//!Get Orders
if(isset($_SESSION['logged-in'])){
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare('SELECT * FROM orders WHERE user_id=? ');
    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();

}

?>
 <?php include('layouts/header.php')  ?>

  <!--Accaunt-->
  <section class="my-5 py-5">
    <div class="row container mx-auto ">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center " style="color:green; font-size:19px;"><?php if(isset($_GET['payment_massage'])){ echo $_GET['payment_massage']; }?></p>
            <p class="text-center " style="color:green;"><?php if(isset($_GET['registration_sueccess'])){ echo $_GET['registration_sueccess']; }?></p>
            <p class="text-center " style="color:green;"><?php if(isset($_GET['login_sueccess'])){ echo $_GET['login_sueccess']; }?></p>
            <h3 class="font-weight-bold">Accaunt Information</h3>
            <hr class="mx-auto">
            <div class="accaunt-info">
                <p>Name: <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}  ?></span></p>
                <p>Email: <span><?php  if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                <p><a href="accaunt.php?log-out=1" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <div class=" col-lg-6 col-md-12 col-sm-12">
            <form action="accaunt.php" method="POST" id="accaunt-form">
            <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
            <p class="text-center" style="color:green "><?php if(isset($_GET['massage'])){ echo $_GET['massage']; }?></p>
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="accaunt-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="accaunt-password-confirm" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" name="change_password" id="change-pass-btn" class="btn">
                </div>
                
            </form>
        </div>
    </div>

  </section>

  <!--Orders-->
  <section id="orders" class="orders mx-5 my-5 py-3">
    <div class="mt-2">
        <h2 class="font-weight-bolde text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Order ID</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Date</th>
            <th>Order Details</th>
        </tr>
        <?php while($row = $orders->fetch_assoc() ){ ?>
        <tr>

            <td>
              
               <span> <div class="mt-3"><?php echo $row['order_id']  ?></div></span>
            
            </td>

            <td>
           
              <span>  <div class="mt-3">$<?php echo $row['order_cost']  ?></div></span>
           
            </td>

            <td>
            
               <span> <div class="mt-3"><?php echo $row['order_status']  ?></div></span>
            
            </td>

            <td>
              <span><?php echo $row['order_date'] ?></span>
            </td>

            <td>
              <form action="order_details.php" method="POST">
                <input type="hidden" value="<?php echo $row['order_status'];  ?>" name="order_status">
                <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                <input type="submit" value="Details" class="btn order-details-btn" name="order_details_btn" id="">
              </form>
            </td>

        </tr>
        <?php } ?>
      
    </table>
</section>



<?php include('layouts/footer.php')  ?>