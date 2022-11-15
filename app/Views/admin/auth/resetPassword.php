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
                                    <h4 class="text-center mb-4">Reset your password</h4>
                                     <form method="post" action="<?php echo $adminBaseURL; ?>reset/password">
                                        <?php echo $messageBoard; ?>
                                        <input type="hidden" name="token" value="<?php echo $uri->getSegment(4); ?>">
                                         <div class="row">
                                            <div class="col-lg-12">
                                               <div class="form-group">
                                                  <label>Password</label>
                                                  <input name="password" class="form-control" type="password" placeholder="Enter password" required>
                                               </div>
                                            </div>
                                            <div class="col-lg-12">
                                               <div class="form-group">
                                                  <label>Confirm Password</label>
                                                  <input class="form-control" type="password" name="confirmPassword" placeholder="Enter confirm password" required>
                                               </div>
                                            </div>
                                         </div>
                                         <div class="text-center mt-4">
                                             <button type="submit" class="btn btn-primary">Submit</button>
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