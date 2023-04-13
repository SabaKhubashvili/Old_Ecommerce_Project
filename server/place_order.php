<?php
session_start();

include('connection.php');

//! IF USER IS NOT LOGGED IN
if(!isset($_SESSION['logged-in'])){
    header('location:../checkout.php?massage=Please Login/Register to place order');
    exit;
}


if(isset($_POST['place_order'])){
    // 1.get user info
    $name= $_POST['email'];
    $phone= $_POST['phone'];
    $city= $_POST['city'];
    $adress= $_POST['adress'];
    $order_cost= $_SESSION['total'];
    $order_status= "Not paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders(order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                    VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$adress,$order_date);

    $stmt_status = $stmt->execute();
    
    if(!$stmt_status){
        header('location:../accaunt.php?error=Unable To Place Order Try Again Later');
        exit;
    }
    
    // 2.store order info in database
    

    $order_id =$stmt->insert_id;

    

    
    
    // 3.get Products From cart(from Session)
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
    // 4. Store each single item in order_items database
    
        $stmt1 = $conn->prepare('INSERT INTO order_items(order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                      VALUES(?,?,?,?,?,?,?,?) ');
        $stmt1->bind_param('iissiiis', $order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

        $stmt1-> execute();
    }



   

    // 5. Remove everything from cart -->Delay until payment is done
    // unset($_SESSION['cart']);

    // 6. Inform user whether everyithing is fine or there is a problem 
    $_SESSION['order_id'] = $order_id;
    header('location: ../payment.php?order_status=order placed succesfully');


};



?>