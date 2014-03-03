/**
master_cal.js for
mastercalendar
prabin
**/

$(document).ready(function() {
	
	
	
    var id_events = new Array();
    var events = [];
    var title_name='';
    var end_day='';
    var start_day='';
    var event_desc='';
    var remainder_type='';
    var remainder_count='';
    var dplanwith='';
    var event_owner='';
    var is_allday=1;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
		
		
    jQuery.ajax({
        cache: false,
        type:'POST',
        url: Drupal.settings.basePath + '?q=mastercalendar/getEvents',
        data: {},
        datatype: "json",
        error: function(request, status, error) {
			
        },
        success: function(data, status, request) {
            var json = jQuery.parseJSON(data);
			//console.log(json);
            $(json).each(function(i,val){
                $.each(val,function(k,v){
					
                    $.each(v,function(x,y){
                        if(x=='title'){ 
                            title_name=y;
                        } 
                        if(x=='uid'){ 
                            event_owner=y;
                        }         
                        if(x=='field_start'){ 
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
                                    start_day=value.value;
                                });
                            });
                        } 
                        if(x=='body'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    event_desc=value.value;
                 						
                                });
                            });
                        }
                        if(x=='field_allday'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    is_allday=value.value;
                 						
                                });
                            });
                        }  
                        if(x=='field_remainder_count'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    remainder_count=value.value;
                 						
                                });
                            });
                        } 
                        if(x=='field_remainder_type'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    remainder_type=value.value;
                 						
                                });
                            });
                        } 
                        if(x=='field_dplanwith'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    dplanwith=value.value;
                 						
                                });
                            });
                        } 
                        
                        if(x=='field_end'){ 
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
                                    end_day=value.value;
         										
                                });
                            });
				 
                        }  
              
                    });
                 
                    events.push({
                        id:k,
                        title: title_name,
                        start: start_day,
                        end: end_day,
                        allDay: is_allday,
                        rcount:remainder_count,
                        rtype:remainder_type,
                        dplanwith:dplanwith,
                        event_owner:event_owner,
                        description: event_desc// will be parsed          // will be parsed          
                    }); 
                    start_day='';
                    end_day='';
                    is_allday=1;
                    event_desc='';
                    remainder_type='';
                    remainder_count='';
                    dplanwith='';
                    event_owner='';
                   
          
                });
            });
	
	
	
	
	
            //initilise the calendar	
            $('#master_cal').fullCalendar({
                theme: true,
                buttonText: {
                    today:    'Today',
                    month:    'Month',
                    week:     'Week',
                    day:      'Day'
                },
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events:events,
                dayClick: function(date, allDay, jsEvent, view) {
					
                    var dateform = $.fullCalendar.formatDate(date, 'MMM dd yyyy');

						
					
                    var offset = $(this).offset();
						
                    $('#dcal_pop').show();
                    var heightpop=$('#dcal_pop').height();
                    var widthpop=$('#dcal_pop').width();
						
    					
                    $('#dcal_pop').css('left', (offset.left-widthpop/2) + 'px');
                    $('#dcal_pop').css('top', (offset.top-heightpop) + 'px');
    					
                    var htmlc='<table cellspacing="0" cellpadding="0" class="cb-table"><tbody style="border:none;"><tr><td class="cb-key">When:</td><td class="cb-value">'+dateform+'</td></tr><tr><td class="cb-key">What:</td><td class="cb-value"><div class="textbox-fill-wrapper"><div class="textbox-fill-mid"><input type="text" maxlength="25" class="" id="evt_title" size="15"><div class="evt_error"></div></div></div><div class="cb-example">e.g. Prayer at somewhere</div></td></tr><tr><td class="cb-actions" colspan="2"><input type="hidden" id="evt_date" value="'+date+'"></td></tr></tbody></table><div class="create_btn_evnt" role="button" ><div id="create_normal_event_btn"  class="fc-button fc-button-agendaWeek ui-state-default">Create event</div></div>';
    				
    					 
                    $('#dcal_pop_container').html(htmlc);
                    $('#create_normal_event_btn').on('click',function(){
                        create_normal_event(dateform);		
                    });
                    $('#evt_title').focus();
                    $(this).css('background','#1CA2DE');
 
                },
                //event click event
                eventClick: function(calEvent, jsEvent, view) {
                    var datebtn='';
                    var startdateform = $.fullCalendar.formatDate(calEvent.start, 'MMM dd yyyy h mm tt');
                    var enddateform = $.fullCalendar.formatDate(calEvent.end, 'MMM dd yyyy h mm tt');
                    if(enddateform=='')
                        datebtn=startdateform;
                    else
                        datebtn=startdateform+' - '+enddateform;
                    var offset = $(this).offset();
                    $('#dcal_pop').show();
                    var heightpop=$('#dcal_pop').height();
                    var widthpop=$('#dcal_pop').width();
                    $('#dcal_pop').css('left', (offset.left-widthpop/2) + 'px');
                    $('#dcal_pop').css('top', (offset.top-heightpop) + 'px');
                    //event click popup inner html
                    var htmlc='<table cellspacing="0" cellpadding="0" class="cb-table"><tbody style="border:none;"><tr><td class="cb-value"></td></tr><tr><td class="cb-value">'+datebtn+'<div class="textbox-fill-wrapper"><div class="textbox-fill-mid">'+calEvent.title+'</div></td></tr><tr><td id="dplanwith_td"></td></tr><tr><td class="cb-actions" colspan="2"><span id=""><input type="hidden" id="selevent_id" value="'+ calEvent.id +'" ><div class="create_btn_evnt" role="button" ><div  class="fc-button fc-button-agendaWeek ui-state-default btn-itm" id="event_edit_btn">Edit Event</div><div onclick="Delete_Event();return false;" class="fc-button fc-button-agendaWeek ui-state-default">Delete Event</div></div></span></td></tr></tbody></table>';
                    $('#dcal_pop_container').html(htmlc);
                    $('#event_edit_btn').on('click',function () {
                        Edit_Event(calEvent);
                    });
                  // The event was scheduled by Shay Robbins but the label is shown as "DPlan with Carl Robbins" - this should read as "DPlan with Shay Robbins"
                    if(calEvent.dplanwith !='' && calEvent.dplanwith > 0){
                        //to get dplanwth user to show on event info page
                        var current_uid=$('#current_uid').val();
                        if(current_uid == calEvent.dplanwith)
                        get_user_details(calEvent.event_owner);
                        else
                        get_user_details(calEvent.dplanwith);
    			
                    }
    			
                } ,          		
        		
                eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
					
			 
                    if (confirm("Are you sure about this change?")) {
                        change_date(event.id,dayDelta,minuteDelta,allDay,'drop');
                    }					
                },
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
				
       

                    if (confirm("Are you sure about this change?")) {
                        change_date(event.id,dayDelta,minuteDelta,'false','resize');
                    }

                }
            });
        //initilise the calendarends
	

        }//success end 
		
    });	//ajax call end end 
	
		
});//


