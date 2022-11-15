<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">User View Detail</h2>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="cards">
               <div class="card-body">
                  <div class="wideget-user">
                     <div class="row">
                        <div class="col-lg-4 col-md-4 col-xl-4">
                           <div class="card card-block card-stretch card-height">
                              <div class="card-bodys p-0">
                                 <div class="main-content">
                                    <div class="profile-img mx-auto mt-4">
                                         <?php if($user['userProfile']){ ?>
                                           <img src="<?php echo $userImagePath.$user['userProfile']; ?>" class="img-fluid avatar-110" alt="profile-image">
                                         <?php } else { ?>
                                            <img src="<?php echo $imageURL; ?>avatar/2.jpg" class="img-fluid avatar-110" alt="profile-image">
                                         <?php } ?>
                                    </div>
                                    <h4 class="text-center mt-4 mb-2 name-text">
                                       <b> Name:</b> <?php echo $user['firstName'].'&nbsp;'.$user['lastName'];?>
                                    </h4>
                                    <div class="d-flex align-items-center justify-content-center pt-2">
                                       <div>
                                          <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="pink-color" width="18" height="18" 
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                             <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                             <polyline points="22,6 12,13 2,6"></polyline>
                                          </svg>
                                       </div>
                                       <div>
                                          <h5 class="mb-0 ps-2 text-muted"><?php echo $user['email'];?></h5>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-8  col-md-8 col-xl-8">
                           <div class="card card-block">
                              <div class="card-body">
                                 <div class="d-flex align-items-center mb-3">
                                 </div>
                                 <div class="ms-panel ms-panel-fh">
                                    <div class="ms-panel-body">
                                       <div class="header-title">
                                          <h3 class="text-heads">Basic Information</h3>
                                       </div>
                                       <table class="table ms-profile-information">
                                          <tbody>
                                             <tr>
                                                <td scope="row" class="h_text"><b> Name</b></td>
                                                <td scope="row"><?php echo $user['firstName'].'&nbsp;'.$user['lastName'];?></td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text">
                                                   <b>
                                                   Designation
                                                   </b>
                                                </td>
                                                <td scope="row"><?php echo $user['designation'];?></td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text">
                                                   <b>
                                                   Description
                                                   </b>
                                                </td>
                                                <td scope="row"><?php echo $user['description'];?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
       <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Private Accounts</h2>
      </div>  
    <div class="row">
        <div>
            <div class="col-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="table-responsive review-table border-0">
                        <table id="example" class="display">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Image</th>
                                 <th>Private Account Name</th>
                                 <th>Description</th>
                              </tr>
                           </thead>
                           <tbody>
                            <?php 
                            $i = 1; 
                            foreach($privates as $private) { ?>   
                              <tr>
                                 <td><?php echo $i++; ?></td>
                                <td>
                                    <?php if($private['privateUserProfile']){?>
                                    <img src="<?php echo $privateAccountImage.$private['privateUserProfile']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                    <?php } else { ?>
                                    <img src="<?php echo $imageURL; ?>avatar/1.jpg" class="rounded-lg me-2" width="35" alt=""> 
                                    <?php } ?>
                                    
                                 </td>
                                 <td><?php echo $private['privateAccountName'];?></td>
                                 <td><?php echo $private['privateAccountDescription'];?></td>
                              </tr>
                             <?php } ?> 
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
         <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Business Accounts</h2>
      </div>
       <div class="row">
        <div>
            <div class="col-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="table-responsive review-table border-0">
                        <table id="example2" class="display">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Image</th>
                                 <th>Business Name</th>
                                 <th>Description</th>
                              </tr>
                           </thead>
                           <tbody>
                            <?php 
                            $j = 1; 
                            foreach($businesses as $business) { ?>   
                              <tr>
                                <td><?php echo $j++; ?></td>
                                <td>
                                    <?php if($business['businessProfile']){?>
                                    <img src="<?php echo $businessAccountImage.$business['businessProfile']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                    <?php } else { ?>
                                    <img src="<?php echo $imageURL; ?>avatar/1.jpg" class="rounded-lg me-2" width="35" alt=""> 
                                    <?php } ?>
                                    
                                 </td>
                                 <td><?php echo $business['businessName'];?></td>
                                 <td><?php echo $business['businessDescription'];?></td>
                              </tr>
                             <?php } ?> 
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
