
function showMsg(id, msg, type)
{
	$(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)});	
}

function updateCompanyProfile()
{
	$('body input').removeClass('error-class');
	var company_name = $.trim($('#company_name').val());	
	var timezone = $.trim($('#timezone').val());		
	var pic_path = $.trim($('#pic_path').val());	

	var check = true;

	if(company_name == '')
	{
		$('#company_name').addClass('error-class').focus();
		check = false;
	}

	if(timezone == '')
	{
		$('#timezone').addClass('error-class');
		check = false;
	}	

	if(pic_path == '')
	{
		$('#picture').addClass('error-class');
		check = false;
	}	

	if(check)
	{
		$.ajax({
		  type: 'PUT',
		  dataType:"JSON",
		  url: api_url + 'company_profile',
		  data: { company_name: company_name, timezone: timezone, pic_path: pic_path },
		  beforeSend:function(){

		  },
		  success:function(data){

		  	showMsg('#profile_update_msg', COMPANY_UPDATE_SUCCESS, 'green')			
		  },
		  error:function(){
		  	showMsg('#profile_update_msg', COMPANY_UPDATE_ERROR, 'red')
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




