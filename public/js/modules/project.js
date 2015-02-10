
function showMsg(id, msg, type)
{
	$(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)});	
}

var sortBy = '';
var sortOrder = '';


function showDayTime(day, value)
{
	if(value != '')
		$('.day_div'+day).show();	
	else
		$('.day_div'+day).hide();			
}

function showPrice(val)
{
	if(val != 0 && val != '')
		$('#price_div').fadeIn();
	else
		$('#price_div').fadeOut();		
}

function showProjectPopup(id)
{
//	validate(1);

	reset();

	$('#project_id').val(id);	
	getClients(true);
//	getResoruces();
//	getProjectServices();


	if(id != '' && id != 0)
	{
		$('#popupLabel').html(UPDATE_PROJECT);
		getProject(id);
	}
	else
	{
		$('#popupLabel').html(ADD_PROJECT);
	}



}

// function getClientServices(value)
// {
// 	getProjectServices(value);
// }

function reset()
{
	$('body input').removeClass('error-class');
	$('#project_name').val('');
	$('#budget_type').val('');
	$('#project_code').val('');
	$('#price').val('');
	$('#price_div').hide();
	$('#pic_path').val('');		
	$('#employee_count').val('');			
	$('#temp_pic').attr('src', canvas_url+'images/placeholder.png');
	
	$('#project_budget').val('0');
	$('#project_hours').val('');	
	$('#project_hours_div').fadeOut();
	$('.resrouces, .services, .days, #express_price').prop('checked', false);
	// $('#single').prop('checked', true);	
	// $('#start_date, #end_date, #start_time, #end_time').val('');
	// $('#dates_range').hide();
	// $('#end_date_div').hide();
	$('#city, #zip, #street_address').val('');
	$('#country').val('Switzerland');
	$('#project_status').val('Active');
	$('#project_notes').val('');
	$('#basecamp, #trello, #google, #harvest, #dropbox').val('');
}


function validate(num)
{
	$('.nav-tabs a:eq( '+num+' )').tab('show')
}

