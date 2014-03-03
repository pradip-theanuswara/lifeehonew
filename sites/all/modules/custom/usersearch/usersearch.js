function refreshTable(page, sort, order,inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation) {
	if(!page) page = 0;
	if(!sort) sort = '';
	if(!order) order = '';
//alert(page);


	jQuery.ajax({
		type: "GET",
		cache: false,
		
		url: Drupal.settings.basePath + '?q=usersearch/check_names',
		data: {page: page, sort: sort, order: order, inputlat:inputzip_value_lat,inputlng:inputzip_value_lng,intrest:intrest,strugles:strugles,victory:victory,mstat:mstat,children:children,relation:relation,prox:prox,zip:zip,age:age,email:email,church:church,personality:personality,name:name,Occupation:Occupation},
		dataType: 'text',
		error: function(request, status, error) {
			//alert(status);
			document.getElementById('tct').value='';
			jQuery('#table-container').html('Search failed.Try again');
			
			
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
						refreshTable(url.param('page'), url.param('sort'), url.param('order'),url.param('inputlat'),url.param('inputlng'),url.param('intrest'),url.param('strugles'),url.param('victory'),url.param('mstat'),url.param('children'),url.param('relation'),url.param('prox'),url.param('zip'),url.param('age'),url.param('email'),url.param('church'),url.param('personality'),url.param('name'),url.param('Occupation'));
					
						return (false);
					});
		}
	});
}
	
function initializeTable(page,sort,order,inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation) {
	
//alert('anil-inside intialize table');
		refreshTable(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation);
		

}




function findajaxzip(zipfinder)
{
	
	//alert('I am in '+zipfinder);
	
	
	jQuery.ajax({
					
   			type: "GET",
					cache: false,
					url: Drupal.settings.basePath + '?q=usersearch/check_zips',
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

	// alert('anil');

	document.getElementById('tct').value='';					
						
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
		var name = jQuery.trim(jQuery('#edit-name').val());
		var intrest = jQuery.trim(jQuery('#edit-intrests').val());
		var strugles = jQuery.trim(jQuery('#edit-strugles').val());
		var victory = jQuery.trim(jQuery('#edit-victory').val());
		var mstat = jQuery.trim(jQuery('#edit-mstatus').val());
		var children =  jQuery.trim(jQuery('#edit-children').val()); //children
		var relation =  jQuery.trim(jQuery('#edit-relationship').val());
		var prox 	=	jQuery.trim(jQuery('#edit-proximities').val());
		var zip = jQuery.trim(jQuery('#edit-zipcode').val());	
		//var age = jQuery.trim(jQuery('#edit-age').val());	
		
		var Occupation = jQuery.trim(jQuery('#edit-occupation').val());
		var age = document.getElementById('edit-age').options[document.getElementById('edit-age').selectedIndex].text;
		var church =jQuery.trim(jQuery('#edit-churchname').val());
		var email  = jQuery.trim(jQuery('#edit-email').val());
		var zipfinder = jQuery.trim(jQuery('#edit-zipcode').val());
                var personality =jQuery.trim(jQuery('#edit-personality').val());
		if(zipfinder!='') {
		var inputzip_value_lat = document.getElementById('lat-id').value;
		var inputzip_value_lng = document.getElementById('lng-id').value;
		}
		//alert(personality);
		//alert(zip);
		//alert(victory);
		//alert(state);
		//alert(prox);

		jQuery('#totalcount').html('&nbsp;');

		  if (isNaN(zip)) {
		  jQuery('#status').html('Zipcode must be integer value.');
		  document.getElementById('tct').value='';
		  jQuery("#table-container").css("display", "none");  
		  return false;
	  
										 }	  
										 else if(zip<0)
										 {
										jQuery('#status').html('Zipcode must be integer value.');	
												  document.getElementById('tct').value='';
		  jQuery("#table-container").css("display", "none");
		   return false;
										 }
										 
										 else {
											 jQuery('#status').html('&nbsp;');
		 jQuery("#table-container").css("display", "block"); 
										 }
		
		
		if(zipfinder!='') {
		
 initializeTable(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation);
 
		}
		
		else {
			
			var inputzip_value_lat = '0';
			var inputzip_value_lng = '0';
			var zip = ''; 
			
		 initializeTable(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation);
		 
		}
	});
});
