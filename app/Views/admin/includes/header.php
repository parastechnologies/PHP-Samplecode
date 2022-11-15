<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- PAGE TITLE HERE -->
      <title>Maara</title>
      <!-- Datatable -->
      <link href="<?php echo $baseURLVendor; ?>datatables/css/jquery.dataTables.min.css" rel="stylesheet">
      <!-- Style css -->
      <link href="<?php echo $baseURLCSS; ?>style-new.css" rel="stylesheet">
   </head>
   <style>
    /*  #main-wrapper
      {
      height: 100vh!important;
      }*/
          .form-control {
  background: #fff;
  border: 0.0625rem solid #f5f5f5;
  padding: 0.3125rem 1.25rem;
  color: #6e6e6e;
      height: 3.5rem;
  border-radius: 7px;
    }
   </style>
   <body>
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
      <div id="main-wrapper">
      <!--**********************************
         Nav header start
         ***********************************-->
      <div class="nav-header">
         <a href="<?php echo $adminBaseURL ?>dashboard" class="brand-logo">
         <!--<img src="<?php echo $imageURL; ?>logo_sm.png" class="img-fluid logo-small mx-auto" alt="">
         <img src="<?php echo $imageURL; ?>logo_mix.svg" class="img-fluid logo-big mx-auto" alt="" width="100%"/></a>-->
         <div class="nav-control">
            <div class="hamburger">
               <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
         </div>
      </div>
      <div class="header">
         <div class="header-content">
            <nav class="navbar navbar-expand">
               <div class="collapse navbar-collapse justify-content-end">
                  <ul class="navbar-nav header-right ml-auto">
                     <li class="nav-item dropdown  header-profile">
                        <a class="nav-link" href="javascript:void(0);">
                        <img src="<?php echo $imageURL; ?>avatar/profile-1.jpg" width="56" alt=""/>
                        </a>
                        <a href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-chevron-down ms-3 text-primary"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <a href="<?php echo $adminBaseURL; ?>logout" class="dropdown-item ai-icon">
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
      <?php include('sidebar.php'); ?>