function addUpdateProject()
{
	var id = $('#project_id').val();
	$('body input').removeClass('error-class');
	check = true;
	// Information
	var project_name = $.trim($('#project_name').val());
	var budget_type = $('#budget_type').val();
	var client_id = $.trim($('#client_id').val());
	var project_code = $.trim($('#project_code').val());
	var employee_count = $('#employee_count').val();			
	var image = $.trim($('#pic_path').val());
	// var start_time = $.trim($('#start_time').val());
	// var end_time = $.trim($('#end_time').val());

	var city = $.trim($('#city').val());
	var street_address = $.trim($('#street_address').val());
	var zip = $.trim($('#zip').val());
	var country = $.trim($('#country').val());

	// var resources  = [];
	// var services

	// var time_type = $('input[name="time_type"]:checked').val();
	var express_price = $('input[id="express_price"]:checked').val();
	if(express_price == null || express_price == '')
		express_price = '';

	var price = 0;
	if(budget_type != '' || budget_type != '0')
	{
		price = $.trim($('#price').val());
	}

	if(project_name == '')
	{
		validate(0);
		$('#project_name').addClass('error-class').focus();
		check = false;
		return check;
	}

	// var start_date = '';
	// var end_date = '';

	// days
	// var days = [];
	// $("input:checkbox[class=days]:checked").each(function()
	// {
	// 	var day = $(this).val();
	// 	days.push(day);
	// });	



	// if(time_type == 'single')
	// {
	// 	var start_date = $('#start_date').val();
	// 	if(start_date == '')
	// 	{
	// 		validate(3);			
	// 		$('#start_date').addClass('error-class').focus();
	// 		check = false;			
	// 	}
	// 	else
	// 		var end_date = start_date;

	// 	if(start_time == '')
	// 	{
	// 		$('#start_time').addClass('error-class');
	// 		check = false;
	// 	}
	// 	if(end_time == '')
	// 	{
	// 		$('#end_time').addClass('error-class');
	// 		check = false;
	// 	}		

	// }
	// else if(time_type == 'recurring')
	// {
	// 	var start_date = $('#start_date').val();
	// 	var end_date = $('#end_date').val();
	// 	start_time = '';
	// 	end_time = '';
	// 	if(start_date == '')
	// 	{
	// 		validate(3);						
	// 		$('#start_date').addClass('error-class');
	// 		check = false;			
	// 	}
	// 	if(end_date == '')
	// 	{
	// 		validate(3);						
	// 		$('#end_date').addClass('error-class');
	// 		check = false;			
	// 	}

	// 	var actual_days = [];
	// 	if(days.length == 0)
	// 	{
	// 		validate(3);
	// 		showMsg('#days_msg', 'Please select a day', 'red');
	// 		check = false;
	// 	}
	// 	else
	// 	{
	// 		var start_end_date = false;
	// 		$(days).each(function(day_ind, day_value)
	// 		{
	// 			var start_day_time = $('#start_time'+day_value).val();
	// 			var end_day_time = $('#end_time'+day_value).val();


	// 			if(start_day_time == '' || end_day_time == '')
	// 			{
	// 				validate(3);
	// 				start_end_date = true;
	// 			}
	// 			else
	// 			{
	// 				var datetime_obj = {"start_time":start_day_time,"end_time":end_day_time};
	// 				actual_days[day_value] = datetime_obj;
	// 			}
	// 		});

	// 		if(start_end_date)
	// 		{
	// 			showMsg('#days_msg', 'Please select start time and end time.', 'red');
	// 			check = false;
	// 		}			
	// 	}
	// }




/*
	if(project_code == '')
	{
		validate();
		$('#project_code').addClass('error-class').focus();
		check = false;
	}	
*/

	// var services = [];
	// $("input:checkbox[class=services]:checked").each(function()
	// {
	// 	var service = $(this).val();
	// 	services.push(service);
	// });	

	// Resources
// 	$("input:checkbox[class=resrouces]:checked").each(function()
// 	{
// //		if($(this).is(":visible"))		{
// 			resource_id = $(this).val();
// 			resource_type = $(this).data('resource_type');

// 			if($("#invite_"+resource_id+'Person').length > 0 && document.getElementById("invite_"+resource_id+'Person').checked)
// 				var project_invite = 1;
// 			else
// 				var project_invite = 0;

// 			if($("#confirm_"+resource_id+'Person').length > 0)
// 			{
// 				if(document.getElementById("confirm_"+resource_id+'Person').checked)
// 					var confirm = 'yes';
// 				else
// 					var confirm = 'no';			
// 			}
// 			else
// 					var confirm = 'no';			


// 			obj = {"resource_id":resource_id,"resource_type":resource_type, 'invite' : project_invite, 'confirm': confirm};
// 			resources.push(obj);

// //		}


// 	});



	// project budget
	var project_budget = $('#project_budget').val();
	if(project_budget != '0')
	{
		project_hours = $('#project_hours').val();
	}
	else
	{
		project_hours = '';
	}






	// project status
	var project_status = $('#project_status').val();

	// project notes
	var project_notes = $.trim($('#project_notes').val());

	// project links
	var basecamp = $.trim($('#basecamp').val());
	var harvest = $.trim($('#harvest').val());	
	var trello = $.trim($('#trello').val());	
	var dropbox = $.trim($('#dropbox').val());		
	var google = $.trim($('#google').val());	

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'project',
		  data: { project_id: id,"project_name":project_name,"project_code":project_code,"image":image,"project_budget":project_hours,"status":project_status,"notes":project_notes,"basecamp":basecamp,"harvest":harvest, "trello":trello, "dropbox":dropbox,"google":google, "client_id":client_id,employee_count:employee_count, budget_type:budget_type, price:price, express_price:express_price, city:city, street_address:street_address, zip:zip, country:country },
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addClientPopup').modal('hide');
		    getProjects();
		  },
		  error:function(){

		  }
		});

	}




}


