<?php
unset($_SESSION['successCheckout']);
?>
      <footer class="section_padding_edit text-white pb-0 pt-5 footer-block">
         <div class="container">
            <div class="row pos-zbox">
               <div class="col-sm-12 col-md-4">
                  <div>
                     <img src="<?php echo $images; ?>logo1.png" alt="img" class="img-fluid">
                     <p class="f_14 mb-sm-4 mt-4">Replace your paper business cards with a connected contactless Maara Card.
                     </p>
                  </div>
               </div>
               <div class="col-sm-12 col-md-4 ps-sm-0 ps-md-2">
                  <p class="f_18 fw_bold mb-md-4 mb-sm-0">LIEN IMPORTANTS</p>
                  <ul class="list-unstyled link-im">
                     <li><a href="<?php echo base_url();?>/terms?lang=fr">Conditions d’utilisations</a></li>
                     <li><a href="<?php echo base_url();?>/privacy?lang=fr">Politique de confidentialité</a></li>
                     <li><a href="<?php echo base_url();?>/shipping" class="terms">Politique d'expédition</a></li>
                     <li><a href="<?php echo base_url();?>/refund">Politique de remboursement</a></li>
                     <li><a href="<?php echo base_url();?>/compatibility">Compatibilité</a></li>
                  </ul>
               </div>
               <div class="col-sm-12 col-md-4">
                  <p class="f_18 fw_bold mb-4">Social Links</p>
                  <p>
                     Maaracard@maaragroup.com
                  </p>
                  <ul class="social-link">
                      
                    <?php foreach($socials as $social){ 
                    if($social['icon']){ ?>
                    <li>
                        <a target="_blank" href="<?php echo $social['link']; ?>">
                        <img src="<?php echo $socialImagePath.$social['icon']; ?>">
                        </a>
                     </li>
                    <?php }  } ?>
                     <!--<li>
                        <a target="_blank" href="https://m.facebook.com/profile.php?id=100085805264849">
                        <img src="<?php echo $images; ?>facebook.png">
                        </a>
                     </li>
                     <li>
                        <a target="_blank" href="">
                        <img src="<?php echo $images; ?>google_plus.png">
                        </a>
                     </li>
                     <li>
                        <a target="_blank" href="https://instagram.com/maaracard?igshid=YmMyMTA2M2Y=">
                        <img src="<?php echo $images; ?>twitter.png">
                        </a>
                     </li>
                     <li>
                        <a target="_blank" href="">
                        <img src="<?php echo $images; ?>instagram.png">
                        </a>
                     </li>-->
                  </ul>
               </div>
               <hr class="my-4">
               <div class="d-flex justify-content-center">
                  <p class="f_14 mb-4">Copyright © 2022 <span class="notranslate"> Maara Card </span> Tous droits réservés
                  </p>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer section end -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"  type="application/javascript"></script>
      <script src="<?php echo $js; ?>bootstrap.js"></script>
      <script src="<?php echo $js; ?>popper.min.js"></script>
      <!--<script src="<?php echo $js; ?>jquery.min.js"></script>-->
      <script src="<?php echo $js; ?>aos.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>
      <script src="<?php echo $js; ?>owl.carousel.js"></script>
      <script src="<?php echo $js; ?>custom.js"></script>
      <!--<script src="<?php echo $js; ?>imageMaker.js"></script>-->
      
      <?php 
        //setcookie('googtrans', "/ja/fr");
    
      if($uri->getSegment(1) == 'custom' && $uri->getSegment(2) == 'card')
      {
        include('customCard.php');
        //echo $deviceTypeID['deviceTypeID'];
      ?>
       <script>
     $( document ).ready(function() {
         $('#clothe-tshirt-maker').imageMaker
         ({
            merge_images:
               [
                  /*{url: './assets/design/just_do_it.png', title:'Just Do it'},
                  {url: './assets/design/starbucks.png', title:'Starbucks'},
                  {url: './assets/design/kiss.png', title:'Kiss'},
                  {url: './assets/design/donkey.png', title:'Donkey 1'},
                  {url: './assets/design/donkey2.png', title:'Donkey 2'},*/
               ],
               templates:
               [
                  {url: '<?php  echo $deviceTypeID['deviceTypeID'] == 1 ? $images."circle_img (2).png" : $images."custom.png"; ?>', title:''},
                  /*{url: '<?php echo $images; ?>rectangle_img.png', title:'black1'},
                  {url: '<?php echo $images; ?>circle_img.png', title:'T-shirt White'},
                  {url: '<?php echo $images; ?>circle_img (2).png', title:'T-shirt White'},      
                  {url: '<?php echo $images; ?>circle_img (2) (1).png', title:'T-shirt black'},*/
                  /*{url: './assets/design/white.png', title:'white'},*/
               ],
            text_boxes_count:0
         });
         $('#image-maker').imageMaker();
         //The following code is for animate scrolling when open the page
         jQuery([document.documentElement, document.body]).animate({
            scrollTop: jQuery("#"+jQuery(":target").attr('id')).offset().top
         }, 1000);
      });
      </script>
      <?php } ?>
      <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
      <script>
         var owl = $('.owl-carousel');
         owl.owlCarousel({
         items:3,
         loop:true,
         margin:10,
         autoplay:true,
         autoplayTimeout:1000,
         autoplayHoverPause:true,
         responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
         });
         $('.play').on('click',function(){
         owl.trigger('play.owl.autoplay',[1000])
         })
         $('.stop').on('click',function(){
         owl.trigger('stop.owl.autoplay')
         })
         
          window.onscroll = function() {scrollFunction()};
               
               function scrollFunction() {
                 if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
                   $('.navbar').addClass('fixed-top');
                 } else {
                   $('.navbar').removeClass('fixed-top');
                 }
               }

      </script>
           <script>
         $(function () {
             $(".tabs nav a").on("click", function () {
                 show_content($(this).index());
             });
         
             show_content(0);
         
             function show_content(index) {
                 // Make the content visible
                 $(".tabs .content.visible").removeClass("visible");
                 $(".tabs .content:nth-of-type(" + (index + 1) + ")").addClass("visible");
         
                 // Set the tab to selected
                 $(".tabs nav a.selected").removeClass("selected");
                 $(".tabs nav a:nth-of-type(" + (index + 1) + ")").addClass("selected");
             }
         });
      </script>
            <script>
        $(document).ready(function()
        {
            $('.changeLanguage').click(function(event) 
            {
               console.log(event.target, "console")
                console.log(event.target.id, "console1");
                console.log(event.target.value, "console2");
                new google.translate.TranslateElement({pageLanguage: event.target.value});
                document.cookie = "googtrans=/en/" + event.target.value;
                //console.log('googtrans= /en/'+event.target.value);
                //document.cookie = 'googtrans= /en/'+event.target.value;
                //document.cookie = "doSomethingOnlyOnce=; expires=Thu, 01 Jan 1970 00:00:00 GMT; SameSite=None; Secure";
                //setCookie("googtrans", "/en/"+event.target.value)
                /*document.cookie = 
                setcookie('googtrans', "/en/"+event.target.id);*/
                /*var value = $(this).html();
                if(event.target.id == 'arbic'){
                $(".english").hide();
                $(".arbic").show();
               }
               else{
                   $(".arbic").hide();
                   $(".english").show();   
               }
               $('.selectbox_selected').attr('data-value', value);
               $('.selectbox_selected').html(value);
               $('.selectbox_values').toggle();*/
            
            });
        })
      </script>
      <script>
/*$('.add').click(function () {
    alert("jsdfjdf");
    $(this).prev().val(+$(this).prev().val() + 1);
});
$('.sub').click(function () {
    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
});*/
</script>
      </body>
</html>