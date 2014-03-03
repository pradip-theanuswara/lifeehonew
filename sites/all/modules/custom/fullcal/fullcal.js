$(document).ready(function() {
	$('.cal_import .form-submit').addClass('ui-state-default ui-corner-left ui-corner-right icalbtn');	
	
	/*append the popup html to the body to show event popup*/	
	var append_pop='<div class="showTooltip" id="dcal_pop"><div onclick="hide_calpop();return false;" class="dcal_popclose" id="dcal_popclose"></div><div class="dcal_container" id="dcal_pop_container"></div></div>';
	$('body').append(append_pop);
	
	/*for cancel click event on pop close */
	$(".dcal_popclose").click(function(){
		hide_calpop();
	});	
	
	
	
	
});//ready function ends
function get_user_details(uid){
		
		jQuery.ajax({
			cache: false,
			type:'POST',
			url: Drupal.settings.basePath + '?q=calendar/getuser',
			data: {uid:uid},
			datatype: "text",
			error: function(request, status, error) {
			
		},
		success: function(data, status, request) {
			
				 $('#dplanwith_td').html('Dplan With: '+data);
		}
		
		});
		
	}
		
	function create_normal_event(date1){
		
	
	var title1=$('#evt_title').val();
	if(title1==''){//if there is no title
		$('#evt_title').next('.evt_error').html('Please fill required field');
		$('#evt_title').addClass('border_error');
		return false;
	}
	
	var allDay=1;
	
	var EventObject = {
				title: title1
			};
	EventObject.start = date1;
	EventObject.allDay = allDay;
	hide_calpop();
	create_event(title1,date1,allDay,EventObject);
	
	
	}
	/*hide the bg cal*/
	function hide_calpop(){
		$('.showTooltip').hide();
		$('.fc-day').css('background','none');
		$('.ui-state-highlight').css('background','#FFEF8F');
	}
	