function addUpdateTask()
{
	var project_id = $('#project_id').val();
	var task_id = $('#task_id').val();	
	var task_name = $('#task_name').val();	
	var service_id = $('#task_service_id').val();		
	$('body input').removeClass('error-class');
	check = true;
	
	// Information
	var start_time = $.trim($('#start_time').val());
	var end_time = $.trim($('#end_time').val());

	var time_type = $('input[name="time_type"]:checked').val();

	var start_date = '';
	var end_date = '';

	var days = [];
	$("input:checkbox[class=days]:checked").each(function()
	{
		var day = $(this).val();
		days.push(day);
	});	

	if(task_name == '')
	{
		$('#task_name').addClass('error-class').focus();
		check = false;
	}

	if(service_id == '')
	{
		$('#task_service_id').addClass('error-class').focus();
		check = false;
	}

	 var resources  = [];

	$(".resources").each(function()
	{
//		if($(this).is(":visible"))		{
			resource_id = $(this).val();
			resource_type = $(this).data('resource_type');

			if($("#invite_"+resource_id+'Person').length > 0 && document.getElementById("invite_"+resource_id+'Person').checked)
				var project_invite = 1;
			else
				var project_invite = 0;

			if($("#confirm_"+resource_id+'Person').length > 0)
			{
				if(document.getElementById("confirm_"+resource_id+'Person').checked)
					var confirm = 'yes';
				else
					var confirm = 'no';			
			}
			else
					var confirm = 'no';			


			obj = {"resource_id":resource_id,"resource_type":resource_type, 'invite' : project_invite, 'confirm': confirm};
			resources.push(obj);

//		}
	})


	if(time_type == 'single')
	{
		var start_date = $('#start_date').val();
		if(start_date == '')
		{
			$('#start_date').addClass('error-class').focus();
			check = false;			
		}
		else
			var end_date = start_date;

		if(start_time == '')
		{
			$('#start_time').addClass('error-class');
			check = false;
		}
		if(end_time == '')
		{
			$('#end_time').addClass('error-class');
			check = false;
		}		

	}
	else if(time_type == 'recurring')
	{
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		start_time = '';
		end_time = '';
		if(start_date == '')
		{
			$('#start_date').addClass('error-class');
			check = false;			
		}
		if(end_date == '')
		{
			$('#end_date').addClass('error-class');
			check = false;			
		}

		var actual_days = [];
		if(days.length == 0)
		{
			showMsg('#days_msg', 'Please select a day', 'red');
			check = false;
		}
		else
		{
			var start_end_date = false;
			$(days).each(function(day_ind, day_value)
			{
				var start_day_time = $('#start_time'+day_value).val();
				var end_day_time = $('#end_time'+day_value).val();


				if(start_day_time == '' || end_day_time == '')
				{
					start_end_date = true;
				}
				else
				{
					var datetime_obj = {"start_time":start_day_time,"end_time":end_day_time};
					actual_days[day_value] = datetime_obj;
				}
			});

			if(start_end_date)
			{
				showMsg('#days_msg', 'Please select start time and end time.', 'red');
				check = false;
			}			
		}
	}

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'task',
		  data: { project_id: project_id, task_id: task_id,"name":task_name, time_type: time_type, start_date:start_date,end_date:end_date, start_time:start_time, end_time:end_time, days:actual_days, resources:resources, service_id: service_id},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addClientPopup').modal('hide');
            $("#tasks").modal('hide');     // dismiss the dialog
		  },
		  error:function(){

		  }
		});

	}




}

function changeTimeType(time_type)
{
	$('#end_date_div').hide();
	if(time_type == 'single')
	{
		$('#start_time_div, #end_time_div').fadeIn();
		$('#days_container').hide();		
	}
	else if(time_type == 'recurring')
	{
		$('#end_date_div').fadeIn();		
		$('#start_time_div, #end_time_div').hide();
		$('#end_date').val('');		
		$('#days_container').fadeIn();
	}
}


// function showDays()
// {
// 	var days = $('input[name="project_days"]:checked').val();
// 	if(days == 0)
// 	{
// 		$('#days_container').fadeOut();
// 	}
// 	else
// 	{
// 		$('#days_container').fadeIn();
// 	}
// }

function showBudget(num)
{
	if(num == 0)
		$('#project_hours_div').fadeOut();
	else
		$('#project_hours_div').fadeIn();	
}

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}


var globalVehicles = [];
var globalPersons = [];

