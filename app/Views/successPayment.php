<section class="shop-banner">
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-4">
            <img src="<?php echo $images; ?>marra_cad-2.png" class="p-2 meta-card" />
         </div>
         <div class="col-md-4 text-center">
            <h4>
               <img src="<?php echo $images; ?>marra-team.png" class="services" />
               Payment Cancel
            </h4>
         </div>
         <div class="col-md-4">
            <div class="shop-info">
               <img src="<?php echo $images; ?>marra_card-1.png" class="p-2 meta-card" />
            </div>
         </div>
      </div>
   </div>
</section>
<section class="py-4 products">
   <div class="container">
         <div class="row">
            <?php 
            if($order['status'] == 4){
                ?>
            <div>
          <div class="col-md-12">
              <center><p class="align-items-center"><b>Order does not exist.</b></p></br>
              <a class="black_btn" href="<?php echo base_url(); ?>">Back To Home</a></center>
         </div>
         </div>
            <?php    
            }
            else if($order['status'] == 1){ ?>
             <div>
          <div class="col-md-12">
              <center><p class="align-items-center"><b>Payment of this order has been already received.</b></p></br>
              <a class="black_btn" href="<?php echo base_url(); ?>">Back To Home</a></center>
         </div>
         </div>
            <?php  } else { ?>
            <div class="col-md-12">
              <center><p class="align-items-center"><b>Your Payment has been received successfully.</b></p>
         </div>
         </div>
         <?php } ?>
         </div>
   </div>
</section>
