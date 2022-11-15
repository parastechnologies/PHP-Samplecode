<section class="shop-banner">
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-4">
            <img src="<?php echo $images; ?>marra_cad-2.png" class="p-2 meta-card" />
         </div>
         <div class="col-md-4 text-center">
            <h4>
               <img src="<?php echo $images; ?>marra-team.png" class="services" />
               Payment
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
<style>
.shipping_payment 
{
    border: 1px solid #E1E1E1;
    padding: 5px 15px;
    border-radius: 4px;
}
.shipping_payment .addr_row {
    justify-content: space-between;
    border-bottom: 1px solid #E1E1E1;
    padding: 12px 0;
}
</style>
<section class="py-4 products">
   <div class="container">
       
      <form class="pt-3 main-form p-2 p-md-4 p-lg-4"  method="post" id="checkoutForm" action="">

         <div class="row">
            <?php //if(!$_SESSION['successCheckout']){ ?> 
            <?php if($items) { ?> 
            <div class="col-md-6">
               <div class="shipping-form">
                <?php echo $messageBoard; ?>             
                  <div class="shipping_payment">
                     <div class="addr_row d-block d-md-block d-lg-block">
                       <p class="contact">Contact</p>
                       <p class="email"><?php echo $order['useremail']; ?></p>
                       <!--<a class="change_addr" href="<">Change</a>-->
                     </div>   
                     <div class="addr_row d-block d-md-block d-lg-block">
                       <p class="contact">Ship to</p>
                       <p class="email">
                           <?php echo $order['firstName'].'&nbsp;'.$order['lastName']; ?>
                           <br/>
                           <?php echo $order['email'].'&nbsp;'.$order['phoneNumber']; ?>
                           <br/>
                       <!--</p>
                       <p class="email">-->
                           <?php echo $order['address'].'&nbsp;'.$order['city'].'&nbsp;'.$order['state'].'&nbsp;'.$order['zipcode'].'&nbsp;'.$order['countryCode']; ?>
                       </p>
                       <!--<a class="change_addr" href="checkout.html">Change</a>-->
                     </div>
                    </div>
               </div>
            </div>
            <div class="col-md-6 order-md-2 mb-4">
               <div class="shipping-form">
                  <ul class="list-group mb-3">
                    <?php 
                        foreach($carts as $item) { 
                            $subTotal += $item['itemPrice'] * $item['itemQty']; 
                        ?>
                     <li class="list-group-item d-block d-md-flex d-lg-flex justify-content-between lh-condensed">
                        <div class="d-block d-md-flex d-lg-flex">
                           <div class="product-thumbnail">
                              <div class="product-thumbnail__wrapper">
                                <?php if($item['isCustom'] == 1) { 
                                    if($item['image'] != ""){
                                  ?>
                                  <img src="<?php echo $customImagePath.$item['image']; ?>"  class="product-thumbnail__image"> 
                                 <?php } else { ?>
                                 <img src="<?php echo $images; ?>pvc_card.png"  class="product-thumbnail__image">
                                 <?php } } else { if($item['pImage'] != ""){ ?>
                                 <img src="<?php echo $productImagePath.$item['pImage']; ?>"  class="product-thumbnail__image">
                                 <?php } else { ?>
                                 <img src="<?php echo $images; ?>pvc_card.png"  class="product-thumbnail__image">
                                 <?php } } ?>
                              </div>
                              <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo $item['itemQty']; ?></span>
                           </div>
                           <div class="d-flex flex-column ms-3">
                              <h6 class="my-0"><?php echo $item['name']; ?></h6>
                              <small class="text-muted"><?php echo $item['colorName']; ?></small>
                              <span class="text-muted"><?php echo $currencySign.$item['itemQtyPrice']; ?></span>
                           </div>
                        </div>
                     </li>
                     <?php } ?>
                     
                  </ul>
                  <?php
        $headers = array (
                 "X-SYCA-MERCHANDID:$MerchandID", 
                 "X-SYCA-APIKEY:$ApiKey", 
                 'X-SYCA-REQUEST-DATA-FORMAT: JSON',
                 'X-SYCA-RESPONSE-DATAFORMAT: JSON',
                );
        $paramsend = array (
            "montant" =>$subTotal, 
            "curr" =>$currency
        );
        $url = $paymentURL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION ,CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data_json = json_encode($paramsend);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $response = json_decode(curl_exec($ch),TRUE);
        curl_close($ch);
        
        if($response['code'] == 0)
        {
            $token = $response['token'];
        }
        else {
            $token = $response['token'];
        }
?>
            <input type="hidden"  name="token" value="<?php echo $token;?>">
            <input type="hidden" name="currency" value="<?php echo $currency;?>">
            <input type="hidden" name=" name" value="Doe">
            <input type="hidden" name=" pname" value="Jonh">
            <input type="hidden" name=" emailpayeur" value="jonh.doe@incognito.com">
            <input type="hidden" name="urls" value="<?php echo base_url(); ?>/landing/orderCancel?id=<?php echo base64_encode($items[0]['orderID']); ?>">
            <input type="hidden" name="urlc" target="_blank" value="<?php echo base_url(); ?>/landing/orderCancel?id=<?php echo base64_encode($items[0]['orderID']); ?>">
            <input type="hidden" name="commande" value="COMTEST">
            <input type="hidden" name="merchandid" value="<?php echo $MerchandID;?>">
            <input type="hidden" name="amount" id="amount" value="<?php echo $subTotal;?>">
            <input type="hidden" name="typpaie" id="typpaie" value="payement">
            <input type="hidden" name="nameplugin" value=" plugin">
        
                  <!--<div class="d-flex justify-content-between align-items-center">
                     <div class="subtotal p-1">
                         <h6>
                             Subtotal
                         </h6>
                     </div>
                     <div class="subtotal price">
                         <p>
                             $19.30
                         </p>
                     </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center">
                     <div class="subtotal p-1">
                         <h6>
                             Shipping
                         </h6>
                     </div>
                     <div class="subtotal price">
                         <p>
                             Calculated at next step
                         </p>
                     </div>
                     </div>-->
                  <!--<div class="border-bottom"></div>-->
                  <div class="d-flex justify-content-between align-items-center">
                     <div class="subtotal p-1">
                        <h6>
                           Grand Total
                        </h6>
                     </div>
                     <div class="subtotal price">
                        <p>
                         <?php echo $currencySign.$subTotal; ?>
                        </p>
                     </div>
                  </div>
                   <!--<div class="shipping-form">
                  <div class="form-group">
                     <div class="d-flex justify-content-between">
                        <strong><label class="mb-3">Payment</label></strong>
                     </div>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" placeholder="Card Number" name="cardNumber"/>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" placeholder="Name on Card" name="cardHolderName" />
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control form-control-lg" placeholder="Expiration date (MM / YY)" name="expDate" />
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control form-control-lg" placeholder="Security Code" name="cvv" />
                        </div>
                     </div>
                  </div>
               </div>-->
                  <div class="d-flex justify-content-between align-items-center">
                    <?php if($loggedin == 1){ ?>  
                     <button type="submit" class="black_btn">Continuer à payer</button>
                     <?php }else { ?>
                     <a href="<?php echo base_url(); ?>/login" class="black_btn">Continuer à payer</a>
                     <?php } ?>
                  </div>
               </div>
            </div>
            <?php } else { ?>
             <div>
          <div class="col-md-12">
              <center><p class="align-items-center"><b>Il n'y a aucun objet dans votre panier.</b></p></br>
              <a class="black_btn" href="<?php echo base_url(); ?>/shop">Continuer vos achats</a></center>
         </div>
         </div>
            <?php }// } else { ?>
            <!--<div class="col-md-12">
              <center><p class="align-items-center"><b>Your order has been successfully placed</b></p>
         </div>
         </div>-->
         <?php //} ?>
         </div>
      </form>
   </div>
</section>

