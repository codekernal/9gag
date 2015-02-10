function setAccount(account_id)
{
	if(account_id != '' && account_id != 0)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'account_session',
		  data: { account_id: account_id},
		  beforeSend:function(){

		  },
		  success:function(data){
			  	window.location  = canvas_url + 'dashboard';
		  },
		  error:function(){

		  }
		});

	}
}