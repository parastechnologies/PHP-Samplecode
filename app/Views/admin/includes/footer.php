</div>
<div class="footer">
   <div class="copyright">
      <p>Copyright © Designed &amp; Developed by 2022</p>
   </div>
</div>
<?php
echo $uri->getSegment(3);
include('loginFooter.php');?>
<script src="<?php echo $baseURLJS; ?>custom.js"></script>
<script src="<?php echo $baseURLVendor; ?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $baseURLJS; ?>datatables.init.js"></script>
<!--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
--><script src="https://cdn.tiny.cloud/1/jgp2inqzp2rl0gg7t8jyrfyxepemmcxhkbxxedpqmevj75u1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
.tox-notifications-container {
    display: none;
}
</style>
<script>
 $(document).ready(function(){
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper'); 
     var x = 1;
    $(addButton).click(function(){
        var maxField = <?php echo count($colors); ?>;
        var fieldHTML = '<div><div class="form-row form-product col-12 pl-0 pt-2"><div class="form-group col-md-5">'+
                  '<select class="form-control role checkcolorVal" name="color[]">'+ 
                  '<option value="">Select color</option>' +
                  <?php 
                    foreach($colors as $color) { 
                        $searchArray = $uri->getSegment(3) == 'update' && $uri->getSegment(4) ? in_array($color['id'],$selectColors,true) : '';
                        if(!$searchArray){?>
                        '<option value="<?php echo $color['id']; ?>" data-value="'+x+'"><?php echo $color['colorName']; ?></option>'+
                    <?php } }?>
                     '</select>'+
                  '</div>'+
                 '<div class="form-group col-md-5">'+
                     '<input type="file" class="form-control productVarients" name="" value="" id="imageVal'+x+'" data-role="tagsinput">'+
                  '</div>'+
                  '<a class="remove_button" href="javascript:void(0);" class="remove_button">Remove</a></div></div>';
        if(x < maxField){ 
             
            x++; 
            $(wrapper).append(fieldHTML); //Add field html
        }
        else{
            alert("only " +maxField+ " are valid to add" )
        }
    });

    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        console.log($(this).parent('div'));
        x--; //Decrement field counter
    });
    $(wrapper).on('change', '.checkcolorVal', function(e)
    {
        var selects = document.querySelectorAll('select.checkcolorVal')
        if(this.value && getOthers(this,selects).indexOf(this.value)>-1){
             alert("You already selected that");
            //notify.innerText = 'You already selected that';
            this.value = "";
        }
    });

    function getOthers(current,selects)
    {
        var values = [];
        for(var i=0;i<selects.length;i++){
            if(selects[i].value!='null' && selects[i]!=current)
                values.push(selects[i].value);
                //const [option] = e.target.selectedOptions
                console.log(selects[i],"selectII",i,"ii")
                $('#imageVal'+i).attr('name','inputVal_'+selects[i].value)
                console.log($(this).children('option:selected').data('value'));
        }
        return values;
    }
}); 


  $(document).ready(function() {
    var ordertable = $('#users').DataTable({
        "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
            },
            {
                "targets": [ 8 ],
                "visible": false,
            },
            {
                "targets": [ 9 ],
                "visible": false,
            },
        ],
    });
    /*$('#orderstatus').on('change', function () {
        ordertable.columns(5).search( this.value ).draw();
    } );*/
    $('#filterUser').on('change', function () {
        if(this.value == 'private'){
            console.log("1");
            ordertable.columns(8).search('private').draw();
        }
        else if(this.value == 'business'){
            console.log("2");
            ordertable.columns(9).search('business').draw();
        }
        else{
            console.log("3");
            ordertable.columns(7).search('public').draw();   
        }
    });
    ordertable.draw();
});

