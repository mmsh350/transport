<?php
  require_once 'session.php';
  require_once '../constants.php';
  if (!isset($_SESSION['amount'], $_SESSION['email'])) {
    @session_destroy();
    header("Location: ../");
    exit;
  }

  $pay = curl_init();
  $email = $_SESSION['email'];
  $amount = $_SESSION['amount'];
?>
<link rel="shortcut icon" type="image/x-icon" href="../images/icon.png">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/jquery-1.12.4-jquery.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>

       <form class="row" name="paymentForm" id="paymentForm">
                     
                      <div class="col-4"  hidden>
                        <input class="form-control"   id="email" name="email" type="email" value="<?php echo $email; ?>" required="">
                      </div>
                      <input type="text"  id="response" hidden/>
                      <input type="text"  id="reference" hidden />
                      <div class="col-6 " hidden> 
                        <label class="col-sm-6 col-form-label"   >Top up Amount</label>
                        <input class="form-control border border-primary"  type="text" id="amount"  name="amount"    value="<?php echo $amount; ?>">
                      </div>  
                      <div class="col-8  " hidden>  
                      <button class="example-popover btn btn-dark mb-1   mt-3 " id="topup" type="button"><i class="icofont icofont-pay">&nbsp;</i>Top Up</button>                    
                      </div>
                    </form>

      <script>
  $(document).ready(function() { 

   document.getElementById("paymentForm");
   let handler = PaystackPop.setup({
    key: 'pk_test_93b89dcf975d40c3fe1bc2508edb0839b35353d2', // Replace with your public key
    email: document.getElementById("email").value,
    amount: document.getElementById("amount").value * 100,
    currency: "NGN",
   
    onClose: function(){
	    Swal.fire({
			  title:'Payment Cancelled',
			  text:'Dont worry you can try again',
			  icon:'error',
			  confirmButtonColor: "#aaa",
			  confirmButtonText: "Close", 
			  allowOutsideClick: false		
		}) .then(function() {
			      //Redirect the user
		        window.location.href='individual.php?page=pay&error=payment&access=1'; 
		   })
		    setTimeout(function(){  
                 window.location.href='individual.php?page=pay&error=payment&access=1'; 
            			}, 5000);
	    
    },
    callback: function(response){

	  if(response.success ='success'){

         document.getElementById("response").value= response.success;
         document.getElementById("reference").value= response.reference;
         
		     window.location.href='verify.php?reference='+response.reference; 
			  
	}else
	  {
		   
         window.location.href='individual.php?page=pay&error=payment&access=1'; 
        
	  }
}
  }); 
 handler.openIframe();

 });
</script>


  