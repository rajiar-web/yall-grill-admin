$(document).ready(function(){
         
    $('#password_reset').submit(function(){

          $('.validation-error').html('');
          $("#spinner").show();
          $(".cat-btn").hide();
          var baseurl   = $("#base").val();
          
          var form_data = $("#password_reset").serializeArray();
       
             $.ajax({
                  type:'POST',
                  dataType:'json',
              
                
                 url:baseurl+'user-password-reset',
         
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
  });

  $(document).ready(function(){
         
    $('#register_update').submit(function(){

          $('.validation-error').html('');
          $("#spinner").show();
          $(".cat-btn").hide();
          var baseurl   = $("#base").val();
          
          var form_data = $("#register_update").serializeArray();
       
             $.ajax({
                  type:'POST',
                  dataType:'json',
              
                
                 url:baseurl+'user-reg-update',
         
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
                          setTimeout(function(){ location.reload(); }, 700);
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
  });
function myCopyFunction() {
var copyText = document.getElementById("foo_copy_text");
copyText.select();
copyText.setSelectionRange(0, 99999)
document.execCommand("copy");
alertify.success("Copied : " + copyText.value);
}

  

 

        