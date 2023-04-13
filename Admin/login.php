<?php  
session_start();

include('../server/connection.php');

  if(isset($_SESSION['admin_logged-in'])){
    header('location:index.php');
    exit;
  } 


if(isset($_POST['login_btn'])){

  $email=$_POST['email'];
  $password=  md5($_POST['password']);

  //*GET EMAIL AND PASSWORD FROM DATABASE
  $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
    $stmt -> bind_result($admin_id,$admin_name,$admin_email,$admin_password);
    $stmt -> store_result();

    if($stmt->num_rows() == 1){
     $stmt->fetch();
     $_SESSION['admin_id'] = $admin_id;
     $_SESSION['admin_name'] = $admin_name;
     $_SESSION['admin_email'] = $admin_email;
     $_SESSION['admin_logged-in'] = true;
     header('location:index.php?login_sueccess=Logged In Succesfully  ');
     
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

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <section class="my-5 py-5">
        <div class=" text-center mt-5 pt-5">
          <h2 class="form-weight-bald">Admin Login</h2>
        </div>
        <div class="mx-auto">
          <form action="login.php" method="POST" id="login-form" class="mt-5">
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
        
          </form>
        </div>
        
      </section>
    
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>