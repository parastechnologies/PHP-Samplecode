<section class="shop-banner">
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-4">
            <img src="<?php echo $images; ?>marra_cad-2.png" class="p-2 meta-card" />
         </div>
         <div class="col-md-4 text-center">
            <h4>
               <img src="<?php echo $images; ?>marra-team.png" class="services" />
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
       
      <form class="pt-3 main-form p-1 p-md-4 p-lg-4"  method="post"  action="<?php echo base_url(); ?>/paynow">

         <div class="row">
            <?php if(!$_SESSION['successCheckout']){ ?> 
            <?php if($items) { ?> 
            <div class="col-md-6">
               <div class="shipping-form">
                <?php echo $messageBoard; ?>             
                  <div class="form-group">
                     <div class="d-flex justify-content-between">
                        <strong><label class="mb-3">Contact Information</label></strong>
                     </div>
                     <div class="email-text d-flex">
                        <div class="form-check">
                        </div>
                        <?php if($loggedin == 1){ ?>
                        <div class="send-text">
                           <b>Logged In email <?php echo $email; ?></b>
                        </div>
                        <?php } else { ?>
                        <div class="send-text">
                           Already have an account? <a href="<?php echo base_url(); ?>/login">LogIn </a> or <a href="<?php echo base_url(); ?>/login">SignUp</a> 
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="d-flex justify-content-between">
                        <strong><label class="mb-3">Shipping Address</label></strong>
                     </div>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <div class="row">
                        <div class="col-6">
                           <input type="text" class="form-control form-control-lg" placeholder="First Name" name="firstName" value="<?php echo $order['firstName']; ?>" required/>
                        </div>
                        <div class="col-6">
                           <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lastName" value="<?php echo $order['lastName']; ?>" required/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" placeholder="Phone" name="phoneNumber" value="<?php echo $order['phoneNumber']; ?>" required/>
                  </div>
                  <input type="hidden" name="addID" value="<?php echo $order['id'];?>">
                  <div class="form-group mt-4 mb-4">
                     <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" value="<?php echo $order['email']; ?>" required/>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <div class="row">
                        <div class="col-6">
                           <select class="form-select" aria-label="Default select example" name="countryCode" required id="stateSelection" required>
                              <option value="">Country</option>
                              <?php foreach($countries as $country) { ?>
                              <option value="<?php echo $country['countryCode']; ?>" <?php echo $countryCode == $order['countryCode'] ? 'selected' : ''; ?>>
                                 <?php echo $country['countryName']; ?>
                              </option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="col-6">
                           <select class="form-select" aria-label="Default select example" name="stateID" required id="stateOption" required>
                              <option value="">State</option>
                              <?php foreach($states as $state) { ?>
                              <option value="<?php echo $state['id']; ?>" <?php echo $state['id'] == $order['stateID'] ? 'selected' : ''; ?>>
                                  <?php echo $state['name']; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" name="address" placeholder="Address" value="<?php echo $order['address']; ?>" required/>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" name="apartment" placeholder="Apartment, suite,etc." value="<?php echo $order['apartment']; ?>"/>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" name="city" placeholder="City" required value="<?php echo $order['city']; ?>"/>
                  </div>
                  <div class="form-group mt-4 mb-4">
                     <input type="text" class="form-control form-control-lg" name="zipcode" placeholder="Zip Code/Postal Code/Pin Code" required value="<?php echo $order['zipcode']; ?>"/>
                  </div>
               </div>
            </div>
            <div class="col-md-6 order-md-2 mb-4">
               <div class="shipping-form">
                  <ul class="list-group mb-3">
                     <?php 
                        foreach($items as $item) { 
                            $subTotal += $item['price'] * $item['qty']; 
                        ?>
                     <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div class="d-flex">
                           <div class="product-thumbnail">
                              <div class="product-thumbnail__wrapper">
                                   <?php if($item['image'] != ""){ 
                                    if($item['isCustom'] == 1) { ?>  
                                    <img src="<?php echo $customImagePath.$item['image']; ?>"  class="product-thumbnail__image"> 
                                  <?php } else { ?>
                                  <img src="<?php echo $productImagePath.$item['image']; ?>"  class="product-thumbnail__image">
                                  <?php } } else { ?>
                                  <img src="<?php echo $images; ?>pvc_card.png"  class="product-thumbnail__image">
                                  <?php } ?> 
                              </div>
                              <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo $item['qty']; ?></span>
                           </div>
                           <div class="d-flex flex-column ms-3">
                              <h6 class="my-0"><?php echo $item['name']; ?></h6>
                              <small class="text-muted"><?php echo $item['colorName']; ?></small>
                              <span class="text-muted"><?php echo $currencySign.$item['price']; ?></span>
                           </div>
                        </div>
                     </li>
                     <?php } ?>
                     
                  </ul>
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
                  <div class="d-flex justify-content-between align-items-center">
                    <?php if($loggedin == 1){ ?>  
                     <button type="submit" class="black_btn">Valider mes achats</button>
                     <?php }else { ?>
                     <a href="<?php echo base_url(); ?>/login" class="black_btn">Valider mes achats</a>
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
            <?php } } else { ?>
            <div class="col-md-12">
              <center><p class="align-items-center"><b>Your order has been successfully placed</b></p>
         </div>
         </div>
         <?php } ?>
         </div>
      </form>
   </div>
</section>

