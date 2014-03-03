/*
 * Special bits to take note of:
 *  - Code is assigned to an object in Drupal.behaviors.
 *  - Code that adds behaviors is wrapped in the 'attach' property.
 *  - Anything that has been attached to should get a new CSS class.
 *  - Run Drupal.attachBehaviors() to attach behaviors to new HTML.
 */
(function ($) {
  Drupal.behaviors.interact = {
    attach: function (context, settings) {
    
    
	/*	$('.drag_list li').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});*/
	    
     $(".fc-view tr td").droppable();
    
    	/* initialize the calendar
		-----------------------------------------------------------------*/
	
		
		
	$('.drag_list li span').addClass('fc-event-inner fc-event-skin');
		
     
      
     
     
      
    }
  }
})(jQuery);