<style>
input[data-readonly] {
  pointer-events: none;
}
</style>
<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Create Order</h2>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body p-0">
                  <div class="table-responsive review-table border-0">
                     <form action="<?php echo $adminBaseURL; ?>orders/create" method="post">
                        <div class="modal-body">
                            <?php echo $messageBoard; ?>
                            <div class="">
                              <div class="row clearfix">
                                <div class="col-md-12">
                                  <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                      <tr>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> Product </th>
                                        <th class="text-center"> Color </th>
                                        <th class="text-center"> Qty </th>
                                        <th class="text-center"> Price </th>
                                        <th class="text-center"> Total </th>
                                        <th class="text-center"> Delete </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>
                                            <select name='products[]' class="form-control selectProduct" id="pro0"/>
                                                <option value="">Select Product</option>
                                                <?php foreach($products as $product){ ?>
                                                    <option value="<?php echo $product['id']; ?>" data-id="<?php echo $product['price']; ?>">
                                                        <?php echo $product['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select  class="form-control selectColor" name="colorVal_0" value="" id="colorID0"/>
                                            </select>
                                        </td>
                                        <td><input type="number" name='qtyVal_0' id="0qty" placeholder='Enter Qty' value="1" class="form-control qty" step="0" min="0"/></td>
                                        <td><input type="number" name='price' id="pro0qty"  placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" readonly/></td>
                                        <td><input type="number" name='total'  id="pro0qtyproductTotal" placeholder='0.00' class="form-control total" readonly/></td>
                                        <td></td>
                                      </tr>
                                      <!--<tr id='addr1'></tr>-->
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="row clearfix">
                                <div class="col-md-12">
                                  <button type="button" id="add_row" class="btn btn-default pull-left">Add</button></div>
                              </div>
                              <div class="row clearfix" style="margin-top:20px">
                                <div class="pull-right col-md-8"></div>
                                <div class="pull-right col-md-4">
                                  <table class="table table-bordered table-hover" id="tab_logic_total">
                                    <tbody>
                                      <tr>
                                        <th class="text-center">Sub Total</th>
                                        <td class="text-center">
                                            <input type="text" name='subTotal' placeholder='0.00' class="form-control totalAmount" id="subTotal" readonly/>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-center">Grand Total</th>
                                        <td class="text-center">
                                            <input type="text" name="grandTotal" id="grandTotal" value="" placeholder='0.00' class="form-control" required data-readonly style="pointer-events: none;"/>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                           <div class="form-group mb-3">
                              <input type="text" class="form-control rounded-0" name="companyName" placeholder="Enter Company name" >
                           </div>
                           <div class="form-group mb-3">
                              <input type="email" class="form-control rounded-0" name="email" placeholder="Enter Email" required>
                           </div>
                           <div class="form-group mb-3">
                              <input type="text" class="form-control rounded-0" name="phoneNumber" placeholder="Enter Phone Number" required>
                           </div>
                           <div class="form-group mb-3">
                              <textarea class="form-control rounded-0" name="address" placeholder="Enter Address" required></textarea>
                           </div>
                           <div class="form-group mb-3">
                              <select class="form-control" name="status">
                                <option value="0">Pending</option>
                                <option value="1">Process</option>
                                <option value="3">Delivered</option>
                              </select>
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