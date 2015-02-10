$( document ).ready(function() {
	$("#email, #password").keypress(function(e) {
	    if(e.which == 13) {
	    	login();
	    }
	});
});


function showForgot()
{
	$('#login_div').hide();	
	$('#forgot_div').fadeIn();
}
function showLogin()
{
	$('#forgot_div').hide();
	$('#login_div').fadeIn();	
}

function login()
{
	$('body input').removeClass('error-class');
	var email = $.trim($('#email').val());	
	var password = $.trim($('#password').val());		
	var check = true;

	if(email == '')
	{
		$('#email').addClass('error-class').focus();
		check = false;
	}

	if(password == '')
	{
		$('#password').addClass('error-class');
		if(email != '')
			$('#password').focus();
		check = false;
	}	

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'login',
		  data: { email: email, password: password },
		  beforeSend:function(){

		  },
		  success:function(data){
		  	if(data.account_type == 'single')
			  	window.location  = canvas_url + 'dashboard';
		    else
			  	window.location  = canvas_url + 'launchpad';
		  },
		  error:function(){
		  	showMsg('#msg', LOGIN_ERROR, 'red')
		  }
		});
	}
}

function updatePassword()
{
	$('body input').removeClass('error-class');
	var password = $.trim($('#password').val());	
	var code = $.trim($('#verify_code').val());

	var confirm_password = $.trim($('#confirm_password').val());		
	var check = true;

	if(password == '')
	{
		$('#password').addClass('error-class').focus();
		check = false;
	}

	if(confirm_password == '')
	{
		$('#confirm_password').addClass('error-class');
		if(password != '')
			$('#password').focus();
		check = false;
	}	

	if(password != confirm_password)
	{
		$('#password').addClass('error-class');
		$('#confirm_password').addClass('error-class');
	  	showMsg('#msg', MATCH_ERROR, 'red')	;	

		$('#password').focus();
		check = false;
	}

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'password',
		  data: { password: password, code: code },
		  beforeSend:function(){

		  },
		  success:function(data){
		  	$('.login-wrap').html(PASSWORD_SUCCESS + '<a href="'+canvas_url+'login'+'">'+LOGIN_HERE+'</a>');
		  },
		  error:function(){
		  	showMsg('#msg', PASSWORD_ERROR, 'red')
		  }
		});
	}
}

function reset()
{
	$('body input').removeClass('error-class');
	var email = $.trim($('#forgot_email').val());	
	var check = true;

	if(email == '')
	{
		$('#forgot_email').addClass('error-class').focus();
		check = false;
	}

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'forgot',
		  data: { email: email },
		  beforeSend:function(){

		  },
		  success:function(data){

		  	 showMsg('#forgotmsg', data.msg, 'green')
		  },
		  error:function(jqXHR){

		 var jsonResponse = $.parseJSON(jqXHR.responseText);
	  	 showMsg('#forgotmsg', jsonResponse.error.message, 'red')
		 
		  }
		});
	}
}


function showMsg(id, msg, type)
{
	$(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)});	
}

function signup()
{
	$('body input').removeClass('error-class');
	var email = $.trim($('#email').val());	
	var first_name = $.trim($('#first_name').val());		
	var last_name = $.trim($('#last_name').val());		
	var company_name = $.trim($('#company_name').val());		
	var password = $.trim($('#password').val());				
	var check = true;

	if(email == '')
	{
		$('#email').addClass('error-class').focus();
		check = false;
	}

	if(first_name == '')
	{
		$('#first_name').addClass('error-class').focus();
		check = false;
	}

	if(last_name == '')
	{
		$('#last_name').addClass('error-class').focus();
		check = false;
	}

	if(company_name == '')
	{
		$('#company_name').addClass('error-class').focus();
		check = false;
	}

	if(password == '')
	{
		$('#password').addClass('error-class');
		if(email != '')
			$('#password').focus();
		check = false;
	}	

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'account',
		  data: { email: email,
		  		  password: password,
		  		  company_name:company_name,
		  		  first_name:first_name,
		  		  last_name:last_name,		  		  		  		  
		  		    },
		  beforeSend:function(){

		  },
		  success:function(data){
		  	showMsg('#msg', SIGNUP_SUCCESS, 'green')		  	
		  	window.location  = canvas_url + 'dashboard';
		  },
		  error:function(){
		  	showMsg('#msg', SIGNUP_ERROR, 'red')
			$('#email').addClass('error-class').focus();		  	
		  }
		});
	}
}

