// slides
$(document).ready(function() {
    $("#next01").click(function() {
        $("#slide1").hide();
        $("#slide2").show();
    });



// online ico

  $(document).on('mousedown','.tab',function(ev){
        if(!$(this).hasClass('active'))
        {
            $(".tab.active").removeClass("active");
            $(this).addClass("active");        
        }
      
      });
// title
$(document).on('mousedown','.dish',function(ev){
    if(!$(this).hasClass('active'))
    {
        $(".dish.active").removeClass("active");
        $(this).addClass("active");        
    }
  
  });


// tabs
$(document).on('mousedown','.all_dishes',function(ev){
  var attr=$(this).attr('attr-to');
  $('.all_dishes_sub').hide();
  $('.sub_dishes').hide();
  
  $("#"+attr+'-sub').show();
  $("#sub_"+attr).show();
  // alert(attr);     
});
    




      
    $("#dish1").click(function() {
        $("#slide2").hide();
        $("#dish1-sub").show();
    });


    $("#confirm-next1").click(function() {
        $("#confirm-slide1").hide();
        $("#confirm-slide2").show();
    });





    $("#previous3").click(function() {
        $("#slide4").hide();
        $("#slide3").show();
    });
    $("#previous4").click(function() {
        $("#slide5").hide();
        $("#slide4").show();
    });
    $("#previous5").click(function() {
        $("#slide6").hide();
        $("#slide5").show();
    });
    $("#previous6").click(function() {
        $("#slide7").hide();
        $("#slide6").show();
    });
    $("#previous7").click(function() {
        $("#slide8").hide();
        $("#slide7").show();
    });
    $("#previous8").click(function() {
        $("#slide9").hide();
        $("#slide8").show();
    });
    $("#previous9").click(function() {
        $("#slide10").hide();
        $("#slide9").show();
    });
    $("#previous10").click(function() {
        $("#slide11").hide();
        $("#slide10").show();
    });
    $("#previous11").click(function() {
        $("#slide12").hide();
        $("#slide11").show();
    });
    
});



