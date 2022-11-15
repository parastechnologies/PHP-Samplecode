<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!-- Bootstrap CSS -->
      <link href="<?php echo $css; ?>bootstrap.css" rel="stylesheet"  type="text/css"/>
      <link href="<?php echo $css; ?>style.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="<?php echo $css; ?>owl.carousel.min.css">
      <link rel="stylesheet" href="<?php echo $css; ?>owl.theme.default.min.css">
      <link rel="stylesheet" href="<?php echo $css; ?>responsive.css">
      <link rel="stylesheet" href="<?php echo $css; ?>imageMaker.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">


<script type="text/javascript">
function googleTranslateElementInit() 
{
    new google.translate.TranslateElement({pageLanguage: 'fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE,includedLanguages: "en,fr"
    }, 'google_translate_element');
}
</script>


<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <!-- <link href="css/aos.css" rel="stylesheet"> -->
      <title class="notranslate">Maara Card</title>
          <style>
         .black_bg {
            background: #000;
            color: #fff;
            border-radius: 100px;
            padding: 0px;
            width: 17px;
            height: 17px;
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            font-size: 12px;
            position:relative;
            top:-4px;
        }
        #navbar .dropdown-menu[data-bs-popper] {
         top: 100%;
         margin-top: 0.125rem;
      } 
        .cart-img .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            display: none;
        }
        /*.cart-img .dropstart .dropdown-menu[data-bs-popper] {*/
        /*    top: 50px;*/
        /*    right: 12px;*/
        /*    left: auto;*/
        /*    margin-top: 0;*/
        /*    margin-right: 0.125rem;*/
        /*    width: 350px;*/
        /*    padding: 7px;*/
        /*}*/
.cart-img .dropstart .dropdown-menu[data-bs-popper] {
    right: 7px;
    left: auto;
    margin-right: 0.125rem;
    padding: 7px;
    width: 400px;
}
        .cart-img .dropstart .dropdown-toggle::before{
           display: none;
        }
        .checkbox-round {
            width: 15px;
            height: 15px;
            background-color: #112C64;
            border-radius: 50%;
            vertical-align: middle;
            border: 1px solid #b5acac;
            appearance: none;
            -webkit-appearance: none;
            /* outline: none; */
            cursor: pointer;
            margin: 2px;
        }
        
        .checkbox-round:checked {
            background-color: #112C64;
            border: 2px solid #b5acac;
            box-shadow: 0 0 2px #060000;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
             .fixed-top {
            position: fixed;
            width: 100%;
            max-width: 1170px;
            margin: 0 auto;
            transition: 0.4s;
            z-index: 999999;
        }
        .goog-te-banner-frame {
            display: none;
        }
        img.goog-te-gadget-icon {
            display: none;
        }
        div#goog-gt-tt {
            display: none !important;
        }
        
        #google_translate_element{
    background-color: #efefef;
    border-left: 0;
    border-top: 0;
    border-bottom: 0;
    border-right: 0;
    font-size: 10pt;
    display: inline-block;
    padding-top: 1px;
    padding-bottom: 2px;
    cursor: pointer;
    zoom: 1;
    padding: 6px;
    border-radius: 8px;
}

.goog-te-gadget-simple {
    border-left: 0;
    border-top: 0;
    border-bottom: 0;
    border-right: 0;
    background:none;
}
.black_bg {
  width: 23px;
  height: 23px;
}

ul.phone_list li {
    padding: 7px 9px;
    list-style-type: disc;
    margin-left: 30px;
}

