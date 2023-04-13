<?php  
session_start();
include('../server/connection.php');

  if(isset($_SESSION['admin_logged-in']) == false ){
        header('location:login.php');
        exit();
  }
  if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];

        $stmt = $conn->prepare('DELETE FROM products WHERE product_id=?');
        $stmt->bind_param('i',$product_id);

        if($stmt->execute()){
        header('location:products.php?massage=Product Deleted Succesfully');
        }
        else{
        header('location:products.php?error:Couldn"t Delete Product'); 
        }
       
       

  }
?>