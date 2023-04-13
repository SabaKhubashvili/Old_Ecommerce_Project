
<?php $page = 'orders';
include('layouts/aside.php');
include('../server/connection.php');
if(isset($_SESSION['admin_logged-in']) == false ){
    header('location:login.php');
    exit();
  }

?>

<?php
    $page_no = 1;
    //! Get Page Number
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //!If User has already entered page number is one they selected
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }

    $stmt = $conn->prepare('SELECT COUNT(*) As total_records FROM orders');
    $stmt->execute();
    $stmt->bind_result($total_records);
    $stmt->store_result();
    $stmt->fetch();

    //! ORDERS Per Page
    $total_records_per_page=10;
    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //!GET ALL ORDERS
    $stmt1 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
    $stmt1->execute();
    $orders = $stmt1->get_result();
?>


<section id="orders">
    <h2 >All Orders</h2>
    <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
    <p class="text-center" style="color:green "><?php if(isset($_GET['massage'])){ echo $_GET['massage']; }?></p>
    <table>
        <thead>
            <tr>
                <th>Order Id</th>
                <th>User Id</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>User Phone</th>
                <th>User Adress</th>
                <th>Delete</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order){ ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= $order['user_id'] ?></td>
                <td class="warning"><?= $order['order_status'] ?></td>
                <td ><?= $order['order_date'] ?>2</td>
                <td><?= $order['user_phone'] ?></td>
                <td><?= $order['user_address'] ?></td>
                <td> <a href="delete_order.php?order_id=<?=$order['order_id'] ?>" class="danger">DELETE</a></td>
                <td><a href="edit_order.php?order_id=<?=$order['order_id']; ?>" class="primary">Details<a/></td>
            </tr>           
            <?php } ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example" >
        <ul class="pagination mt-5 mx-auto">
            <li class="page-item <?php if($page_no <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($page_no <= 1){ echo '#'; } else{ echo '?page_no='.($page_no-1); } ?>" class="page-link">Previous</a>
            </li>

            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

            <?php if($page_no >= 3){?>
                <li class="page-item"><a href="#" class="page-link">...</a></li>
                <li class="page-item"><a href="<?php echo '?page_n='.$page_no; ?>" class="page-link"><?= $page_no; ?></a></li> 
                <?php  }?>

                <li class="page-item" <?php if($page_no >= $total_records_per_page){ echo 'disabled'; } ?>>
                        <a href="<?php if($page_no >= $total_no_of_pages){ echo '#'; }else{ echo '?page_no='.$page_no+1; } ?>">Next</a> 
                </li>
        </ul>
    </nav>
    
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