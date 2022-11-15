<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Pages Management</h2>
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
                              <th>title</th>
                              <th>Content</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 1;
                              foreach($pages as $page){ 
                                $string = $page['content'];
                                $string = strip_tags($string);
                                if (strlen($string) > 300) {
                                
                                    // truncate string
                                    $stringCut = substr($string, 0, 300);
                                    $endPoint = strrpos($stringCut, ' ');
                                
                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                }
                            ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $page['title']; ?></td>
                              <td><?php echo $string; ?></td>
                              <td>
                                 <div class="d-flex align-items-center">
                                    <a  role="button" 
                                        class="btn btn-primary btn-sm me-2" 
                                        href="<?php echo $adminBaseURL; ?>pages/<?php echo base64_encode($page['id']); ?>">
                                        update
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