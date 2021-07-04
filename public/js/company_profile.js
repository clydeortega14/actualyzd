$(document).ready(function(){
    $("#show").click(function(){
      $("#main_info").hide();
      $("#c_profile").hide();
      $("#Users").hide();
      $("#c_employees").hide();
  
      $("#edit_info").show();
      $("#logo").show();
    });
    $("#cancel").click(function(){
  
      $("#main_info").show();
      $("#c_profile").show();
      $("#c_employees").show();

      $("#edit_info").hide();
      $("#logo").hide();

    });
    $("#c_profile").click(function(){
      $("#main_info").show();
      $("#edit_info").hide();
      $("#Users").hide();
  
    });
    $("#c_employees").click(function(){
      $("#main_info").hide();
      $("#edit_info").hide();
      $("#Users").show();
    });
   
  
    
    
  });
  $(function() {

    $('#select-client').on('change', function() {
        let client = $('#select-client').val();
        let user = $('.user');
        if(client == 0) return user.show();
        
        user.hide();
        if(user.attr(`[data-client-id="${client}"]`) === undefined) {
            $('.user').attr(`[data-client-id="${client}"]`).show();
        }
    });

});

  function previewFile(input){
	var file=$("input[type=file]").get(0).files[0];
	if(file)
	{
		var reader  = new FileReader();
		reader.onload = function(){
			$('#previewImg').attr("src", reader.result);
		}
		reader.readAsDataURL(file);
	}
  }