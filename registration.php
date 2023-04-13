<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logged-in'])){
  header('location:accaunt.php');
  exit;
}

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];
  //! IF PASSWORDS DONT MATCH
  if($password !== $confirmPassword){
    header('location:registration.php?error=passwords dont match');
  }
  //! IF PASSWORD IS SMALLER THAN 6 CHARACTERS
  else if(strlen($password) < 6)
  {
    header('location:registration.php?error=Password must be at least 6 charracters');
  }
  //*IF THERE IS NO ERRORS
  else{
        //!CHECK IF THERE USER WITH THIS EMAIL
      $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
      $stmt1->bind_param('s',$email);
      $stmt1->execute();
      $stmt1->bind_result($num_rows);
      $stmt1->store_result();
      $stmt1->fetch();
      //IF THERE IS USER WITH ALREADY REGISTERED WITH THIS EMAIL
      if($num_rows !=0){
        header('location:registration.php?error= Email Is Already Used');
      }
      //* IF NO USER REGISTERED WITH THIS EMAIL
      else{
        //*CREATE NEW USER
      $stmt = $conn->prepare('INSERT INTO users(user_name,user_email,user_password)
                    VALUES(?,?,?)');
      $stmt->bind_param('sss',$name,$email,md5($password));

      //!IF ACCAUNT WAS CREATED SUCCESFULLY
      if($stmt->execute()){
        $user_id= $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged-in'] = true;
        header('location:accaunt.php?registration_sueccess=You Registered Succesfully');

        //! IF THERE WAS SOME PROBLEM CREATING ACCAUNT
      }else{
        header('location:registration.php?error=Coultn`t Create An Accaunt At The Moment');
      }
      
      }


      


  }
 


}


?>

<?php include('layouts/header.php')  ?>

  <!--Login-->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bald">Register</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form action="registration.php" method="POST" id="register-form">
        <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="register-name" placeholder="Name" required>
          </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="register-email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="register-password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm-password" class="form-control" id="register-confirm-password" placeholder="Confirm Password" required>
          </div>
        <div class="form-group">
          <input type="submit"  class="btn" id="register-btn" name="register" value="Register">
        </div>
        <div class="form-group">
          <a href="" id="login-url" class="btn">Do you have accaunt? <span> Login here </span></a>
        </div>
      </form>
    </div>
    
  </section>

  <?php include('layouts/footer.php')  ?>