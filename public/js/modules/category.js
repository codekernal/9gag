var sortBy = '';
var sortOrder = '';

function resetCat()
{
	  	$('#name').val('');
	  	$('#min_hours').val('');
	  	$('#max_hours').val('');	  	
	  	$('#desc').val('');	  	
		$('#cat_id').val('');
		$('#payment_type').val('');

}


function resetSalaryType()
{
	  	$('#salary_type_name').val('');
	  	$('#salary_type_desc').val('');
	  	$('#salary_type_raise').val(0);	  	
		$('#salary_type_id').val('');
}

 function showSurchargeTypePopup()
{
	$('.nav-tabs a:eq( 3 )').tab('show')	
}
function resetEducation()
{
	  	$('#education_name').val('');
	  	$('#education_desc').val('');
	  	$('#raise').val(0);	  	
		$('#education_id').val('');
}

function getNightShift()
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'night_shift',
	  data: {},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#start_time').val(data.start_time);
	  	$('#end_time').val(data.end_time);
	  	$('#night_shift_raise').val(data.night_shift_raise);
	  },
	  error:function(){

	  }
	});

}

var counter = 1;
function addMoreHoliday()
{
	counter++;
	var html = '                    <div class="form-group lable-padd">\
                      <label class="col-lg-3 control-label" for="recipient-name">Name :</label>\
                    <div class="col-sm-6">\
                      <input type="text" id="name_holiday'+counter+'" class="holiday_name" class="form-control" value="">\
                    </div>\
                    </div>\
	<div class="form-group lable-padd">\
                      <label class="col-lg-3 control-label" for="recipient-name">Holiday :</label>\
                    <div class="col-sm-6">\
                      <input type="text" id="holiday'+counter+'" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF; z-index:9999;" class="form-control datepicker form-control-inline input-medium default-date-picker holiday">\
                    </div>\
                    </div>';

        $('#holiday_div').append(html);

			   $('.holiday').datepicker({
			    autoclose:true
			   });

}

function addHoliday()
{
	var obj = {};

	var raise = $('#raise_holiday1').val();

	$( ".holiday" ).each(function( index ) {
		var holiday_id = this.id;
		var holiday = this.value;
		var name = $('#name_'+this.id).val();;
		if(holiday != '')
		{
			obj[this.id] = {holiday:holiday, name:name, raise: raise};
		}

	});


		$.ajax({
		  type: 'PUT',
		  dataType:"JSON",
		  url: api_url + 'holidays',
		  data: {holidays: obj},
		  beforeSend:function(){

		  },
		  success:function(data){

		  },
		  error:function(){

		  }
		});
}

function updateNightShift()
{
	var start_time = $('#start_time').val();
	var end_time = $('#end_time').val();
	var night_shift_raise = $('#night_shift_raise').val();		

	$.ajax({
	  type: 'PUT',
	  dataType:"JSON",
	  url: api_url + 'night_shift',
	  data: {start_time: start_time, end_time: end_time, night_shift_raise:night_shift_raise},
	  beforeSend:function(){

	  },
	  success:function(data){

	  },
	  error:function(){

	  }
	});

}

function getHolidays()
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'holidays',
	  data: {},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	var html = '';
  		$.each(data, function( index, value ) {
  			if(index == 0)
  			{
  				$('#holiday1').val(value.holiday);
  				$('#name_holiday1').val(value.name);
  				$('#raise_holiday1').val(value.raise);  				
  				counter++;
  			}
  			else
  			{
				html += '                    <div class="form-group lable-padd">\
                      <label class="col-lg-3 control-label" for="recipient-name">Name :</label>\
                    <div class="col-sm-6">\
                      <input type="text" id="name_holiday'+counter+'" class="holiday_name" class="form-control" value="'+value.name+'">\
                    </div>\
                    </div>\
				<div class="form-group lable-padd">\
                      <label class="col-lg-3 control-label" for="recipient-name">Holiday :</label>\
                    <div class="col-sm-6">\
                      <input type="text" id="holiday'+counter+'" value="'+value.holiday+'" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF; z-index:9999;" class="form-control datepicker form-control-inline input-medium default-date-picker holiday">\
                    </div>\
                    </div>';

  			}

		  });

		if(html != '')
	        $('#holiday_div').append(html);

	   $('.holiday').datepicker({
	    autoclose:true
	   });


	  },
	  error:function(){

	  }
	});

}


function getEducation(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'education',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#education_name').val(data.name);
	  	$('#education_desc').val(data.desc);
	  	$('#raise').val(data.raise);	  	
	  },
	  error:function(){

	  }
	});

}

function getSalaryType(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'salary_type',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#salary_type_name').val(data.name);
	  	$('#salary_raise').val(data.raise);	  	

  		$('#salary_desc').val(data.desc);

	  },
	  error:function(){

	  }
	});

}

function showSalaryTypePopup(id)
{
	resetSalaryType();

	$('#salary_type_id').val(id);
	if(id != '' && id != 0)
	{
		$('#popupSalaryTypesLabel').html(UPDATE_SALARY_TYPE);
		getSalaryType(id);
	}
	else
	{
		$('#popupSalaryTypesLabel').html(ADD_SALARY_TYPE);
	}
}


