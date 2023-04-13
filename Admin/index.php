
<?php $page = 'dashboard';
include('layouts/aside.php') ?>

<?php   
  

  include('../server/connection.php');

  if(isset($_SESSION['admin_logged-in']) == false ){
    header('location:login.php');
    exit();
  }


    $stmt = $conn->prepare('SELECT * FROM orders ORDER BY order_id desc LIMIT 8 ');
    $stmt->execute();

    $orders = $stmt->get_result();

?>
        <main>
            <h1>Dasbhoard</h1>
            <p class="text-center " style="color:green; font-size:19px;"><?php if(isset($_GET['login_sueccess'])){ echo $_GET['login_sueccess']; }?></p>
            <div class="date">
                <input type="date">
            </div>
            <div class="insights">
                <div class="sale">
                    <i class="fa-solid fa-chart-simple"></i>
                    <div class="middle">
                        <div class="lef">
                            <h3>Total Sales</h3>
                            <h1>$25,201</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>85%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24h</small>
                </div>
                  <!--=================One Sale End===============-->
                  <div class="expenses">
                    <i class="fa-solid fa-chart-line"></i>
                    <div class="middle">
                        <div class="lef">
                            <h3>Total Expenses</h3>
                            <h1>$25,201</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>31%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24h</small>
                </div>
                  <!--=================Expenses End===============-->
                  <div class="income">
                    <i class="fa-solid fa-chart-pie"></i>
                    <div class="middle">
                        <div class="lef">
                            <h3>Total Income</h3>
                            <h1>$25,201</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24h</small>
                </div>
                  <!--=================End Of income===============-->
            </div>

            <!--=========================================Recent Orders========================-->
            <div class="recent-orders">
                <h2>Recent Orders</h2>
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
                            <td><?=$order['order_id']?></td>
                            <td><?=$order['user_id']?></td>
                            <td class="warning"><?=$order['order_status']?> </td>
                            <td ><?=$order['order_date']?></td>
                            <td ><?=$order['user_phone']?></td>
                            <td ><?=$order['user_address']?></td>
                            <td> <a href="orders.php" class="danger" >DELETE</a></td>
                            <td class="primary"><a href="orders.php">Details<a/></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="orders.php">Show All</a>
            </div>
        </main>

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
            <!--END OF TOP-->
            <div class="recent-updates">
                <h2>Recent updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="/images/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Tony Stark </b>Received his order of astronaut Jacket. </p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="/images/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Black Widow </b>Received his order of astronaut Jacket. </p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="/images/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Tony Stark </b>Received his order of astronaut Jacket. </p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!--========================= End Of Updates ==================-->
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>ONLINE ORDERS</h3>
                            <small class="text-muted">Last 24h</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3842</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <i class="fa-solid fa-user-large"></i>  
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>NEW CUSTOMERS</h3>
                            <small class="text-muted">Last 24h</small>
                        </div>
                        <h5 class="success">+25%</h5>
                        <h3>832</h3>
                    </div>
                </div>
                <a href="./add_product.php">
                 <div class="item add-product">
                        <i class="fa-solid fa-plus"></i>
                        <h3>ADD PRODUCT</h3>
                    
                 </div>
                </a>
            </div>
        </div>
    </div>
 



  <script src="./script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>