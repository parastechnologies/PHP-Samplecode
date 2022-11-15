 <section class="team-banner  d-flex align-items-center justify-content-center">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="banner-text">
                     Orders

                  </h1>
               </div>
            </div>
         </div>
      </section>
      <section class="video-bn">
         
         <div class="container">
            <div class="row d-flex align-items-center">
         <div class="col-12">
            <div class="custom-tab-1 card p-4">
               <div class="tab-content">
                  <div id="my-posts" class="tab-pane fade active show">
                     <div class="row">
                        <div>
                           <div class="col-12">
                              <div class="cards">
                                 <div class="card-body p-0">
                                    <div class="table-responsive review-table border-0">
                                       <table id="example" class="display">
                                          <thead>
                                             <tr>
                                                <th>Order ID</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>View Order</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                            <?php 
                                            foreach($orders as $order){ ?>  
                                             <tr>
                                                <td><?php echo $order['orderNumber']; ?></td>
                                                <td><?php echo $currencySign.$order['grandTotal']; ?></td>
                                                <td>
                                                    <?php if($order['status'] == 1){ ?>
                                                    <span class="btn bgl-success text-success btn-sm">
                                                       Confirmed
                                                    </span>
                                                    <?php } else if($order['status'] == 2) { ?>
                                                    <span class="btn bgl-success text-success btn-sm">
                                                       Payment Failed
                                                    </span>
                                                    <?php } else { ?>
                                                    <span id="pending" class="btn bgl-danger text-success btn-sm">In Process</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                   <div class="d-flex align-items-center">
                                                      <a role="button" class="btn btn-primary btn-sm me-2" 
                                                      href="<?php echo $adminBaseURL; ?>order/<?php echo base64_encode($order['orderID']); ?>">View Orders</a>
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
               </div>
            </div>
         </div>
         </div>
      </section>