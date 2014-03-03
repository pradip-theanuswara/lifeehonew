function refreshTables(page, sort, order,inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation) {
	if(!page) page = 0;
	if(!sort) sort = '';
	if(!order) order = '';
//alert(page);


	jQuery.ajax({
		type: "GET",
		cache: false,
		
		url: Drupal.settings.basePath + '?q=outsideusersearch/check_names_os',
		data: {page: page, sort: sort, order: order, inputlat:inputzip_value_lat,inputlng:inputzip_value_lng,intrest:intrest,strugles:strugles,victory:victory,mstat:mstat,children:children,relation:relation,prox:prox,zip:zip,age:age,email:email,church:church,personality:personality,name:name,Occupation:Occupation},
		dataType: 'text',
		error: function(request, status, error) {
			//alert(status);
			document.getElementById('tct-tab2').value='';
			jQuery('#table-container_tab2').html('Search failed.Try again');
			
			
		},
		success: function(data, status, request) {
			var html = data;
			jQuery('#table-container_tab2').html(html);
			//added by prabi to check box init
			//int_checkbox();
			jQuery('#table-container_tab2 th a').
				add('#table-container_tab2 .pager-item a')
				.add('#table-container_tab2 .pager-first a')
				.add('#table-container_tab2 .pager-previous a')
				.add('#table-container_tab2 .pager-next a')
				.add('#table-container_tab2 .pager-last a')
					.click(function(el, a, b, c) {
						var url = jQuery.url(el.currentTarget.getAttribute('href'));
						refreshTables(url.param('page'), url.param('sort'), url.param('order'),url.param('inputlat'),url.param('inputlng'),url.param('intrest'),url.param('strugles'),url.param('victory'),url.param('mstat'),url.param('children'),url.param('relation'),url.param('prox'),url.param('zip'),url.param('age'),url.param('email'),url.param('church'),url.param('personality'),url.param('name'),url.param('Occupation'));
					
						return (false);
					});
		}
	});
}
	
function initializeTables(page,sort,order,inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation) {
	
//alert('anil-inside intialize table');
		refreshTables(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation);
		

}

function findajaxzips(zipfinder)
{
	
	//alert('I am in '+zipfinder);
	
	
	jQuery.ajax({
					
   			type: "GET",
					cache: false,
					url: Drupal.settings.basePath + '?q=outsideusersearch/check_zips_os',
		   			data: "ezip=" +zipfinder,
   			success: function(msg){
				//	eval(msg);
					//alert(msg);
					var parts = msg.split("@");
					var part12 = parts[0];
					var part22=parts[1];
					document.getElementById('lat-id_tab2').value = part12;
					document.getElementById('lng-id_tab2').value = part22;
					//alert(document.getElementById('lng-id').value);
					
					
   			}
 		}); 
	
}

jQuery(document).ready(function() {

	document.getElementById('tct').value='';

	jQuery('#check_name_tab2').attr('href', 'javascript:void(0);');
 
	jQuery('#edit-user-name').keydown(function(event){
		jQuery('#status').html('');
	});
 
 jQuery('#edit-zipcode-tab2').blur(function() {
						var zipfinder = jQuery.trim(jQuery('#edit-zipcode-tab2').val());
						
					if(zipfinder!='')
                                           // alert('test');
						findajaxzips(zipfinder);
						});
 
 jQuery('#tabs2').click(function() {
 	jQuery('#tct-tab2').val(' ');
 });
 
    jQuery('#check_name_tab2').click(function() {
		//alert('anil');

                var name = jQuery.trim(jQuery('#edit-name-tab2').val());
		var intrest = jQuery.trim(jQuery('#edit-intrests-tab2').val());
		var strugles = jQuery.trim(jQuery('#edit-strugles-tab2').val());
		var victory = jQuery.trim(jQuery('#edit-victory-tab2').val());
		var mstat = jQuery.trim(jQuery('#edit-mstatus-tab2').val());
		var children =  jQuery.trim(jQuery('#edit-children-tab2').val()); //children
		var relation =  jQuery.trim(jQuery('#edit-relationship-tab2').val());
		var prox 	=	jQuery.trim(jQuery('#edit-proximities-tab2').val());
		var zip = jQuery.trim(jQuery('#edit-zipcode-tab2').val());	
		//var age = jQuery.trim(jQuery('#edit-age').val());	
		
		var Occupation = jQuery.trim(jQuery('#edit-occupation-tab2').val());
		var age = document.getElementById('edit-age-tab2').options[document.getElementById('edit-age-tab2').selectedIndex].text;
		var church =jQuery.trim(jQuery('#edit-churchname-tab2').val());
		var email  = jQuery.trim(jQuery('#edit-email-tab2').val());
		var zipfinder = jQuery.trim(jQuery('#edit-zipcode-tab2').val());	
		if(zipfinder!='') {
		var inputzip_value_lat = document.getElementById('lat-id_tab2').value;
		var inputzip_value_lng = document.getElementById('lng-id_tab2').value;
		}
		var personality =jQuery.trim(jQuery('#edit-personality-tab2').val());

		//alert(personality);
		//alert(city);
		//alert(state);
		//alert(prox);

		jQuery('#totaloutsidecount').html('&nbsp;');

		  if (isNaN(zip)) {
		  jQuery('#status_tab2').html('Zipcode must be integer value.');
		  document.getElementById('tct-tab2').value='';
		  jQuery("#table-container_tab2").css("display", "none");  
		  return false;
	  
										 }	  
										 else if(zip<0)
										 {
										jQuery('#status_tab2').html('Zipcode must be integer value.');	
												  document.getElementById('tct-tab2').value='';
		  jQuery("#table-container_tab2").css("display", "none");
		   return false;
										 }
										 
										 else {
											 jQuery('#status_tab2').html('&nbsp;');
		 jQuery("#table-container_tab2").css("display", "block"); 
										 }
		
		
		if(zipfinder!='') {
		
 initializeTables(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation);
 
		}
		
		else {
			
			var inputzip_value_lat = '0';
			var inputzip_value_lng = '0';
			var zip = ''; 
			
		 initializeTables(' ',' ',' ',inputzip_value_lat,inputzip_value_lng,intrest,strugles,victory,mstat,children,relation,prox,zip,age,email,church,personality,name,Occupation);
		 
		}
	});
});
