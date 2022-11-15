<?php
//unset($_SESSION['cartItems']);
//print_r($_SESSION['cartItems']);
?>
<section class="shop-banner">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-4">
                <img src="<?php echo $images; ?>marra_cad-2.png" class="p-2 meta-card" />
            </div>
            <div class="col-md-4 text-center">
                <h4>
                    <img src="<?php echo $images; ?>marra-team.png" class="services" />
                    Chariot
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
        <?php if($items){ ?> 
         <div class="col-md-8">
            <div class="shipping-form">
               <ul class="list-group mb-3">
                  <?php 
                  foreach($items as $item) { 
                      if($item['isCustom'] == 1)
                      {
                          $CID = 02;
                      }
                      else
                      {
                         $CID = $item['colorID'] ? $item['colorID'] : 0;   
                      }
                      $productID = base64_encode($item['productID'].$salt);
                      $colorID = base64_encode($CID.$salt);
                      $subTotal += $item['price'] * $item['qty']; 
                      $productColorID = base64_encode($productID.$colorID.$salt);
                    
                  ?>
                  <li class="list-group-item d-block d-md-flex d-lg-flex justify-content-between lh-condensed" id="itemID<?php echo $productColorID; ?>">
                     <div class="d-block d-md-flex d-lg-flex">
                        <div class="product-thumbnail">
                           <div class="product-thumbnail__wrapper">
                              <?php if($item['image'] != ""){ 
                                if($item['isCustom'] == 1) { ?>  
                                    <img src="<?php echo $customImagePath.$item['image']; ?>"  class="product-thumbnail__image cart_image"> 
                              <?php } else { ?>
                              <img src="<?php echo $productImagePath.$item['image']; ?>"  class="product-thumbnail__image cart_image">
                              <?php } } else { ?>
                              <img src="<?php echo $images; ?>pvc_card.png"  class="product-thumbnail__image cart_image">
                              <?php } ?> 
                           </div>
                        </div>
                        <div class="d-flex flex-column ms-0 ms-md-3">
                           <h4 class="my-0"><?php echo $item['name']; ?></h4>
                           <?php if($item['isCustom'] != 1) {?>
                           <h6 class="text-muted"><strong>Color: </strong><?php echo $item['colorName']; ?></h6>
                           <?php } ?>
                            <span class="text-muted"><?php echo $currencySign.$item['price']; ?></span>
                        <div class="quantity">
                           <div class="input-group">
                              <input 
                                type="button" 
                                value="-" 
                                data-value-remove="subQty" 
                                id="sub<?php echo $productColorID; ?>" 
                                data-value="subColor<?php echo $colorID; ?>" 
                                data-value-id="subproduct<?php echo $productID; ?>"
                                class="button-minus sub changeQtyOfItem" 
                                data-field="quantity">
                              <input type="number" step="1" id="qty<?php echo $productColorID; ?>" max="" value="<?php echo $item['qty']; ?>" name="quantity" class="quantity-field">
                              <input 
                                type="button" 
                                value="+" 
                                id="add<?php echo $productColorID; ?>" 
                                data-value="addColor<?php echo $colorID; ?>" 
                                data-value-id="addproduct<?php echo $productID; ?>" 
                                class="button-plus add changeQtyOfItem" 
                                data-field="quantity">
                           </div>
                        </div>
                        <h6 class="text-muted"><strong>Total: </strong>
                        <span id="subTotal<?php echo $productColorID; ?>">
                            <?php echo $currencySign.$item['subTotal']; ?><span></h6>
                        </div>
                     </div>
                      <div class="remove" data-value-remove="removeQty">
                          <a class="sub" 
                           data-value="subColor<?php echo $colorID; ?>" 
                          data-value-id="subproduct<?php echo $productID; ?>"
                          id="remove<?php echo $productColorID; ?>" href="javascript:void();" >Retirer</a>
                     </div> 
                  </li>
                  <?php } ?>
               </ul>
            </div>
         </div>
         <div class="col-md-4 order-md-2 mb-4">
            <div class="shipping-form">
               <div class="d-flex justify-content-between align-items-center mb-5">
                  <div class="subtotal p-1">
                     <h6>
                        Subtotal
                     </h6>
                  </div>
                  <div class="subtotal price">
                     <p id="grandTotalPrice">
                        <?php echo $currencySign.$subTotal; ?>
                     </p>
                  </div>
               </div>
               <div class="d-flex justify-content-between align-items-center">
                   <div class="mx-auto text-center d-block">
                       <?php if($loggedin == 1){ ?>  
                     <a class="black_btn" href="<?php echo base_url(); ?>/checkout">Valider mes achats</a>
                     <?php }else { ?>
                     <a href="<?php echo base_url(); ?>/login" class="black_btn">Valider mes achats</a>
                     <?php } ?>
                        
                    </div>    
               </div>
               <!--<div class="d-flex justify-content-between align-items-center">
                  <div class="subtotal p-1">
                      <h6>
                          Total
                      </h6>
                  </div>
                  <div class="subtotal price">
                      <p>
                          USD $19.99
                      </p>
                  </div>
                  </div>-->
            </div>
         </div>
         <?php } else { ?>
          <div>
          <div class="col-md-12">
              <center><p class="align-items-center"><b>Il n'y a aucun objet dans votre panier.</b></p></br>
              <a class="black_btn" href="<?php echo base_url(); ?>/shop">Continuer vos achats</a></center>
         </div>
         </div>
         <?php } ?>
          <div id="isItemCartInCart12" style="display:none">
          <div class="col-md-12">
              <center><p class="align-items-center"><b>Il n'y a aucun objet dans votre panier.</b></p></br>
              <a class="black_btn" href="<?php echo base_url(); ?>/shop">Continuer vos achats</a></center>
         </div>
         </div>
      </div>
   </div>
</section>
