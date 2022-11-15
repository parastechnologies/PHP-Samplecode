<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Product Management</h2>
         <td>
            <a href="<?php echo $adminBaseURL; ?>product/add" class="btn btn-primary btn-sm">Add Product</a>
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
                              <th>Image</th>
                              <th>Product Name</th>
                              <th>Price</th>
                              <th>Device Type</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($products as $product){
                                  $statusMessage = $product['status'] == 1 ? 'Deactivate' : 'Activate';
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td>
                                  <?php if($product['image']){ ?>
                                    <img src="<?php echo $productImagePath.$product['image']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                  <?php } ?>
                              </td>
                              <td><?php echo $product['name']; ?></td>
                              <td><?php echo $product['price']; ?></td>
                              <td><?php echo $product['typeName']; ?></td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <a 
                                        onClick="return confirm('Do you want to <?php echo $statusMessage; ?> product')"                
                                        role="button" class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>product/delete/<?php echo base64_encode($product['id']); ?>">
                                        <?php echo $statusMessage; ?>
                                    </a>
                                    <a 
                                        role="button" class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>product/detail/<?php echo base64_encode($product['id']); ?>">
                                        View
                                    </a>
                                    <a 
                                        role="button" class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>product/update/<?php echo base64_encode($product['id']); ?>">
                                        Update
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
