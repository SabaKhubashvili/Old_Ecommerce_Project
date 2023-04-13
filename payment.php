<?php  
session_start();

$order_status= "";
$order_total_price= 0; 


// if($_SERVER['REQUEST_METHOD'] != 'POST') { //!SERVER DIE IF REQUEST = GET;
//   header("HTTP/1.0 404 Not Found");
//   die();
// }

if(isset($_POST['order_pay_btn'])){
  $order_status = $_POST['order_status'];
  $order_total_price =  $_POST['order_total_price'];
  echo '<script>console.log("Done")</script>';
}

?>


<?php include('layouts/header.php')  ?>
  <!--Payment-->
  <section class="my-5 py-5">
    <div class="container text-center mt-5 pt-5">
      <h2 class="form-weight-bald mt-2">Payment</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center mt-5">
    <?php 
          if(isset($order_status) && $order_status == 'Not paid') {?>
              <?php $amount = strval($order_total_price) ?>    
              <?php $order_id = $_POST['order_id']; ?>
              <p>Total payment:$ <?=$order_total_price?></p>
              <div id="paypal-button-container"></div>

    
      <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0 ){ ?>
              <?php $amount =strval($_SESSION['total'] )?>        
              <?php $order_id = $_SESSION['order_id'] ?>
              <p>Total Payment: $<?=$_SESSION['total'];?></p>
              <div id="paypal-button-container"></div>
              
        
       

          <?php }
          
        else{ ?>
             <p style="color:red; font-weight:400; font-size:18px;">You don't have order</p>
            <?php } ?>


    </div>
  </section>

 <script src="https://www.paypal.com/sdk/js?client-id=AT2iM0bVx5E0d9Kwgpuxzmtl8LvX8o24bh7WId2s9Hkds4k0IT1icSETUGJVmudVKsurKdTiWHjvLSsy&currency=USD"></script>

 <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?=$amount;?>' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            window.location.href='server/complete_payment.php?transaction_id='+transaction.id+'&order_id='+<?=$order_id?>;
          });
        }
      }).render('#paypal-button-container');
    </script>

  <?php include('layouts/footer.php')  ?>