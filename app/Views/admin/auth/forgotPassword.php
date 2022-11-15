<div class="authincation h-100" style="background:#4A91E2; background-repeat: no-repeat;background-size: cover; background-position: center;">
   <div class="container h-100">
      <div class="row justify-content-center h-100 align-items-center">
         <div class="col-md-6">
            <div class="authincation-content">
               <div class="row no-gutters">
                  <div class="col-xl-12">
                     <div class="auth-form">
                        <div class="text-center mb-3">
                           <a href="index.html"><img src="<?php echo $imageURL; ?>logo.png" alt="" width="80px"></a>
                        </div>
                        <h4 class="text-center mb-4">Forgot password</h4>
                        <form  method="post" action="<?php echo $adminBaseURL?>forgot/password/mail">
                           <?php echo $messageBoard; ?>
                           <div class="mb-3">
                              <p>
                                 Enter your email address and we'll send you an email with instructions to reset your password.
                              </p>
                           </div>
                           <div class="mb-3">
                              <label class="mb-1"><strong>Email</strong></label>
                              <input type="email" class="form-control" name="email" value="">
                           </div>
                           <!-- <div class="row d-flex justify-content-between mt-4 mb-2">
                              <div class="mb-3">
                              <a href="javascript:;">Forgot Password?</a>
                              </div>
                              </div> -->
                           <div class="text-center mt-5">
                              <button type="submit" class="btn btn-primary login btn-block">Submit</button>
                           </div>
                           <div class="text-center mt-3">
                              <a href="<?php echo $adminBaseURL?>login" class="">Back to Login</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>