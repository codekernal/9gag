function showContainer(container)
{
	$('#invite_div').show();
	$('#invite_status_div').hide();	

	$('.nav-tabs a:first').tab('show')	
	if(container == 'person')
	{
		$('#vehicle_container').hide();
		$('#person_container').fadeIn();
	}
	else if(container == 'vehicle')
	{
		$('#person_container').hide();
		$('#vehicle_container').fadeIn();
	}
	else
	{
		$('#person_container').fadeOut();
		$('#vehicle_container').fadeOut();
	}

}

function showMsg(id, msg, type)
{
	$(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)});	
}

function addUpdateResource()
{
	$('body input').removeClass('error-class');

	var resource_type = $.trim($('#resource_type').val());
	var id = $.trim($('#id').val());

	// vehicle info
	var vehicle_name = $.trim($('#vehicle_name').val());
	var vehicle_color = $.trim($('#vehicle_color').val());
	var person_color = $.trim($('#person_color').val());
	var vehicle_timezone = $.trim($('#vehicle_timezone').val());
	var vehicle_pic_path = $.trim($('#vehicle_pic_path').val());
	var vehicle_notes = $.trim($('#vehicle_notes').val());

	// person info
	var first_name = $.trim($('#first_name').val());
	var role_id = $.trim($('#role_id').val());
	var last_name = $.trim($('#last_name').val());
	var email = $.trim($('#email').val());
	var invite = $.trim($('#invite').val());
	var timezone = $.trim($('#timezone').val());
	var pic_path = $.trim($('#pic_path').val());
	var notes = $.trim($('#notes').val());
	var personal_nr = $.trim($('#personal_nr').val());
	var mobile = $.trim($('#mobile').val());
	var birthday = $.trim($('#birthday').val());
	var avh = $.trim($('#avh').val());
	var hire_date = $.trim($('#hire_date').val());
	var leaving_date = $.trim($('#leaving_date').val());
	var cat_id = $.trim($('#cat_id').val());
	var bank_name = $.trim($('#bank_name').val());
	var salary_payment = $.trim($('#salary_payment').val());
	var account_number = $.trim($('#account_number').val());
	var status = $.trim($('#status').val());
	var salary_type_id = $.trim($('#salary_type_id').val());
	var street_address = $.trim($('#street_address').val());
	var city = $.trim($('#city').val());
	var zip = $.trim($('#zip').val());
	var country = $.trim($('#country').val());



	var invite = 0;



	var services = [];
	$("input:checkbox[class=services]:checked").each(function()
	{
		var service = $(this).val();
		services.push(service);
	});	


	var educations = [];
	$("input:checkbox[class=educations]:checked").each(function()
	{
		var education = $(this).val();
		educations.push(education);
	});	

	var check = true;

	if(id != '0' && id != '')
		var method = 'POST';
	else
		var method = 'POST';

	if(resource_type == 'vehicle')
		var route = 'resource';
	else if(resource_type == 'person')
		var route = 'resource';	

	if(resource_type == '')
	{
		$('#resource_type').addClass('error-class').focus();
		check = false;
		return false;
	}

	if(resource_type == 'vehicle')
	{
		if(vehicle_name == '')
		{
			$('#vehicle_name').addClass('error-class').focus();
			check = false;
		}


		if(vehicle_color == '')
		{
			$('#vehicle_color').addClass('error-class').focus();
			check = false;
		}

		if(vehicle_timezone == '')
		{
			$('#vehicle_timezone').addClass('error-class').focus();
			check = false;
		}
/*
		if(vehicle_pic_path == '')
		{
			$('#vehicle_picture').addClass('error-class').focus();
			check = false;
		}		
	*/	
	}
	else
	{
		if(first_name == '')
		{
			$('#first_name').addClass('error-class').focus();
			check = false;
		}

		if(personal_nr == '')
		{
			$('#personal_nr').addClass('error-class').focus();
			check = false;
		}

		if(last_name == '')
		{
			$('#last_name').addClass('error-class').focus();
			check = false;
		}

		if(email == '')
		{
			$('#email').addClass('error-class').focus();
			check = false;
		}

		if(timezone == '')
		{
			$('#timezone').addClass('error-class').focus();
			check = false;
		}

		if(document.getElementById("invite").checked)
		{
			invite = 1;
		}
		else
			invite = 0;		
	}



	if(check)
	{
		$.ajax({
		  type: method,
		  dataType:"JSON",
		  url: api_url + route,
		  data: {salary_type_id: salary_type_id, id:id,'resource_type':resource_type, 'vehicle_name':vehicle_name, 'vehicle_color':vehicle_color,
		  'vehicle_timezone':vehicle_timezone, 'vehicle_pic_path':vehicle_pic_path,'vehicle_notes':vehicle_notes,
		   first_name:first_name, last_name:last_name, email:email, invite: invite, timezone: timezone, pic_path:pic_path,
		   notes:notes, mobile:mobile, person_color: person_color, "birthday" : birthday, "avh":avh, "hire_date" : hire_date,
		    "leaving_date" : leaving_date, cat_id:cat_id, bank_name:bank_name, salary_payment:salary_payment, 
		    account_number:account_number, status: status, "services" : services, 'role_id' : role_id, educations: educations,
		    city:city, street_address:street_address, country:country,zip:zip, personal_nr:personal_nr
			},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addClientPopup').modal('hide');
             getResources();
		  },
		  error:function(){
			showMsg('#msg', 'Resource already exists with this email', 'red')
		  }
		});
	}	
	else
	{
		$('.nav-tabs a:first').tab('show');
	}
}

