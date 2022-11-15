
    <div class="authincation h-100" style="background:#4A91E2; background-repeat: no-repeat;background-size: cover; background-position: center;">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="<?php echo $imageURL; ?>logo.jpeg" alt="" width="80px"></a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="<?php echo $adminBaseURL; ?>loginMe" method="post">
                                        <?php echo $messageBoard; ?>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                             <input name="email" class="form-control" type="email" value="" placeholder="Enter email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                              <input class="form-control" type="password" value="" name="password" placeholder="Enter password" required>
                                        </div>
                                        <div class="text-end">
                                            <a href="<?php echo $adminBaseURL; ?>forgot/password" class=" float-right">Forgot Password?</a>
                                        </div>
                                        <!-- <div class="row d-flex justify-content-between mt-4 mb-2">
                                                <div class="mb-3">
                                                <a href="javascript:;">Forgot Password?</a>
                                            </div>
                                        </div> -->
                                        <div class="text-center mt-5">
                                            <button type="submit" class="btn btn-primary login btn-block">Login</button>
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
