$(document).ready(function(){
         
    $('#cform').submit(function(){

          $('.validation-error').html('');
          $("#spinner").show();
          $(".cat-btn").hide();
          var baseurl   = $("#base").val();
          
          var form_data = $("#cform").serializeArray();
       
             $.ajax({
                  type:'POST',
                  dataType:'json',
              
                
                 url:baseurl+'forget-action',
         
                  data:form_data,
                 
                  success:function(data)
                  { 
                    
                      $(".error").html("");
                      $("#spinner").hide();
                      $(".cat-btn").show();
                      if(data.res == 1)
                       { 
                          alertify.success(data.msg);
                          $('#cform').trigger('reset');
                       }
                       else
                    {
                        if($.isEmptyObject(data.errors))
                        {
                            alertify.error(data.msg);
                        }
                        else
                        {
                            for(var key in data.errors)
                            {
                                console.log(key);
                                var v = data.errors[key];
                                $('#'+key+"_error").html(v);;

                            }
                        }
                    }
  
                     
                  }
              }); 
  
          return false;
      })
  })


  

 

         
    $('#aform').submit(function(){

          $('.validation-error').html('');
          $("#spinner").show();
          $(".cat-btn").hide();
          var baseurl   = $("#base").val();
       
          var form_data = $("#aform").serializeArray();
       
             $.ajax({
                  type:'POST',
                  dataType:'json',
              
                
                 url:baseurl+'reset-action',
         
                  data:form_data,
                 
                  success:function(data)
                  { 
                    
                      $(".error").html("");
                      $("#spinner").hide();
                      $(".cat-btn").show();
                      if(data.res == 1)
                       { 
                          alertify.success(data.msg);
                          setTimeout(function(){ window.location=baseurl+'user-login' }, 700);
                       }
                       else
                    {
                        if($.isEmptyObject(data.errors))
                        {
                            alertify.error(data.msg);
                        }
                        else
                        {
                            for(var key in data.errors)
                            {
                                console.log(key);
                                var v = data.errors[key];
                                $('#'+key+"_error").html(v);;

                            }
                        }
                    }
  
                     
                  }
              }); 
  
          return false;
      })

  