function addVechicle()
{
	var options = '<option value="0">--Select Vehicle--</option>';
	if(globalVehicles.length > 0)
	{
		$.each(globalVehicles, function( index, value ) {
		
			options += '<option value="'+value.id+'">'+value.name+'</option>';

		});	
	}

	html = '<div style="border:1px solid #ddd; padding : 15px;border-radius: 10px;margin-bottom:5px;"><div class="form-group">\
                <label for="recipient-name" class="col-lg-4 control-label"></label>\
                <select name="vehicles[]" class="resources" data-resource_type="Vehicle">'+options+'</select>\
                <i onclick="$(this).parent().parent().remove();" class="fa fa-times"style="float:right;margin-right:40px;"></i>\
           </div></div>';

    $('#vehicle_container').append(html);
}
var globailPersonArr = [];

function showPersonOptions(cur_obj, counter)
{
	var obj = globailPersonArr[cur_obj.value];
	var html = '<div class="form-group">\
                <label for="recipient-name" class="col-lg-4 control-label">Invite</label>\
                '+obj['invite_var']+'\
           </div>           \
				<div class="form-group">\
                <label for="recipient-name" class="col-lg-4 control-label">Invite Status</label>\
                '+obj['invite_status']+'\
           </div>           \
				<div class="form-group">\
                <label for="recipient-name" class="col-lg-4 control-label">Confirmed</label>\
                '+obj['confirm_var']+'\
           </div>';

    $('.person_options'+counter).html(html);
}

var globalCounter = 0;
function addPerson()
{
	var options = '<option value="0">--Select Person--</option>';
	if(globalPersons.length > 0)
	{
		$.each(globalPersons, function( index, value ) {
		
			options += '<option value="'+value.id+'">'+value.name+'</option>';

			var invite_status = 'Not Invited';

			if(value.type == 'Person')
			{
				var confirm_var = '<input type="checkbox" id="confirm_'+value.id+value.type+'" value="yes">';	
			}

			var confirmed = '';
			if(value.is_resource)
			{
				checked = 'checked="checked"';

				if(value.type == 'Person')
				{
					if(value.confirmed == 'yes')
					{
						var confirmed = 'checked="checked"';
					}
					var confirm_var = '<input '+confirmed+' type="checkbox" id="confirm_'+value.id+value.type+'" value="yes">';	
				}

				if(value.invite_status == 'declined')
					confirm_var = '';


				if(value.invite_status == 'declined' || value.invite_status == 'pending')
				{
					var invite_var = '<input type="checkbox" id="invite_'+value.id+value.type+'" value="1"> Invite';					
					var invite_status = capitaliseFirstLetter(value.invite_status);					
				}
				else if(value.invite_status == 'not_invited')
				{
					var invite_var = '<input type="checkbox" id="invite_'+value.id+value.type+'" value="1"> Invite';
				}
				else if(value.invite_status == 'accepted')
				{
					var invite_var = 'Accepted';
					var invite_status = 'Accepted';					
				}
			}
			else
				var invite_var = '<input type="checkbox" id="invite_'+value.id+value.type+'" value="1"> Invite';

			var obj = {"invite_var":invite_var, "invite_status":invite_status, "confirm_var":confirm_var};
			globailPersonArr[value.id] = obj;

		});	
	}



	html = '<div style="border:1px solid #ddd; padding : 15px;border-radius: 10px;margin-bottom:5px;">\
                <i onclick="$(this).parent().remove();" class="fa fa-times"style="float:right;margin-right:40px;"></i>\
		   <div class="form-group">\
                <label for="recipient-name" class="col-lg-4 control-label"></label>\
                <select name="persons[]" data-resource_type="Person" class="resources" onchange="showPersonOptions(this, '+globalCounter+');">'+options+'</select>\
           </div>\
           <div class="person_options'+globalCounter+'"></div>\
           </div>\
           ';

    $('#person_container').append(html);

    globalCounter++;
}

