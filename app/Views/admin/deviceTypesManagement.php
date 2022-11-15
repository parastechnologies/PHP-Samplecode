<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Types Management</h2>
         <td>
            <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deviceTypeModal">Add New Type</a>
         </td>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
                <?php echo $messageBoard; ?> 
               <div class="card-body p-0">
                  <div class="table-responsive review-table border-0">
                    <table id="example" class="display">
                        <thead>
                           <tr>
                              <th>Sr. No</th>
                              <th>Icon</th>
                              <th>Type Name</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($types as $type){ 
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td>
                                  <?php if($type['icon']){ ?>
                                    <img src="<?php echo $TypeImagePath.$type['icon']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                  <?php } ?>
                              </td>
                              <td><?php echo $type['typeName']; ?></td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <?php if($type['isCheck'] == 1) { ?>
                                    <a 
                                        role="button" class="btn btn-primary btn-sm me-2" 
                                        href="javascript:void(0)"
                                        onClick="alert('You can not delete this device type because this device is connect with tags')">
                                        Delete
                                    </a>
                                    <?php } else { ?>
                                    <a 
                                        onClick="return confirm('Do you want to delete device type?')"                
                                        role="button" class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>device/type/delete/<?php echo base64_encode($type['id']); ?>">
                                        Delete
                                    </a>
                                    <?php } ?>
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
<div class="modal fade" id="deviceTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addDeviceTypeSub" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <h4 class="mb-3 me-auto">Add Device Type</h4>
               <h5 class="mb-3 me-auto deviceTypeError" style="color:red;display:none"></h5>
               <h5 class="mb-3 me-auto deviceTypeSuccess" style="color:green;display:none"></h5>
               <div class="form-group mb-3">
                  <input type="file" class="form-control rounded-0" name="icon">
               </div>
               <div class="form-group mb-3">
                  <input type="text" class="form-control rounded-0" name="typeName" placeholder="Enter type name">
               </div>
            </div>
            <div class="modal-footer justify-content-center">
               <button type="submit" class="btn btn-primary btn-sm px-4">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>