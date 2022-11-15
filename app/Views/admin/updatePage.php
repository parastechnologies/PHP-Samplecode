<div class="content-body">
   <div class="container-fluid">
      <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
         <h2 class="mb-3 me-auto">Update Page</h2>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body p-0">
                  <div class="table-responsive review-table border-0">
                     <form action="<?php echo $adminBaseURL; ?>page/update" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?php echo $messageBoard; ?>
                            <input type="hidden" name="pageID" value="<?php echo $page['id'];?>">
                           <div class="form-group mb-3">
                              <input type="text" class="form-control rounded-0" name="title" value="<?php echo $page['title']; ?>" placeholder="Enter Page title" required>
                           </div>
                           <div class="form-group mb-3">
                              <textarea  id="mytextarea" class="form-control rounded-0" name="content" placeholder="Enter Title" required>
                                  <?php echo $page['content']; ?>
                              </textarea>
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
