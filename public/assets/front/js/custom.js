/*$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    dots:true,
    autoplay:true,
    autoplayTimeout:5000,
    responsive:{
        0:{
            items:1,
            loop:true
        },
        600:{
            items:2,
            loop:true
        },
        1000:{
            items:5,
            loop:true
        },
    }
})
});*/

$(document).ready(function(){
    /*$('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      responsiveClass:true,
      dots:true,
      autoplay:true,
      autoplayTimeout:5000,
      responsive:{
          0:{
              items:1,
              loop:true
          },
          600:{
              items:2,
              loop:true
          },
          1000:{
              items:4,
              loop:true
          },
      }
  })*/
  $('#viewMore[data-bs-toggle="collapse"]').click(function() {
    $(this).toggleClass( "more" );
    if ($(this).hasClass("more")) {
      $(this).text("Read Less");
    } else {
      $(this).text("Read More");
    }
  });
  });

  $(document).ready(function(){
    AOS.init();
    $(".addToCart").on('submit',function(event){
        event.preventDefault();
        var id = event.target.id;
        console.log(event,"sdjasdh",id);
        $.ajax({
            url:"/product/cart/add",
            method:"post",
           // dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success:function(data)
            {
                const response = JSON.parse(data); 
                console.log(response.cartCount, "ffff");
                if(response.cartCount == 1)
                {
                    console.log("red");
                    $("#showCheckout").show();
                }
                else
                {
                    console.log("pop");
                    $("#showCheckout").attr('id','');
                    //$("#showCheckout").hide();
                }
                $("#emptyCart").hide();
                $("#showCheckoutButton").show();
             //   $("#showCheckout").show();
                $("#subTotal").html(response.subTotal);
                $("#cartCount").html(response.cartCount);
                $("#cartItemList").html(response.items);
            }
        })
    })

  });
 $('.add').on('click',function(event)
 {
    $(this).prev().val(+$(this).prev().val() + 1);
     event.preventDefault();
        var id = event.target.id;
        var ids = id.split("add");
        var qty = $(this).prev().val();
        var colorID = $("#"+id).attr("data-value").split("addColor");
        var productID = $("#"+id).attr("data-value-id").split("addproduct");
        if(qty != null || qty != undefined){
        $.ajax({
            url:"cart/qty/change",
            method:"post",
            data:"qty="+qty+"&productID="+productID[1]+"&colorID="+colorID[1],
            success:function(data){
                //$("#emptyCart").hide();
                const response = JSON.parse(data); 
                console.log(response);
                $("#grandTotalPrice").html(response.subTotal);
                $("#cartCount").html(response.cartCount);
                $("#subTotal"+ids[1]).html(response.itemSubTotal);
            }
        })
        }
        else{
            alert('Something went wrong');
        }
});
$('.sub').on('click',function(event)
{
    event.preventDefault();
    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
        var id = event.target.id;
        var ids = id.split("sub");
        var dataVal  = $("#"+id).attr("data-value-remove");
        console.log(dataVal, "dataVal");
        var colorID = $("#"+id).attr("data-value").split("subColor");
        console.log(colorID,"colorID");
        var productID = $("#"+id).attr("data-value-id").split("subproduct");
        if(dataVal == 'subQty')
        {
            var productIDs = ids;
            var qty = $(this).next().val();
        }
        else{
            var productIDs = id.split("remove");
            var qty = '0';
        }
        console.log("#subTotal"+productIDs[1], "io");
        if(qty != null || qty != undefined){
        $.ajax({
            url:"cart/qty/change",
            method:"post",
            data:"qty="+qty+"&productID="+productID[1]+"&colorID="+colorID[1],
            success:function(data){
                const response = JSON.parse(data); 
                if(response.cartCount == 0)
                {
                    $("#isItemCartInCart12").show();
                    
                    $(".shipping-form").hide();
                }
                if(qty == 0){
                    $("#itemID"+productIDs[1]).attr('style','display:none !important');
                    $("#headerItemID"+productIDs[1]).attr('style','display:none !important');
                }
                console.log(response);
                $("#grandTotalPrice").html(response.subTotal);
                $("#cartCount").html(response.cartCount);
                $("#subTotal"+productIDs[1]).html(response.itemSubTotal);
            }
        })
    }
    else
    {
        alert("Something went wrong");   
    }
});

$('.checkColor').on('change',function (event)
{
    var valRadio = event.target.value;   
    var id = event.target.id;   
    var ids = id.split("&P&");
    $(".imageID"+ids[1]).attr("id","imageID"+ids[1]+valRadio);
    $("#colorID"+ids[1]).val(ids[0]);
    $.ajax({
        url:"product/color/image",
        method:"post",
        data:{colorID:ids[0],productID:ids[1]},
        success:function(data){
            console.log("success","#imageID"+ids[1]+valRadio);
            $("#imageID"+ids[1]+valRadio).html(data);
        },
        error:function(error){
            console.log("error");
            console.log(error.responseText);
        }
    })
})

$('#stateSelection').on('change',function (event)
{
    console.log("sdhjsadjasgdk");
    var country = $("#stateSelection option:selected").val();
    $.ajax({
        url:"state/selection",
        method:"post",
        data:{country:country},
        success:function(data){
            if(data == 0){
                $("#stateOption").hide();   
            }
            else{
                $("#stateOption").show(); 
                $("#stateOption").html(data);
            }
        },
        error:function(error){
            console.log("error");
            console.log(error.responseText);
        }
    })
})

$('#checkoutForm').on('submit',function (event)
{
  //  event.preventDefault();
   // var country = $("#stateSelection option:selected").val();
    $.ajax({
        url:"paynow",
        method:"post",
        contentType: false,
        cache: false,
        processData:false,
        data:new FormData(this),
        success:function(data){
            $("#tokenID").val(data);
         //   return false;
            /*if(data == 0){
                $("#stateOption").hide();   
            }
            else{
                $("#stateOption").show(); 
                $("#stateOption").html(data);
            }*/
        }
        /*error:function(error){
            console.log("error");
            console.log(error.responseText);
        }*/
    })
})
/*
function changeQty(id,action,ids)
{
    console.log(id,"hasdjsdhjs");
    var qty = $("#qty"+id).val();
    $("#qty"+id).attr("value", qty);
    $.ajax({
        url: '/zeed/merchant/order/create/search',
        method:'post',
        data:{action,id,qty},
        success: function(data){
            const response = JSON.parse(data); 
            console.log(response, "response");
            let itemPrice = 0;
            let itemDiscount =0;
            $("#changeRow_"+id).html("$"+response.changeTotal);
            $("#discountval_"+id).val(response.itemDiscount);
            $("#val_"+id).val(response.changeTotal);
            ids.forEach(element => {
                itemPrice += parseFloat($("#val_"+element).val(),2);
                itemDiscount += parseFloat($("#discountval_"+element).val(),2);
            });
            console.log(parseFloat(itemPrice),"text");
            $("#cartSubTotal").html("$"+itemPrice);
            $("#cartDisocunt").html("$"+itemDiscount);
            $("#cartTotal").html("$"+(itemPrice - itemDiscount ));
            $("#subTotal").attr('value',itemPrice);
            $("#discountTotal").attr('value',itemDiscount);
            $("#grandTotal").attr('value',itemPrice - itemDiscount);
            
        }
    })
}*/