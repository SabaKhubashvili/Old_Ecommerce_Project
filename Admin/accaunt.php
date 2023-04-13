

<?php 
        $page = 'settings';
        include('layouts/aside.php');
        include('../server/connection.php');
        if(isset($_SESSION['admin_logged-in']) == false ){
            header('location:login.php');
            exit();
          }
?>
<?php  
    if(isset($_POST['change-admin-password'])){
        $password = $_POST['change-password'];
        $confirm_password = $_POST['confirm-password'];
        $admin_email = $_SESSION['admin_email'];

        if($password !== $confirm_password){
            header('location:accaunt.php?error=Passwords Dont Match');
            exit();
        }
        else if(strlen($password) < 6  ){
            header('location:accaunt.php?error=Password must be longer than 6 charracters');
            exit();
        }
        else{
            $stmt = $conn->prepare('UPDATE admins SET admin_password=? WHERE admin_email=?');
            $stmt->bind_param('ss',md5($password),$admin_email);
            if($stmt->execute()){
                header('location:accaunt.php?massage=Password changed succesfully');
            }else{
                header('location:accaunt.php?error=Something wrong happened, try again');
            }
        }
    }

?>


          <section id="accaunt-info">
            <div class="accaunt-information">
                <h1>Accaunt Information</h1>
                <hr>
                <div class="accaunt-details">
                    <p>Name: <span> <?=$_SESSION['admin_name']?></span></p>
                    <p>Email: <span> <?=$_SESSION['admin_email']?></span></p>
                </div>
            </div>
            <div class="change-password">
                <h1>Change Password</h1>
                <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <p class="text-center" style="color:green "><?php if(isset($_GET['massage'])){ echo $_GET['massage']; }?></p>
                <form action="accaunt.php" method="POST">
                    <div class="form-group">
                        <label for="change-password">Password</label>
                        <input type="password" name="change-password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="change-password">Confirm Password</label>
                        <input type="password" name="confirm-password" placeholder="Repeat Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="change-admin-password" class="change-password-btn">Submit</button>
                    </div>
                </form>
            </div>
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