function change_date(event_id,delta,minuteDelta,allDay,ttype){
		
    jQuery.ajax({
        cache: false,
        type:'POST',
        url: Drupal.settings.basePath + '?q=mastercalendar/changeEvent',
        data: {
            differ:delta,
            node_id:event_id,
            minuteDelta:minuteDelta,
            allDay:allDay,
            ttype:ttype
        },
        datatype: "json",
        error: function(request, status, error) {
			
        },
        success: function(data, status, request) {
			
			
        }
    });
	
}
function create_event(title1,date,allDay,calEvent){
    var dplanwith=0;//$('#dplan_with').val();//get the dplanwith uid from hidden input declared in custom alter 
    jQuery.ajax({
        cache: false,
        type:'POST',
        url: Drupal.settings.basePath + '?q=calendar/createEvent',
        data: {
            date:date,
            allDay:allDay,
            title1:title1,
            dplan_uid:dplanwith
        },
        datatype: "json",
        error: function(request, status, error) {
			
        },
        success: function(data, status, request) {
			
			
            calEvent.id=data;
            calEvent.dplanwith=dplanwith;
            calEvent.description='';
			
            $('#master_cal').fullCalendar('renderEvent', calEvent, true);
        }
    });
}
	
function delete_event(event_id){
		
    jQuery.ajax({
        cache: false,
        type:'POST',
        url: Drupal.settings.basePath + '?q=calendar/deleteEvent',
        data: {
            event_id:event_id
        },
        datatype: "json",
        error: function(request, status, error) {
			
        },
        success: function(data, status, request) {
			
        //	alert(data);
        }
    });
}	
function Delete_Event(){
    var evt_id=$('#selevent_id').val();
		
    if (confirm("Are you sure to delete?")) {
        $('#master_cal').fullCalendar( 'removeEvents', evt_id);
        delete_event(evt_id);
    }
    hide_calpop();
}
function Edit_Event(calEvent){
    var startdate= $.fullCalendar.formatDate(calEvent.start, 'yyyy-MM-dd hh:mm tt');
    var enddate = $.fullCalendar.formatDate(calEvent.end, 'yyyy-MM-dd hh:mm tt');
    if(calEvent.allDay==1)
        var ischecked = 'checked=checked';
    else
        var ischecked =''; 
				
    if(calEvent.rcount > 0){
        var remainder_str='<span id="reminder_span"><input type="text" maxlength="5" size="3" value="'+calEvent.rcount+'" id="reminder_count"><select id="reminder_type" class="fullcal_rem"><option value="60">minutes</option><option value="3600">hours</option><option value="86400">days</option><option  value="604800">weeks</option></select><a href="#" id="remove_reminder">remove</a></span>';
    }else{
        var remainder_str='<a href="#" id="add_reminder">Add a reminder</a>';
    }	
    var htmledit='<table cellspacing="0" cellpadding="0" class="cb-table"><tbody style="border:none;"><tr><td class="cb-key">What:</td><td class="cb-value"><div class="textbox-fill-wrapper"><div class="textbox-fill-mid"><input type="hidden" id="selevent_id" value="'+ calEvent.id +'" ><input type="text" maxlength="25" class="text_input" value="'+calEvent.title+'" id="evt_title" ><div class="evt_error"></div></div></div><div class="cb-example">e.g. Prayer at somewhere</div></td></tr><tr><td class="cb-key">Start time:</td><td class="cb-value"><input type="text" maxlength="25" class="text_input" id="tx_event_start"  value="'+startdate+'"></td></tr><tr><td class="cb-key">End time:</td><td class="cb-value"><input type="text" maxlength="25" class="text_input" id="tx_event_end"  value="'+enddate+'"></td></tr><tr><td class="cb-key">Reminder:</td><td class="cb-value" id="remainder_value_div">'+remainder_str+'</td></tr><div class="create_btn_evnt" role="button" ><div onclick="Delete_Event();return false;" class="fc-button fc-button-agendaWeek ui-state-default btn-itm">Delete Event</div><div  class="fc-button fc-button-agendaWeek ui-state-default btn-itm" id="update_event_btn">Update Event</div></div></span></td></tr></tbody></table><div><input '+ischecked+' type="checkbox" id="evt_allday" >All day event</div><div><div class="cb-key">Description:</div><textarea maxlength="120" id="evt_desc" class="textinput">'+calEvent.description+'</textarea></div>';
	
    $('#dcal_pop_container').html(htmledit);
    init_select_remainder_type();
    remainder_remove();
    add_remainder_init();
    function init_select_remainder_type(){
			
        $('#reminder_type').val(calEvent.rtype);
			
    }
    function add_remainder_init(){
        /* init onclick on add reminder*/
        $('#add_reminder').on('click',function(){
			
            $(this).parent().append('<span id="reminder_span"><input type="text" maxlength="5" size="3" value="10" id="reminder_count"><select id="reminder_type" class="fullcal_rem"><option value="60">minutes</option><option value="3600">hours</option><option value="86400">days</option><option value="604800">weeks</option></select><a href="#" id="remove_reminder">remove</a></span>');
            $(this).hide();
            remainder_remove();
            return false;
			
		
        });
			
    }
		
    function remainder_remove(){
			
        $("#reminder_count").keyup(function(){ 
            var text=$(this).val();
            $(this).val(text.replace(/[^\d]/,""));
    
        }); 
 			 
        $('#remove_reminder').on('click',function(){
            $('#reminder_span').remove();
            $('#remainder_value_div').html('<a href="#" id="add_reminder">Add a reminder</a>');
            add_remainder_init();
            return false;
					
        });
    }
	
    $('#update_event_btn').on('click',function(){
											
        update_event(calEvent);		
    });
    $('#tx_event_start').datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "hh:mm tt"
    });
    $('#tx_event_end').datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "hh:mm tt"
    });