function getSingleTask(task_id)
{
	$('#task_id').val(task_id);
	$('.nav-tabs-tasks a:eq( 1 )').tab('show');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'task',
	  data: { task_id: task_id },
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#task_name').val(data.name);
	  	$('#task_service_id').val(data.service_id);
		
		getResoruces(data.service_id);
		
		if(data.start_date != '' || data.end_date != '')
	  	{
	  		if(data.start_date != '')
	  			$('#start_date').val(data.start_date);
	  		if(data.end_date != '')
	  			$('#end_date').val(data.end_date);	  		
	  	}



	  	if(data.time_type == 'single')
	  	{
			$('#single').prop('checked', true);
			$('#end_date_div').hide();
			$('#start_time').val(data.start_time);
			$('#end_time').val(data.end_time);
			$('#start_time_div, #end_time_div').show();
	  	}
	  	else if(data.time_type == 'recurring')
	  	{
			$('#recurring').prop('checked', true);	
			$('#start_time_div, #end_time_div').hide();
			$('#end_date_div').show();

	  		$.each(data.days, function( index, day_value ) {
	  			$('#day_'+day_value.day_code).prop('checked', 'checked');
	  			$('#start_time' + day_value.day_code).val(day_value.start_time);	  			
	  			$('#end_time' + day_value.day_code).val(day_value.end_time);	  			
	  			$('.day_div' + day_value.day_code).show();
			});			

			$('#days_container').show();
	  	}
	  },
	  error:function(){


	  }
	});
}

function getProjectTasks(project_id)
{
	html = '<table class="table table-striped statusTable">\
            <thead>\
            <tr>\
                <td>Task Name</td>\
                <td>Actions</td>\
            </tr>\
            </thead>\
            <tbody>';

	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'tasks',
	  data: { project_id: project_id },
	  beforeSend:function(){

	  },
	  success:function(data){

	  		$.each(data, function( index, value ) {
				html += '<tr>\
                                <td>'+value.name+'</td>\
                                <td><a  data-toggle="modal" onclick="getSingleTask('+value.id+');" href="#">\
                      <i class="fa fa-pencil"></i> '+EDIT+'</a> | \
                      <a onclick="deleteTask('+value.id+', \'task\');" href="javascript:void(0);">\
                      <i class="fa fa-trash-o"></i> '+DELETE+'</a><br></td>\
                            </tr>';

	  		})
			html += '</tbody></table>';	  		
			$('#home').html(html);
	  },
	  error:function(){

			html += '<tr><td style="align:center;" colspan=2>No tasks found</td></tr></tbody></table>';	  		
			$('#home').html(html);

	  }
	});
}

