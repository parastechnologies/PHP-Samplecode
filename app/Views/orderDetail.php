<section class="team-banner  d-flex align-items-center justify-content-center">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="banner-text">
               Order Detail
            </h1>
         </div>
      </div>
   </div>
</section>
<section class="video-bn">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <p><?php echo $messageBoard; ?></p>
         </div>
         <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head justify-content-between">
            <h2 class="mb-3 me-auto"></h2>
         </div>
      </div>
      <!-- row -->
      <div class="row  align-items-start">
         <div class="col-lg-6  col-md-6 col-xl-6 mb-3">
            <div class="ms-panel-body  border p-2">
               <div class="header-title">
                  <h4 class="text-heads">Order Summary</h4>
               </div>
               <table class="table ms-profile-information">
                  <tbody>
                     <tr>
                        <td scope="row" class="h_text"><b>Order Number</b></td>
                        <td scope="row"><?php echo $order['orderNumber']; ?></td>
                     </tr>
                     <tr>
                        <?php if($order['isCheck'] == 1) { ?> 
                        <td scope="row" class="h_text"><b>Customer Name</b></td>
                        <td scope="row"><?php echo $order['firstName'].'&nbsp;'.$order['lastName']; ?></td>
                        <?php } else { ?>
                        <td scope="row" class="h_text"><b>Company Name</b></td>
                        <td scope="row"><?php echo $order['companyName']; ?></td>
                        <?php } ?>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text"><b>Email</b></td>
                        <td scope="row"><?php echo $order['email']; ?></td>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text"><b>Phone</b></td>
                        <td scope="row"><?php $order['phoneNumber']; ?></td>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text">
                           <b>
                           Shipping Addressff
                           </b>
                        </td>
                        <td scope="row">
                           <?php echo $order['address'].'&nbsp;'.$order['state'].'&nbsp;'.$order['country'].'&nbsp;'.$order['zipcode']; ?>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-xl-6">
            <div class="ms-panel-body  border p-2">
               <div class="header-title">
                  <h4 class="text-heads">Payment Details</h4>
               </div>
               <table class="table ms-profile-information">
                  <tbody>
                     <tr>
                        <td scope="row" class="h_text"><b>Order Status</b></td>
                        <td scope="row"><?php echo $statusMessage; ?></td>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text"> <b>
                           Payment Method
                           </b> 
                        </td>
                        <td scope="row">
                           <?php echo $order['cardType']; ?> 
                        </td>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text"> <b>
                           Transaction ID
                           </b> 
                        </td>
                        <td scope="row">
                           <?php echo $order['transactionID']; ?> 
                        </td>
                     </tr>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text"> <b> Sub Total
                           </b> 
                        </td>
                        <td scope="row"> <?php echo $currencySign.$order['subTotal']; ?></td>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text">
                           <b>Discount
                           </b>  
                        </td>
                        <td scope="row"> <?php echo $currencySign.$order['discount']; ?></td>
                     </tr>
                     <tr>
                        <td scope="row" class="h_text">
                           <b>Grand Total
                           </b>  
                        </td>
                        <td scope="row"> <?php echo $currencySign.$order['grandTotal']; ?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-responsive order-table border-0">
                     <table id="example" class="display pb-0 dataTable no-footer">
                        <thead>
                           <tr>
                              <th>Sr. No</th>
                              <th>Product Image</th>
                              <th>Product Name</th>
                              <th>Product Price</th>
                              <th>Product Qty</th>
                              <th>Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($order['items'] as $item) { ?>  
                           <tr class="selected" role="row">
                              <td><?php echo $i++; ?></td>
                              <td>
                                 <div class="icon_imgs">
                                    <div class="main-icn">
                                       <?php if($item['isCustom'] == 1) { 
                                          if($item['image'] != ""){
                                          ?>
                                       <img src="<?php echo $customImagePath.$item['image']; ?>" class="me-2" width="85" height="85" alt=""> 
                                       <?php } else {?>
                                       <img src="<?php echo $images; ?>pvc_card.png" class="me-2" width="85" height="85" alt="">
                                       <?php } } else { if($item['pImage'] != ""){ ?>
                                       <img src="<?php echo $productImagePath.$item['pImage']; ?>" class="me-2" width="85" height="85" alt="">
                                       <?php } else { ?>
                                       <img src="<?php echo $images; ?>pvc_card.png" class="me-2" width="85" height="85" alt="">
                                       <?php } } ?>
                                       <!--<?php if($item['image']){ ?>
                                          <img src="<?php echo $productImagePath.$item['image']; ?>" class="me-2" width="85" height="85" alt=""> 
                                          <?php } else { ?>
                                          <img src="<?php echo $imageURL; ?>3.png" class="me-2" width="85" height="85" alt=""> 
                                          <?php } ?>-->
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <?php echo $item['name']; ?>
                              </td>
                              <td> <?php echo $currencySign.$item['itemPrice']; ?></td>
                              <td><?php echo $item['itemQty']; ?></td>
                              <td><?php echo $currencySign.$item['itemQtyPrice']; ?></td>
                           </tr>
                           <?php } ?>
                           <tr>
                              <td colspan="5" class="text-right">
                                 <b>Sub Total:</b>
                              </td>
                              <td><?php echo $currencySign.$order['subTotal']; ?></td>
                           </tr>
                           <!--<tr>
                              <td colspan="5" class="text-right">
                                 <b>
                                 Discount (-):
                                 </b> 
                              </td>
                              <td><?php echo $currencySign.$order['discount']; ?></td>
                              </tr>
                              <tr>
                              <td colspan="5" class="text-right">
                                 <b>
                                 Grand Total:
                                 </b> 
                              </td>
                              <td><?php echo $currencySign.$order['grandTotal']; ?></td>
                              </tr>-->
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   
</section>