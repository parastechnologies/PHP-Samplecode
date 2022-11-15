<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
       <div class="col-lg-6">
        <p><?php echo $messageBoard; ?></p>
       </div>
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head justify-content-between">
         <h2 class="mb-3 me-auto">Order Details</h2>
         <div class="d-flex align-items-center">
            <?php if($order['orderStatus'] == 0) { ?> 
            <a href="" data-toggle="modal" class="btn btn-primary btn-sm me-2 accept" onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,1,0)" data-bs-toggle="modal" data-bs-target="#suspendModal"> 
            <i class="far fa-check-circle me-1 "></i>In Process</a>
            <!--<a href="" data-toggle="modal" class="btn btn-primary btn-sm me-2 accept" onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,1,0)" data-bs-toggle="modal" data-bs-target="#suspendModal"> 
            <i class="far fa-check-circle me-1 "></i>Accept</a>
            <a href="" data-toggle="modal" class=" btn btn-primary btn-sm me-2 reject" onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,4,0)" data-bs-toggle="modal" data-bs-target="#suspendModal1">  
            <i class="far fa-check-circle me-1 "></i>Reject</a>-->
            <?php } else if($order['orderStatus'] == 4) { ?>
            <!--<a href="" data-toggle="modal" class=" btn btn-primary btn-sm me-2 accept" onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,5,0)" data-bs-toggle="modal" data-bs-target="#suspendModal1">
                 <i class="fa fa-person-dolly"></i>Deliverd</a>-->
            <?php } else if($order['orderStatus'] == 1) {  ?>
            <a href="" data-toggle="modal" class=" btn btn-primary btn-sm me-2 accept" onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,2,0)" data-bs-toggle="modal" data-bs-target="#suspendModal1">  
            <i class="fa fa-truck-pickup me-1"></i>PickUp</a>
            <?php } else if($order['orderStatus'] == 2) { ?>
            <a href="" data-toggle="modal" class=" btn btn-primary btn-sm me-2 accept" onClick="changetOrderStatus(<?php echo "'".base64_encode($order['orderID'])."'"; ?>,3,0)" data-bs-toggle="modal" data-bs-target="#suspendModal1">
                 <i class="fa fa-person-dolly"></i>Deliverd</a>
            <?php } ?>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-lg-12">
         <div class="cards">
            <div class="card-body">
               <div class="wideget-user">
                  <div class="row  align-items-start">
                     <div class="col-lg-6  col-md-6 col-xl-6">
                        <div class="card card-block card-stretch card-height">
                           <div class="card-body">
                              <div class="ms-panel ms-panel-fh">
                                 <div class="ms-panel-body">
                                    <div class="header-title">
                                       <h4 class="text-heads">Order Summary</h4>
                                    </div>
                                    <table class="table ms-profile-information">
                                       <tbody>
                                          <tr>
                                             <td scope="row" class="h_text"><b>Order Number</b></td>
                                             <td scope="row"><?php echo $order['orderNumber']; ?></td>
                                          </tr>
                                          <tr>
                                              <?php if($order['isCheck'] == 1) { ?> 
                                             <td scope="row" class="h_text"><b>Customer Name</b></td>
                                             <td scope="row"><?php echo $order['firstName'].'&nbsp;'.$order['lastName']; ?></td>
                                             <?php } else { ?>
                                             <td scope="row" class="h_text"><b>Company Name</b></td>
                                             <td scope="row"><?php echo $order['companyName']; ?></td>
                                             <?php } ?>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text"><b>Email</b></td>
                                             <td scope="row"><?php echo $order['email']; ?></td>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text"><b>Phone</b></td>
                                             <td scope="row"><?php echo $order['phoneNumber']; ?></td>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text">
                                                <b>
                                                Shipping Address
                                                </b>
                                             </td>
                                             <td scope="row">
                                                 <?php echo $order['address'].'&nbsp;'.$order['city'].'&nbsp;'.$order['state'].'&nbsp;'.$order['countryCode'].'&nbsp;'.$order['zipcode']; ?>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-xl-6">
                        <div class="card card-block card-stretch card-height">
                           <div class="card-body">
                              <div class="ms-panel ms-panel-fh">
                                 <div class="ms-panel-body">
                                    <div class="header-title">
                                       <h4 class="text-heads">Payment Details</h4>
                                    </div>
                                    <table class="table ms-profile-information">
                                       <tbody>
                                           <tr>
                                             <td scope="row" class="h_text"><b>Order Status</b></td>
                                             <td scope="row"><?php echo $statusMessage; ?></td>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text"> <b>
                                                Payment Method
                                                </b> 
                                             </td>
                                             <td scope="row">
                                                <?php echo $order['cardType']; ?> 
                                             </td>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text"> <b>
                                                Transaction ID
                                                </b> 
                                             </td>
                                             <td scope="row">
                                                <?php echo $order['transactionID']; ?> 
                                             </td>
                                          </tr>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text"> <b> Sub Total
                                                </b> 
                                             </td>
                                             <td scope="row"> <?php echo $currencySign.$order['subTotal']; ?></td>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text">
                                                <b>Discount
                                                </b>  
                                             </td>
                                             <td scope="row"> <?php echo $currencySign.$order['discount']; ?></td>
                                          </tr>
                                          <tr>
                                             <td scope="row" class="h_text">
                                                <b>Grand Total
                                                </b>  
                                             </td>
                                             <td scope="row"> <?php echo $currencySign.$order['grandTotal']; ?></td>
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
  <!-- <div class="row">
      <div class="col-lg-12">
         <div class="cards">
            <div class="card-body">
               <div class="wideget-user">
                  <div class="row  align-items-start">
                     <div class="col-lg-12 col-md-12 col-xl-12">
                        <div class="card card-block">
                           <div class="card-body">
                              <div class="d-flex align-items-center mb-3">
                              </div>
                              <div class="ms-panel ms-panel-fh">
                                 <div class="ms-panel-body">
                                    <!--<div class="header-title">
                                       <h4 class="text-heads mb-4 mt-4">Order Status</h4>
                                    </div>-->
                                    <!--<ul class="orders">
                                       <li class="active">
                                          <a href="javascript:void(0);">
                                             <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M32.764 37.0455C33.0967 37.0339 33.409 37.1955 33.5079 37.5633C33.9617 39.2583 35.9523 39.7855 37.6573 38.6972L37.324 38.1189C37.104 37.7044 37.4195 37.0044 38.0301 37.1261L40.4956 37.6211C41.2823 37.7772 41.5951 38.3439 41.3462 39.0883L40.5417 41.4755C40.4401 41.7728 40.1801 41.9616 39.9079 41.965C39.6967 41.965 39.4823 41.8522 39.3323 41.5939L38.9295 40.8972C38.2384 41.3628 37.4945 41.6494 36.754 41.75C34.4217 42.0689 32.4601 40.795 31.8234 38.4133C31.6006 37.5705 32.2106 37.065 32.764 37.0455ZM33.2962 31.235C33.5079 31.235 33.7245 31.3444 33.8723 31.605L34.2773 32.3016C34.969 31.8361 35.7129 31.5478 36.4506 31.4489C38.7823 31.1311 40.7445 32.4039 41.384 34.7855C41.7401 36.1333 39.9629 36.6194 39.7001 35.635C39.2462 33.94 37.2523 33.4128 35.5479 34.5011L35.8834 35.0794C36.1034 35.4939 35.7851 36.1939 35.1751 36.07L32.7095 35.5772C31.9251 35.4178 31.6101 34.8533 31.859 34.1111L32.6629 31.7228C32.764 31.4255 33.024 31.2372 33.2962 31.235ZM36.6034 28.2194C31.974 28.2194 28.224 31.9694 28.2212 36.5994C28.224 41.2261 31.974 44.9783 36.6034 44.9783C41.2301 44.9783 44.9834 41.2261 44.9834 36.5994C44.9834 31.9694 41.2301 28.2194 36.6034 28.2194Z" fill="white"></path>
                                                <path d="M17.9202 19.4605H27.0263C27.8424 19.4605 28.5019 20.1177 28.5019 20.9339V21.7266C28.5019 22.5422 27.8419 23.1989 27.0263 23.1989H17.9202C17.1013 23.1989 16.4446 22.5422 16.4446 21.7266V20.9339C16.4446 20.1177 17.1013 19.4605 17.9202 19.4605ZM6.79686 15.5139C5.81297 15.5139 5.02075 16.365 5.02075 17.4233V42.0472C5.02075 43.1061 5.81353 43.9572 6.79686 43.9572H28.513C26.7452 42.0128 25.6541 39.4344 25.6541 36.5994C25.6541 30.5544 30.5558 25.6533 36.603 25.6533C37.5958 25.6533 38.5508 25.7977 39.4646 26.0439V17.4233C39.4646 16.365 38.6719 15.5139 37.688 15.5139H6.79686Z" fill="white"></path>
                                                <path d="M23.9647 5.92219L25.0531 13.315H37.6453C38.3486 13.315 38.7914 12.5283 38.4414 11.8944L35.2297 7.34052C34.7436 6.4633 33.8381 5.92274 32.8597 5.92274H23.9647V5.92219ZM11.627 5.92219C10.6486 5.92219 9.74306 6.46274 9.25695 7.33996L6.04528 11.8938C5.69473 12.5277 6.13751 13.3144 6.84084 13.3144H19.4336L20.5219 5.92163H11.627V5.92219Z" fill="white"></path>
                                             </svg>
                                          </a>
                                          <h4>Order Created</h4>
                                          <span>
                                          <?php 
                                            if($order['createdDate'] != NULL){
                                                $format = new dateTime($order['createdDate']);
                                                echo $format->format('D,d M Y h:i A'); 
                                            }
                                          ?>
                                          </span>
                                       </li>
                                       <li class="active">
                                          <a href="javascript:void(0);">
                                             <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M31.25 4.6875H18.75C17.0241 4.6875 15.625 6.08661 15.625 7.8125V10.9375C15.625 12.6634 17.0241 14.0625 18.75 14.0625H31.25C32.9759 14.0625 34.375 12.6634 34.375 10.9375V7.8125C34.375 6.08661 32.9759 4.6875 31.25 4.6875Z" fill="#FD683E"></path>
                                                <path d="M33.8218 18.75H16.1783C14.2616 18.75 12.5379 19.917 11.8261 21.6966L6.36183 35.3572C5.9513 36.3836 6.70717 37.5 7.81258 37.5H42.1876C43.293 37.5 44.0488 36.3836 43.6383 35.3572L38.1741 21.6966C37.4622 19.917 35.7387 18.75 33.8218 18.75Z" fill="#FD683E"></path>
                                                <path d="M15.625 25C15.625 25.863 16.3245 26.5625 17.1875 26.5625H26.5625C27.4255 26.5625 28.125 25.863 28.125 25C28.125 24.137 27.4255 23.4375 26.5625 23.4375H17.1875C16.3245 23.4375 15.625 24.137 15.625 25Z" fill="white"></path>
                                                <path d="M31.25 26.5625C30.387 26.5625 29.6875 25.863 29.6875 25C29.6875 24.137 30.387 23.4375 31.25 23.4375H32.8125C33.6755 23.4375 34.375 24.137 34.375 25C34.375 25.863 33.6755 26.5625 32.8125 26.5625H31.25Z" fill="white"></path>
                                                <path d="M20.3125 40.625C20.3125 41.488 21.012 42.1875 21.875 42.1875H28.125C28.988 42.1875 29.6875 41.488 29.6875 40.625C29.6875 39.762 28.988 39.0625 28.125 39.0625H21.875C21.012 39.0625 20.3125 39.762 20.3125 40.625Z" fill="white"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M31.2501 4.6875H18.7501C17.0241 4.6875 15.6251 6.08661 15.6251 7.8125V10.9375C15.6251 12.6634 17.0241 14.0625 18.7501 14.0625H23.4376V18.75H16.1783C14.2616 18.75 12.5379 19.917 11.8261 21.6966L6.3752 35.3238C6.34583 35.3925 6.32123 35.4638 6.30184 35.537C6.25947 35.6948 6.24317 35.853 6.25006 36.0073V42.1875C6.25006 44.7764 8.34873 46.875 10.9376 46.875H39.0626C41.6515 46.875 43.7501 44.7764 43.7501 42.1875V36.008C43.7571 35.8512 43.7402 35.6906 43.6965 35.5305C43.6776 35.4598 43.6537 35.3913 43.6254 35.3248L38.1741 21.6966C37.4622 19.917 35.7387 18.75 33.8218 18.75H26.5626V14.0625H31.2501C32.976 14.0625 34.3751 12.6634 34.3751 10.9375V7.8125C34.3751 6.08661 32.976 4.6875 31.2501 4.6875ZM18.7501 10.9375V7.8125H31.2501V10.9375H18.7501ZM39.8797 34.375H10.1204L14.7276 22.8572C14.9648 22.2641 15.5394 21.875 16.1783 21.875H33.8218C34.4607 21.875 35.0354 22.2641 35.2726 22.8572L39.8797 34.375ZM9.37506 42.1875V37.5H40.6251V42.1875C40.6251 43.0505 39.9255 43.75 39.0626 43.75H10.9376C10.0746 43.75 9.37506 43.0505 9.37506 42.1875Z" fill="white"></path>
                                             </svg>
                                          </a>
                                          <h4>Payment Success</h4>
                                          <span>  
                                          <?php 
                                              if($order['transactionDate'] != NULL){
                                                $format1 = new dateTime($order['transactionDate']);
                                                echo $format1->format('D,d M Y h:i A');
                                              }
                                          ?></span>
                                       </li>
                                       <li class="process">
                                          <a href="javascript:void(0);">
                                             <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M35.2718 22.9973H38.7934C39.2218 23.0006 39.2595 23.0084 39.3662 23.4106L40.3468 27.3084C40.5379 28.1328 40.5701 28.1645 39.7512 28.1645H35.3707C34.8007 28.1645 34.6584 28.1828 34.6584 27.3867V23.6662C34.6584 23.0317 34.7862 22.9973 35.2718 22.9973ZM21.4351 14.1917C21.4501 14.4317 21.4701 14.6723 21.4701 14.9156C21.4701 20.6795 16.7973 25.3517 11.0329 25.3517C9.88677 25.3517 8.78788 25.1584 7.75732 24.8167V37.6012C7.75732 38.8706 8.62843 39.895 9.71343 39.895H13.1045L13.0984 39.7562C13.0984 36.5423 15.7029 33.9378 18.9179 33.9378C22.1301 33.9378 24.7368 36.5423 24.7368 39.7562C24.734 39.8028 24.7307 39.8495 24.7284 39.895H29.9945L29.989 39.7562C29.989 36.5423 32.5934 33.9378 35.8084 33.9378C39.0201 33.9378 41.624 36.5423 41.624 39.7562C41.624 39.8028 41.6212 39.8495 41.6179 39.895H45.2701C46.2107 39.895 46.9657 39.0073 46.9657 37.9073V34.6323C46.9657 32.9362 46.4218 31.7245 45.5418 30.7367L43.2795 28.2017L41.8907 22.2589C41.6012 20.7889 40.8951 20.2767 39.324 20.2767H33.3218V15.9973C33.3218 14.7278 32.4473 14.1917 31.3634 14.1917H21.4351Z" fill="#FD683E"></path>
                                                <path d="M18.9176 41.4228C19.8376 41.4228 20.5843 40.6761 20.5843 39.7561C20.5843 38.8361 19.8376 38.0895 18.9176 38.0895C17.9976 38.0895 17.2509 38.8361 17.2509 39.7561C17.2509 40.6761 17.9981 41.4228 18.9176 41.4228ZM18.9176 44.2006C16.4637 44.2006 14.4731 42.2106 14.4731 39.7561C14.4731 37.3028 16.4637 35.3117 18.9176 35.3117C20.0959 35.3117 21.2265 35.7806 22.0598 36.6139C22.8931 37.4473 23.362 38.5789 23.362 39.7561C23.362 42.2106 21.3709 44.2006 18.9176 44.2006Z" fill="#FD683E"></path>
                                                <path d="M35.8077 38.0895C36.7277 38.0895 37.4744 38.8361 37.4744 39.7561C37.4744 40.6761 36.7277 41.4228 35.8077 41.4228C34.8866 41.4228 34.1411 40.6761 34.1411 39.7561C34.1411 38.8361 34.8866 38.0895 35.8077 38.0895ZM35.8077 35.3117C33.3538 35.3117 31.3655 37.3028 31.3633 39.7561C31.3633 40.9345 31.8311 42.065 32.6644 42.8984C33.4977 43.7317 34.63 44.2006 35.8077 44.2006C36.9877 44.2006 38.1166 43.7317 38.9499 42.8984C39.7866 42.065 40.2522 40.9345 40.2522 39.7561C40.2522 37.3028 38.2644 35.3117 35.8077 35.3117Z" fill="#FD683E"></path>
                                                <path d="M7.54278 15.8261C7.87555 15.8144 8.18778 15.9761 8.28667 16.3439C8.74056 18.0389 10.7311 18.5661 12.4361 17.4778L12.1028 16.8994C11.8828 16.485 12.1983 15.785 12.8089 15.9067L15.2744 16.4017C16.0611 16.5578 16.3739 17.1244 16.125 17.8689L15.3206 20.2561C15.2189 20.5533 14.9589 20.7422 14.6867 20.7456C14.4756 20.7456 14.2611 20.6328 14.1111 20.3744L13.7083 19.6778C13.0172 20.1433 12.2733 20.43 11.5328 20.5306C9.20055 20.8494 7.23889 19.5756 6.60222 17.1939C6.37945 16.3511 6.98944 15.8456 7.54278 15.8261ZM8.075 10.0156C8.28667 10.0156 8.50333 10.125 8.65111 10.3856L9.05611 11.0822C9.74778 10.6167 10.4917 10.3283 11.2294 10.2294C13.5611 9.91167 15.5233 11.1844 16.1628 13.5661C16.5189 14.9139 14.7417 15.4 14.4789 14.4156C14.025 12.7206 12.0311 12.1933 10.3267 13.2817L10.6622 13.86C10.8822 14.2744 10.5639 14.9744 9.95389 14.8506L7.48833 14.3578C6.70389 14.1983 6.38889 13.6339 6.63778 12.8917L7.44167 10.5033C7.54278 10.2061 7.80278 10.0178 8.075 10.0156ZM11.3822 7C6.75278 7 3.00278 10.75 3 15.38C3.00278 20.0067 6.75278 23.7589 11.3822 23.7589C16.0089 23.7589 19.7622 20.0067 19.7622 15.38C19.7622 10.75 16.0089 7 11.3822 7Z" fill="#624FD1"></path>
                                             </svg>
                                          </a>
                                          <h4>Pickup</h4>
                                          <span><?php 
                                              if($order['pickupDate'] != NULL){
                                                $format2 = new dateTime($order['pickupDate']);
                                                echo $format2->format('D,d M Y h:i A');
                                              }
                                          ?></span>
                                       </li>
                                       <li>
                                          <a href="javascript:void(0);">
                                             <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.42733 32.6639C6.519 32.6639 5.78955 33.1361 5.78955 33.7205V44.5572C5.78955 45.1411 6.519 45.61 7.42733 45.61H9.64677C10.5557 45.61 11.2846 45.1411 11.2846 44.5572V33.7205C11.2846 33.1355 10.5557 32.6639 9.64677 32.6639H7.42733ZM18.2834 31.5189C16.4607 31.6233 15.1096 32.3522 14.1896 33.3333C13.7034 33.8511 13.4229 34.9467 13.4229 35.6589V43.0267C13.4229 44.4533 14.5801 45.61 16.0068 45.61H32.7718C33.2984 45.61 33.8162 45.445 34.2446 45.1389L43.7323 36.6778C45.3096 35.37 42.7779 32.9655 39.2329 35.0111L32.9946 38.7144C32.1296 39.2122 31.5907 39.3078 30.6418 39.3078H23.8162C21.799 39.3078 22.0918 37.245 23.8707 37.245H29.9357C32.4646 37.245 32.4618 33.6133 29.9357 33.2033L20.2623 31.6344C19.5834 31.5472 18.8796 31.4844 18.2834 31.5189Z" fill="#624FD1"></path>
                                                <path d="M35.2716 5.50891C36.2205 5.50891 37.0944 6.0328 37.5666 6.88391L40.6738 11.2906C41.0122 11.9017 40.5811 12.5722 39.9044 12.6645H27.0544L26.0005 5.50891H35.2716Z" fill="#9B9B9B"></path>
                                                <path d="M10.0541 14.2817C9.10245 14.2817 8.33301 15.1061 8.33301 16.1306V30.6822H9.64634C10.4625 30.6822 11.2869 30.7983 11.9408 31.3278C12.6208 31.8767 12.3491 32.12 13.278 31.4311C15.633 29.6789 17.9797 29.2622 20.5952 29.6872L30.2686 31.2517C30.963 31.3644 31.5558 31.6683 32.0941 32.0222C32.5313 32.3111 32.6613 33.0333 33.1619 33.0333H39.9469C40.8997 33.0333 41.6663 32.21 41.6663 31.1856V16.13C41.6663 15.1056 40.8997 14.2811 39.9469 14.2811H10.0541V14.2817Z" fill="#9B9B9B"></path>
                                                <path d="M14.7278 5.50891C13.7811 5.50891 12.905 6.0328 12.4328 6.88391L9.32559 11.2906C8.98726 11.9017 9.42059 12.5722 10.0956 12.6645H22.945L23.9984 5.50947H14.7278V5.50891Z" fill="#9B9B9B"></path>
                                             </svg>
                                          </a>
                                          <h4>Order Delivered</h4>
                                          <span><?php 
                                              if($order['deliveredDate'] != NULL){
                                                $format3 = new dateTime($order['deliveredDate']);
                                                echo $format3->format('D,d M Y h:i A');
                                              }
                                          ?></span>
                                       </li>
                                    </ul>
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
   </div>-->
   <div class="row m-4">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="table-responsive order-table border-0">
                  <table id="example" class="display pb-0 dataTable no-footer">
                     <thead>
                        <tr>
                           <th>Sr. No</th>
                           <th>Product Image</th>
                           <th>Product Name</th>
                           <th>Product Price</th>
                           <th>Product Qty</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $i = 1;
                           foreach($items as $item) {  ?>  
                        <tr class="selected" role="row">
                           <td><?php echo $i++; ?></td>
                           <td>
                              <div class="icon_imgs">
                                 <div class="main-icn">
                                    <?php if($item['image']){ ?>
                                    <img src="<?php echo $productImagePath.$item['image']; ?>" class="me-2" width="85" height="85" alt=""> 
                                    <?php } else { ?>
                                    <img src="<?php echo $imageURL; ?>3.png" class="me-2" width="85" height="85" alt=""> 
                                    <?php } ?>
                                 </div>
                              </div>
                           </td>
                           <td>
                              <?php echo $item['name']; ?>
                           </td>
                           <td> <?php echo $currencySign.$item['itemPrice']; ?></td>
                           <td><?php echo $item['itemQty']; ?></td>
                           <td><?php echo $currencySign.$item['itemQtyPrice']; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                           <td colspan="5" class="text-right">
                              <b>Sub Total:</b>
                           </td>
                           <td><?php echo $currencySign.$order['subTotal']; ?></td>
                        </tr>
                        <!--<tr>
                           <td colspan="5" class="text-right">
                              <b>
                              Discount (-):
                              </b> 
                           </td>
                           <td><?php echo $currencySign.$order['discount']; ?></td>
                        </tr>
                        <tr>
                           <td colspan="5" class="text-right">
                              <b>
                              Grand Total:
                              </b> 
                           </td>
                           <td><?php echo $currencySign.$order['grandTotal']; ?></td>
                        </tr>-->
                     </tbody>
                  </table>
   <?php
   /*$url = "https://dev.sycapay.net/api/login.php";
        $paramsend = [
        "montant" => "10",
        "currency" => "XOF"
        ];
        $headers = array
        (
            'X-SYCA-MERCHANDID:C_626BCDCF101EE',
            'X-SYCA-APIKEY:pk_syca_e692ddb9dbc219e760d3c058542f965beb18c70e',
            'X-SYCA-REQUEST-DATA-FORMAT:JSON' ,
            'X-SYCA-RESPONSE-DATA-FORMAT:JSON'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($paramsend));
        $response = json_decode(curl_exec($ch),TRUE);
        print_r($response);
        if( empty($response) )
        {
        echo "Error Number:".curl_errno($ch)." <br>"; echo "Error
        String:".curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        curl_close($ch);*/

?>                  
<!--<form method="post" action=" https://dev.sycapay.net/index.php">
<input type="hidden" name="token" value="5655c40fc88b2cdc1e224a10ff21db99b21424925e625c0bed2b27957f340fe3">
<input type="hidden" name="amount" value="100">
<input type="hidden" name="currency" value="XOF">
<input type="hidden" name=" numpayeur" value="XXXXXXXX">
<input type="hidden" name=" name" value="Doe">
<input type="hidden" name=" pname" value="Jonh">
<input type="hidden" name=" emailpayeur" value="jonh.doe@incognito.com">
<input type="hidden" name="urls" value="votreUrldeSuccess">
<input type="hidden" name="urlc" value="VotreUrlCancel">
<input type="hidden" name=" commande" value="COMTEST">
<input type="hidden" name="merchandid" value=" C_626BCDCF101EE">
<input type="hidden" name="typpaie" value=" payement">
<input type="hidden" name="nameplugin" value=" plugin">
<input type="submit" value="valider">
</form>-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
