jQuery(document).ready(function() {
jQuery('.discipleship_101_container #tabs-2-new').click(function() {

initializeTable_admin();

});

});




function initializeTable() {

	jQuery(document).ready(function() {

		refreshTable();
		
		
	});
}

function refreshTable(page, sort, order) {
	if(!page) page = 0;
	if(!sort) sort = '';
	if(!order) order = '';

	jQuery.ajax({
		cache: false,
		
		url: Drupal.settings.basePath + '?q=discipleship/callback',
		data: {page: page, sort: sort, order: order},
		dataType: 'text',
		error: function(request, status, error) {
			//alert(status);
			jQuery('#tabs-1').html('An error occured');
		},
		success: function(data, status, request) {
			var html = data;
			jQuery('#tabs-1').html(html);
			//added by prabi to check box init
			//int_checkbox();
			jQuery('#tabs-1 th a').
				add('#tabs-1 .pager-item a')
				.add('#tabs-1 .pager-first a')
				.add('#tabs-1 .pager-previous a')
				.add('#tabs-1 .pager-next a')
				.add('#tabs-1 .pager-last a')
					.click(function(el, a, b, c) {
						var url = jQuery.url(el.currentTarget.getAttribute('href'));
						refreshTable(url.param('page'), url.param('sort'), url.param('order'));
					
						return (false);
					});
		}
	});
}


function initializeTable_admin() {

	jQuery(document).ready(function() {

		refreshTable_admin();
		
		
	});
}

function refreshTable_admin(page, sort, order) {
	if(!page) page = 0;
	if(!sort) sort = '';
	if(!order) order = '';

	jQuery.ajax({
		cache: false,
		
		url: Drupal.settings.basePath + '?q=discipleshipadmin/callback',
		data: {page: page, sort: sort, order: order},
		dataType: 'text',
		error: function(request, status, error) {
			//alert(status);
			jQuery('#tabs-2').html('An error occured');
		},
		success: function(data, status, request) {
			var html = data;
			jQuery('#tabs-2').html(html);
			//added by prabi to check box init
			//int_checkbox();
			jQuery('#tabs-2 th a').
				add('#tabs-2 .pager-item a')
				.add('#tabs-2 .pager-first a')
				.add('#tabs-2 .pager-previous a')
				.add('#tabs-2 .pager-next a')
				.add('#tabs-2 .pager-last a')
					.click(function(el, a, b, c) {
						var url = jQuery.url(el.currentTarget.getAttribute('href'));
						refreshTable_admin(url.param('page'), url.param('sort'), url.param('order'));
					
						return (false);
					});
		}
	});
}