function deleteClient(id)
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

function getResourceDetail(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'person',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){

	  		var generalInfo = '';
	  		$('#role_label').html(data.semantic_role).show();
	  		$('#detailpopupLabel').html(data.first_name+' '+data.last_name).show();

	  		$('#name_label').html(data.first_name+' '+data.last_name).show();
	  		$('#email_label').html(data.email).show();
	  		$('#mobile_label').html(data.mobile).show();
	  		$('#color_label').css('background-color', '#'+data.color).show();
	  		$('#invite_label').html(data.inv_status).show();
	  		$('#timezone_label').html(data.timezone).show();
	  		if(data.abs_pic != '')
		  		$('#pic_label').attr('src', data.abs_pic).show();
	  		$('#notes_label').html(data.notes).show();

	  		$('#birthday_label').html(data.birthday).show();
	  		$('#avh_label').html(data.avh).show();
	  		$('#hire_date_label').html(data.hire_date).show();
	  		$('#leaving_date_label').html(data.leaving_date).show();
	  		if(typeof data.cat_data.name != 'undefined' )
		  		$('#empcategory_label').html(data.cat_data.name).show();
	  		$('#salary_payment_label').html(data.salary_payment).show();
	  		$('#bank_name_label').html(data.bank_name).show();
	  		$('#account_number_label').html(data.account_number).show();
	  		$('#status_label').html(data.status).show();
	  		$('#street_address_label').html(data.street_address).show();
	  		$('#city_label').html(data.city).show();
	  		$('#zip_label').html(data.zip).show();
	  		$('#country_label').html(data.country).show();
	  		$('#personal_nr_label').html(data.personal_nr).show();

	  		var skills = '';
	  		$.each(data.services, function( index, value ) {
	  			skills += value.name+'<br>';
	  		});
	  		$('#skills_label').html(skills).show();

	  		var educations = '';
	  		$.each(data.educations, function( index, value ) {
	  			educations += value.name+'<br>';
	  		});

	  		$('#educations_label').html(educations).show();

	  		$('#monthly_hours').html(data.working_hours.monthly).show();
	  		$('#yearly_hours').html(data.working_hours.yearly).show();

	  		var projects = '';
	  		$.each(data.projects, function( index, value ) {
	  			projects += value+'<br>';
	  		});
	  		$('#projects_label').html(projects).show();	  		


	 //  	$('#first_name').val(data.first_name);
	 //  	$('#last_name').val(data.last_name);
	 //  	$('#person_color').val(data.color);
	 //  	$('#mobile').val(data.mobile);
	 //  	$('#email').val(data.email);
	 //  	$('#email').css('disabled','disabled');
	 //    $("#person_color").change();
	 //  	$('#timezone').val(data.timezone);
	 //  	if(data.url!='')
	 //  	{
		//   	$('#temp_pic').attr('src',data.url);
		//   	$('#temp_pic').show();
	 //  	}
	 //  	$('#email').attr('disabled',true);		  	
	 //  	$('#pic_path').val(data.pic);
	 //  	$('#role_id').val(data.role_id);
	 //  	$('#notes').val(data.notes);
	 //  	$('#birthday').val(data.birthday);
	 //  	$('#avh').val(data.avh);
	 //  	$('#hire_date').val(data.hire_date);
	 //  	$('#leaving_date').val(data.leaving_date);
	 //  	$('#cat_id').val(data.cat_id);
	 //  	$('#salary_payment').val(data.salary_payment);
	 //  	$('#bank_name').val(data.bank_name);
	 //  	$('#account_number').val(data.account_number);
	 //  	$('#status').val(data.status);

	 //  	if(data.invite_status == 'pending' || data.invite_status == 'not_invited' || data.invite_status == 'declined')
	 //  	{
	 //  		$('#invite_div').show();
	 //  	}
	 //  	else if(data.invite_status == 'accepted')
	 //  	{
	 //  		$('#invite_div').hide();
	 //  	}
	  	
	 //  	if(data.invite_status == 'not_invited')
	 //  		data.invite_status = 'Not invited';

  // 		$('#invite_status').html(capitaliseFirstLetter(data.invite_status));
  // 		$('#invite_status_div').show();

		// $(data.services).each(function(ind, val)
		// {
		// 	$('#service_'+val).attr('checked', 'checked');
		// });	

	  },
	  error:function(){

	  }
	});	
}

