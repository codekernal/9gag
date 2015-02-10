var sortBy = '';
var sortOrder = '';

function showServicePopup(id)
{
	$('#client_related').prop('checked', false);
	$('#client_div').hide();	
  	$('#service_name, #employee_price, #client_price').val('');
  	$('#description').val('');

	if(id != 0)
	{
		$('#popupLabel').html(UPDATE_SERVICE);
		$('#service_id').val(id);

		// fetch data
		$.ajax({
		  type: 'GET',
		  dataType:"JSON",
		  url: api_url + 'service',
		  data: {id:id},
		  beforeSend:function(){

		  },
		  success:function(data){

		  	$('#service_name').val(data.name);
		  	$('#description').val(data.desc);
		  	$('#client_price').val(data.client_price);
		  	$('#employee_price').val(data.employee_price);		  	
		  	if(data.client_id != 0)
		  	{
		  		$('#client_id').val(data.client_id);
		  		$('#client_div').show();
		  		$('#client_related').prop('checked', true);
		  	}
		  },
		  error:function(){

		  }
		});

	}
	else
	{
		$('#popupLabel').html(ADD_SERVICE);
		$('#service_id').val('');
	}
}

function addUpdateService()
{
	$('body input').removeClass('error-class');

	var name = $('#service_name').val();
	var desc = $('#description').val();
	var id = $('#service_id').val();
	var client_price = $('#client_price').val();	
	var employee_price = $('#employee_price').val();

	var client_id = clientRelated();
	var check = true;
	if(id != '0' && id != '')
	{
		var method = 'PUT';
	}
	else
	{
		var method = 'POST';
	}

	if(name == '')
	{
		$('#service_name').addClass('error-class').focus();
		check = false;
	}

	if(employee_price == '')
	{
		$('#employee_price').addClass('error-class').focus();
		check = false;
	}

	if(desc == '')
	{
		$('#description').addClass('error-class');
		if(name != '')
			$('#description').focus();		
		check = false;
	}	
	
	if(check)
	{
		$.ajax({
		  type: method,
		  dataType:"JSON",
		  url: api_url + 'service',
		  data: {id:id, 'name':name, 'desc':desc, 'client_id' : client_id, employee_price: employee_price, client_price:client_price},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addServicePopup').modal('hide')		  	
		  	getServices();
		  },
		  error:function(){

		  }
		});

	}	
}

function deleteService(id)
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
	$('#confirm #delete').attr('onclick', 'deleteServiceCall('+id+')')

}

function deleteServiceCall(id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'service',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getServices();
	  },
	  error:function(){

	  }
	});	
}

function clientRelated()
{
	var client_id = 0;
	if($('#client_related').prop('checked'))
	{
		$('#client_div').show();
		client_id = $('#client_id').val();
	}
	else
	{
		$('#client_div').hide();
		client_id = 0
	}
	return client_id;
}

function getServices()
{
	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'services',
	  data: { sort_by: sortBy, sort_order: sortOrder},
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
                      <a  data-toggle="modal" data-target="#addServicePopup" onclick="showServicePopup('+value.id+');" href="javascript:void(0);"><i class="fa fa-pencil"></i> '+EDIT+'</a> |\
                      <a onclick="deleteService('+value.id+');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DELETE+'</a>\
                    </td>';
			}
			else
			{
				var update_part = '';
			}

	  			html += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.employee_price+'</td>\
                    <td>'+value.client_price+'</td>\
                    <td>'+value.desc+'</td>\
                    '+update_part+'\
                  </tr>';
			});

		  	$('#dataBody').html(html);			
	  	}

	  },
	  error:function(){
	  	$('#dataBody').html('<tr><td align="center" colspan="4">'+NO_RECORD+'</td></tr>');
	  }
	});
}