function dish_function(attr)
{

  // alert(attr);

  var baseurl = $('#base_url').val();
  var form_data = new FormData();
  form_data.append('dish_id', attr);
  $.ajax({
      url : baseurl+'dish-detail', 
      type: "POST",
      dataType:'json',
      data: form_data,
      contentType: false,  
      cache: false,
      processData: false,
      success: function (data) 
      {
        $(".noorder").attr("style", "display:none;");
        var reduce_amount=parseInt($('#cid').val());
       
        if(parseInt(reduce_amount)==''){
           reduce_amount='0';
        }
        else if(isNaN(parseFloat(reduce_amount))){
          reduce_amount='0';
       }

        if(($("div").hasClass("sel-dish-"+data.result[0]['d_id'])) == true)
        {
          // alert('has');
          var srvs_chrge= $('#db_service_charge').val(); 
          
         

          var crnt_tot= parseFloat($('#tot_val').val());
          var new_amt = parseFloat(data.result[0]['d_price']);
          var new_tot_val = (crnt_tot + new_amt);
          $('#tot_val').val(new_tot_val);
          $('#sub_tot_val').html('Subtotal:  £<span >'+new_tot_val.toFixed(2)+'</span>');
          $('#sub_service_val').html('Service Charge:  £<span >0.00');
        
          if(reduce_amount>0)
          {
          $('#offer_val').html('Offer Amount:  £<span >'+parseFloat(reduce_amount).toFixed(2)+'</span>');
          }
          var sub_tot_val= parseFloat(new_tot_val);
          var sub_service_val = parseFloat(srvs_chrge);
          var all_tot_val = (sub_tot_val + sub_service_val)-reduce_amount;//
          $('#all_tot_val').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');
          var c_qty =$('#text-qty-'+data.result[0]['d_id']).val();
          var n_qty=parseInt(c_qty) + parseInt(1);
          $('#text-qty-'+data.result[0]['d_id']).val(n_qty);
          $('#text-qty_mobile-'+data.result[0]['d_id']).val(n_qty);

                  // mobile start

          $('.mob_sub_total').html('Subtotal:  £<span >'+new_tot_val.toFixed(2)+'</span>');
          $('.mob_service').html('Service Charge:  £<span >'+srvs_chrge+'</span>');
          if(reduce_amount>0)
          {
          $('.mob_offer').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          $('.mob_all_total').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');

          // mobile end


          alertify.success('succesfully added 1 more '+data.result[0]['d_item']); 

          var qty_vals=$('input[name="qty_ar[]"]').map(function(){
              return $(this).val()
          }).get();
          // console.log(qty_vals);
          var price_vals=$('input[name="dish_price_ar[]"]').map(function(){
              return $(this).val()
          }).get();
          // console.log(price_vals);          
          var id_vals=$('input[name="dish_id_ar[]"]').map(function(){
            return $(this).val()
          }).get();

          $('#db_sub_total').val(new_tot_val);
          $('#all_total_amount').val(all_tot_val);
          $('#db_service_charge').val(srvs_chrge);

          $('#db_item_ids').val(id_vals);
          $('#db_qty').val(qty_vals);
          $('#db_prices').val(price_vals);

        }
        else
        {
          var srvs_chrge= $('#db_service_charge').val();          
          var crnt_tot= parseFloat($('#tot_val').val());
          var new_amt = parseFloat(data.result[0]['d_price']);
          var new_tot_val = (crnt_tot + new_amt);
          $('#tot_val').val(new_tot_val);
          $('#sub_tot_val').html('Subtotal:  £<span >'+new_tot_val.toFixed(2)+'</span>');
          $('#sub_service_val').html('Service Charge:  £<span >'+srvs_chrge+'</span>');
          if(reduce_amount>0)
          {
          $('#offer_val').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          var sub_tot_val= parseFloat(new_tot_val);
          var sub_service_val = parseFloat(srvs_chrge);
          var all_tot_val = (sub_tot_val + sub_service_val)-reduce_amount;//
          $('#all_tot_val').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');
          

                  // mobile start

          $('.mob_sub_total').html('Subtotal:  £<span >'+new_tot_val.toFixed(2)+'</span>');
          $('.mob_service').html('Service Charge:  £<span >'+srvs_chrge+'</span>');
          if(reduce_amount>0)
          {
          $('.mob_offer').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          $('.mob_all_total').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');

                  // mobile end

            // console.log(data.result[0]['d_price']);
            $('.bg-order').append('<div class="row sel-dish-'+data.result[0]['d_id']+'"><div class="col-10"><div class="col-12 p-0"><h4>'+data.result[0]['d_item']+'</h4><ul><li>QTY</li><li style="width: 30%;"><input type="number" class="qty_ar" name="qty_ar[]" onKeyDown="return false" oninput="txt_qty_change('+data.result[0]['d_id']+')" onchange="txt_qty_change('+data.result[0]['d_id']+')" id="text-qty-'+data.result[0]['d_id']+'" min="1" style="width:100%;height:30px;"><input type="hidden" class="dish_price_ar" name="dish_price_ar[]" value="'+data.result[0]['d_price']+'" id="text-price-'+data.result[0]['d_id']+'"><input type="hidden" class="dish_id_ar" name="dish_id_ar[]" value="'+data.result[0]['d_id']+'" id="text-d_id-'+data.result[0]['d_id']+'"></li><li><b> £'+data.result[0]['d_price']+'</b></li></ul></div></div><div class="col-2 delete d-flex justify-content-center align-items-center" onClick="dish_del_function('+data.result[0]['d_id']+')"><a href="javascript:void(0);"> <i class="far fa-trash-alt"></i></a></div></div>');
            $('.bg-order-mobile').append('<div class="row sel-dish-'+data.result[0]['d_id']+'"><div class="col-10"><div class="col-12 p-0"><h4>'+data.result[0]['d_item']+'</h4><ul><li>QTY</li><li style="width: 60%;"><input type="number" class="qty_ar_mb" name="qty_ar_mb[]" oninput="txt_qty_change_mobile('+data.result[0]['d_id']+')"  id="text-qty_mobile-'+data.result[0]['d_id']+'" min="1" style="width:100%;height:30px;"><input type="hidden" class="dish_price_ar_mb" name="dish_price_ar_mb[]" value="'+data.result[0]['d_price']+'" id="text-price-'+data.result[0]['d_id']+'"><input type="hidden" class="dish_id_ar_mb" name="dish_id_ar_mb[]" value="'+data.result[0]['d_id']+'" id="text-d_id-'+data.result[0]['d_id']+'"></li><li><b> £'+data.result[0]['d_price']+'</b></li></ul></div></div><div class="col-2 delete d-flex justify-content-center align-items-center" onClick="dish_del_function('+data.result[0]['d_id']+')"><a href="javascript:void(0);"> <i class="far fa-trash-alt"></i></a></div></div>');
            $('#text-qty-'+data.result[0]['d_id']).val(1);
            $('#text-qty_mobile-'+data.result[0]['d_id']).val(1);
            alertify.success('added '+data.result[0]['d_item']+' succesfully'); 


              var qty_vals=$('input[name="qty_ar[]"]').map(function(){
                  return $(this).val()
              }).get();
              // console.log(qty_vals);
              var price_vals=$('input[name="dish_price_ar[]"]').map(function(){
                  return $(this).val()
              }).get();
              // console.log(price_vals);          
              var id_vals=$('input[name="dish_id_ar[]"]').map(function(){
                return $(this).val()
              }).get();

              $('#db_sub_total').val(new_tot_val);
              $('#all_total_amount').val(all_tot_val);
              $('#db_service_charge').val(srvs_chrge);

              $('#db_item_ids').val(id_vals);
              $('#db_qty').val(qty_vals);
              $('#db_prices').val(price_vals);

        }
        
                
      }
  });

}

function dish_del_function(attr)
{
  var baseurl = $('#base_url').val();
  var form_data = new FormData();
  form_data.append('dish_id', attr);
  $.ajax({
      url : baseurl+'dish-del', 
      type: "POST",
      dataType:'json',
      data: form_data,
      contentType: false,  
      cache: false,
      processData: false,
      success: function (data) 
      {
        var srvs_chrge= $('#db_service_charge').val();
        var reduce_amount=parseFloat($('#cid').val());
        if(parseInt(reduce_amount)==''){
          reduce_amount='0';
       }
       else if(isNaN(parseFloat(reduce_amount))){
         reduce_amount='0';
      }
        var crnt_tot= parseFloat($('#tot_val').val());
        var new_amt = parseFloat(data.result[0]['d_price']);

        var c_qty =$('#text-qty-'+data.result[0]['d_id']).val();

        var new_tot_val = (crnt_tot.toFixed(2) - (parseInt(c_qty) * new_amt.toFixed(2)));
        // alert(new_tot_val.toFixed(2));
        $('#tot_val').val(new_tot_val);
        $('#sub_tot_val').html('Subtotal:  £<span >'+new_tot_val.toFixed(2)+'</span>');
        $('#sub_service_val').html('Service Charge:  £<span >'+srvs_chrge+'</span>');
        if(reduce_amount>0)
        {
        $('#offer_val').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
        }
        var sub_tot_val= new_tot_val.toFixed(2);
        var sub_service_val = parseFloat(srvs_chrge);
        var all_tot_val = (sub_tot_val + sub_service_val)-reduce_amount;//
        $('#all_tot_val').html('Total  : £<span >'+parseFloat(all_tot_val).toFixed(2)+'</span>');
        
        
        // mobile start

          $('.mob_sub_total').html('Subtotal:  £<span >'+new_tot_val.toFixed(2)+'</span>');
          $('.mob_service').html('Service Charge:  £<span >0.00</span>');
          if(reduce_amount>0)
          {
          $('.mob_offer').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          $('.mob_all_total').html('Total  : £<span >'+parseFloat(all_tot_val).toFixed(2)+'</span>');

          // mobile end

          $(".sel-dish-"+data.result[0]['d_id']).remove();
          alertify.success('removed '+data.result[0]['d_item']+' successfully');
          // console.log(data.result[0]['d_id']);

          var qty_vals=$('input[name="qty_ar[]"]').map(function(){
            return $(this).val()
        }).get();
        // console.log(qty_vals);
        var price_vals=$('input[name="dish_price_ar[]"]').map(function(){
            return $(this).val()
        }).get();
        // console.log(price_vals);          
        var id_vals=$('input[name="dish_id_ar[]"]').map(function(){
          return $(this).val()
        }).get();

        $('#db_sub_total').val(new_tot_val);
        $('#all_total_amount').val(all_tot_val);
        $('#db_service_charge').val(srvs_chrge);

        $('#db_item_ids').val(id_vals);
        $('#db_qty').val(qty_vals);
        $('#db_prices').val(price_vals);
          
                
      }
  });
}




function dish_order()
{
  var order_amount = $('#all_total_amount').val();
  var date=$('#date').val();
  var time=$('#time').val();
  if(parseInt(order_amount) == 0)
  {
    alertify.error('please add any item');
  }
  if(date == 0)
  {
    alertify.error('please Select Date');
  }
   if(time==0)
  {
    alertify.error('please Select Time');
  }
  else
  {
    // alertify.success("Your order was successfull");
    // setTimeout(function(){ location.reload(); }, 700);
    var baseurl = $('#base_url').val();
  
    var db_sub_total = $('#db_sub_total').val();
    var all_total_amount = $('#all_total_amount').val();
    var db_service_charge = $('#db_service_charge').val();





    var db_item_ids = $('#db_item_ids').val();
    var db_qty = $('#db_qty').val();
    var db_prices =  $('#db_prices').val();

    var form_data = new FormData();
    form_data.append('db_sub_total', db_sub_total);
    form_data.append('all_total_amount', all_total_amount);
    form_data.append('db_service_charge', db_service_charge);
    form_data.append('db_item_ids', db_item_ids);
    form_data.append('db_qty', db_qty);
    form_data.append('db_prices', db_prices);

    form_data.append('date', date);
    form_data.append('time', time);
    var pid=$('#pid').val();

    $.ajax({
        url : baseurl+'add-order', 
        type: "POST",
        dataType:'json',
        data: form_data,
        contentType: false,  
        cache: false,
        processData: false,
        success: function (data) 
        {
          if(data.res == 1)
            { 
              alertify.success(data.msg);
              setTimeout(function(){ window.location=baseurl+'confirm-order/'+data.id+'/'+pid; }, 700);
            }
            else
            {   
              alertify.error(data.msg);
            }
          
          
            
                  
        }
    });
    
  }


}

function txt_qty_change($dish_id)
{
  var dish_id = $dish_id;
  // alert(dish_id);

  var reduce_amount=parseFloat($('#cid').val());
  if(parseInt(reduce_amount)==''){
    reduce_amount='0';
 }
 else if(isNaN(parseFloat(reduce_amount))){
   reduce_amount='0';
}

  var srvs_chrge= $('#db_service_charge').val();
  var qty_vals=$('input[name="qty_ar[]"]').map(function(){
        return $(this).val()
    }).get();
    console.log(qty_vals);
    var price_vals=$('input[name="dish_price_ar[]"]').map(function(){
        return $(this).val()
    }).get();
    // console.log(price_vals);

    var id_vals=$('input[name="dish_id_ar[]"]').map(function(){
      return $(this).val()
    }).get();
  var result=[];
  if (qty_vals.length != price_vals.length) 
      {
          System.out.println("Arrays must be same size");
          return null;
      }
      else
      {
        for (var i = 0; i < qty_vals.length; i++) {
          result[i] = qty_vals[i] * price_vals[i];
          // console.log(qty_vals[i] * price_vals[i]);
        }
      }
      var sum = result.reduce(function(a, b){
        return a + b;
    }, 0);
    
    // console.log(sum);


      if(sum =='' || sum== null)
      {
        alertify.error('something wrong');
      }
      else
      {
        if (qty_vals.length != id_vals.length) 
        {
          // console.log(id_vals);
           console.log("Arrays must be same size");
            return null;
        }
        else
        {
          for (var j = 0; j < id_vals.length; j++) {
            $('#text-qty_mobile-'+id_vals[j]).val(qty_vals[j]);
            // console.log(qty_vals[j]);
          }
        }

          $('#tot_val').val(sum);
          $('#sub_tot_val').html('Subtotal:  £<span >'+sum.toFixed(2)+'</span>');
          $('#sub_service_val').html('Service Charge:  £<span >'+srvs_chrge+'</span>');
          var sub_tot_val= parseFloat(sum);
          var sub_service_val = parseFloat(srvs_chrge);
          var all_tot_val = (sub_tot_val + sub_service_val)-reduce_amount;//
          $('#all_tot_val').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');



          $('.mob_sub_total').html('Subtotal:  £<span >'+sum.toFixed(2)+'</span>');
          $('.mob_service').html('Service Charge:  £<span >'+srvs_chrge+'</span>');
          if(reduce_amount>0)
          {
          $('.mob_offer').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          $('.mob_all_total').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');

          $('#db_sub_total').val(sub_tot_val);
          $('#all_total_amount').val(all_tot_val);
          $('#db_service_charge').val(srvs_chrge);

          $('#db_item_ids').val(id_vals);
          $('#db_qty').val(qty_vals);
          $('#db_prices').val(price_vals);

      }

          


  


}

function txt_qty_change_mobile($dish_id)
{
  var dish_id = $dish_id;
  // alert(dish_id);
  var reduce_amount=parseFloat($('#cid').val());
  if(parseInt(reduce_amount)==''){
    reduce_amount='0';
 }
 else if(isNaN(parseFloat(reduce_amount))){
   reduce_amount='0';
}

  var srvs_chrge= $('#db_service_charge').val();
  var qty_vals=$('input[name="qty_ar_mb[]"]').map(function(){
      return $(this).val()
  }).get();
  console.log(qty_vals);
  var price_vals=$('input[name="dish_price_ar_mb[]"]').map(function(){
      return $(this).val()
  }).get();
  // console.log(price_vals);

  var id_vals=$('input[name="dish_id_ar_mb[]"]').map(function(){
    return $(this).val()
  }).get();
  var result=[];
  if (qty_vals.length != price_vals.length) 
      {
          console.log("Arrays must be same size");
          return null;
      }
      else
      {
        for (var i = 0; i < qty_vals.length; i++) {
          result[i] = qty_vals[i] * price_vals[i];
          // console.log(qty_vals[i] * price_vals[i]);
        }
      }
      var sum = result.reduce(function(a, b){
        return a + b;
    }, 0);
    
    // console.log(sum.toFixed(2));


      if(sum =='' || sum== null)
      {
        alertify.error('something wrong');
      }
      else
      {
        if (qty_vals.length != id_vals.length) 
        {
          // console.log(id_vals);
           console.log("Arrays must be same size");
            return null;
        }
        else
        {
          for (var j = 0; j < id_vals.length; j++) {
            $('#text-qty-'+id_vals[j]).val(qty_vals[j]);
            // console.log(qty_vals[j]);
          }
        }
        // console.log(qty_vals);
        // $('.qty_ar').val(qty_vals);
          $('#tot_val').val(sum);
          $('#sub_tot_val').html('Subtotal:  £<span >'+sum.toFixed(2)+'</span>');
          $('#sub_service_val').html('Service Charge:  £<span >0.00');
          if(reduce_amount>0)
          {
          $('#offer_val').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          var sub_tot_val= parseFloat(sum);
          var sub_service_val = parseFloat(srvs_chrge);
          var all_tot_val = (sub_tot_val + sub_service_val)-reduce_amount;//
          $('#all_tot_val').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');
          $('#all_total_amount').val(all_tot_val);


          
          $('.mob_sub_total').html('Subtotal:  £<span >'+sum.toFixed(2)+'</span>');
          $('.mob_service').html('Service Charge:  £<span >0.00</span>');
          if(reduce_amount>0)
          {
          $('.mob_offer').html('Offer Amount:  £<span >'+reduce_amount.toFixed(2)+'</span>');
          }
          $('.mob_all_total').html('Total  : £<span >'+all_tot_val.toFixed(2)+'</span>');


          $('#db_sub_total').val(sub_tot_val);
          $('#all_total_amount').val(all_tot_val);
          $('#db_service_charge').val(srvs_chrge);

          $('#db_item_ids').val(id_vals);
          $('#db_qty').val(qty_vals);
          $('#db_prices').val(price_vals);


      }

          


  


}

