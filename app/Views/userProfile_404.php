<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <title>Maara</title>

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
            body {
                margin: 0px;
                padding: 0px;
                background-color: rgba(0,0,0,0.4);
                font-family: "Raleway", sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .info-wrap {
                width: 313px;
                margin: 0 auto;
                padding: 0px 21px;
                height: auto;
                background: #fff;
                border: 2px solid #2b98fc;
                border-radius: 17px;
                text-align: center;
                box-sizing: border-box;
            }
            .modal-content.modal_profile p {
                font-size: 15px;
                color: #000;
                font-weight: 600;
                padding: 0 35px;
            }
            
            
            .mx-auto.profile-img {
              display: block;
              margin: 0px auto;
              text-align: center;
            }
            
            
            .modal_profile {
                display: flex;
                justify-content: center;
                align-content: center;
            }
            
              #myModal {
                background: #f2f2f2;
                border-radius: 5px;
              }
            
              .info-wrap1 {
                width: 400px;
                margin: 0 auto;
                overflow: hidden;
                padding: 0 40px;
                background: #fff;
                height: calc(100vh - 72px);
                display: flex;
                align-items: center;
              }
            
              .modal-body {
                padding: 22px;
              }
              h4.changeText {
                font-weight: 500;
             }
                    
        </style>
    </head>
    <body>
        <div class="info-wrap light-text">
            <div class="buttons button_box ">
            <!--New Modal -->
                <div id="myModal" class="modal fade modal_block" role="dialog">
                       <div class="modal-dialog">
                    <!-- Modal content-->
                        <div class="modal-content modal_profile">
                           <div class="modal-body">
                               <div class="mx-auto profile-img">
                                 <img src="<?php echo base_url(); ?>/assets/front/images/deactivate-account.svg" alt="img">
                               <div>
                               <h4 class="changeText">The Profile or device is NOT active</h4>
                          <!--  <p>Activate your profile from the settings tab</p>
                            <p>OR</p>
                            <p>Activate your device from the Device tab</p>-->
                          </div>
                        </div>
                    </div>
                </div>    
            </div>
                </div>    
            </div>
        </div>
    </body>
</html>
