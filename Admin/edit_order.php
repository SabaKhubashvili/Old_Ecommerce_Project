

<?php 
        $page = 'orders';
        include('layouts/aside.php');
        include('../server/connection.php');
        if(isset($_SESSION['admin_logged-in']) == false ){
            header('location:login.php');
            exit();
          }
?>

<?php

        if(isset($_GET['order_id'])){
            $order_id = $_GET['order_id'];
            $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
            $stmt->bind_param('i',$order_id);
            $stmt->execute();
            $order = $stmt->get_result();
        }else if(isset($_POST['order_edit_btn'])){
            $order_status = $_POST['order_status'];
            $order_id = $_POST['order_id'];

            $stmt = $conn-> prepare("UPDATE orders SET order_status=? WHERE order_id=?");
            $stmt->bind_param('si',$order_status, $order_id);
            
            if($stmt->execute()){
            header('location:orders.php?massage=Order Updated Succesfully');
            }else{
            header('location:orders.php?error=Something Wrong Happened');  
            }
        }
        
?>

        <section id="edit_order">
            <h1>Edit Order</h1>
            <form action="edit_order.php" method="POST">
                <?php foreach($order as $order1){ ?>
                <div class="form-group">
                        <label for="title">Order Id</label>
                        <p><?=$order1['order_id']?></p>
                </div>
                <div class="form-group">
                        <label>Order Price</label>
                        <p>$<?=$order1['order_cost']?></p>
                </div>
                <input type="hidden" name="order_id" value="<?=$order1['order_id']?>">
                <div class="form-group">
                <label for="category">Order Status</label>
                <select  id="" class="form-select"   required name="order_status">
                    <option value="Not paid" <?php if($order1['order_status'] == 'Not paid'){ echo 'selected'; } ?> > Not Paid</option>
                    <option value="Paid" <?php if($order1['order_status'] == 'Paid'){ echo 'selected'; } ?>> Paid</option>
                    <option value="Delivered" <?php if($order1['order_status'] == 'Delivered'){ echo 'selected'; } ?>>Delivered</option>
                </select>
                </div>
                <div class="form-group">
                        <label><?=$order1['order_date']?></label>
                        <p>#</p>
                </div>
                <div class="form-group">
                        <button type="submit" class="order_edit_btn" name="order_edit_btn">Submit</button>
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