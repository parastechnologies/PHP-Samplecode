<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/bPopup/0.11.0/jquery.bpopup.js"></script>
        <title>Maara</title>
          <script>
        function redirect_to ( device, slug, content, base_url, linking_url ) { 
            if ( content.indexOf("http://") == 0 || content.indexOf("https://") == 0 ) {
                if ( device == 'web' ) {
                    window.location.href = content;
                } else {
                    window.location.href = linking_url + content;
                    setInterval(function () {
                        window.location.replace( content );
                    }, 6000);
                }
            } else {
                if ( device == 'web' ) {
                    window.location.href = base_url + content;
                } else {
                    window.location.href = linking_url + content;
                    setInterval(function () {
                        window.location.replace( base_url + content );
                    }, 6000);
                }
            }
        }
        
    </script>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
            body {
                margin: 0px;
                padding: 0px;
                background-color: #fff;
                font-family: "Raleway", sans-serif;
            }
            body h2,h3,h5, p {
                color: <?php echo $data['colorID'] == 4 ? '#000000' : '#ffffff'; ?> !important;
            }
            .links img {
                width: 97px;
            }
            .info-wrap {
                width: 400px;
                margin: 0 auto;
                overflow: auto;
                padding: 0px 13px;
                height: 100vh;
                background: <?php echo $data['color']; ?>;
            }

            .img-left {
                position: relative;
            }
            .profile-data h3 {
                font-weight: normal;
                margin: 0px 0 17px 0;
                /*color: #ffffff;*/
            }
            .pargh_block p {
                font-size: 18px;
                margin-top: 7px;
                padding: 0px 0 0px 0px;
                width: auto;
                line-height: 22px;
                padding: 17px;
                text-align: center;
                /*color: #676a71;*/
            }
            p {
                font-size: 18px;
            }
            .me-5 {
                float: right;
                margin: 5px 0 0;
            }
            .links a {
                display: inline-block;
                text-decoration: none;
                width: 32%;
                text-align: center;
            }
            .links span {
                text-align: center;
                display: block;
                margin: 0px 0 15px;
                font-size: 16px;
                color: #000;
                font-weight: 500;
            }
            a.btn.btn-primary.connected_btn {
                width: auto;
                -webkit-box-flex: 0.9;
                -ms-flex-positive: 0.9;
                flex-grow: 0.9;
                background: <?php echo $data['colorID'] != 4 ? '#ffffff' : '#0d0d0d'; ?>;
            }
            a.btn.btn-primary.connected_btn img {
                float: right;
                padding-top: 5px;
            }
            p.pargh_blocks {
                text-align: left;
                color: #fff;
            }
            .logo_info {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                align-items: center;
            }
            .logo_info img {
                width: 90px;
                height: 90px;
                object-fit: cover;
            }
            .main_block {
                background: rgba(255, 255, 255, 0.1);
                -webkit-box-shadow: 0px 2px 6px rgb(0 0 0 / 7%);
                box-shadow: 0px 2px 6px rgb(0 0 0 / 7%);
                padding: 11px;
                border-radius: 12px;
                margin: 23px 0;
            }
            .logo_img.logo_info h3 {
                margin-left: 30px;
                color:#fff;
            }

            .info-s {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }

            .user_list {
                display: block;
                background: rgba(255, 255, 255, 0.1);
                -webkit-box-shadow: 0px 2px 6px rgb(0 0 0 / 7%);
                box-shadow: 0px 2px 6px rgb(0 0 0 / 7%);
                padding: 11px;
                border-radius: 12px;
                margin: 23px 0;
                color: #fff;
            }
            p.m-0 {
                margin: 0;
            }
            .user_header {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                border-bottom: 1px solid #e7e2e2;
                padding: 10px 0;
            }
            span.name {
                font-size: 17px;
                text-align: left;
            }
            .user_header h5 {
                font-size: 19px;
                margin: 0;
            }
            .main-img img {
                width: 37px;
                height: 37px;
                border-radius: 30px;
            }
            p.name-title {
                font-size: 17px;
                font-weight: bold;
                margin: 0 10px;
            }
            .info-s {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                padding: 5px 0;
            }
            .overflow-scroll {
                overflow-y: auto;
                height: 128px;
            }
            #style-1::-webkit-scrollbar-thumb {
                border-radius: 10px;
                box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            }
            #style-1::-webkit-scrollbar {
                width: 4px;
            }

            #style-1::-webkit-scrollbar-thumb {
                border-radius: 20px;
                border: 3px solid #cda053;
            }

            p.name-title {
                margin: 0;
                font-size: 17px;
                font-weight: bold;
                margin: 7px 10px;
            }
            /*responsive*/
            .info-wrap1 {
                width: 400px;
                margin: 0 auto;
                overflow: hidden;
                padding: 0 40px;
                background: #fff;
                height: calc(100vh - 72px);
            }
            /**/
         
            .profile {
                margin: 14px auto;
                display: block;
                text-align: center;
            }
            .img-left img {
                width: 90px;
                height: 90px;
                border-radius: 10px;
                object-fit: cover;
            } 
            .profile-data h2 {
                font-size: 20px;
                font-weight: 600;
                margin: 0 0 12px;
                color: #fff;
                margin-bottom: 0px;
                line-height: 30px;
            }
            .pargh_block .btn-primary {
                background: #ffffff;
                padding: 13px 17px;
                border-radius: 6px;
                color: <?php echo $data['colorID'] == 4 ? '#ffffff' : '#000000'; ?>;
                text-decoration: none;
                font-size: 14px;
            }
            .download_btn path {
                fill: black;
            }
            .links span {
                text-align: center;
                display: block;
                margin: 0px 0 15px;
                font-size: 14px;
                color: #fff;
                font-weight: 500;
            }
            .links {
                margin-top: 23px;
                border-radius: 15px 15px 0 0;
                padding: 10px 9px 13px 12px;
                /* background: rgb(252, 249, 243); */
                /* background: -webkit-gradient(linear, left top, left bottom, from(rgba(252, 249, 243, 1)), color-stop(37%, rgba(248, 248, 248, 1))); */
                background: -o-linear-gradient(top, rgba(252, 249, 243, 1) 0%, rgba(248, 248, 248, 1) 37%);
                /* background: linear-gradient(180deg, rgba(252, 249, 243, 1) 0%, rgba(248, 248, 248, 1) 37%); */
                background: rgba(255, 255, 255, 0.1);
            }
            h3.text-center {
                text-align: center;
                padding: 7px 0 10px;
                color: #fff;
            }
            .button_all {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                gap: 7px;
            }
            /**/
            /* popup*/
            .button.b-close {
                border-radius: 7px 7px 7px 7px;
                font: bold 131% sans-serif;
                padding: 0 6px 2px;
                position: absolute;
                right: 12px;
                top: 9px;
                cursor: pointer;
                color: #1c1b1b;
            }
            #connected_form {
                width: 350px;
                height: 400px;
                background: #fff;
                display: none;
                border-radius: 17px;
                padding: 15px;
                text-align: center;
                font-family: 'texta_altregular';
            }
            .connected_wrap h2 {
                font-size: 24px;
            }
            .connected_wrap p {
                color: #8f8787;
                padding: 0 20px;
            }
            .connected_block input {
                width: 240px;
                background: #EFEFEF;
                border: 0;
                padding: 12px;
                margin: 0 auto 13px;
                border-radius: 8px;
            }
            .connected_block .btn {
                background: #2B98FC;
                color: #fff;
                font-size: 16px;
                width: 76%;
                cursor: pointer;
            }
            .status-msg ul {
              list-style: none;
              color: red;
              font-style: italic;
              font-size: 14px;
              padding: 0;
            }
            .status-msg p {
                color:green;
            }
            /**/
            @media screen and (max-width: 390px) {
                .header {
                    padding: 0px 10px;
                    width: auto;
                }
                .info-wrap {
                    width: auto;
                    padding: 10px 10px;
                }
                .img-left {
                    margin-right: 12px;
                }
                .buttons .btn,
                .buttons a {
                    width: auto;
                }
                .profile-data h2 {
                    margin: 5px 0;
                }
                .img-left img {
                    max-width: 78px;
                }
            }
            
            /*not found*/
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
    <?php
    if ( ! empty ( $data['platforms'] ) ) {
        foreach ( $data['platforms'] as $app ) {
            if ( $app['default'] == 1 ) {
                
                echo '<script>'; 
                echo "redirect_to ( '".$device."', '".$app['slug']."', '".$app['profileLink']."', '".$app['baseURL']."', '".$app['profileURL']."' );";
                echo '</script>'; 
                
            }
        }
    } 
    ?>
    <body>
        <?php 
        
        if($data['status'] == 1) { ?>
        <div class="info-wrap light-text">
            <div class="profile">
                <div class="img-left">
                    <?php 
                    if($userType == 'staff'){ 
                        if($data['profileImage']){ ?> 
                        <img src="<?php echo $staffImages.$data['profileImage']; ?>"/>
                    <?php }}
                    else if($userType == 'private'){
                        if($data['privateUserProfile']){ ?>
                        <img src="<?php echo $privateAccounts.$data['privateUserProfile']; ?>" />
                    <?php } }
                    else if($userType == 'business'){ 
                        if($data['businessProfile']){?>
                        <img src="<?php echo $businessAccounts.$data['businessProfile']; ?>" />
                    <?php } }
                    else if($userType == 'public'){ 
                        if($data['userProfile']){ ?> 
                        <img src="<?php echo $users.$data['userProfile']; ?>" />
                    <?php } }
                    ?>
                </div>
                <div class="profile-data">
                    <h2>
                        <?php 
                            echo $data['name']; 
                            echo $data['businessName']; 
                            echo $data['privateAccountName']; 
                            echo $data['firstName'].' '.$data['lastName']; 
                        ?>
                    </h2>
                    <div class="clearfix" style="clear: both;"></div>
                    <h3> <?php 
                            echo $data['businessDescription']; 
                            echo $data['privateAccountDescription'];
                            echo $data['designation']; 
                        ?>
                    </h3>
                    <div class="clearfix" style="clear: both;"></div>
                </div>
                           <div class="pargh_block">
                <!--<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac dignissim nulla. Quisque laoreet ex quis viverra interdum. Mauris dolor nis.
                </p>-->
                <div class="button_all">
                    <a href="#" class="btn btn-primary connected_btn">
                        <span>Connected with <?php 
                            echo $data['name']; 
                            echo $data['businessName']; 
                            echo $data['privateAccountName']; 
                            echo $data['firstName'].' '.$data['lastName']; 
                        ?> </span>
                        <svg class="me-5" width="15.846" height="11.364" viewBox="0 0 15.846 11.364">
                            <path
                                id="Icon_feather-check"
                                data-name="Icon feather-check"
                                d="M19.018,9l-8.95,8.95L6,13.882"
                                transform="translate(-4.586 -7.586)"
                                fill="none"
                                stroke="#fff"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                    </a>
                    <a href="<?php echo base_url(); ?>/home/vcard?profileID=<?php echo $data['profileID']; ?>&userType=<?php echo $data['userType']; ?>" class="btn btn-primary download_btn" download>
                        <svg width="14.858" height="18.042" viewBox="0 0 14.858 18.042">
                            <path id="download" d="M23.855,12.794H19.61V6.427H13.243v6.368H9l7.429,7.429ZM9,22.346v2.123H23.855V22.346H9Z" transform="translate(-8.997 -6.427)" fill="#fff" />
                        </svg>
                    </a>
                </div>
            </div>
                <!---->
       <!--         <div class="main_block">
                    <div class="logo_img logo_info">
                        <img src="<?php echo $users.$data['userProfile']; ?>">
                        <div class="pargh_block">
                            <h3>
                                Maara Group
                            </h3>
                        </div>
                    </div>

                    <p class="pargh_blocks">
                        We are a multi-sectoral company with a mission to innovate. We want to create value in the areas of real estate consulting, transport, technology and interior design in Africa.
                    </p>
                </div>
                <div class="user_list">
                    <div class="user_header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13.615" height="13.615" viewBox="0 0 13.615 13.615">
                            <path id="user_icon" d="M6.807,7.658A3.829,3.829,0,1,0,2.978,3.829,3.83,3.83,0,0,0,6.807,7.658Zm3.4.851H8.746a4.629,4.629,0,0,1-3.877,0H3.4a3.4,3.4,0,0,0-3.4,3.4v.425a1.277,1.277,0,0,0,1.276,1.276H12.338a1.277,1.277,0,0,0,1.276-1.276v-.425A3.4,3.4,0,0,0,10.211,8.509Z" fill="#000"></path>
                        </svg>
                        <h5>
                            You have 2 staff account
                        </h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="11.808" height="6.751" viewBox="0 0 11.808 6.751">
                            <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M12.089,13.282,7.624,17.75a.84.84,0,0,1-1.192,0,.851.851,0,0,1,0-1.2l5.059-5.062a.842.842,0,0,1,1.164-.025l5.094,5.083a.844.844,0,1,1-1.192,1.2Z" transform="translate(-6.188 -11.246)" fill="#000"></path>
                        </svg>
                    </div>
                    <div class="overflow-scroll" id="style-1">
                        <div class="info-s">
                            <div class="main-img">
                                <img src="<?php echo $users.$data['userProfile']; ?>">
                            </div>
                            <div class="info_cards ms-3">
                                <span>
                                    <p class="name-title">
                                        Aziz OUATTARA
                                    </p>
                                    <p class="m-0">
                                        <span class="name">
                                            UI UX Designer
                                        </span>
                                    </p>
                                </span>
                            </div>
                        </div>
                        <div class="info-s">
                            <div class="main-img">
                                <img src="<?php echo $users.$data['userProfile']; ?>">
                            </div>
                            <div class="info_cards ms-3">
                                <span>
                                    <p class="name-title">
                                        Aziz OUATTARA
                                    </p>
                                    <p class="m-0">
                                        <span class="name">
                                            UI UX Designer
                                        </span>
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!---->
                <?php if($userType == 'staff'){?>
                <div class="main_block">
                    <div class="logo_img logo_info">
                        <img src="<?php echo $businessAccounts.$data['businessProfile']; ?>" />
                        <div class="pargh_block">
                            <h3>
                                <?php echo $data['businessName'];  ?>
                            </h3>
                        </div>
                    </div>
                    <p class="pargh_blocks">
                         <?php echo $data['businessDescription'];  ?>
                    </p>
                </div>
                <?php } ?>
                <?php if($data['staff']) { ?>
                <div class="user_list">
                    <div class="user_header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13.615" height="13.615" viewBox="0 0 13.615 13.615">
                            <path
                                id="user_icon"
                                d="M6.807,7.658A3.829,3.829,0,1,0,2.978,3.829,3.83,3.83,0,0,0,6.807,7.658Zm3.4.851H8.746a4.629,4.629,0,0,1-3.877,0H3.4a3.4,3.4,0,0,0-3.4,3.4v.425a1.277,1.277,0,0,0,1.276,1.276H12.338a1.277,1.277,0,0,0,1.276-1.276v-.425A3.4,3.4,0,0,0,10.211,8.509Z"
                                fill="#000"
                            />
                        </svg>
                        <h5>
                            You have <?php echo count($data['staff']); ?> staff account
                        </h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="11.808" height="6.751" viewBox="0 0 11.808 6.751">
                            <path
                                id="Icon_ionic-ios-arrow-down"
                                data-name="Icon ionic-ios-arrow-down"
                                d="M12.089,13.282,7.624,17.75a.84.84,0,0,1-1.192,0,.851.851,0,0,1,0-1.2l5.059-5.062a.842.842,0,0,1,1.164-.025l5.094,5.083a.844.844,0,1,1-1.192,1.2Z"
                                transform="translate(-6.188 -11.246)"
                                fill="#000"
                            />
                        </svg>
                    </div>
                    <div class="overflow-scroll" id="style-1">
                        <?php foreach($data['staff'] as $st) { ?>
                        <div class="info-s">
                            <div class="main-img">
                                <img src="<?php echo $staffImages.$st['profileImage']; ?>" />
                            </div>
                            <div class="info_cards ms-3">
                                <span>
                                    <p class="name-title">
                                        <?php echo $st['name']; ?>
                                    </p>
                                    <p class="m-0">
                                        <span class="name">
                                            <?php echo $st['designation']; ?>
                                        </span>
                                    </p>
                                </span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <div class="clearfix" style="clear: both;"></div>
            </div>
 
            <?php if($data['platforms']) { ?>
            <div class="links">
                <h3 class="text-center">Connect With</h3>
                <?php foreach($data['platforms'] as $platform) { ?>
                <a href="javascript:void(0);" 
                onclick="redirect_to ( '<?php echo $device; ?>', '<?php echo $platform['slug']; ?>', '<?php echo $platform['profileLink']; ?>', '<?php echo $platform['baseURL']; ?>', '<?php echo $platform['profileURL']; ?>' )"
                class="myBtn_multi medical">
                    <?php if($data['iconType'] == 'Rounded') { ?>
                    <img src="<?php echo $platformImages.$platform['roundImage']; ?>" />
                    <?php } else { ?>
                    <img src="<?php echo $platformImages.$platform['rectImage']; ?>" />
                    <?php } ?>
                    <span><?php echo $platform['name']; ?></span>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="info-wrap1" style="padding-top:20px;">
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
        <?php } ?>
<div id="connected_form">
    <span class="button b-close">&times;</span>
    <div class="connected_wrap">
        <form action="post">
            <h2>Connect</h2>
            <p><strong><?php echo $user['name']; ?></strong> will receive the information you provide below.</p>
            <div class="status-msg"></div>
            <div class="connected_block">
                <input type="text" name="name" id="name" placeholder="Name" />
                <input type="text" name="email" id="email" placeholder="Email" />
                <input type="text" name="phone" id="phone" placeholder="Phone" />
                <input type="hidden" name="user_id" id="userID" value="<?php echo @$data['userID']; ?>" />
                <input type="Submit" class="btn button_form" name="submit" id="submit" value="Connect">
            </div>
        </form>
    </div>
</div>
       <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
          <script>
    $(document).ready(function () {
        $( ".connected_btn" ).on( "click", function() { 
            $('.status-msg').html('');
            $('#connected_form').bPopup();
        });
        $(".button_form").click(function (event) {
            if( $(this).hasClass('active') ) {
                return false
            }
            $(this).addClass('active');
            $(this).css('opacity', 0.3);
            $('.status-msg').html('');
            var formData = {
                name:   $("#name").val(),
                email:  $("#email").val(),
                phone:  $("#phone").val(),
                user_id:  $("#user_id").val(),
            };
            var url = '<?php echo base_url( 'connect/send/mail' ) ; ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                //dataType: "json",
                //encode: true,
            }).done(function (data) {
                console.log("sdasdas")
                console.log(data);
                if(data == 1) {
                    $('.status-msg').html('<p> Mail send successfully </p>');
                    $("#name").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $(".connected_btn span").text('Connected');
                    $("#tick-img").show();
                    setTimeout(function(){ $('.b-close').trigger('click') }, 1000);
                } else {
                    console.log("sdsadsad");
                   /* var html = '<ul>';
                    $.each( data, function( key, value ) {
                        html = html + '<li>'+value+'</li>';
                    });
                    var html = html + '</ul>';*/
                    $('.status-msg').html("<p style='color:red'>"+data+"</p>");
                }
                $('.button_form').removeClass('active');
                $('.button_form').css('opacity', 1);
            });
            event.preventDefault();
        });
    });
    </script>
    </body>
</html>