function getResources()
{
	var search_key = $('#search_key').val();

	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'resources',
	  data: {"keyword":search_key},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	if(data.vehicles.length > 0)
	  	{
	  		var personhtml = '';
	  		var vehiclehtml = '';

			var vehicle_found = false;
			var person_found = false;
			var vehicleRs = data.vehicles;
			var allResources = data.persons.concat(data.vehicles);
	  		$.each(allResources, function( index, value ) {

	  			if(value.pic == '')
	  				pic = '';
	  			else
	  				pic = '<img src="'+value.pic+'" width="50">';

	  		var detail_part = '';

			if(value.type == 'Person')
			{
				detail_part = '<a data-toggle="modal" data-target="#resourceDetail" onclick="getResourceDetail('+value.id+');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DETAIL+'</a> | ';
			}



			if(can_update)
			{
				var update_part = '<td>\
				'+detail_part+'\
                      <a data-toggle="modal" data-target="#addClientPopup" onclick="showResourcePopup('+value.id+', \''+value.type+'\');" href="javascript:void(0);"><i class="fa fa-pencil"></i> '+EDIT+'</a> |\
                      <a onclick="deleteResource('+value.id+', \''+value.type+'\');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DELETE+'</a>\
                    </td>';
			}
			else
			{
				var update_part = '';
			}


			if(value.type == 'Vehicle')
			{
				vehicle_found = true;
	  			vehiclehtml += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.type+'</td>\
                    <td><div style="width:20px;height:20px;background-color:'+value.color+'"></div> \
                    <td>'+pic+'</td> \
                    '+update_part+'</tr>';				
			}
			if(value.type == 'Person')
			{
				person_found = true;				
	  			personhtml += '<tr>\
                    <td>'+pic+'</td> \
                    <td>'+value.name+'</td>\
                    <td>'+value.email+'</td>\
                    <td>'+value.mobile+'</td>\
                    '+update_part+'</tr>';				
			}

			
			});
			
			
		  	$('#dataBodyPerson').html(personhtml);
		  	$('#dataBodyVehicle').html(vehiclehtml);
		  	if(!person_found)
			  	$('#dataBodyPerson').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
		  	if(!vehicle_found)
			  	$('#dataBodyVehicle').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  	}

	  },
	  error:function(){
	  	
	  	$('#dataBodyPerson').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  	$('#dataBodyVehicle').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  	
	  }
	});
}

function deleteResource(id, type)
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

	$('#confirm #delete').attr('onclick', 'deleteResourceCall('+id+', \''+type+'\')')
}

function deleteResourceCall(id, type)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'delete_resource',
	  data: {id:id, type:type},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getResources();
	  },
	  error:function(){

	  }
	});		
}

