<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Add Product</h2>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body p-0">
                  <div class="table-responsive review-table border-0">
                     <form action="<?php echo $adminBaseURL; ?>product/add" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?php echo $messageBoard; ?>
                           <div class="form-group mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                              <input type="file" class="form-control rounded-0" name="icon[]" multiple accept="image/*">
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                              <input type="text" class="form-control rounded-0" name="name" placeholder="Enter product name">
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Price</label>
                              <input type="number" class="form-control rounded-0" name="price" placeholder="Enter Price">
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Description</label>
                              <textarea class="form-control rounded-0 productDescriptionClass" name="description" placeholder="Enter description"></textarea>
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Compatibility</label>
                              <textarea class="form-control rounded-0 productDescriptionClass" name="compatibility" placeholder="Enter Compatibility"></textarea>
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Shipping and returns</label>
                              <textarea class="form-control rounded-0 productDescriptionClass" name="shipping" placeholder="Enter Shipping and returns"></textarea>
                           </div>
                           <div class="form-group mb-3">
                               <label for="exampleFormControlInput1" class="form-label">Device Type</label>
                              <select class="form-control" name="deviceTypeID">
                                <option value="">Select Device Types</option>
                                  <?php foreach($deviceTypes as $deviceType) { ?>
                                    <option value="<?php echo $deviceType['id']; ?>"><?php echo $deviceType['typeName']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                           <div class="form-group mb-3">
                              <div class="field_wrapper">
                                 <div>  
                                 <label for="exampleFormControlInput1" class="form-label">Images with color</label>
                                <select class="form-control checkcolorVal" name="color[]" id="sel1">
                                    <option value="">Select color</option>
                                    <?php foreach($colors as $color) { ?>
                                        <option value="<?php echo $color['id']; ?>" data-value="0"><?php echo $color['colorName']; ?></option>
                                    <?php } ?>
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
   </div>
</div>
<!-- Modal -->
