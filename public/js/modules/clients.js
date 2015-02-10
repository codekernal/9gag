var sortBy = '';
var sortOrder = '';

function showClientPopup(id)
{
  	$('#first_name').val('');
  	$('#last_name').val('');
  	$('#phone').val('');
  	$('#mobile').val('');
  	$('#fax').val('');
  	$('#company_name').val('');
  	$('#email').val('');
  	$('#street_address').val('');
  	$('#zip').val('');
  	$('#city').val('');
  	$('#country').val('Switzerland');
  	$('#invoice_country').val('Switzerland');  	
	$('#client_id, #invoice_street_address, #invoice_zip, #invoice_city, #express_price').val('');

	if(id != 0)
	{
		$('#popupLabel').html(UPDATE_CLIENT);
		$('#client_id').val(id);

		// fetch data
		$.ajax({
		  type: 'GET',
		  dataType:"JSON",
		  url: api_url + 'client',
		  data: {id:id},
		  beforeSend:function(){

		  },
		  success:function(data){

		  	$('#first_name').val(data.first_name);
		  	$('#last_name').val(data.last_name);
		  	$('#phone').val(data.phone);
		  	$('#mobile').val(data.mobile);
		  	$('#fax').val(data.fax);
		  	$('#company_name').val(data.company_name);		  	
		  	$('#email').val(data.email);
		  	$('#street_address').val(data.street_address);
		  	$('#zip').val(data.zip);
		  	$('#city').val(data.city);
		  	$('#country').val(data.country);
		  	$('#invoice_country').val(data.invoice_country);
		  	$('#invoice_city').val(data.invoice_city);
		  	$('#invoice_zip').val(data.invoice_zip);
		  	$('#invoice_street_address').val(data.invoice_street_address);
		  	$('#express_price').val(data.express_price);
		  },
		  error:function(){

		  }
		});

	}
	else
	{
		$('#popupLabel').html(ADD_CLIENT);
		$('#service_id').val('');
	}
}

function addUpdateClient()
{
	$('body input').removeClass('error-class');

	var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();
	var phone = $('#phone').val();
	var mobile = $('#mobile').val();
	var fax = $('#fax').val();
	var email = $('#email').val();
	var street_address = $('#street_address').val();
	var zip = $('#zip').val();
	var city = $('#city').val();
	var company_name = $('#company_name').val();
	var invoice_country = $.trim($('#invoice_country').val());
	var invoice_city = $.trim($('#invoice_city').val());
	var invoice_zip = $.trim($('#invoice_zip').val());
	var invoice_street_address = $.trim($('#invoice_street_address').val());
	var express_price = $.trim($('#express_price').val());
	var country = $('#country').val();
	var id = $('#client_id').val();
	var check = true;

	if(id != '0' && id != '')
	{
		var method = 'PUT';
	}
	else
	{
		var method = 'POST';
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

	if(phone == '')
	{
		$('#phone').addClass('error-class').focus();
		check = false;
	}

	if(email == '')
	{
		$('#email').addClass('error-class').focus();
		check = false;
	}

	if(street_address == '')
	{
		$('#street_address').addClass('error-class').focus();
		check = false;
	}

	if(zip == '')
	{
		$('#zip').addClass('error-class').focus();
		check = false;
	}

	if(city == '')
	{
		$('#city').addClass('error-class').focus();
		check = false;
	}

	if(country == '')
	{
		$('#country').addClass('error-class').focus();
		check = false;
	}


	if(check)
	{
		$.ajax({
		  type: method,
		  dataType:"JSON",
		  url: api_url + 'client',
		  data: {id:id, 'first_name':first_name, 'last_name':last_name, 'phone':phone, 'mobile':mobile, 'fax':fax, 'email':email,
		  				 'street_address':street_address, 'zip':zip,'city':city,'country':country, company_name:company_name,
		  				 "invoice_country":invoice_country,"invoice_zip":invoice_zip,"invoice_city":invoice_city,"express_price":express_price,"invoice_street_address":invoice_street_address},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addClientPopup').modal('hide')		  	
		  	getClients();
		  },
		  error:function(){

		  }
		});

	}	
}

function deleteClient(id)
{
  $("#confirm").on("show", function() {    // wire up the OK button to dismiss the modal when shown
        $("#confirm a.btn").on("click", function(e) {
            $("#confirm").modal('hide');     // dismiss the dialog
        });
    });
    
    $("#confirm").on("hidden", function() {  // remove the actual elements from the DOM when fully hidden
        $("#confirm").remove();
    });
    
    $("#confirm").modal({                    // wire up the actual modal functionality and show the dialog
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     // ensure the modal is shown immediately
    });

//    $("#confirm #delete").on("click", function() {  // remove the actual elements from the DOM when fully hidden

//    });
	$('#confirm #delete').attr('onclick', 'deleteClientCall('+id+')')

}


function deleteClientCall(id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'client',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getClients();
	  },
	  error:function(){

	  }
	});
		
}


function getClients()
{
	var search_key = $('#search_key').val();
	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'clients',
	  data: {search_key:search_key , sort_by: sortBy, sort_order: sortOrder},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	if(data.length > 0)
	  	{
	  		var html = '';
	  		$.each(data, function( index, value ) {

			if(can_update)
			{
				var update_part = '<td>\
                      <a  data-toggle="modal" data-target="#addClientPopup" onclick="showClientPopup('+value.id+');" href="javascript:void(0);"><i class="fa fa-pencil"></i> '+EDIT+'</a> |\
                      <a onclick="deleteClient('+value.id+');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DELETE+'</a>\
                    </td>';
			}
			else
			{
				var update_part = '';
			}

	  			html += '<tr>\
                    <td>'+value.company_name+'</td> \
                    <td>'+value.first_name+' '+value.last_name+'</td>\
                    <td>'+value.phone+'</td>\
                    <td>'+value.mobile+'</td> \
                    <td>'+value.email+'</td> \
                    <td>'+value.street_address+', '+value.city+', '+value.zip+'. '+value.country+'</td> \
                    '+update_part+'\
                  </tr>';
			});

		  	$('#dataBody').html(html);			
	  	}

	  },
	  error:function(){
	  	$('#dataBody').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  }
	});
}