/*	calEvent.title='ffffff';
			alert(JSON.stringify(calEvent));		
		$('#dplan_cal').fullCalendar('renderEvent', calEvent, true);*/
		
}
function update_event(calEvent){
    var r_count='0';
    var r_type_hour=60;//init with type day
    var event_id=$('#selevent_id').val();
    var title1=$('#evt_title').val();
    if(title1==''){//if there is no title
        $('#evt_title').next('.evt_error').html('Please fill required field');
        $('#evt_title').addClass('border_error');
        return false;
    }
    var datestart=$('#tx_event_start').val();
    var dateend=$('#tx_event_end').val();
	
	
	
    if($('#reminder_count').val() != ''){
        r_count=$('#reminder_count').val();
        r_type=$('#reminder_type').val();
	
    }
	
    var event_desc=$('#evt_desc').val();
    if ($('#evt_allday').is(":checked"))
    {
        var allDay=1;// it is checked
    }else{
        var allDay=0;
    }
   
 
   
    jQuery.ajax({
        cache: false,
        type:'POST',
        url: Drupal.settings.basePath + '?q=dplancalendar/updateEvent',
        data: {
            node_id:event_id,
            r_count:r_count,
            r_type:r_type,
            evt_title:title1,
            start_date:datestart,
            end_date:dateend,
            allDay:allDay,
            desc:event_desc
        },
        datatype: "json",
        error: function(request, status, error) {
			
        },
        success: function(data, status, request) {
			
            calEvent.title=title1;
            calEvent.start=convertDateTo24Hour(datestart);
            if(dateend)
            calEvent.end=convertDateTo24Hour(dateend);
            else
             calEvent.end='';
            calEvent.allDay=allDay;
            calEvent.description=event_desc;
            calEvent.rcount=r_count;
            calEvent.rtype=r_type;
		
		
            $('#master_cal').fullCalendar('renderEvent', calEvent, true);
			
            hide_calpop();	
        }
    });
		
		
}
	
