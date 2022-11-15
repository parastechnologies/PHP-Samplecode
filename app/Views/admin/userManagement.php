
<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">User Management</h2>
         <td>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importUserModal">Import User</button>
         </td>
      </div>
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <td>
             <div class="form-group mb-3">
                <select class="form-control rounded-0" id="filterUser">
                    <option value="public" selected>Public</option>
                    <option value="private">Private</option>
                    <option value="business">Business</option>
                </select>    
              </div>
         </td>
      </div>
      <div class="row">
         <div>
            <div class="col-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="table-responsive review-table border-0">
                        <table id="users" class="display">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Image</th>
                                 <th>Full Name</th>
                                 <th>Email</th>
                                 <th>Plan</th>
                                 <th>View</th>
                                 <th>Action</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                            <?php 
                            $i = 1; 
                                foreach($users as $user) {?>   
                              <tr>
                                 <td><?php echo $i++; ?></td>
                                <td>
                                    <?php if($user['userProfile']){?>
                                    <img src="<?php echo $userImagePath.$user['userProfile']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                    <?php } else { ?>
                                    <img src="<?php echo $imageURL; ?>avatar/1.jpg" class="rounded-lg me-2" width="35" alt=""> 
                                    <?php } ?>
                                    
                                 </td>
                                 <td><?php echo $user['firstName'].'&nbsp;'.$user['lastName'];?></td>
                                 <td><?php echo $user['email'];?></td>
                                 <td><?php echo $user['plan'];?></td>
                                 <td>
                                     <div class="d-flex align-items-center">
                                        <a  role="button" 
                                            class="btn btn-primary btn-sm me-2" 
                                            href="<?php echo $adminBaseURL; ?>user/<?php echo base64_encode($user['id']); ?>">View
                                        </a>
                                    </div>
                                </td>
                                 <td>
                                    <a 
                                        id="statusBtnID<?php echo $user['id']; ?>"
                                        href="javascript:void(0);" 
                                        class="dropdown-item text-black"
                                        OnClick = "changetstatus(<?php echo $user['id']; ?>,<?php echo $user['status']; ?>)">
                                        
                                        <?= $user['isSuspended'] == 1 ? '<i class="far fa-times-circle me-1 text-danger"></i>Suspended' :
                                        '<i class="far fa-check-circle me-1 text-success"></i>Unsuspended'; ?>
                            </a>  
                            </td>
                            <td>public</td>
                            <td><?php echo $user['PID'] ? 'private' : ''; ?></td>
                            <td><?php echo $user['BID'] ? 'business' : ''; ?></td>
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

<div class="modal fade" id="importUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addUserImport" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <h4 class="mb-3 me-auto">Add Users</h4>
               <h5 class="mb-3 me-auto userImportError" style="color:red;display:none"></h5>
               <h5 class="mb-3 me-auto userImportSuccess" style="color:green;display:none"></h5>
               <div class="form-group mb-3">
                  <input type="file" class="form-control rounded-0" name="file">
               </div>
            </div>
            <div class="modal-footer justify-content-center">
               <button type="submit" class="btn btn-primary btn-sm px-4">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>