function getResoruces(service_id)
{
	var project_id = $.trim($('#project_id').val());	
	var task_id = $.trim($('#task_id').val());	

	globalVehicles = [];
	globalPersons = [];

	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  	  async: false,
	  url: api_url + 'project_resources',
	  data: { project_id: project_id, service_id:service_id, task_id: task_id },
	  beforeSend:function(){

	  },
	  success:function(data){
	  	
	  	globalVehicles = data.vehicles;
	  	globalPersons = data.persons;

	  	if(globalPersons.length > 0)
	  		$('#addPersonAnchor').show();
	  	else
	  		$('#addPersonAnchor').hide();	  		

	  	$('#person_container').html('');
	  	var html = '';
 		$.each(globalVehicles, function( index, value ) {
			if(value.is_resource)
			{
				html += '<div style="border:1px solid #ddd; padding : 15px;border-radius: 10px;margin-bottom:5px;"><div class="form-group">\
	                <label for="recipient-name" class="col-lg-4 control-label"></label>\
	                <span>'+value.name+'</span>\
	                <select name="vehicles[]" class="resources" data-resource_type="Vehicle" style="display:none;"><option value="'+value.id+'"></option></select>\
	                <i onclick="$(this).parent().parent().remove();" class="fa fa-times"style="float:right;margin-right:40px;"></i>\
	           </div></div>';
			} 			
 		});

	  	$('#vehicle_container').html(html);

// 			vehicle_str = '';
// 		$.each(data, function( index, value ) {
// 			var checked = '';
			
// 			var invite_status = 'Not Invited';

// 			if(value.type == 'Person')
// 			{
// 				var confirm_var = '<input type="checkbox" id="confirm_'+value.id+value.type+'" value="yes">';	
// 			}

// 			var confirmed = '';
// 			if(value.is_resource)
// 			{
// 				checked = 'checked="checked"';

// 				if(value.type == 'Person')
// 				{
// 					if(value.confirmed == 'yes')
// 					{
// 						var confirmed = 'checked="checked"';
// 					}
// 					var confirm_var = '<input '+confirmed+' type="checkbox" id="confirm_'+value.id+value.type+'" value="yes">';	
// 				}

// 				if(value.invite_status == 'declined')
// 					confirm_var = '';
// 				if(value.invite_status == 'declined' || value.invite_status == 'pending')
// 				{
// 					var invite_var = '<input type="checkbox" id="invite_'+value.id+value.type+'" value="1"> Invite';					
// 					var invite_status = capitaliseFirstLetter(value.invite_status);					
// 				}
// 				else if(value.invite_status == 'not_invited')
// 				{
// 					var invite_var = '<input type="checkbox" id="invite_'+value.id+value.type+'" value="1"> Invite';					
// 				}
// 				else if(value.invite_status == 'accepted')
// 				{
// 					var invite_var = 'Accepted';
// 					var invite_status = 'Accepted';					
// 				}
// 			}
// 			else
// 				var invite_var = '<input type="checkbox" id="invite_'+value.id+value.type+'" value="1"> Invite';

// 			var classes = '';


// 			if(typeof value.services != 'undefined')
// 			{
// 				$.each(value.services, function( service_index, service_id ) {
// 					classes += ' service_class_'+service_id;
// 				});

// 			html += '<tr class="resources_div '+classes+'" style="margin-bottom:0px;display:none;"><td><div class="form-group">\
// 			<div><label class="checkbox-inline">\
// 			<input type="checkbox" class="resrouces" '+checked+' value="'+value.id+'" data-resource_type="'+value.type+'">\
// 			<i class="fa fa-'+resource_icon+'"></i> '+value.name+'</label></div></div></td><td>'+invite_var+'</td><td>'+invite_status+'</td><td>'+confirm_var+'</td></tr>';


// 			}
// 			else
// 			{
// 				html += '<tr><td colspan="4"><div class="form-group">\
// 			<div><label class="checkbox-inline">\
// 			<input type="checkbox" class="resrouces" '+checked+' value="'+value.id+'" data-resource_type="'+value.type+'">\
// 			<i class="fa fa-'+resource_icon+'"></i> '+value.name+'</label></div></div></td></tr>';
// 			}





// 		});

// 		html += '</tbody></table>';

// 		$('#res_container').html(html);
// //		$('#res_container').append(vehicle_str);



	  },
	  error:function(){
	  		$('#addPersonAnchor').hide();
		  	$('#person_container').html('');
	  }
	});
}

