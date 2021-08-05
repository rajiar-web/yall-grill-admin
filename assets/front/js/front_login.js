$(document).ready(function(){
         
    $('#front_login').submit(function(){

          $('.validation-error').html('');
          $("#spinner").show();
          $(".cat-btn").hide();
          var baseurl   = $("#base").val();
          
          var form_data = $("#front_login").serializeArray();
       
             $.ajax({
                  type:'POST',
                  dataType:'json',
              
                
                 url:baseurl+'user-login-action',
         
                  data:form_data,
                 
                  success:function(data)
                  { 
                    //   alert('hhh');
                      //console.log(data);
                      $(".error").html("");
                      $("#spinner").hide();
                      $(".cat-btn").show();
                      if(data.res == 1)
                       { 
                          alertify.success(data.msg);
                          setTimeout(function(){ window.location=baseurl+data.url; }, 700);
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
                                    alertify.error(v);

                                }
                            }
                        }
  
                     
                  }
              }); 
  
          return false;
      })
  })


  

 

        