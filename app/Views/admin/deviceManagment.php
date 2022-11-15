<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Device Management</h2>
         <td>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deviceModal">Add Device</button>
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
                              <th>Name</th>
                              <th>Device Number</th>
                              <th>Link</th>
                              <th>QR Code</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($devices as $device){ 
                                  $statusMessage = $device['status'] == 1 ? 'Unblock' : 'Block';
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $device['deviceName']; ?></td>
                              <td><?php echo $device['deviceNumber']; ?></td>
                              <td style="word-break: break-word;">
                                  <?php echo $device['deviceURL'];//$device['privateprofileLink'],$device['businessprofileLink'],$device['staffprofileLink'],$device['profileLink']; ?></td>
                              <td>
                                  <?php 
                                /*  if($device['privateQRCode'] || $device['businessQRCode'] || $device['staffQRCode'] || $device['QRCode'])
                                  {
                                      ?>
                                      <img src="<?php echo $QRcodePath.$device['privateQRCode'],$device['businessQRCode'],$device['staffQRCode'],$device['QRCode']; ?>" width="100" height="100">
                                      <?php 
                                  }*/
                                  ?>
                                  <?php 
                                  if($device['qrCode'])
                                  {
                                      ?>
                                      <img src="<?php echo $QRcodePath.$device['qrCode']; ?>" width="100" height="100">
                                      <?php 
                                  }
                                  ?>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <a  role="button" 
                                        onClick="return confirm('Do you want to <?php echo $statusMessage; ?> device')" 
                                        class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>device/block/<?php echo base64_encode($device['id']); ?>">
                                        <?php echo $statusMessage; ?>
                                    </a>
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
<div class="modal fade" id="deviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addDeviceSub" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <h4 class="mb-3 me-auto">Add Device</h4>
               <h5 class="mb-3 me-auto deviceError" style="color:red;display:none"></h5>
               <h5 class="mb-3 me-auto deviceSuccess" style="color:green;display:none"></h5>
               <div class="form-group mb-3">
                  <input type="text" class="form-control rounded-0" name="deviceName" placeholder="Enter device name">
               </div>
               <div class="form-group mb-3">
                  <input type="text" class="form-control rounded-0" name="deviceNumber" placeholder="Enter device number">
               </div>
               <div class="form-group mb-3">
                  <div class="form-group">
                     <select class="form-control" name="deviceType" id="sel1">
                        <option value="">Select Device Types</option>
                        <?php foreach($types as $type) {?>
                            <option value="<?php echo $type['id']; ?>">
                                <?php echo $type['typeName']; ?>
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