function getProject(project_id)
{
	$('.nav-tabs a:first').tab('show')	
	$('#services_container').hide();
	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  	  async: false,	  
	  url: api_url + 'project',
	  data: {project_id:project_id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#project_name').val(data.name)
	  	$('#project_code').val(data.code)
	  	$('#employee_count').val(data.employee_count)	  	
	  	$('#temp_pic').attr('src',data.url)
	  	$('#pic_path').val(data.pic)
	  	$('#budget_type').val(data.budget_type);

	  	$('#city').val(data.city)
	  	$('#zip').val(data.zip)
	  	$('#street_address').val(data.street_address)

	  	if(data.country != "")
		  	$('#country').val(data.country)

	  	if(data.budget_type != '' && data.budget_type != '0')
	  	{
	  		$('#price_div').show();
	  		$('#price').val(data.price);
	  	}
	  	else
	  	{
	  		$('#price_hide').show();
	  		$('#price').val(0);	  		
	  	}

	  	if(data.budget != '' && data.budget != 0)
	  	{
	  		$('#project_hours_div').fadeIn();	  		
	  		$('#project_budget').val(1);
	  		$('#project_hours').val(data.budget);
	  	}

	  	

	  	if(data.express_price == '1')
			$('#express_price').prop('checked', true);

		// if(data.start_date != '' || data.end_date != '')
	  	// {
	  	// 	if(data.start_date != '')
	  	// 		$('#start_date').val(data.start_date);
	  	// 	if(data.end_date != '')
	  	// 		$('#end_date').val(data.end_date);	  		
	  	// }

	  // 	if(data.time_type == 'single')
	  // 	{
			// $('#single').prop('checked', true);
			// $('#end_date_div').hide();
			// $('#start_time').val(data.start_time);
			// $('#end_time').val(data.end_time);
			// $('#start_time_div, #end_time_div').show();
	  // 	}
	  // 	else if(data.time_type == 'recurring')
	  // 	{
			// $('#recurring').prop('checked', true);	
			// $('#start_time_div, #end_time_div').hide();
			// $('#end_date_div').show();

	  // 		$.each(data.days, function( index, day_value ) {
	  // 			$('#day_'+day_value.day_code).prop('checked', 'checked');
	  // 			$('#start_time' + day_value.day_code).val(day_value.start_time);	  			
	  // 			$('#end_time' + day_value.day_code).val(day_value.end_time);	  			
	  // 			$('.day_div' + day_value.day_code).show();
			// });			

			// $('#days_container').show();
	  // 	}



  		$('#client_id').val(data.client_id);

  		// if(data.client_id > 0)
  		// {
  		// 	$('#services_container').show();
  		// 	getProjectServices(data.client_id);
  		// }

  		$('#project_status').val(data.status);
  		$('#project_notes').val(data.notes);  		

  		$('#basecamp').val(data.basecamp);  		
  		$('#trello').val(data.trello);  		
  		$('#google').val(data.google);  		
  		$('#harvest').val(data.harvest);  		
  		$('#dropbox').val(data.dropbox);  		
	  },
	  error:function(){

	  }
	});
}

function getProjects()
{
	var search_key = $('#search_key').val();

	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'projects',
	  data: {search_key:search_key, sort_by: sortBy, sort_order: sortOrder},
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
                      <a  data-toggle="modal" data-target="#addClientPopup" onclick="showProjectPopup('+value.id+');" href="javascript:void(0);">\
                      <i class="fa fa-pencil"></i> '+EDIT+'</a> <br>\
                      <a onclick="deleteProject('+value.id+');" href="javascript:void(0);">\
                      <i class="fa fa-trash-o"></i> '+DELETE+'</a><br>\
                      <a onclick="projectTasks('+value.id+', '+value.client_id+');" href="javascript:void(0);">\
                      <i class="fa fa-tasks"></i> '+TASKS+'</a></td>';
			}
			else
			{
				var update_part = '';
			}

/*
	  			html += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.code+'</td>\
                    <td><img src="'+value.pic+'" width="80" height="80"></td> \
                    <td>'+value.status+'</td> \
                    <td>'+value.date_created+'</td> \
                    '+update_part+'\
                  </tr>';*/
                // var services = '';
                // var resources = '';
                // var days = '';
                // var start_end = '';

				// $.each(value.services, function( service_index, service_value ) {
				// 	services += service_value+'<br>';
				// });

				// $.each(value.days, function( days_index, days_value ) {
				// 	days += days_value['day_code']+' '+days_value.start_time+' - '+days_value.end_time+'<br>';
				// });

				// $.each(value.resources, function( resource_index, resource_value ) {
				// 	if(resource_value.type == 'Person')
				// 		var type = 'male';
				// 	else
				// 		var type = 'truck';

				// 	resources += '<label><i class="fa fa-'+type+'"></i> '+resource_value.name+'</label><br>';
				// });

				// var seperator = '';
				// if(value.start_date != '0000-00-00')
				// 	start_end = value.start_date;

				// if(value.end_date != '0000-00-00')
				// {
				// 	if(start_end != '')
				// 		seperator = ' - ';
				// 	start_end +=  seperator + value.end_date;						
				// }

				// if(value.time_type == 'single')
				// 	start_end += '<br>'+ value.start_time + ' - ' + value.end_time;


