
 
      <!-- Banner section -->
     
      <!--start section-->
      <img  src="1.png" alt="" class="img-fluid ">
      <section class="main-banner">
         <div class="container">
            <div class="row mt-sm-0 mt-md-5 mt-sm-0 py-sm-0 py-md-5">
               <div class="col-sm-12 col-md-6 d-sm-block d-md-flex align-items-center justify-content-center">
                  <div class="left_side">
                     <h1>
                        Maara <span> Card</span>  
                     </h1>
                     <p class="mb-4">
                        Votre dernière carte de visite
                     </p>
                     <a class="black_btn" href=""> Shop Now</a>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 text-sm-center text-md-end">

                  <div class="banner-img">
                     <img  src="<?php echo $images; ?>screen_header.png" alt="" class="img-fluid ">
                  </div>
                 
               </div>
            </div>
         </div>
      </section>
      <!--End section-->
      <!--start section-->
      <section class="business">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="pre_heading text-center">
                     <h3 class="mb-3">
                        LA CARTE DE VISITE NOUVELLE GÉNÉRATION
                     </h3>
                     <p class="w-sm-100 w-md-75 mx-auto">
                        Créer des interactions transparentes, mémorables et efficaces pour 
                        les entreprises d'Afrique et du monde. Maara Card est une carte de 
                        visite numérique qui vous permet de partager instantanément vos informations avec un ami, 
                        un prospect, un client, etc.
                     </p>
                  </div>
               </div>
            </div>
            <div class="row mt-5">
               <div class="col-md-6  d-flex align-items-center justify-content-center">

                  <div class="banner-img">
                     <img src="<?php echo $images; ?>generation_business.png" class="float-center">
                  </div>

                
               </div>
               <div class="col-md-6">
                  <div class="d-sm-block d-md-flex d-lg-flex  align-items-center about_shadow mb-4">
                     <div class="abount-cnt_img">
                        <img src="<?php echo $images; ?>accessible.svg" class="mx-sm-0 mx-md-3">
                     </div>
                     <div class="about_content">
                        <h1 class="f_22">
                           Accessible à tous
                        </h1>
                        <p>
                           Aucune application requise pour accéder à votre profil.
                        </p>
                     </div>
                  </div>
                  <div class="d-sm-block d-md-flex d-lg-flex  align-items-center about_shadow mb-4">
                     <div class="abount-cnt_img">
                        <img src="<?php echo $images; ?>contact_icon.svg" class="mx-3">
                     </div>
                     <div class="about_content">
                        <h1 class="f_22">
                           Sans contact
                        </h1>
                        <p>
                           Partagez instantanément vos contacts d'un simple geste
                        </p>
                     </div>
                  </div>
                  <div class="d-sm-block d-md-flex d-lg-flex  align-items-center about_shadow mb-4">
                     <div class="abount-cnt_img">
                        <img src="<?php echo $images; ?>current.svg" class="mx-3">
                     </div>
                     <div class="about_content">
                        <h1 class="f_22">
                           Coordonnées actualisées
                        </h1>
                        <p>
                           Ajoutez et modifiez les détails de votre carte de visite indépendamment.
                        </p>
                     </div>
                  </div>
                  <div class="d-sm-block d-md-flex d-lg-flex  align-items-center about_shadow">
                     <div class="abount-cnt_img">
                        <img src="<?php echo $images; ?>custom.svg" class="mx-3">
                     </div>
                     <div class="about_content">
                        <h1 class="f_22">
                           Personnalisable
                        </h1>
                        <p>
                           Votre appareil et votre profil peuvent s'afficher comme vous le souhaitez
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--start section-->
      <!--end section-->
      <section class="products">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="pre_heading text-center">
                     <h3 class="mb-3">
                        OUR PRODUCTS
                     </h3>
                  </div>
               </div>
            </div>
            <div class="row row-eq-height">
            <?php 
            foreach($products as $product){?>    
               <div class="col-md-3 card-product">
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
                                                 <div class="mx-auto text-center mb-4">
                             <input type="hidden" id="colorID<?php echo base64_encode($product['id'] . $salt);?>" name="colorID" value="<?php echo $product['colorID'] ?  base64_encode($product['colorID'] . $salt) : 0;?>">
                             <input type="hidden" name="productID" value="<?php echo base64_encode($product['id'] . $salt);?>">
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
              <?php } ?> 
            </div>
         </div>
         
      </section>
      <!--products end section-->
      <section class="how-it-works">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="pre_heading text-center ">
                     <h3 class="mb-3">
                        COMMENT ÇA MARCHE
                     </h3>
                  </div>
               </div>
            </div>
            <div class="row d-flex align-items-center">
               <div class="col-md-6">
                  <div class="img-work text-center">
                     <img src="<?php echo $images; ?>how_its_work.png" class="img-fluid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="pre_headings text-center ">
                     <h3 class="mb-3">
                        COMMANDEZ VOTRE MAARA CARD
                     </h3>
                     <p class="mx-auto text-left text-hows">
                        Vous pouvez choisir l'appareil que vous préférez et lui donner l'apparence que vous voulez
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--how its works section-->
      <section class="create-profile">
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-md-6">
                  <div class="pre_headings text-center ">
                     <h3 class="mb-3">
                        CRÉEZ VOTRE PROFILE
                     </h3>
                     <p class="mx-auto text-left text-hows">
                        Directement depuis l'application Maara Card, ajoutez des informations de contact pertinentes, des profils sociaux et des liens/URL de votre choix. Incluez une photo de vous ou le logo de votre entreprise et une petite description de ce que vous faites.
                     </p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="img-work text-center">
                     <img src="<?php echo $images; ?>create_profile.png" class="img-fluid">
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--create profile end section-->
      <section class="networking">
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-md-6">
                  <div class="networking-img text-center">
                     <img src="<?php echo $images; ?>about-img-mobile.png" class="img-fluid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="pre_headings text-center">
                     <h3 class="mb-3">
                        COMMENCEZ À RÉSEAUTER
                     </h3>
                     <p class="mx-auto text-left text-hows">
                        D'un simple touché ou scan de votre QR code, vous pouvez partager vos informations ! Demandez à votre prospect/client d'enregistrer vos informations, de se connecter à vous, ou redirigez le tout simplement vers vos réseaux sociaux ou une URL de votre choix.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--networking end section-->
      <section class="business">
         <div class="container">
         <div class="row">
            <div class="col-md-12 mb-4">
               <div class="pre_heading text-center">
                  <h3 class="mb-3">
                     ET DEVINEZ QUOI ?
                  </h3>
                  <p class="w-75 mx-auto">
                     Les gens n'ont même pas besoin d'une application ou d'une carte Maara pour recevoir vos informations!
                  </p>
               </div>
            </div>
         </div>
         
         <div class="row">
            <div class="col-md-12 mb-4 mt-4">
               <div class="owl-carousel owl-theme">
                  <div class="item">
                     <div class="tour-item ">
                        <div class="tour-desc ">
                           <div class="d-flex justify-content-between pt-2 pb-2">
                              <div class="link-name d-flex justify-content-between">
                                 <div class="info">
                                    <img class="tm-people" src="<?php echo $images; ?>img-1.png" alt="">
                                    <p>
                                       Aziz Ouattara
                                    </p>
                                    <span>
                                    3/1/2022
                                    </span>
                                 </div>
                                 <div class="detail">
                                    <p>
                                    <div class="ratings"> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="far fa-star"></i> </div>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="tour-text color-grey-3">As a business owner. I'm always meeting and networking with new businesses and further developing relationships with existing clients. Maara Card not only allows me to do this with extreme ease, it gives me a competitive edge over others in my industry and reduces environmental impact</div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="tour-item ">
                        <div class="tour-desc ">
                           <div class="d-flex justify-content-between pt-2 pb-2">
                              <div class="link-name d-flex justify-content-between">
                                 <div class="info">
                                    <img class="tm-people" src="<?php echo $images; ?>img-2.png" alt="">
                                    <p>
                                       Koffi Kouadio 
                                    </p>
                                    <span>
                                    23/1/2022
                                    </span>
                                 </div>
                                 <div class="detail">
                                    <p>
                                    <div class="ratings"> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="far fa-star"></i> </div>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="tour-text color-grey-3">I first saw the Maara Card on instagram and loved the concept. It's tedious to carry business cards around all the time and they end up being wasted anyway as soon as a detail changes. Maara Card is very well conceived. Would recommend to all. The team were great with getting it set up for me and it was very easy!’
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="tour-item ">
                        <div class="tour-desc ">
                           <div class="d-flex justify-content-between pt-2 pb-2">
                              <div class="link-name d-flex justify-content-between">
                                 <div class="info">
                                    <img class="tm-people" src="<?php echo $images; ?>img-3.png" alt="">
                                    <p>
                                       Laetitia Kraidy
                                    </p>
                                    <span>
                                    18/1/2022
                                    </span>
                                 </div>
                                 <div class="detail">
                                    <p>
                                    <div class="ratings"> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="far fa-star"></i> </div>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="tour-text color-grey-3">Simplicity meets intelligence... With a synergistic approach to exchanging informations, this product critically evolves the future of business, made effortless with seamless design, integration and future technologies. Truly the last card you will ever need. Absolutely love my Maara Card!*
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="tour-item ">
                        <div class="tour-desc ">
                           <div class="d-flex justify-content-between pt-2 pb-2">
                              <div class="link-name d-flex justify-content-between">
                                 <div class="info">
                                    <img class="tm-people" src="<?php echo $images; ?>img-1.png" alt="">
                                    <p>
                                       Mireille Yobouet
                                    </p>
                                    <span>
                                    23/1/2022
                                    </span>
                                 </div>
                                 <div class="detail">
                                    <p>
                                    <div class="ratings"> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="far fa-star"></i> </div>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="tour-text color-grey-3">Maara Card is a game changer! Our products are constantly turning heads and getting people to come and talk with us, wherever we are. We used to keep a stash of generic business cards to hand out but our Maara Card provides so much more information and is a lot more professional. Couldn't recommend it enough!
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="tour-item ">
                        <div class="tour-desc ">
                           <div class="d-flex justify-content-between pt-2 pb-2">
                              <div class="link-name d-flex justify-content-between">
                                 <div class="info">
                                    <img class="tm-people" src="<?php echo $images; ?>img-2.png" alt="">
                                    <p>
                                       Samuel Feyla
                                    </p>
                                    <span>
                                    23/1/2022
                                    </span>
                                 </div>
                                 <div class="detail">
                                    <p>
                                    <div class="ratings"> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="far fa-star"></i> </div>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="tour-text color-grey-3">We have been using out Maara Card now for over a month and it has paid for itself 10 fold. Such an innovative idea allowing my customers new and old to have all my infos in one place. Any business who uses business cards would be silly not to invest in a Maara Card</div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="tour-item ">
                        <div class="tour-desc ">
                           <div class="d-flex justify-content-between pt-2 pb-2">
                              <div class="link-name d-flex justify-content-between">
                                 <div class="info">
                                    <img class="tm-people" src="<?php echo $images; ?>img-3.png" alt="">
                                    <p>
                                       Fatima Dosso
                                    </p>
                                    <span>
                                    23/1/2022
                                    </span>
                                 </div>
                                 <div class="detail">
                                    <p>
                                    <div class="ratings"> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="fa fa-star rating-color"></i> <i class="far fa-star"></i></div>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="tour-text color-grey-3">I can honesty say I have ditched the traditional business cards and saved money on printing. The usability and function is user-friendly and to top it oft, not only can i add my social media accounts but I can embed my podcast episodes. The top and QR capability is 10/10 and it has impressed my prospects and clients who have added my details into their smartphone with a single click</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="download">
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-md-6">
                  <div class="pre_headings text-center ">
                     <h3 class="mb-3 p-4">
                        TÉLÉCHARGEZ L'APPLICATION GRATUITE SUR APPLE & PLAY STORE MAINTENANT!
                     </h3>
                     <p class="mx-auto text-left text-hows p-4">
                        Utilisez les fonctionnalités puissantes de l'application Maara Card pour aller encore plus loin avec votre carte de visite.
                        Gérez votre profil où que vous soyez, modifiez les données et les liens à tout moment, activez le mode direct, gérez votre équipe et bien plus encore !
                     </p>
                  </div>
                  <div class="download_btn p-4">
                     <a href="#"><img src="<?php echo $images; ?>play_store.png" class="img-fluid me-1"></a>
                     <a href="#"><img src="<?php echo $images; ?>apple_download.png" class="img-fluid me-1"></a>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="img-work text-center">
                     <img src="<?php echo $images; ?>create_profile.png" class="img-fluid">
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php 
      //print_r($_SESSION['cartItems']);
      //unset($_SESSION['cartItems']);?>