function reset()
{
	$('#resource_type, #first_name,#vehicle_name, #last_name, #email, #mobile, #vehicle_pic_path, #pic_path').val('');
	$('#invite').attr('checked', false);
	$('#vehicle_temp_pic, #temp_pic').attr('src', '').hide();;
	$('#timezone, #vehicle_timezone').val('Europe/Amsterdam');
	$('#vehicle_color, #person_color').val('#000000');
  	$('#email').removeAttr('disabled');	
  	$('#birthday, #avh, #hire_date, #leaving_date, #bank_name, #account_number, #personal_nr').val('');
  	$('#status').val('active');
  	$('#salary_payment').val('monthly');
	$("#cat_id option:first").attr('selected','selected');

	$('#city, #street_address, #zip').val('');
	$("#role_id option:first").attr('selected','selected');
	$("#salary_type_id option:first").attr('selected','selected');
	$("#country option:first").attr('selected','selected');
	$('#salary_div').html(SELECT_HIRE_DATE);

	$("input:checkbox[class=services]:checked").each(function()
	{
		$(this).prop('checked', false);
	});		

	$("input:checkbox[class=educations]:checked").each(function()
	{
		$(this).prop('checked', false);
	});		

}	

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function populatePerson(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'person',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#first_name').val(data.first_name);
	  	$('#last_name').val(data.last_name);
	  	$('#person_color').val(data.color);
	  	$('#mobile').val(data.mobile);
	  	$('#email').val(data.email);
	  	$('#email').css('disabled','disabled');
	    $("#person_color").change();
	  	$('#timezone').val(data.timezone);
	  	if(data.url!='')
	  	{
		  	$('#temp_pic').attr('src',data.url);
		  	$('#temp_pic').show();
	  	}

	  	
	  	$('#salary_type_id').val(data.salary_type_id);

	  	$('#email').attr('disabled',true);		  	
	  	$('#pic_path').val(data.pic);
	  	$('#role_id').val(data.role_id);
	  	$('#notes').val(data.notes);
	  	$('#birthday').val(data.birthday);
	  	$('#avh').val(data.avh);
	  	$('#hire_date').val(data.hire_date);
	  	$('#leaving_date').val(data.leaving_date);
	  	$('#cat_id').val(data.cat_id);
	  	$('#salary_payment').val(data.salary_payment);
	  	$('#bank_name').val(data.bank_name);
	  	$('#personal_nr').val(data.personal_nr);
	  	$('#account_number').val(data.account_number);
 	 	$('#city').val(data.city);
 	 	
 	 	if(data.country != '' && typeof data.country != null)
 		 	$('#country').val(data.country);
 	 	
 	 	$('#zip').val(data.zip);
 	 	$('#street_address').val(data.street_address);

	  	$('#status').val(data.status);

	  	if(data.invite_status == 'pending' || data.invite_status == 'not_invited' || data.invite_status == 'declined')
	  	{
	  		$('#invite_div').show();
	  	}
	  	else if(data.invite_status == 'accepted')
	  	{
	  		$('#invite_div').hide();
	  	}
	  	
	  	if(data.invite_status == 'not_invited')
	  		data.invite_status = 'Not invited';

  		$('#invite_status').html(capitaliseFirstLetter(data.invite_status));
  		$('#invite_status_div').show();

		$(data.services).each(function(ind, val)
		{
			$('#service_'+val['service_id']).prop('checked', true);
		});	

		$(data.educations).each(function(ind, val)
		{
			$('#education_'+val['education_id']).prop('checked', true);
		});	

		getSalary();

	  },
	  error:function(){

	  }
	});	
}


function getSalary()
{
	var hire_date = $('#hire_date').val();
	var cat_id = $('#cat_id').val();
	var id = $('#id').val();

	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'get_salary',
	  data: {id:id, hire_date:hire_date, cat_id: cat_id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	if(data)
		  	$('#salary_div').html(data);
	  },
	  error:function(){

	  }
	});	
}



function populateVehicle(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'vehicle',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#vehicle_name').val(data.name);
	  	$('#vehicle_color').val(data.color);
	    $("#vehicle_color").change();
	  	$('#vehicle_timezone').val(data.timezone);
	  	if(data.url!='')
	  	{
		  	$('#vehicle_temp_pic').attr('src',data.url);
		  	$('#vehicle_temp_pic').show();
	  	}
	  	$('#vehicle_pic_path').val(data.pic);

	  	$('#vehicle_notes').val(data.notes);

	  },
	  error:function(){

	  }
	});	
}
	
function showResourcePopup(id, type)
{
	reset();
	var type = type.toLowerCase();

	$('#select_resource').hide();
	$('#resource_type').val(type);
	if(id != '')
	{
		$('#id').val(id);		

		$('#select_resource').hide();
		$('#resource_type').val(type);
		showContainer(type);
		$('#popupLabel').html(UPDATE_RESOURCE);		
		if(type == 'vehicle')
			populateVehicle(id);
		else if(type == 'person')
			populatePerson(id);		
	}
	else
	{
		$('#id').val('');
		//$('#select_resource').show();
		$('#popupLabel').html(ADD_RESOURCE);
		showContainer(type);
	}


}