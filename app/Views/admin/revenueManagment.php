<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Revenue Management</h2>
         <td>Total Amount: $<?php echo count($revenues)
         *10; ?></td>
      </div>
      <div class="row">
         <div class="col-12">
               <div class="tab-content">
                  <div id="my-posts" class="tab-pane fade active show">
                     <div class="row">
                        <div>
                           <div class="col-12">
                              <div class="cards">
                                 <div class="card-body p-0">
                                    <div class="table-responsive review-table border-0">
                                       <table id="example" class="display">
                                          <thead>
                                             <tr>
                                                <th>Sr.No.</th> 
                                                <th>Image</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Plan</th>
                                                <th>Source</th>
                                                <th>Amount</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach($revenues as $revenue){ ?>  
                                            <tr>
                                                 <td><?php echo $i++; ?></td>
                                                <td>
                                                    <?php if($revenue['userProfile']){?>
                                                    <img src="<?php echo $userImagePath.$revenue['userProfile']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                                    <?php } else { ?>
                                                    <img src="<?php echo $imageURL; ?>avatar/1.jpg" class="rounded-lg me-2" width="35" alt=""> 
                                                    <?php } ?>
                                                 </td>
                                                 <td><?php echo $revenue['firstName'].'&nbsp;'.$revenue['lastName'];?></td>
                                                 <td><?php echo $revenue['email'];?></td>
                                                 <td><?php echo $revenue['plan'];?></td>
                                                 <td><?php echo $revenue['source'];?></td>
                                                 <td>$10</td>
                                              </tr>
                                             <?php } ?>
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
   </div>
</div>