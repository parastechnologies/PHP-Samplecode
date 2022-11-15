$(document).ready(function()
{
    $("#addDeviceSub").on("submit", function(event){
        event.preventDefault();
        var formValues = $(this).serializeArray();
        console.log(formValues,"formData");
        $.ajax({
            url:"device/add",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data){
                console.log(data);
                if(data != 1){
                    $('.deviceError').show();
                    $('.deviceError').text(data);
                }
                else{
                    $('.deviceError').hide();
                    $('.deviceSuccess').show();
                    $('.deviceSuccess').text("Device has added successfully");
                    $('#deviceModal').trigger("reset");
                    setTimeout(function(){
                        $("#deviceModal").modal('show');
                        window.location.href = "devices";
                    }, 2000);
                }
            }
        })
    })
    $("#productUploads").change(function()
    {
        var formData = new FormData();
        var file = document.getElementById("productUploads").files[0];
        formData.append("Filedata", file);
        var t = file.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png" && t != "gif") {
            alert('Please select a valid imaddDeviceTypeSubage file');
             $("#productUploads").val('');
          //  document.getElementById(id).value = '';
            return false;
        }
        if (file.size > 171986) {
            alert('image size should be 172.0 kB');
             $("#productUploads").val('');
            //document.getElementById(id).value = '';
            return false;
        }
        var total_file=document.getElementById("productUploads").files.length;
        if (total_file >= 5) {
            alert('only 5 images allowed');
             $("#productUploads").val('');
            return false;
        }
        for(var i=0;i<total_file;i++)
        {
            const URLtext = URL.createObjectURL(event.target.files[i]).substring(URL.createObjectURL(event.target.files[i]).lastIndexOf('/') + 1);
            console.log(event.target.files[i].name,"lljaslkj");
            //console.log(URL,"console3",URL.createObjectURL(event.target.files[i]),"console")
            //var className = 
          /*  $('#image_preview').append('<div class="col-md-3 nopad text-center">'+
                '<label class="image-radio" id="test'+URLtext+'">' + 
                '<img width="100" height="100" class="img-responsive" src="'+URL.createObjectURL(event.target.files[i])+'">'+
                '<input type="radio" onchange="passImageName(event,'+"'"+URLtext.toLocaleString()+"'"+','+"'"+event.target.files[i].name+"'"+')" id="test1'+URLtext+'" name="image_radio" value="'+URLtext+'" /></label></div>'
            );*/
        }
    });
    $("#addColorSub").on("submit", function(event){
        event.preventDefault();
        var formValues = $(this).serializeArray();
        console.log(formValues,"formData");
        $.ajax({
            url:"color/add",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data){
                console.log(data);
                if(data != 1){
                    $('.colorError').show();
                    $('.colorError').text(data);
                }
                else{
                    $('.colorError').hide();
                    $('.colorSuccess').show();
                    $('.colorSuccess').text("Color has added successfully");
                    $('#colorModal').trigger("reset");
                    setTimeout(function(){
                        $("#colorModal").modal('show');
                        window.location.href = "colors";
                    }, 2000);
                }
            }
        })
    })
    $("#addDeviceTypeSub").on("submit", function(event){
        event.preventDefault();
        var formValues = $(this).serializeArray();
        console.log(formValues,"formData");
        $.ajax({
            url:"/maara/WS0maaraFZ9D/device/type/add",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data){
                console.log(data);
                if(data != 1){
                    $('.deviceTypeError').show();
                    $('.deviceTypeError').text(data);
                }
                else{
                    $('.deviceTypeError').hide();
                    $('.deviceTypeSuccess').show();
                    $('.deviceTypeSuccess').text("Device Type has added successfully");
                    $('#deviceTypeModal').trigger("reset");
                    setTimeout(function(){
                        $("#deviceTypeModal").modal('show');
                        window.location.href = "types";
                    }, 2000);
                }
            }
        })
    })
    $("#addUserImport").on("submit", function(event){
        event.preventDefault();
        var formValues = $(this).serializeArray();
        console.log(formValues,"formData");
        $.ajax({
            url:"/maara/WS0maaraFZ9D/users/csv/import",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data){
                console.log(data);
                if(data != 1){
                    $('.userImportError').show();
                    $('.userImportError').text(data);
                }
                else{
                    $('.userImportError').hide();
                    $('.userImportSuccess').show();
                    $('.userImportSuccess').text("User has imported successfully");
                    $('#importUserModal').trigger("reset");
                    setTimeout(function(){
                        $("#importUserModal").modal('show');
                        window.location.href = "users";
                    }, 2000);
                }
            }
        })
    })
    
    $("#addSocialub").on("submit", function(event){
        event.preventDefault();
        var formValues = $(this).serializeArray();
        console.log(formValues,"formData");
        $.ajax({
            url:"social/add",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data){
                console.log(data);
                if(data != 1){
                    $('.deviceError').show();
                    $('.deviceError').text(data);
                }
                else{
                    $('.deviceError').hide();
                    $('.deviceSuccess').show();
                    $('.deviceSuccess').text("Social has added successfully");
                    $('#deviceModal').trigger("reset");
                   setTimeout(function(){
                        $("#deviceModal").modal('show');
                        window.location.href = "social";
                    }, 2000);
                }
            }
        })
    })
        
    $(".addSocialUpdate").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            url:"social/update",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data){
                console.log(data);
                if(data != 1){
                    $('.deviceError').show();
                    $('.deviceError').text(data);
                }
                else{
                    $('.deviceError').hide();
                    $('.deviceSuccess').show();
                    $('.deviceSuccess').text("Social has updated successfully");
                   // $('#deviceModal').trigger("reset");
                   setTimeout(function(){
                        //$("#deviceModal").modal('show');
                        window.location.href = "social";
                    }, 2000);
                }
            }
        })
    })
})
function changetOrderStatus(id,status,type)
{
    var ok = confirm('Do you want to change status?');
    if(ok){
        var url = type == 1 ? 'order/status/change' : 'status/change';
        $.ajax({
            url: url,
            data:{id:id,status:status},
            method: 'post',
            success: function(response){
                console.log(response, "response");
                if(type == 0){
                    //console.log("uiop",type);
                    window.location.href = id;
                }
                else if(type == 1){
                    if(response == 1){
                        if(status == 1){
                            $("#accept").addClass( "dropdown-item text-black disabled");
                            $("#accept").text( "Accepted");
                            $("#reject").hide();
                            $("#pending").text("Order in Process");
                            $("#pending").addClass("btn bgl-success text-success btn-rounded btn-sm");
                            alert("You have successfully accepted this order");
                        }
                        else
                        {
                            $("#reject").addClass( "dropdown-item text-black disabled");
                            $("#reject").text( "Rejected");
                            $("#accept").hide(); 
                            $("#pending").text("Rejected");
                            $("#pending").addClass("btn bgl-success text-danger btn-rounded btn-sm");
                            alert("You have successfully rejected this order");
                        }
                    }   }
                else{
                    alert("Something went wrong");
                }
            }
        })
    }
  }
  
function changetstatus(id,status){
   var ok = confirm('Do you want to change status?');
    if(ok){
        $.ajax({
            url: 'user/change/status',
            data:{id:id,status:status},
            method: 'post',
            success: function(response){
                console.log(response, "response");
               var text = response == 1 ? '<i class="far fa-check-circle me-1 text-danger"></i>Suspended' : '<i class="far fa-check-circle me-1 text-success"></i>Unsuspended';
                $("#statusBtnID"+id).html(text);
            }
        })
    }
  }

  