@media(max-width:767px)
{
    .cart-img .dropstart .dropdown-menu[data-bs-popper] {
  right: 7px;
  left: auto;
  width: 260px;
}
}

      </style>
   </head>
   <?php //print_r($_SESSION);unset($_SESSION['subTotal']);die();?>
   <body>
      <header id="home" class="main_banner">
         <div class="menu-top"> 
            <span>
                Free premium trial for 14 day 
            <!--Free shipping for orders over <?php echo $currencySign; ?> 40-->
            </span>
         </div>
         <div class="main-navbar">
            <div class="container-fluid">
               <div class="row d-flex">
                  <div class="col-sm-12 main_menu">
                     <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-none custom_navbar justify-content-md-center">
                        <div class="container-fluid px-0">
                           <a class="navbar-brand" href="<?php echo base_url(); ?>">
                           <img src="<?php echo $images; ?>logo_main.png" alt="Logo">
                           </a>
                           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="navbar-toggler-icon"></span>
                           </button>
                           <div class="collapse navbar-collapse " id="navbarSupportedContent">
                              <ul class="navbar-nav  mb-2 mb-lg-0 navbar-nav  mb-0 mb-lg-0 d-flex align-items-md-left align-items-lg-center align-items-sm-left mx-auto">
                                 <li class="nav-item">
                                    <a class="nav-link active" href="<?php echo base_url();?>/shop">Boutique</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>/services">À propos</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>/team">Entreprises</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>/help">Support</a>
                                 </li>
                              </ul>
                              <form class="d-sm-block d-md-flex  justify-content-sm-start justify-content-md-center float-right align-items-sm-left align-items-md-center fsm">
                                <div id="google_translate_element"></div>
                                <!--<select class="changeLanguage">
                                    <option value="fr">French</option>
                                    <option value="en">English</option>
                                </select>-->
                                  <div class="top-icon">
                                    <!-- <img src="images/search.svg" class="pe-3 mt-3"> -->
                                    <div class="cart-img position-relative">
                                       <div class="dropdown dropstart">
                                          <button class="dropdown-toggle cart_btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                             <img src="<?php echo $images; ?>shopping-cart.svg" width="20px">
                                             <span class="black_bg" id="cartCount"><?php echo $qty; ?></span>
                                          </button>
                                          <?php if($uri->getSegment(1) != 'cart') { ?>
                                          <div class="dropdown-menu chat-new" aria-labelledby="dropdownMenuButton1" >
                                             <ul class="list-group cart-items mb-3"  id="cartItemList">
                                                <?php foreach($items as $item){ 
                                                    $qtys = $item['qty'];
                                                    //$subTotal += ((int)$item['price'] * (int)$qtys); 
                                                    $subTotal += $item['price'] * $qtys;
                                                    $CID = $item['colorID'] ? $item['colorID'] : 0;
                                                    $productID = base64_encode($item['productID'].$salt);
                                                    $colorID = base64_encode($CID.$salt);
                                                    $productColorID = base64_encode($productID.$colorID.$salt);
                                               ?>  
                                            <li class="list-group-item d-flex justify-content-between lh-condensed" id="headerItemID<?php echo $productColorID; ?>">
                                                <div class="d-flex">
                                                   <div class="product-thumbnail">
                                                      <div class="product-thumbnail__wrapper">
                                                           <?php if($item['image'] != ""){ 
                                                                if($item['isCustom'] == 1) { ?>  
                                                                    <img src="<?php echo $customImagePath.$item['image']; ?>"> 
                                                              <?php } else { ?>
                                                              <img src="<?php echo $productImagePath.$item['image']; ?>">
                                                              <?php } } else { ?>
                                                              <img src="<?php echo $images; ?>pvc_card.png">
                                                              <?php } ?> 
                                                        <!--<?php if($item['image'] != ""){ ?>  
                                                            <img src="<?php echo $productImagePath.$item['image']; ?>"> 
                                                        <?php } else { ?>
                                                            <img src="<?php echo $images; ?>pvc_card.png">
                                                        <?php } ?>-->  
                                                      </div>
                                                   </div>
                                                   <div class="d-flex flex-column ms-3">
                                                      <h6 class="my-0 product_title"><?php echo $item['name']; ?></h6>
                                                      <small class="text-muted"><?php echo $item['colorName']; ?></small>
                                                      <small class="text-muted"><b>Qty:</b><?php echo $item['qty']; ?></small>
                                                      <small class="text-muted"><b>Price:</b><?php echo $currencySign.$item['price']; ?></small>
                                                   </div>
                                                </div>
                                             </li>
                                             <?php } ?>
                                            </ul>
                                            <?php if($qty == 0) { ?>
                                            <div class="justify-content-between align-items-center" id="emptyCart">
                                             <div class="subtotal p-1 ">
                                                 <p class="align-items-center">
                                                    Votre panier est vide
                                                 </p>
                                             </div>
                                         </div>
                                            <?php } else { ?>
                                            <div id="">
                                                <div class="d-flex justify-content-between align-items-center">
                                                 <div class="subtotal p-1">
                                                     <h6>
                                                         Subtotal
                                                     </h6>
                                                 </div>
                                                 <div class="subtotal price">
                                                     <p id="subTotal">
                                                         <?php echo $currencySign.$subTotal; ?>
                                                     </p>
                                                 </div>
                                             </div>
                                             <div class="py-sm-0 py-md-2 d-flex align-items-center">
                                                 <a href="<?php echo base_url(); ?>/cart" class="black_btn w-100 text-center">Valider mes achats</a>
                                             </div>
                                        </div>    
                                            <?php } ?>
                                            <div id="showCheckout" style="display:none">
                                                <div class="d-flex justify-content-between align-items-center">
                                                 <div class="subtotal p-1">
                                                     <h6>
                                                         Subtotal
                                                     </h6>
                                                 </div>
                                                 <div class="subtotal price">
                                                     <p id="subTotal">
                                                         <?php echo $currencySign.$subTotal; ?>
                                                     </p>
                                                 </div>
                                             </div>
                                             <div class="py-sm-0 py-md-2 d-flex align-items-center">
                                                 <a href="<?php echo base_url(); ?>/cart" class="black_btn w-100 text-center">Valider mes achats</a>
                                             </div>
                                        </div>  
                                         </div> 
                                         <?php } ?>
                                        </div>
                                    </div>
                      
                                   
                                 </div>
                    
                                <!-- start -->
                                             <?php if($loggedin == 1){ ?>
                                  <div class="dropdown">
                                    <a class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                       <span><img src="<?php echo $images; ?>img-2.png"/></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                      <li>
                                       <a href="<?php echo base_url(); ?>/orders" class="sign-up-btn mx-2" href="">Ordres</a>
                                     </li>
                                      <li>
                                       <a href="<?php echo base_url(); ?>/logout" class="sign-up-btn mx-2" href="">Se déconnecter</a>
                                      </li>
                                      <!--<li><a class="dropdown-item" href="#">Another action</a></li>
                                      <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                                    </ul>
                                  </div>
                                 <?php } else { ?>
                                 <a href="<?php echo base_url(); ?>/login" class="btn-bron mx-3" href="">Rapport</a>
                                 <a href="<?php echo base_url(); ?>/register" class="sign-up-btn mx-2" href="">S'inscrire</a>
                                 <?php } ?>
                                 <!-- stop --> 
                              </form>
                           </div>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>      
      <?php //print_r($_SESSION['cartItems']);?>