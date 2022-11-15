<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- PAGE TITLE HERE -->
        <title>Mixology</title>
        <!-- Datatable -->
        <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
        <!-- Style css -->
        <link href="css/style-new.css" rel="stylesheet" />
    </head>
    <body>
        <!--*******************
        Preloader start
    ********************-->
        <div id="preloader">
            <div class="gooey">
                <span class="dot"></span>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!--*******************
        Preloader end
    ********************-->

        <!--**********************************
        Main wrapper start
    ***********************************-->
        <div id="main-wrapper">
            <!--**********************************
            Nav header start
        ***********************************-->
            <div class="nav-header">
                <a href="index.html" class="brand-logo">
                <img src="images/logo_sm.png" class="img-fluid logo-small mx-auto" alt="">
               <img src="images/logo_mix.svg" class="img-fluid logo-big mx-auto" alt="" width="100%"/></a>
                <div class="nav-control">
                    <div class="hamburger"><span class="line"></span><span class="line"></span><span class="line"></span></div>
                </div>
            </div>
            <!--**********************************
            Nav header end
        ***********************************-->

            <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
               <nav class="navbar navbar-expand">
                  <div class="collapse navbar-collapse justify-content-end">
                     <ul class="navbar-nav header-right ml-auto">
                        <li class="nav-item dropdown notification_dropdown">
                           <a class="nav-link  ai-icon" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                              <svg width="28" height="28" class="notify" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M22.75 15.8385V13.0463C22.7471 10.8855 21.9385 8.80353 20.4821 7.20735C19.0258 5.61116 17.0264 4.61555 14.875 4.41516V2.625C14.875 2.39294 14.7828 2.17038 14.6187 2.00628C14.4546 1.84219 14.2321 1.75 14 1.75C13.7679 1.75 13.5454 1.84219 13.3813 2.00628C13.2172 2.17038 13.125 2.39294 13.125 2.625V4.41534C10.9736 4.61572 8.97429 5.61131 7.51794 7.20746C6.06159 8.80361 5.25291 10.8855 5.25 13.0463V15.8383C4.26257 16.0412 3.37529 16.5784 2.73774 17.3593C2.10019 18.1401 1.75134 19.1169 1.75 20.125C1.75076 20.821 2.02757 21.4882 2.51969 21.9803C3.01181 22.4724 3.67904 22.7492 4.375 22.75H9.71346C9.91521 23.738 10.452 24.6259 11.2331 25.2636C12.0142 25.9013 12.9916 26.2497 14 26.2497C15.0084 26.2497 15.9858 25.9013 16.7669 25.2636C17.548 24.6259 18.0848 23.738 18.2865 22.75H23.625C24.321 22.7492 24.9882 22.4724 25.4803 21.9803C25.9724 21.4882 26.2492 20.821 26.25 20.125C26.2486 19.117 25.8998 18.1402 25.2622 17.3594C24.6247 16.5786 23.7374 16.0414 22.75 15.8385ZM7 13.0463C7.00232 11.2113 7.73226 9.45223 9.02974 8.15474C10.3272 6.85726 12.0863 6.12732 13.9212 6.125H14.0788C15.9137 6.12732 17.6728 6.85726 18.9703 8.15474C20.2677 9.45223 20.9977 11.2113 21 13.0463V15.75H7V13.0463ZM14 24.5C13.4589 24.4983 12.9316 24.3292 12.4905 24.0159C12.0493 23.7026 11.716 23.2604 11.5363 22.75H16.4637C16.284 23.2604 15.9507 23.7026 15.5095 24.0159C15.0684 24.3292 14.5411 24.4983 14 24.5ZM23.625 21H4.375C4.14298 20.9999 3.9205 20.9076 3.75644 20.7436C3.59237 20.5795 3.50014 20.357 3.5 20.125C3.50076 19.429 3.77757 18.7618 4.26969 18.2697C4.76181 17.7776 5.42904 17.5008 6.125 17.5H21.875C22.571 17.5008 23.2382 17.7776 23.7303 18.2697C24.2224 18.7618 24.4992 19.429 24.5 20.125C24.4999 20.357 24.4076 20.5795 24.2436 20.7436C24.0795 20.9076 23.857 20.9999 23.625 21Z" fill="#9B9B9B"/>
                              </svg>
                              <span class="badge light text-white bg-primary rounded-circle">12</span>
                           </a>
                           <div class="dropdown-menu dropdown-menu-end">
                              <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
                                 <ul class="timeline">
                                    <li>
                                       <div class="timeline-panel">
                                          <div class="media me-2">
                                             <img alt="image" width="50" src="images/3.png">
                                          </div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Order Confirmed</h6>
                                             <small class="d-block">29 July 2020 - 02:26 PM</small>
                                             <div class="d-flex justify-content-between">
                                                <small class="d-block price"> $59</small>
                                                <small class="d-block cubes">2x2 CUBES </small> 
                                             </div>
                                             <small class="d-block">4 pieces </small>
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="timeline-panel">
                                          <div class="media me-2 media-info">
                                             <img alt="image" width="50" src="images/6.png">
                                          </div>
                                          <div class="media-body">
                                             <h6 class="mb-1"> Order Cancel</h6>
                                             <small class="d-block">Your order has been canceled</small>
                                             <div class="d-flex justify-content-between">
                                                <small class="d-block price"> $29</small>
                                                <small class="d-block cubes">MINT INFUSED  </small> 
                                             </div>
                                             <small class="d-block"> 4 pieces </small>
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="timeline-panel">
                                          <div class="media me-2 media-success">
                                             <img alt="image" width="50" src="images/mint.png">
                                          </div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Order Confirmed</h6>
                                             <small class="d-block">29 July 2020 - 02:26 PM</small>
                                             <div class="d-flex justify-content-between">
                                                <small class="d-block price"> $59</small>
                                                <small class="d-block cubes">2x2 CUBES </small> 
                                             </div>
                                             <small class="d-block">4 pieces </small>
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="timeline-panel">
                                          <div class="media me-2">
                                             <img alt="image" width="50" src="images/3.png">
                                          </div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Order Confirmed</h6>
                                             <small class="d-block">Be patient ! your order is pending ...</small>
                                             <div class="d-flex justify-content-between">
                                                <small class="d-block price"> $59</small>
                                                <small class="d-block cubes">JALAPENO INFUSED  </small> 
                                             </div>
                                             <small class="d-block">4 pieces </small>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                              <a class="all-notification" href="javascript:void(0);">See all notifications <i class="ti-arrow-end"></i></a>
                           </div>
                        </li>
                        <li class="nav-item dropdown  header-profile">
                           <a class="nav-link" href="javascript:void(0);">
                           <img src="images/avatar/profile-1.jpg" width="56" alt=""/>
                           </a>
                           <a href="" role="button" data-bs-toggle="dropdown"><i class="fas fa-chevron-down ms-3 text-primary"></i></a>
                           <div class="dropdown-menu dropdown-menu-end">
                              <a href="login.html" class="dropdown-item ai-icon">
                                 <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                 </svg>
                                 <span class="ms-2">Logout </span>
                              </a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
            <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

            <!--**********************************
            Sidebar start
        ***********************************-->
            <div class="deznav">
                <div class="deznav-scroll">
                    <ul class="metismenu" id="menu">
                        <li ><a href="index.html">
                         <i class="flaticon-025-dashboard mr-0"></i>
                         <span class="nav-text">Dashboard</span>
                      </a>
                        </li>
                        <li><a class="ai-icon" href="user_mgt.html">
                           <i class="flaticon-381-user"></i>
                           <span class="nav-text">User Management</span>
                        </a>
                     </li>
                   <li><a class="ai-icon" href="order_management.html">
                      <i class="flaticon-381-user"></i>
                      <span class="nav-text">Order Management</span>
                   </a>
                </li>
                        <li><a href="product_managment.html">
                      <i class="flaticon-050-info mr-0"></i>
                         <span class="nav-text">Product Management</span>
                      </a>
                        </li>
                        <li><a href="revenue_managment.html">
                         <i class="flaticon-381-video-camera"></i>
                         <span class="nav-text">Revenue Management</span>
                      </a>
                        </li>
                        <li><a href="report_mgt.html">
                         <i class="flaticon-086-star"></i>
                         <span class="nav-text">Report Management</span>
                      </a>
                        </li>
                        
                       
                <li><a href="login.html">
                   <i class="flaticon-381-lock"></i>
                   <span class="nav-text">Logout</span>
                </a>
             </li>
                    </ul>
                </div>
            </div>
            <!--**********************************
            Sidebar end
        ***********************************-->

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
                        <h2 class="mb-3 me-auto">Report Management</h2>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="DZ_W_Todo1" class="widget-media dz-scroll ps ps--active-y">
                                            <ul class="timeline">
                                                <li>
                                                    <div class="timeline-panel">
                                                          <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 1</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                        <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 2</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                            <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 3</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                           <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 4</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                            <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 5</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                           
                                                <li>
                                                    <div class="timeline-panel">
                                                        <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 7</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="DZ_W_Todo1" class="widget-media dz-scroll ps ps--active-y">
                                            <ul class="timeline">
                                                <li>
                                                    <div class="timeline-panel">
                                                          <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 8</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                        <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 9</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                            <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 10</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                           <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 11</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                            <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 12</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-panel">
                                                            <!-- <div class="media me-2">
                                                            <img alt="image" width="50" src="images/avatar/1.jpg" /> 
                                                        </div> -->
                                                        <div class="media-body">
                                                            <h5 class="mb-1">Ticket No 13</h5>
                                                            <span><strong>info@gmail.com</strong></span>
                                                            <small class="d-block fs-6 pe-5">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum Duis quis orem ipsum dolor sit amet, consectetur adipiscing elit....
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary light sharp px-3 mx-2" data-bs-toggle="modal" data-bs-target="#reportModalCenter">Reply</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                    </div>
                </div>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->

            <!--**********************************
            Footer start
        ***********************************-->
            <div class="footer">
                
           
                <div class="copyright">
                    <p>Copyright © Designed &amp; Developed by 2022</p>
                </div>
            </div>
            <!--**********************************
            Footer end
        ***********************************-->
        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->
        <!-- Modal edit -->
        <div class="modal fade" id="reportModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <label class="mb-1"><strong>To</strong></label>
                                <input type="email" class="form-control" placeholder="" />
                            </div>
                            <div class="mb-3">
                                <label class="mb-1"><strong>Message</strong></label>
                                <textarea class="form-control h-25" rows="6" cols="5" id="comment"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
        Scripts
    ***********************************-->
        <!-- Required vendors -->
        <script src="js/global.min.js"></script>
        <!-- Dashboard 1 -->
        <script src="js/custom.min.js"></script>
        
        <!-- Datatable -->
        <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="js/datatables.init.js"></script>	
        <script src="js/deznav-init.js"></script>
    </body>
</html>
