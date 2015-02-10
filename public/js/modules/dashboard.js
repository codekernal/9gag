

function getProjectCalender(language)
{
    $('#calendar').fullCalendar('destroy');
    $('#calendar').fullCalendar({
     views: {
        agenda: {
            axisFormat:'H(:mm)'
        }
    },      
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
//      defaultDate: '2015-01-08',
      editable: false,
      lang: language,
      defaultView: 'agendaWeek',
      firstDay : 1,
      timeFormat: 'H(:mm)',
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: api_url+'get_project_schedule',
        error: function() {
          $('#script-warning').show();
        }
      },
      loading: function(bool) {
        $('#loading').toggle(bool);
      }
    });

}

function invitation(id, status)
{
	$.ajax({
	  type: 'POST',
	  dataType:"JSON",
	  url: api_url + 'invite_status',
	  data: {id:id, status:status},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	getNotifications();
	  },
	  error:function(){


	  }
	});

}

function getNotifications()
{
	$.ajax({
	  type: 'GET',
	  dataType:"JSON",
	  url: api_url + 'notifications',
	  data: {},
	  beforeSend:function(){

	  },
	  success:function(data){
	  	var notification_length = data.length;

        var notfication_html = '<div class="notify-arrow notify-arrow-red"></div>\
                <li><p class="red" id="notification_string"> You have '+notification_length+' new notifications</p></li>';
      var daysArr = {"1":"Monday","2":"Tuesday","3":"Wednesday","4":"Thursday","5":"Friday","6":"Saturday","7":"Sunday"};
		$.each(data, function( index, value ) {

      var days_html = '';
      if(value.project_data.time_type == 'single')
      {
        days_html = value.project_data.start_time + ' - ' + value.project_data.end_time;
      }
      else
      {
        $.each(value.project_data.days, function( indexday, valueday ) {
          days_html += daysArr[valueday.day_code] + ' ' +valueday.start_time + ' - ' + valueday.end_time + '<br>';
        });

      }  


			notfication_html += '<li> <a style="cursor:default;" href="javascript:void(0);"> <span class="label label-warning"><i class="fa fa-bolt"></i></span> '+value.project_name+'. - '+value.project_data.client_name+'\
       <span class="small italic" onclick="invitation('+value.id+',0);" style="float:right;margin-left:10px;cursor:pointer;">Decline </span> <span class="small italic" onclick="invitation('+value.id+',1);" style="float:right;margin-left:10px;cursor:pointer;"> Accept</span>\
<hr style="margin-top:5px; margin-bottom:5px;">Project Dates: '+value.project_data.start_date+' - '+value.project_data.end_date+'<br>\
Project Days: <br>\
'+days_html+'\
 </a> </li>';
		});
		$('#notification_div').html(notfication_html);
	  	$('#notification_count').html(notification_length);
	  },
	  error:function(){
	  	$('#notification_count').html('');
        var notfication_html = '<div class="notify-arrow notify-arrow-red"></div>\
                <li><p class="red" id="notification_string"> You have 0 new notifications</p></li>';
		$('#notification_div').html(notfication_html);

	  }
	});

}

function loadSchedue(project_id, resource_id, language)
{

    $('#calendar').fullCalendar('destroy');
    $('#calendar').fullCalendar({
     views: {
        agenda: {
            axisFormat:'H(:mm)'
        }
    },      
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },

//      defaultDate: '2014-11-12',
      editable: false,
      lang: language,      
      firstDay : 1,
      timeFormat: 'H(:mm)',
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: api_url+'get_resource_schedule?project_id='+project_id+'&resource_id='+resource_id,
        error: function() {
          $('#script-warning').show();
        }
      },
      loading: function(bool) {
        $('#loading').toggle(bool);
      }
    });


}