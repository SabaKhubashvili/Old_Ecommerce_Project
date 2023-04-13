<?php   include('../server/connection.php'); ?>

<?php
  if(isset($_POST['product_add_btn'])){
    echo  'gadavida';
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['product_price'];
    $category = $_POST['product_category'];
    $special_offer = $_POST['product_special_offer'];
    $color = $_POST['product_color'];
    $image1 = $_FILES['product_image_1']['tmp_name'];
    $image2 = $_FILES['product_image_2']['tmp_name'];
    $image3 = $_FILES['product_image_3']['tmp_name'];
    $image4 = $_FILES['product_image_4']['tmp_name'];
    //$file_name = $_FILES['product_image_1']['name'];

    $image_name1 = $name.'.jpg';
    $image_name2 = $name.'.jpg';
    $image_name3 = $name.'.jpg';
    $image_name4 = $name.'.jpg';

    move_uploaded_file($image1,"./assets/imgs/products/".$image_name1);
    move_uploaded_file($image2,"./assets/imgs/products/".$image_name2);
    move_uploaded_file($image3,"./assets/imgs/products/".$image_name3);
    move_uploaded_file($image4,"./assets/imgs/products/".$image_name4);

    //! UPLOAD TO DATABASE
    $stmt = $conn->prepare('INSERT INTO products(product_name,product_category,product_description,
                                                product_image,product_image2,product_image3,product_image4,
                                                product_price,product_special_offer,product_color)
                                                VALUES(?,?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssssss',$name,$category,$description,$image_name1,$image_name2,$image_name3,
                                   $image_name4,$price,$special_offer,$color);
    if($stmt->execute()){
    header('location:products.php?massage=Product Updated Succesfully');
    }else{
    header('location:products.php?error=Something Wrong Happened');  
    }
  } 

  ?>