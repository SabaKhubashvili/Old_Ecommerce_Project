<?php  
session_start();
include('../server/connection.php');

  if(isset($_SESSION['admin_logged-in']) == false ){
        header('location:login.php');
        exit();
  }

  if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];

        $stmt = $conn->prepare('DELETE FROM orders WHERE order_id=?');
        $stmt->bind_param('i',$order_id);

        if($stmt->execute()){
            header('location:orders.php?massage=Order deleted succesfully');
        }else{
            header('location:orders.php?error=Something wrong happened');
        }

  }else{
    header('location.index.php');
  }
  ?>