function ical_generate(){
    //alert(window.events_array);
    var id_events = new Array();
    var events = [];
    var title_name='';
    var end_day='';
    var start_day='';
    var event_desc='';
    var remainder_type='';
    var remainder_count='';
    var dplanwith='';
    var is_allday=1;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
			
    var eventsical = [];
		
    //var events=JSON.stringify(window.events_array);
		
    jQuery.ajax({
        cache: false,
        type:'POST',
        url: Drupal.settings.basePath + '?q=mastercalendar/getEvents',
        data: {},
        datatype: "json",
        error: function(request, status, error) {
			
        },
        success: function(data, status, request) {
            var json = jQuery.parseJSON(data);
			
            $(json).each(function(i,val){
                $.each(val,function(k,v){
					
                    $.each(v,function(x,y){
                        if(x=='title'){ 
                            title_name=y;
                        }         
                        if(x=='field_start'){ 
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
                                    start_day=value.value;
                                });
                            });
                        } 
                        if(x=='body'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    event_desc=value.value;
                 						
                                });
                            });
                        }
                        if(x=='field_allday'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    is_allday=value.value;
                 						
                                });
                            });
                        }  
                        if(x=='field_remainder_count'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    remainder_count=value.value;
                 						
                                });
                            });
                        } 
                        if(x=='field_remainder_type'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    remainder_type=value.value;
                 						
                                });
                            });
                        } 
                        if(x=='field_dplanwith'){ 
             	
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
         							
                                    dplanwith=value.value;
                 						
                                });
                            });
                        } 
                        if(x=='field_end'){ 
                            $.each(y,function(val,res){
                                $.each(res,function(start,value){
                                    end_day=value.value;
         										
                                });
                            });
				 
                        }  
              
                    });
                    eventsical.push({
                        id:k,
                        title: title_name,
                        start: start_day,
                        end: end_day,
                        allDay: is_allday,
                        rcount:remainder_count,
                        rtype:remainder_type,
                        dplanwith:dplanwith,
                        description: event_desc// will be parsed          // will be parsed          
                    }); 
                    start_day='';
                    end_day='';
                    is_allday=1;
                    event_desc='';
                    remainder_type='';
                    remainder_count='';
                    dplanwith='';
                   
          
                });
            });
	
            var events=JSON.stringify(eventsical);
            $('#ical_events').val(events);
            $('#ical_form').submit();
        /*jQuery.ajax({
			cache: false,
			type:'POST',
			url: Drupal.settings.basePath + '?q=calendar/ical',
			data: {events:events},
			datatype: "json",
			error: function(request, status, error) {
			
		},
		success: function(data, status, request) {
		//location.href=Drupal.settings.basePath + '?q=calendar/ical?events="'+ events +'"';
			
			//$("body").append("<iframe src='ical_download.php?events='"+events+"' style='display: none;'></iframe>");
			//window.open( "data:text/calendar;charset=utf8," + escape( data ));
		}
		});*/
		
		
        }
    });

	
}
	
$(document).ready(function(){
    $('#master_cal').before('<form method="post" id="ical_form" name="ical_form" action="'+Drupal.settings.basePath + '?q=calendar/ical"><div class="ui-state-default ui-corner-left ui-corner-right icalbtn"><a id="icalclick"  href="#">iCal Export</a></div><input type="hidden" value="" id="ical_events" name="ical_events"></form>');
    $('#icalclick').click(function(){
        ical_generate();
        return false;	
    });
		
});
	
function convertDateTo24Hour(date){
	
    var elem = date.split(' ');
    var stSplit = elem[1].split(":");// alert(stSplit);
    var stHour = stSplit[0];
    var stMin = stSplit[1];
    var stAmPm = elem[2];
    var newhr = 0;
    var ampm = '';
    var newtime = '';
    //alert("hour:"+stHour+"\nmin:"+stMin+"\nampm:"+stAmPm); //see current values
    
    if (stAmPm=='pm')
    { 
        if (stHour!=12)
        {
            stHour=stHour*1+12;
        }
       
    }else if(stAmPm=='am' && stHour=='12'){
        stHour = stHour -12;
    }else{
        stHour=stHour;
    }
 		//alert(elem[0]+" "+stHour+':'+stMin);
    return elem[0]+" "+stHour+':'+stMin;
    
    
  
}
	