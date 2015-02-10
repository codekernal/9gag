
function showMsg(id, msg, type)
{
	$(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)});	
}

function updateProfile()
{
	$('body input').removeClass('error-class');
	var first_name = $.trim($('#first_name').val());	
	var last_name = $.trim($('#last_name').val());		
	var mobile = $.trim($('#mobile').val());	
	var pic_path = $.trim($('#pic_path').val());		

	var check = true;

	if(first_name == '')
	{
		$('#first_name').addClass('error-class').focus();
		check = false;
	}

	if(last_name == '')
	{
		$('#last_name').addClass('error-class');
		check = false;
	}	

	if(mobile == '')
	{
		$('#mobile').addClass('error-class');
		check = false;
	}	

	if(check)
	{
		$.ajax({
		  type: 'PUT',
		  dataType:"JSON",
		  url: api_url + 'profile',
		  data: { first_name: first_name, last_name: last_name, mobile: mobile, pic_path:pic_path },
		  beforeSend:function(){

		  },
		  success:function(data){
			var pic_path = $.trim($('#pic_path').val());		
			if(pic_path != '')
			{
		        file = canvas_url + '/data/pictures/' + pic_path;
		        $('.profile_pic').attr('src',file);		  					
			}
		  	showMsg('#profile_update_msg', PROFILE_UPDATE_SUCCESS, 'green')			
		  },
		  error:function(){
		  	showMsg('#profile_update_msg', PROFILE_UPDATE_ERROR, 'red')
		  }
		});
	}
	
}



function updatePassword()
{
	$('body input').removeClass('error-class');
	var current_password = $.trim($('#current_password').val());	
	var new_password = $.trim($('#new_password').val());	
	var confirm_password = $.trim($('#confirm_password').val());	
	var check = true;

	if(current_password == '')
	{
		$('#current_password').addClass('error-class').focus();
		check = false;
	}

	if(new_password == '')
	{
		$('#new_password').addClass('error-class');
		check = false;
	}

	if(confirm_password == '')
	{
		$('#confirm_password').addClass('error-class');
		check = false;
	}	

	if(new_password != confirm_password)
	{
		$('#new_password').addClass('error-class');
		$('#confirm_password').addClass('error-class');
	  	showMsg('#msg', MATCH_ERROR, 'red')	;	
		$('#new_password').focus();
		check = false;
	}

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'password_update',
		  data: { password: new_password, current_password: current_password },
		  beforeSend:function(){

		  },
		  success:function(data){
		  	showMsg('#password_update_msg', PASSWORD_SUCCESS, 'green')
		  },
		  error:function(){
		  	showMsg('#password_update_msg', PASSWORD_ERROR, 'red')
		  }
		});
	}
}




