      <!--end section-->
      <section class="product-main">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-5">
                        <div id="carouselExampleIndicatorsLeft" class="carousel slide carousel-fade carousel-thumbs-top" data-bs-ride="carousel">

                    
                        <!-- Slides -->
                    <div class="carousel-inner mb-5">
                    <?php 
                        $i =1; 
                        foreach($productImages as $image){ 
                    ?>    
                      <div class="carousel-item <?php echo $i == 1 ? 'active' : '';?>">
                        <img src="<?php echo $productImagePath.$image['image']; ?>" class="d-block w-100" alt="..." />
                      </div>
                    <?php $i++; } ?>
                    </div>
                    
        
        <!-- Thumbnails -->
                <div class="slider carousel-indicators position-absolute">
                <?php 
                    $j = 0; 
                    foreach($productImages as $imageT){ 
                ?>  
                <button type="button" data-bs-target="#carouselExampleIndicatorsLeft" data-bs-slide-to="<?php echo $j; ?>" class="active" aria-current="true" aria-label="Slide <?php echo $j+1; ?>">
                    <img class="d-block w-100" src="<?php echo $productImagePath.$imageT['image']; ?>" class="img-fluid" />
                </button>
                <?php $j++; } ?>
                </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsLeft" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsLeft" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
      </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-7">
                  <!--<nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        <li class="breadcrumb-item active" aria-current="page">PVC Card</li>
                     </ol>
                  </nav>-->
                   <form class="addToCart" method="post">    
                  <div class="single-product">
                     <h1>
                        <?php echo $product['name']; ?>
                     </h1>
                     <h6 class="price-size"><span>Price:</span><?php echo $currencySign.$product['price']; ?>
                     </h6>
                     <h6 class="price-size"><span>Technology:</span><?php echo $product['typeName']; ?></h6>
                    
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
                     <h6 class="price-size pt-3"><span>  Quanity</span>  
                     </h6>
                     <div class="quantity">
                        <div class="input-group">
                           <input type="button" value="-" class="button-minus sub" data-field="quantity">
                           <input type="number" step="1" max="" value="1" name="qty" class="quantity-field">
                           <input type="button" value="+" class="button-plus add" data-field="quantity">
                        </div>
                     </div>
                      <input type="hidden" id="colorID<?php echo base64_encode($product['id'] . $salt);?>" name="colorID" value="<?php echo $product['colorID'] ?  base64_encode($product['colorID'] . $salt) : 0;?>">
                             <input type="hidden" name="productID" value="<?php echo base64_encode($product['id'] . $salt);?>">
                     <button type="submit" class="black_btn" href=""> Add to Cart</button>
                    <!-- <a class="shop-btn mt-3" href=""> Create your Own</a>-->
                     <!-- Nav tabs -->
                     <ul class="nav nav-tabs" role="tablist mt-5">
                        <li class="nav-item">
                           <a class="nav-link active" data-bs-toggle="tab" href="#home">Description</a>
                        </li>
                        <li class="nav-item comptit">
                           <a class="nav-link" data-bs-toggle="tab" href="#compatibility">Compatibility</a>
                        </li>
                        <li class="nav-item comptit">
                           <a class="nav-link" data-bs-toggle="tab" href="#shipping">Shipping</a>
                        </li>
                     </ul>
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                           
                           <p><?php echo $product['description']; ?></p>
                        </div>
                            <div id="compatibility" class="container tab-pane fade ">
                        
                           <p><?php echo $product['compatibility']; ?></p>
                        </div>
                        <div id="shipping" class="container tab-pane fade ">
                            <p><?php echo $product['shipping']; ?></p>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
      <!--end section-->
      <section class="product-related">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="pre_heading text-center">
                     <h3 class="mb-3">
                        RELATED PRODUCTS
                     </h3>
                  </div>
               </div>
            </div>
            <div class="owl-carousel  products mt-4">
            <?php foreach($relatedProducts as $relatedProduct) {?>    
               <div class="item">
                  <div class="card-product p-3">
                     <div class="image text-center">
                         <?php if($relatedProduct['image'] != ""){ ?>
                        <img src="<?php echo $productImagePath.$relatedProduct['image']; ?>" class="img-fluid"> 
                        <?php } else { ?>
                        <img src="<?php echo $images; ?>pvc_card.png" class="img-fluid"> 
                        <?php } ?>
                     </div>
                     <div class="mt-2">
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                           <h5 class="main-heading mt-0"><?php echo $relatedProduct['name']; ?></h5>
                        </div>
                        <h6 class="price-text"><?php echo $currencySign.$relatedProduct['price']; ?></h6>
                        <div class="colors">
                            <?php $colors = explode(",",$product['colors']);
                        foreach($colors as $color){ ?>
                            <span style="color:<?php echo $color; ?>"></span>
                        <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>
               
            </div>
         </div>
         </div>
         </div>
      </section>

<div class="container">
  <div class="row">
    <div class="col">

      <!-- Carousel wrapper -->

    </div>
  </div>
</div>

<style>
.carousel.carousel-thumbs-top {
  padding-top: 60px;
}

.carousel .carousel-indicators button {
  width: 100px !important;
}
</style>
