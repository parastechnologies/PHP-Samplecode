<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Order Management</h2>
         <td>
            <a class="btn btn-primary btn-sm" href="<?php echo $adminBaseURL; ?>orders/create">Create Order</a>
         </td>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="custom-tab-1 card p-4">
              <!-- <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab" class="nav-link active show">In Progress Order</a>
                  </li>
                  <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">Past Orders</a>
                  </li>
               </ul>-->
               <!-- <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Past Orders</a>
                  </li> -->
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
                                                <th>Email</th>
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
                                                <td>
                                                   <div class="icon_imgs">
                                                      <div class="name">
                                                         <?php echo $order['email']; ?> 
                                                      </div>
                                                   </div>
                                                </td>
                                                <td><?php echo $currencySign.$order['grandTotal']; ?></td>
                                                <td>
                                                    <?php if($order['status'] == 1){ ?>
                                                    <span class="btn bgl-success text-success btn-sm">
                                                       Pick up
                                                    </span>
                                                    <?php } else if($order['status'] == 2) { ?>
                                                    <span class="btn bgl-success text-success btn-sm">
                                                       Delivered
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
                                          <!--      <td>
                                                   <div class="dropdown ml-auto">
                                                      <!--<div class="btn-link" data-bs-toggle="dropdown" >
                                                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.0005 12C11.0005 12.5523 11.4482 13 12.0005 13C12.5528 13 13.0005 12.5523 13.0005 12C13.0005 11.4477 12.5528 11 12.0005 11C11.4482 11 11.0005 11.4477 11.0005 12Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M18.0005 12C18.0005 12.5523 18.4482 13 19.0005 13C19.5528 13 20.0005 12.5523 20.0005 12C20.0005 11.4477 19.5528 11 19.0005 11C18.4482 11 18.0005 11.4477 18.0005 12Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M4.00049 12C4.00049 12.5523 4.4482 13 5.00049 13C5.55277 13 6.00049 12.5523 6.00049 12C6.00049 11.4477 5.55277 11 5.00049 11C4.4482 11 4.00049 11.4477 4.00049 12Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                         </svg>
                                                      </div>
                                                      <div class="dropdown-menu dropdown-menu-right">
                                                      -->
                                            <!--            <?php if($order['status'] == 0 ){ ?>
                                                        <a  class="dropdown-item text-black" 
                                                            id="accept" 
                                                            onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,1,1)" 
                                                            href="javascript:void(0);"
                                                        >
                                                            <i class="far fa-check-circle me-1 text-success"></i>Accept order
                                                        </a>
                                                        <a 
                                                            class="dropdown-item text-black" 
                                                            id="reject" 
                                                            onClick="changetOrderStatus(<?php echo  "'".base64_encode($order['orderID'])."'"; ?>,4,1)" 
                                                            href="javascript:void(0);"
                                                        >
                                                            <i class="far fa-times-circle me-1 text-danger"></i>Reject order
                                                        </a>
                                                        <?php } else if($order['status'] == 1 || $order['status'] == 2){ ?>
                                                        <a class="dropdown-item text-black" href="javascript:void(0);">
                                                             <i class="far fa-check-circle me-1 text-success"></i>Accepted
                                                        </a>
                                                        <?php } else if($order['status'] == 4 || $order['status'] == 5) { ?>
                                                        <a class="dropdown-item text-black" href="javascript:void(0);">
                                                             <i class="far fa-check-circle me-1 text-success"></i>Rejected
                                                        </a>
                                                        <?php } ?>-->
                                                      <!--</div>
                                                   </div>
                                                </td>-->
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
               <!--   <div id="about-me" class="tab-pane fade">
                     <div class="row m-4">
                        <div id="example_wrapper" class="dataTables_wrapper no-footer">
                           <table id="example" class="display dataTable no-footer" role="grid" aria-describedby="example_info">
                              <thead>
                                 <tr>
                                    <th>Order ID</th>
                                    <th>Email</th>
                                    <th>Price</th>
                                    <th>Status Order</th>
                                    <th>View Order</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php foreach($pastOrders as $pOrder){ ?>  
                                 <tr>
                                    <td><?php echo $pOrder['orderNumber']; ?></td>
                                    <td>
                                       <div class="icon_imgs">
                                          <div class="name">
                                             <?php echo $pOrder['email']; ?> 
                                          </div>
                                       </div>
                                    </td>
                                    <td><?php echo $currencySign.$pOrder['grandTotal']; ?></td>
                                    <td>
                                        <?php if($pOrder['status'] == 3){ ?>
                                        <span class="btn bgl-success text-success btn-rounded btn-sm">
                                           Deliveried
                                        </span>
                                        <?php } else if($pOrder['status'] == 4) { ?>
                                        <span class="btn bgl-success text-success btn-rounded btn-sm">Cancel</span>
                                        <?php } else { ?>
                                        <span class="btn bgl-danger text-danger btn-rounded btn-sm">Refund</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                       <div class="d-flex align-items-center">
                                           <a role="button" class="btn btn-primary btn-sm me-2" 
                                            href="<?php echo $adminBaseURL; ?>order/detail/<?php echo base64_encode($pOrder['orderID']); ?>">View Orders</a>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>