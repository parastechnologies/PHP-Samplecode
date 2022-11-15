
<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head justify-content-between">
         <h2 class="mb-3 me-auto">Product Details</h2>
         <a href="<?php echo $adminBaseURL; ?>product/update/<?php echo base64_encode($product['id']); ?>" class="btn btn-primary btn-sm">Edit  Product</a>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="cards">
               <div class="card-body">
                  <div class="wideget-user">
                     <div class="row">
                        <div class="col-lg-3 col-md-3 col-xl-3">
                           <div class="card card-block card-stretch ">
                              <div class="cards">
                                 <div class="card-bodys p-3 product-img">
                                     <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                      <div class="carousel-inner">
                                        <?php $i = 1; foreach($images as $image) { ?>  
                                        <div class="carousel-item <?php echo $i == 1 ? 'active' : ''; ?>">
                                          <img src="<?php echo $productImagePath.$image['image']; ?>" class="d-block w-100" alt="...">
                                        </div>
                                        <?php $i++;  } ?>
                                      </div>
                                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                      </button>
                                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                      </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-9  col-md-9 col-xl-9">
                           <div class="card card-block">
                              <div class="card-body">
                                 <div class="d-flex align-items-center mb-3">
                                 </div>
                                 <div class="ms-panel ms-panel-fh">
                                    <div class="ms-panel-body">
                                       <div class="header-title">
                                          <!--<h4 class="text-heads">Product Detail</h4>-->
                                       </div>
                                       <table class="table ms-profile-information">
                                          <tbody>
                                             <tr>
                                                <td scope="row" class="h_text"><b>Product Name</b></td>
                                                <td scope="row"><?php echo $product['name']; ?></td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text"> <b>
                                                   Device Type
                                                   </b> 
                                                </td>
                                                <td scope="row">
                                                   <?php echo $product['typeName']; ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text">
                                                   <b>
                                                   Product Price
                                                   </b>
                                                </td>
                                                <td scope="row"><?php echo $currencySign.$product['price']; ?></td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text">
                                                   <b>
                                                    Product Description
                                                   </b>
                                                </td>
                                                <td scope="row"><?php echo $product['description']; ?></td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text">
                                                   <b>
                                                   Product Compatibility
                                                   </b>
                                                </td>
                                                <td scope="row"><?php echo $product['compatibility']; ?></td>
                                             </tr>
                                             <tr>
                                                <td scope="row" class="h_text">
                                                   <b>
                                                   Product Shipping
                                                   </b>
                                                </td>
                                                <td scope="row"><?php echo $product['shipping']; ?></td>
                                             </tr>
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
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($images as $image1){
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $image1['colorID'] != NULL ? $image1['colorName'] : ""; ?></td>
                              <td>
                                  <?php if($image1['image']){ ?>
                                    <img src="<?php echo $productImagePath.$image1['image']; ?>" class="rounded-lg me-2" width="35" alt=""> 
                                  <?php } ?>
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


