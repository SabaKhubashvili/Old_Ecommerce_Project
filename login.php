<?php  
session_start();

include('server/connection.php');

  if(isset($_SESSION['logged-in'])){
    header('location:accaunt.php');
    exit;
  } 


if(isset($_POST['login_btn'])){

  $email=$_POST['email'];
  $password=  md5($_POST['password']);

  //*GET EMAIL AND PASSWORD FROM DATABASE
  $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
    $stmt -> bind_result($user_id,$user_name,$user_email,$user_password);
    $stmt -> store_result();

    if($stmt->num_rows() == 1){
     $stmt->fetch();
     $_SESSION['user_id'] = $user_id;
     $_SESSION['user_name'] = $user_name;
     $_SESSION['user_email'] = $user_email;
     $_SESSION['logged-in'] = true;
     header('location:accaunt.php?login_sueccess=Logged In Succesfully  ');
     
    }
    else{
      header('location:login.php?error=Accaunt Name or Password Is Incorrect');

    }
  
    }
    else{
      //!ERROR
      header('location:login.php?error=Something Went Wrong');
    }
  

}

?>
 <?php include('layouts/header.php')  ?>

  <!--Login-->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bald">Login</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form action="login.php" method="POST" id="login-form">
      <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="login-email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="login-password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit"  class="btn" id="login-btn" name="login_btn" value="Login">
        </div>
        <div class="form-group">
          <a href="/registration.php" id="register-url" class="btn">Don't have accaunt? <span> Register here </span></a>
        </div>
      </form>
    </div>
    
  </section>

  <?php include('layouts/footer.php')  ?>