/*Start order create */
$(document).ready(function(){
    var addButton = $('#add_row'); 
    var wrapper = $('#tab_logic'); 
    var x = 1;
    $(addButton).click(function(){
        var y = x+1;
        var maxField = <?php echo count($colors); ?>;
        var fieldHTML = '<tr><td>'+y+'</td>'+
                  '<td>'+
                      '<select name="products[]" id="pro'+x+'" class="form-control selectProduct"/>' + 
                        '<option value="">Select Product</option>'+
                        <?php foreach($products as $product){ ?>
                         '<option value="<?php echo $product['id']; ?>" data-id="<?php echo $product['price']; ?>"><?php echo $product['name']; ?></option>'+
                        <?php } ?>
                      '</select>'+
                  '</td>'+
                  '<td>'+
                      '<select class="form-control selectColor" name="colorVal_'+x+'" id="colorID'+x+'"/>' + 
                      '</select>'+
                  '</td>'+
                  '<td><input type="number" name="qty" id="'+x+'qty" placeholder="Enter Qty" class="form-control qty" step="0" value="1" min="0"/></td>'+
                  '<td><input type="number" name="price"  id="pro'+x+'qty" placeholder="Enter Unit Price" class="form-control price" step="0.00" min="0" readonly/></td>'+
                  '<td><input type="number" name="total" id="pro'+x+'qtyproductTotal" placeholder="0.00" class="form-control total" readonly/></td>'+
                  '<td><a class="remove_button" href="javascript:void(0);"  class="remove_button">Remove</a></td></tr>';
        if(x < maxField){ 
             
            x++; 
            $(wrapper).append(fieldHTML); //Add field html
        }
        else{
            alert("only " +maxField+ " are valid to add" )
        }
    });

    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
       // $(this).parent('tr').remove();
        $(this).closest('tr').remove();
        x--; //Decrement field counter
    });
    $(wrapper).on('change', '.selectProduct', function(e)
    {
        var selects = document.querySelectorAll('select.selectProduct');
        var productVal = e.target.value;
        var productID = e.target.id;
        var values = getOthers(this,selects);
        var dataId = productID.split("pro")
        var price = $(this).find(':selected').data('id');
        $.ajax({
            url:"<?php echo $adminBaseURL; ?>product/colors",
            method:"post",
            cache: false,
            processData:false,
            data:"productID="+productVal,
            success:function(data){
                $("#colorID"+dataId[1]).html(data);
            }
        })
        $("#"+productID+"qty").val(price);
        $("#"+productID+"qtyproductTotal").val(price);
        update_amounts();
        /*if(this.value && getOthers(this,selects).indexOf(this.value)>-1){
             alert("You already selected that");
             console.log(this.value, "sdasd");
            //notify.innerText = 'You already selected that';
            this.value = "";
        }*/
    });
    $(wrapper).on('change', '.selectColor', function(e)
    {
        var selects = document.querySelectorAll('select.selectColor');
        var productVal = e.target.value;
        var productID = e.target.id;
       /* var values = getOthers(this,selects);
        var dataId = productID.split("pro")
        var price = $(this).find(':selected').data('id');
        $("#"+productID+"qty").val(price);
        $("#"+productID+"qtyproductTotal").val(price);
        */
        /*if(this.value && getOthers(this,selects).indexOf(this.value)>-1){
             alert("You already selected that");
             console.log(this.value, "sdasd");
            //notify.innerText = 'You already selected that';
            this.value = "";
        }*/
    });
    $(wrapper).on('keyup change', '.qty', function(e)
    {
     
        var qVal = e.target.value;
        var qID = e.target.id;
        var price = $("#pro"+qID).val();
        $("#"+qID+"productTotal").val(qVal*price);
        update_amounts();
        
    }); 
    function getOthers(current,selects)
    {
        var values = [];
        for(var i=0;i<selects.length;i++){
            if(selects[i].value!='null' && selects[i]!=current)
                values.push(selects[i].value);
                $('#colorID'+i).attr('name','colorVal_'+selects[i].value)
                $('#'+i+'qty').attr('name','qtyVal_'+selects[i].value)
        }
        return values;
    }
    function update_amounts()
    {
        var sum = 0.0;
        $('#tab_logic > tbody  > tr').each(function() {
            var qty = $(this).find('.qty').val();
            var price = $(this).find('.price').val();
            var amount = (qty*price)
            sum+=amount;
            //$(this).find('.totalAmount').text(''+amount);
        });
        console.log(sum,"sum");
        //just update the total to sum  
        $('#subTotal').val(sum.toFixed(2));
        $('#grandTotal').val(sum.toFixed(2));
    }
    
      tinymce.init({
        selector: '#mytextarea',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount','code'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help | code'
      });
      
      tinymce.init({
        selector: '.productDescriptionClass',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount','code'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help | code'
      });
      
      
    /*var i=1;
    wrapper = "#tab_logic";
    $("#add_row").click(function(e){ 
        b = i-1;
        j = i+1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
      	
      	$('#tab_logic tbody tr').each(function(j, element) {
		var html = $(this).html();
		if(html!='')
		{
			$(this).find('.selectColor').attr('id','colorID'+j);
		}
    });
  	});
  	$(wrapper).on('change', '.selectProduct', function(e)
    {
        var selects = document.querySelectorAll('select.selectProduct')
        if(this.value && getOthersColor(this,selects).indexOf(this.value)>-1)
        {
            
        }
    });
    function getOthersColor(current,selects)
    {
        var values = [];
        for(var i=0;i<selects.length;i++){
            if(selects[i].value!='null' && selects[i]!=current)
                values.push(selects[i].value);
                $('#colorID'+i).attr('name','inputVal_'+selects[i].value)
                var colorID = '#colorID'+i;
                $.ajax({
                    url:"<?php echo $adminBaseURL; ?>product/colors",
                    method:"post",
                   // dataType:'JSON',
                   // contentType: false,
                    cache: false,
                    processData:false,
                    data:"productID="+selects[i].value,
                    success:function(data){
                        console.log(data);
                        //console.log(test,"resr",'#colorID'+i);
                        $(colorID).html(data);
                    }
                })
        }
        return values;
    }
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
	
	$('#tab_logic tbody').on('change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});*/

   /*$(".selectProduct").on("change", function(event){
        event.preventDefault();
        var val = event.target.value;
        console.log(event.target.value, "jshgfhd");
        $(".selectColor").attr('id',"colorID"+val);
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
    })*/	

});

/*function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#tax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}
*/

/*Stop order create*/
</script>