//                    <td>'+value.name+'<br>'+value.project_hours+'</td>\
                    // <td>'+services+'</td> \
                    // <td>'+resources+'</td> \
                    // <td>'+start_end+'</td> \
                    // <td>'+days+'</td> \

	  			html += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.client_company+'</td>\
                    <td>'+value.status+'</td> \
                    '+update_part+'\
                  </tr>';

			});

		  	$('#dataBody').html(html);			
	  	}

	  },
	  error:function(){
	  	$('#dataBody').html('<tr><td align="center" colspan="8"> '+NO_RECORD+'</td></tr>');
	  }
	});
}

function projectTasks(project_id, client_id)
{
	$('.days').prop('checked', false);
	$('#single').prop('checked', true);	
	$('#start_date, #end_date, #start_time, #end_time').val('');
	$('#dates_range').hide();
	$('#end_date_div').hide();
	$('#vehicle_container, #person_container').html('');
	$('#task_id, #task_name').val('');	
	$('#project_id').val(project_id);
	$('.nav-tabs-tasks a:eq( 0 )').tab('show');	
	getProjectTasks(project_id);
	getProjectServices(client_id);
  $("#tasks").on("show", function() {    // wire up the OK button to dismiss the modal when shown
        $("#tasks a.btn").on("click", function(e) {
            $("#tasks").modal('hide');     // dismiss the dialog
        });
    });
    
    $("#tasks").on("hidden", function() {  // remove the actual elements from the DOM when fully hidden
        $("#tasks").remove();
    });
    
    $("#tasks").modal({                    // wire up the actual modal functionality and show the dialog
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     // ensure the modal is shown immediately
    });
}

function deleteTask(task_id, type)
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

    if(type == 'task')
		$('#confirm #delete').attr('onclick', 'deleteTaskCall('+task_id+')')
    else
		$('#confirm #delete').attr('onclick', 'deleteProjectCall('+task_id+')')
}


function deleteProjectCall(project_id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'project',
	  data: { project_id: project_id },
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getProjects();
	  },
	  error:function(){


	  }
	});
}

function deleteTaskCall(task_id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'task',
	  data: { task_id: task_id },
	  beforeSend:function(){

	  },
	  success:function(data){
	    $('#tasks').modal('hide');

	  },
	  error:function(){


	  }
	});
}

function getClients(is_project)
{
	var project_id = $.trim($('#project_id').val());	

	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  async: false,
	  url: api_url + 'project_clients',
	  data: { project_id: project_id },
	  beforeSend:function(){

	  },
	  success:function(data){

		var html = '<select id="client_id">';
		
		if(is_project)
			html += '<option value="0"> -- Select client -- </option>';
		
		$.each(data, function( index, value ) {
			html += '<option value="'+value.id+'">'+value.company_name+'</option>';
		});
		html += '</select>';
		$('#client_container').html(html);
	  },
	  error:function(){
	  	var html = '<p>No client found. Add client <a href="'+canvas_url+'clients">Add Client</a></p>'
		$('#client_container').html(html);

	  }
	});
}

// function showServiceResources()
// {
// 	$('.resources_div').hide();
// //	var services = [];
// 	$("input:checkbox[class=services]:checked").each(function()
// 	{
// 		var service = $(this).val();
// 		$('.service_class_'+service).show();
// //		services.push(service);
// 	});

// }

function getProjectServices(client_id)
{
	// var project_id = $.trim($('#project_id').val());	
	// $('#services_container').fadeOut();
	if(client_id > 0)
	{
		$.ajax({
		  type: 'GET',
		  async: false,		  
		  dataType:"JSON",
		  url: api_url + 'services',
		  data: {client_id:client_id },
		  beforeSend:function(){

		  },
		  success:function(data){
			var html = '<select id="task_service_id" onchange="getResoruces(this.value);"><option value="">--Select Service--</option>';
			$.each(data, function( index, value ) {
				var checked = '';

				// if(value.is_service)
				// {
				// 	checked = 'checked="checked"';
				// 	$('.service_class_'+value.id).show();
				// }

				html += '<option value="'+value.id+'">'+value.name+'</option>';
			});

			html += '</select>';

			$('#services_div').html(html);
		  },
		  error:function(){
		  	$('#services_container').html('<p>No services found. <a href="'+canvas_url+'services">Add Services</a></p>');
		  }
		});
	}


 }


