<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Update Product</h2>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body p-0">
                  <div class="table-responsive review-table border-0">
                     <form action="<?php echo $adminBaseURL; ?>product/update/<?php echo base64_encode($product['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?php echo $messageBoard; ?>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                              <input type="file" class="form-control rounded-0" name="icon[]" multiple accept="image/*">
                           </div>
                           <div class="form-group mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                              <input type="text" class="form-control rounded-0" name="name" value="<?php echo $product['name']; ?>" placeholder="Enter product name">
                           </div>
                           <div class="form-group mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Price</label>
                              <input type="number" class="form-control rounded-0" name="price" placeholder="Enter Price" value="<?php echo $product['price']; ?>">
                           </div>
                           <div class="form-group mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Description</label>
                              <textarea class="form-control rounded-0 productDescriptionClass" name="description" placeholder="Enter description">
                                  <?php echo $product['description']; ?>
                              </textarea>
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">compatibility</label>
                              <textarea class="form-control rounded-0 productDescriptionClass" name="compatibility" placeholder="Enter Compatibility">
                                  <?php echo $product['compatibility']; ?>
                              </textarea>
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Shipping and Returns</label>
                              <textarea class="form-control rounded-0 productDescriptionClass" name="shipping" placeholder="Enter Shipping and returns">
                                  <?php echo $product['shipping']; ?>
                              </textarea>
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Device Type</label>
                              <select class="form-control" name="deviceTypeID">
                                <option value="">Select Device Types</option>
                                  <?php foreach($deviceTypes as $deviceType) { ?>
                                    <option value="<?php echo $deviceType['id']; ?>" <?php echo $deviceType['id'] == $product['deviceTypeID'] ? "selected" : ""; ?>>
                                        <?php echo $deviceType['typeName']; ?>
                                    </option>
                                  <?php } ?>
                              </select>
                            </div>
                           <div class="form-group mb-3">
                              <div class="field_wrapper">
                                 <div>  
                                <label for="exampleFormControlInput1" class="form-label">Images with color</label> 
                                <select class="form-control checkcolorVal" name="color[]" id="sel1">
                                    <option value="">Select color</option>
                                    <?php 
                                    foreach($colors as $color) {
                                        $searchArray = in_array($color['id'],$selectColors,true);
                                        if(!$searchArray){
                                     ?>
                                        <option value="<?php echo $color['id']; ?>" data-value="0"><?php echo $color['colorName']; ?></option>
                                    <?php } }?>
                                 </select>
                                </div> 
                                 <div class="">
                                     <input type="file" class="form-control productVarients" name="inputVal" value="" id="imageVal0" data-role="tagsinput">
                                    <!--<input type="file"  class="form-control rounded-0" name="image" value="">-->
                                </div>
                              </div>
                             <a href="javascript:void(0);" class="btn btn-primary btn-sm px-4 add_button" title="Add field">add</a>
                           </div>
                        </div>
                         <div class="modal-footer justify-content-center">
                           <button type="submit" class="btn btn-primary btn-sm px-4">Submit</button>
                         </div>  
                     </form>
                  </div>
               </div>
            </div>
         </div>
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
                              <th>Color</th>
                              <th>Image</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($images as $image1){
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $image1['colorID'] != NULL ?  $image1['colorName'] : "" ; ?></td>
                              <td>
                                  <?php if($image1['image']){ ?>
                                    <img src="<?php echo $productImagePath.$image1['image']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                  <?php } ?>
                              </td> 
                              <td>
                                  <a 
                                        onClick="return alert('Do you want to delete this image')"                
                                        role="button" class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>product/image/delete/<?php echo base64_encode($image1['id']); ?>/<?php echo base64_encode($product['id']); ?>">
                                        delete
                                    </a>
                              </td>
                           </tr>
                           <?php }  ?>
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
<!-- Modal -->