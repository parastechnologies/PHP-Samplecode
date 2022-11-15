<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Social Management</h2>
         <td>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deviceModal">Add Social</button>
         </td>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body p-0">
                  <div class="table-responsive review-table border-0">
                    <table id="example" class="display">
                        <thead>
                           <tr>
                              <th>Sr. No</th>
                              <th>Icon</th>
                              <th>Type</th>
                              <th>Link</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($socials as $social){ 
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td>
                                  <?php if($social['icon']){  ?>
                                  <img src="<?php echo $socialImagePath.$social['icon']; ?>" class="rounded-lg me-2" width="50" alt="">
                                  <?php } ?>
                              <td><?php echo $social['type']; ?></td>
                              <td><?php echo $social['link']; ?></td>
                              <td>
                                 <div class="d-flex align-items-center">
                                     <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#deviceModal<?php echo $social['id']; ?>">Update</button>
                                    <a  role="button" 
                                     class="btn btn-primary btn-sm me-2"
                                        onClick="return confirm('Do you want to Delete this')"
                                        href="<?php echo $adminBaseURL; ?>social/delete/<?php echo $social['id']; ?>">
                                        Delete
                                    </a>
                                 </div>
                              </td>
                           </tr>
                           <div class="modal fade" id="deviceModal<?php echo $social['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <form class="addSocialUpdate" method="post" enctype="multipart/form-data" id="<?php echo $social['id']; ?>">
                                    <div class="modal-body">
                                       <h4 class="mb-3 me-auto">Update Social</h4>
                                       <h5 class="mb-3 me-auto deviceError" style="color:red;display:none"></h5>
                                       <h5 class="mb-3 me-auto deviceSuccess" style="color:green;display:none"></h5>
                                       <input type="hidden" value="<?php echo $social['id']; ?>" name="id">
                                       <div class="form-group mb-3">
                                           <label>Upload icon</label>
                                            <?php if($social['icon']){  ?>
                                          <img src="<?php echo $socialImagePath.$social['icon']; ?>" class="rounded-lg me-2" width="50" alt="">
                                          <?php } ?>
                                          <input type="file" class="form-control rounded-0" name="icon">
                                       </div>
                                       <div class="form-group mb-3">
                                          <input type="text" class="form-control rounded-0" name="link" placeholder="Enter Link" value="<?php echo $social['link']; ?>" required>
                                       </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                       <button type="submit" class="btn btn-primary btn-sm px-4">Submit</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
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
<!-- Modal -->
<div class="modal fade" id="deviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addSocialub" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <h4 class="mb-3 me-auto">Add Social</h4>
               <h5 class="mb-3 me-auto deviceError" style="color:red;display:none"></h5>
               <h5 class="mb-3 me-auto deviceSuccess" style="color:green;display:none"></h5>
               <div class="form-group mb-3">
                   <label>Upload icon</label>
                  <input type="file" class="form-control rounded-0" name="icon" required>
               </div>
               <div class="form-group mb-3">
                  <input type="text" class="form-control rounded-0" name="link" placeholder="Enter Link" required>
               </div>
               <div class="form-group mb-3">
                  <div class="form-group">
                     <select class="form-control" name="type" id="sel1" required>
                        <option value="">Select Social Types</option>
                        <?php foreach($types as $type) {?>
                            <option value="<?php echo $type; ?>">
                                <?php echo $type; ?>
                            </option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer justify-content-center">
               <button type="submit" class="btn btn-primary btn-sm px-4">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>