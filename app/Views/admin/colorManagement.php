<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Color Management</h2>
         <td>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#colorModal">Add Color</button>
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
                              <th>Color Name</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($colors as $color){ 
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $color['colorName']; ?></td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <a role="button" onClick="javascript: return confirm('Do you want to delete this color?');" 
                                        class="btn btn-primary btn-sm me-2" href="<?php echo $adminBaseURL; ?>color/delete/<?php echo base64_encode($color['id']); ?>">Delete</a>
                                 </div>
                              </td>
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
<!-- Modal -->
<div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addColorSub" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <h4 class="mb-3 me-auto">Add Color</h4>
               <h5 class="mb-3 me-auto colorError" style="color:red;display:none"></h5>
               <h5 class="mb-3 me-auto colorSuccess" style="color:green;display:none"></h5>
               <div class="form-group mb-3">
                  <input type="text" class="form-control rounded-0" name="colorName" placeholder="Enter color name">
               </div>
            </div>
            <div class="modal-footer justify-content-center">
               <button type="submit" class="btn btn-primary btn-sm px-4">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>