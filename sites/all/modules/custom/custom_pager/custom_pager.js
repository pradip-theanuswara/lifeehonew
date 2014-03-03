function initializePotentialTable() {
	jQuery(document).ready(function() {
                alert('inside first call');
		//refreshPotentialTable();
	});
}



function refreshPotentialTable(page, sort, order) {
	if(!page) page = 0;
	if(!sort) sort = '';
	if(!order) order = '';

	jQuery.ajax({
		cache: false,
		
		url: Drupal.settings.basePath + '?q=potential/contact_page',
		data: {page: page, sort: sort, order: order},
		dataType: 'text',
		error: function(request, status, error) {
			//alert(status);
		jQuery('#view-potential-contacts').html('An error occured');
		},
		success: function(data, status, request) {
		var html = data;
			jQuery('#view-potential-contacts').html(html);

			jQuery('#view-potential-contacts th ').
				add('#view-potential-contacts .pager-item a')
				.add('#view-potential-contacts .pager-first a')
				.add('#view-potential-contacts .pager-previous a')
				.add('#view-potential-contacts .pager-next a')
				.add('#view-potential-contacts .pager-last a')

					.click(function(el, a, b, c) {
var url = jQuery.url(el.currentTarget.getAttribute('href'));
var url = jQuery.url(el.currentTarget.getAttribute('href'));
refreshPotentialTable(url.param('page'), url.param('sort'), url.param('order'));
					return (false);
					});
		}
	});
}
