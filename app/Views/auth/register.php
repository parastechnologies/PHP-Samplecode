<div class="container-scroller">
   <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
         <div class="row w-100 mx-0 v-100">
            <div class="col-12 col-sm-8 col-md-8 col-lg-5 mx-auto">
               <div class="login-wrap py-md-3 px-sm-0 px-md-2">
                  <!--<div class="brand-logo px-3 py-3 text-center">
                     <img src="<?php echo $images; ?>logo_marra.png" alt="logo" class="img-fluid" />
                  </div>-->
                  <div class="main-text px-3 py-2">
<!--                     <h4 class="my-1">Welcome </h4>-->
                     <p>
                        Inscrivez-vous avec vos identifiants
                     </p>
                  </div>
                  <?php echo $messageBoard; ?>
                  <?php //$validation = \Config\Services::validation(); ?>
                  <form class="pt-3 main-form p-4" action="<?php echo base_url(); ?>/register" method="post">
                     <div class="form-group">
                        <label class="mb-1">Prénoms</label>
                        <input type="text" class="form-control form-control-lg" name="firstName" placeholder="Prénoms" required/>
                     </div>
                     <div class="form-group">
                        <label class="mb-1">Nom de famille</label>
                        <input type="text" class="form-control form-control-lg" name="lastName" placeholder="Nom de famille" required/>
                     </div>
                     <div class="form-group">
                        <label class="mb-1">Date de naissance</label>
                        <input type="date" class="form-control" name="dob" placeholder="Date de naissance" required/>
                     </div>
                     <div class="form-group">
                        <label class="mb-1">Métier</label>
                        <input type="text" class="form-control form-control-lg" name="designation" placeholder="Métier" required/>
                     </div>
                     <div class="form-group">
                        <label class="mb-1">E-mail</label>
                        <input type="text" class="form-control form-control-lg" name="email" placeholder="E-mail" required/>
                     </div>
                     <div class="form-group mt-4 mb-4">
                        <label class="mb-1">Mot de passe</label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" required/>
                     </div>
                     <div class="form-group mt-4 mb-4">
                        <label class="mb-1">Confirmez le mot de passe</label>
                        <input type="password" class="form-control form-control-lg" name="cofirmPassword" placeholder="Confirmez le mot de passe" required/>
                     </div>
                     <div class="p-sm-0 p-md-3 text-center">
                        <button type="submit" class="black_btn" name="register">S'inscrire</button>
                     </div>
                   <!--  <div class="form-row d-flex justify-content-center align-items-center mt-4">
                        <div class="form-group text-center get_password d-flex">
                           <span>
                           Forgot your password?
                           <a href="forgot_password.html"  class="get_password">Get Password</a>
                           </span>
                        </div>
                     </div>-->
                  </form>
               </div>
            </div>
         </div>
         <!-- end of rows -->
      </div>
      <!-- content-wrapper ends -->
   </div>
   <!-- page-body-wrapper ends -->
</div>