function showEducationPopup(id)
{
	resetEducation();

	$('#education_id').val(id);
	if(id != '' && id != 0)
	{
		$('#popupEducationLabel').html(UPDATE_EDUCATION);
		getEducation(id);
	}
	else
	{
		$('#popupEducationLabel').html(ADD_EDUCATION);
	}
}


function getCategory(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'category',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#name').val(data.name);
	  	$('#min_hours').val(data.min_hours);
	  	$('#max_hours').val(data.max_hours);	  	
	  	$('#desc').val(data.desc);	  	
	  	$('#payment_type').val(data.payment_type);	  	

	  },
	  error:function(){

	  }
	});

}

function getSalaryType(id)
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'salary_type',
	  data: {id:id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	$('#salary_type_name').val(data.name);
	  	$('#salary_type_name').val(data.raise);
	  	$('#salary_type_desc').val(data.desc);	  	
	  },
	  error:function(){

	  }
	});

}


function showCatPopup(id)
{
	resetCat();

	$('#cat_id').val(id);
	if(id != '' && id != 0)
	{
		$('#popupLabel').html(UPDATE_CATEGORY);
		getCategory(id);
	}
	else
	{
		$('#popupLabel').html(ADD_CATEGORY);
	}
}

function addUpdateEducation()
{
	var id = $('#education_id').val();
	$('body input').removeClass('error-class');
	check = true;

	var name = $.trim($('#education_name').val());
	var education_desc = $.trim($('#education_desc').val());
	var raise = $.trim($('#raise').val());

	if(name == '')
	{
		$('#education_name').addClass('error-class').focus();
		check = false;
	}


	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'education',
		  data: {id:id, "name":name, desc:education_desc,raise: raise},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addEducationPopup').modal('hide');
		    getEducations();
		  },
		  error:function(){

		  }
		});
	}

}

function addUpdateSalaryType()
{
	var id = $('#salary_type_id').val();
	$('body input').removeClass('error-class');
	check = true;

	var name = $.trim($('#salary_type_name').val());
	var desc = $.trim($('#salary_desc').val());
	var raise = $.trim($('#salary_raise').val());

	if(name == '')
	{
		$('#salary_type_name').addClass('error-class').focus();
		check = false;
	}


	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'salary_type',
		  data: {id:id, "name":name, desc:desc,raise: raise},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addSalaryTypesPopup').modal('hide');
		    getSalaryTypes();
		  },
		  error:function(){

		  }
		});
	}

}


function addUpdateCat()
{
	var id = $('#cat_id').val();

	$('body input').removeClass('error-class');
	check = true;

	var name = $.trim($('#name').val());
	var min_hours = $.trim($('#min_hours').val());
	var max_hours = $.trim($('#max_hours').val());
	var desc = $.trim($('#desc').val());
	var payment_type = $('#payment_type').val();
	if(name == '')
	{
		$('#name').addClass('error-class').focus();
		check = false;
	}

	if(min_hours == '')
	{
		$('#min_hours').addClass('error-class').focus();
		check = false;
	}

	if(max_hours == '')
	{
		$('#max_hours').addClass('error-class').focus();
		check = false;
	}	

	if(payment_type == '')
	{
		$('#payment_type').addClass('error-class').focus();
		check = false;
	}

	if(check)
	{
		$.ajax({
		  type: 'POST',
		  dataType:"JSON",
		  url: api_url + 'category',
		  data: {"name":name, min_hours:min_hours, max_hours: max_hours, desc:desc, id:id, 'payment_type' : payment_type},
		  beforeSend:function(){

		  },
		  success:function(data){
		    $('#addCatPopup').modal('hide');
		    getCategories();
		  },
		  error:function(){

		  }
		});
	}

}

function getEducations()
{
	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'educations',
	  data: {sort_by: sortBy, sort_order: sortOrder},
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
                      <a  data-toggle="modal" data-target="#addEducationPopup" onclick="showEducationPopup('+value.id+');" href="javascript:void(0);"><i class="fa fa-pencil"></i> '+EDIT+'</a> |\
                      <a onclick="delEducation('+value.id+');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DELETE+'</a>\
                    </td>';
			}
			else
			{
				var update_part = '';
			}

	  			html += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.raise+'</td> \
                    <td>'+value.desc+'</td> \
                    '+update_part+'</tr>';
			});

		  	$('#dataBodyEducation').html(html);			
	  	}

	  },
	  error:function(){
	  	$('#dataBodyEducation').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  }
	});
}

function getSalaryTypes()
{
	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'salary_types',
	  data: {},
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
                      <a  data-toggle="modal" data-target="#addSalaryTypesPopup" onclick="showSalaryTypePopup('+value.id+');" href="javascript:void(0);"><i class="fa fa-pencil"></i> '+EDIT+'</a> |\
                      <a onclick="delSalaryType('+value.id+');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DELETE+'</a>\
                    </td>';
			}
			else
			{
				var update_part = '';
			}

	  			html += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.raise+'</td> \
                    <td>'+value.desc+'</td> \
                    '+update_part+'</tr>';
			});

		  	$('#dataBodySalaryTypes').html(html);			
	  	}

	  },
	  error:function(){
	  	$('#dataBodySalaryType').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  }
	});
}

