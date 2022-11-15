<section class="shop-banner">
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-6">
            <img src="<?php echo $images; ?>shop-card.png" class="p-2 meta-card">
         </div>
         <div class="col-md-6">
            <div class="logo-img p-2">
               <img src="<?php echo $images; ?>logo_marra.png" class="float-center">
            </div>
            <div class="shop-info">
               <h4>
                  Choose what you want to 
                  share with your interlocutor
               </h4>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="products">
   <div class="container">
    <?php
    $i = 1;
    foreach($devicesTypes as $devicesType){ ?>
      <div class="row <?php echo $i != 1 ? 'mb-4 mt-4' : ''; ?>">
         <div class="col-md-12">
            <div class="pre_heading text-center">
               <h3 class="mb-4">
                  <?php echo $devicesType['typeName'];?>
               </h3>
            </div>
         </div>
      </div>
      <div class="row mx-auto d-flex justify-content-center pb-4">
      <?php
       foreach($devicesType['products'] as $product) {  
      ?>
        <div class="col-md-5">
                    <form class="addToCart" method="post">    
                  <div class="p-3">
                    <a href="<?php ?>product/<?php echo base64_encode($product['id'] . $salt); ?>" target="_blank">
                     <div class="image text-center imageID<?php echo base64_encode($product['id'].$salt);?>" id="imageID<?php echo base64_encode($product['id'].$salt);?>"> 
                        <?php if($product['image'] != ""){ ?>
                        <img src="<?php echo $productImagePath.$product['image']; ?>" class="img-fluid"> 
                        <?php } else { ?>
                        <img src="<?php echo $images; ?>pvc_card.png" class="img-fluid"> 
                        <?php } ?>
                     </div>
                    </a>
                     <div class="mt-2">
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                           <h5 class="main-heading mt-0"><?php echo $product['name']; ?></h5>
                        </div>
                        <h6 class="price-text"><?php echo $currencySign.$product['price']; ?>
                        </h6>
                                                 <div class="mx-auto d-block d-md-block d-lg-flex text-center mb-4">
                             <input type="hidden" id="colorID<?php echo base64_encode($product['id'] . $salt);?>" name="colorID" value="<?php echo $product['colorID'] ?  base64_encode($product['colorID'] . $salt) : 0;?>">
                             <input type="hidden" name="productID" value="<?php echo base64_encode($product['id'] . $salt);?>">
                             <a href="<?php echo base_url(); ?>/custom/card/<?php echo base64_encode($product['id'] . $salt); ?>" class="custom_btn" href="">Customize</a>
                             <button type="submit" class="black_btn" href=""> Add to Cart</button>
                          </div>
                            <div class="color-new mb-3"> 
                        <?php
                        if($product['colors']){
                        $colors = explode(",",$product['colors']);
                        $i = 1;
                        foreach($colors as $color){
                            $colorExl = explode("-",$color);
                            $colorName = $colorExl[0];
                            $colorID = $colorExl[1];
                        ?>
                          <input type="radio"
                            id="<?php echo base64_encode($colorID. $salt).'&P&'.base64_encode($product['id'] . $salt);?>"
                            style="background-color: <?php echo $colorName; ?>" 
                            class="checkbox-round checkColor"
                            name="checkColor"
                            <?php echo $colorID  == $product['colorID'] ? 'checked' : ''; ?>
                            value="<?php echo $colorName; ?>"/>
                        <?php $i++;} } ?>
                            </div>

                     </div>
                  </div>
                 </form>
               </div>
    <?php } echo '</div>'; $i++; } ?>  
   </div>
   </div>
   </div>
   </div>
</section>
<!--end section-->