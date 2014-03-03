function refreshTable(page, sort, order,inputzip_value_lat,inputzip_value_lng,zip,name,city,state,p) {
	if(!page) page = 0;
	if(!sort) sort = '';
	if(!order) order = '';
//alert(page);


	jQuery.ajax({
		type: "GET",
		cache: false,
		
		url: Drupal.settings.basePath + '?q=communitysearch/check_name',
		data: {page: page, sort: sort, order: order, inputlat:inputzip_value_lat,inputlng:inputzip_value_lng,zip:zip,name:name,city:city,state:state,p:p},
		dataType: 'text',
		error: function(request, status, error) {
			//alert(status);
			jQuery('#table-container').html('Search failed.Try again');
			document.getElementById('totalcount').value='';
		},
		success: function(data, status, request) {
			var html = data;
			jQuery('#table-container').html(html);
			//added by prabi to check box init
			//int_checkbox();
			jQuery('#table-container th a').
				add('#table-container .pager-item a')
				.add('#table-container .pager-first a')
				.add('#table-container .pager-previous a')
				.add('#table-container .pager-next a')
				.add('#table-container .pager-last a')
					.click(function(el, a, b, c) {
						var url = jQuery.url(el.currentTarget.getAttribute('href'));
						refreshTable(url.param('page'), url.param('sort'), url.param('order'),url.param('inputlat'),url.param('inputlng'),url.param('zip'),url.param('name'),url.param('city'),url.param('state'),url.param('p'));
					
						return (false);
					});
		}
	});
}
	
function initializeTable(page,sort,order,inputzip_value_lat,inputzip_value_lng,zip,name,city,state,prox) {
	
//alert('anil-inside intialize table');
		refreshTable(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,zip,name,city,state,prox);
		

}




function findajaxzip(zipfinder)
{
	
	//alert('I am in '+zipfinder);
	
	
	jQuery.ajax({
					
   			type: "GET",
					cache: false,
					url: Drupal.settings.basePath + '?q=communitysearch/check_zip',
		   			data: "ezip=" +zipfinder,
   			success: function(msg){
				//	eval(msg);
					//alert(msg);
					var parts = msg.split("@");
					var part1 = parts[0];
					var part2=parts[1];
					document.getElementById('lat-id').value = part1;
					document.getElementById('lng-id').value = part2;
					//alert(document.getElementById('lng-id').value);
					
					
   			}
 		}); 
	
}

jQuery(document).ready(function() {

//document.getElementById('totalcount').value='';
						
	jQuery('#check_name').attr('href', 'javascript:void(0);');
 
	jQuery('#edit-user-name').keydown(function(event){
		jQuery('#status').html('');
	});
 
 jQuery('#edit-zipcode').blur(function() {
		
		var zipfinder = jQuery.trim(jQuery('#edit-zipcode').val());	  
						
		if(zipfinder!='')
		findajaxzip(zipfinder);
		});
 
 
 
    jQuery('#check_name').click(function() {

var prox    =	jQuery.trim(jQuery('#edit-proximity').val());

   if((document.getElementById('totalcount').value='undefined') && (prox >=0))
   {
       
        prox    =	jQuery.trim(jQuery('#edit-proximity').val());
   

   }
   else
   {
       prox = 0;
   }
		//alert(prox);
                var name = jQuery.trim(jQuery('#edit-name').val());
		
		var zip     =	jQuery.trim(jQuery('#edit-zipcode').val());
		var city    =	jQuery.trim(jQuery('#edit-city').val());
		var state   =	jQuery.trim(jQuery('#edit-state').val());
		
		var zipfinder = jQuery.trim(jQuery('#edit-zipcode').val());	
		if(zipfinder!='') {
		var inputzip_value_lat = document.getElementById('lat-id').value;
		var inputzip_value_lng = document.getElementById('lng-id').value;
		}

		//alert(inputzip_value_lat);
		//alert(city);
		//alert(state);
		//alert(prox);

		//jQuery('#totalcount').html('&nbsp;');

		  if (isNaN(zip)) {
		  jQuery('#status').html('Zipcode must be integer value.');
		  document.getElementById('totalcount').innerHTML ='';
		  jQuery("#table-container").css("display", "none");  
		  return false;
	  
		  }	  
		  else if(zip<0)
		  {
		 jQuery('#status').html('Zipcode must be an integer value.');													document.getElementById('totalcount').value='';
		  jQuery("#table-container").css("display", "none");
		   return false;
		  }								 
		  else {
		 
		 jQuery("#table-container").css("display", "block"); 
		 }
		 if(name)
		 {
		if (!isNaN(name)) {
			jQuery('#status').html('Name must have atleast one charcter and does not support integer value');
		 document.getElementById('totalcount').innerHTML ='';
		  jQuery("#table-container").css("display", "none");
		   return false;
		}
		}
		
		
		if(city)
		{
		if (!isNaN(city)) {
			jQuery('#status').html('City must have atleast one charcter and does not support integer value');
		  document.getElementById('totalcount').innerHTML ='';
		  jQuery("#table-container").css("display", "none");
		   return false;
		}	
			
			
		}
		
		
		
		if(zipfinder!='') {
		
 initializeTable(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,zip,name,city,state,prox);
 
		}
		
		else {
			
			var inputzip_value_lat = '0';
			var inputzip_value_lng = '0';
			var zip = ''; 
			
		 initializeTable(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,zip,name,city,state,prox);
		 
		}
	});
});