function updateYearPayments()
{
	var arr = [];
	$( ".all_cats" ).each(function( index ) {
		var yearsObj = [];
		for(var i = 0; i<= 10; i++)
		{
			var year_value = $('#'+this.value+'year'+i).val();
			yearsObj.push(year_value);
		}
		console.log(yearsObj)
		if(!jQuery.isEmptyObject(yearsObj))
			arr[this.value] = yearsObj;

	});	

	$.ajax({
	  type: 'POST',
	  dataType:"JSON",
	  url: api_url + 'years_salary',
	  data: {years_salary : arr},
	  beforeSend:function(){

	  },
	  success:function(data){
			showMsg('#year_update_msg', 'Salary payments updated successfully', 'green')
	  },
	  error:function(){

	  }
	});


}

function showMsg(id, msg, type)
{
	$(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)});	
}


function getCategories()
{
	$('body input').removeClass('error-class');
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'categories',
	  data: { sort_by: sortBy, sort_order: sortOrder},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	console.log(data);
	  	if(data.length > 0)
	  	{
	  		var html = '';
	  		var monthly_html = '';	  		
	  		var hourly_html = '';
	  		var invoice_html = '';

	  		$.each(data, function( index, value ) {

	  		var elem_html = '<tr>\
	  		<td>'+value.name+'<input type="hidden" class="all_cats" value="'+value.id+'"></td>\
	  		<td><input type="text" id="'+value.id+'year1" size="5" value="'+value.year1+'"></td>\
	  		<td><input type="text" id="'+value.id+'year2" size="5" value="'+value.year2+'"></td>\
	  		<td><input type="text" id="'+value.id+'year3" size="5" value="'+value.year3+'"></td>\
	  		<td><input type="text" id="'+value.id+'year4" size="5" value="'+value.year4+'"></td>\
	  		<td><input type="text" id="'+value.id+'year5" size="5" value="'+value.year5+'"></td>\
	  		<td><input type="text" id="'+value.id+'year6" size="5" value="'+value.year6+'"></td>\
	  		<td><input type="text" id="'+value.id+'year7" size="5" value="'+value.year7+'"></td>\
	  		<td><input type="text" id="'+value.id+'year8" size="5" value="'+value.year8+'"></td>\
	  		<td><input type="text" id="'+value.id+'year9" size="5" value="'+value.year9+'"></td>\
	  		<td><input type="text" id="'+value.id+'year10" size="5" value="'+value.year10+'"></td>\
	  		</tr>';



	  		if(value.payment_type == 1)
	  		{
	  			monthly_html += elem_html;
	  		}
	  		else if(value.payment_type == 2)
	  		{
	  			hourly_html += elem_html;
	  		}
	  		else if(value.payment_type == 3)
	  		{
	  			invoice_html += elem_html;
	  		}

			if(can_update)
			{
				var update_part = '<td>\
                      <a  data-toggle="modal" data-target="#addCatPopup" onclick="showCatPopup('+value.id+');" href="javascript:void(0);"><i class="fa fa-pencil"></i> '+EDIT+'</a> |\
                      <a onclick="delCat('+value.id+');" href="javascript:void(0);"><i class="fa fa-trash-o"></i> '+DELETE+'</a>\
                    </td>';
			}
			else
			{
				var update_part = '';
			}

	  			html += '<tr>\
                    <td>'+value.name+'</td>\
                    <td>'+value.min_hours+' - '+value.max_hours+'</td> \
                    <td>'+value.desc+'</td> \
                    '+update_part+'</tr>';
			});
		
			$('#monthlysalary').html(monthly_html);
			$('#hourlysalary').html(hourly_html);
			$('#invoicesalary').html(invoice_html);						
		  	$('#dataBody').html(html);			


	  	}

	  },
	  error:function(){
	  	$('#dataBody').html('<tr><td align="center" colspan="7"> '+NO_RECORD+'</td></tr>');
	  }
	});
}

function delEducation(id)
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

	$('#confirm #delete').attr('onclick', 'delEducationCall('+id+')')
}

function delSalaryType(id)
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

	$('#confirm #delete').attr('onclick', 'delSalaryTypeCall('+id+')')
}


function delCat(id)
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

	$('#confirm #delete').attr('onclick', 'delCatCall('+id+')')
}

function delEducationCall(id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'education',
	  data: {"id":id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getEducations();
	  },
	  error:function(){

	  }
	});
}

function delSalaryTypeCall(id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'salary_type',
	  data: {"id":id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getSalaryTypes();
	  },
	  error:function(){

	  }
	});
}

function delCatCall(id)
{
	$.ajax({
	  type: 'DELETE',
	  dataType:"JSON",
	  url: api_url + 'category',
	  data: {"id":id},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getCategories();
	  },
	  error:function(){

	  }
	});
}
