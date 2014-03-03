var $k=jQuery.noConflict();

$k(function() { //When the dom is ready

$k('#showdialog').click(function() {
 $k("#terms_dialog").dialog();
});

var limit_max = 0;
// discipleship pairs functionality.

$k('.load_more').live("click",function() { //When user clicks
$k('.load_more').hide();
var last_msg_id = $k(this).attr("id"); // Get the id from the hyperlink
var gid = $k('#comid').val();
var totalcount = $k('#totalcount').val();
var limit = $k('#limit').val();
$k("#limit_max").val(parseInt($k("#limit_max").val())+parseInt(limit));
var ends = document.getElementById('limit_max').value;
if(last_msg_id!='end'){ //if not all post has been loaded yet
// otalcount: totalcount
$k.ajax({ // fetch the article via ajax
type: "POST",
url:  "?q=community/discipleshippair/callback",//calling this page
data: { lastmsg: last_msg_id, gid: gid,ends: ends,totalcount: totalcount },
beforeSend:  function() { // add the loadng image
$k('a.load_more').append('<img src="sites/all/modules/custom_block/facebook_style_loader.gif" />');
 },
success: function(html) {
$k("#facebook_style").remove();//remove the div with class name "facebook_style"
$k("#discipleship_pairs").append(html);//output the server response into ol#updates
$k('.load_more').show();
}
});
 }
return false;

});
});


(function($)
{


    $k.fn.fbGetcover = function(FBuid, containerWidth, containerHeight, callback)
    {

	
        var $this = this;

	
        if(typeof(containerWidth) == 'undefined') containerWidth = 968;
        if(typeof(containerHeight) == 'undefined') containerHeight = 314;
        if(typeof(callback) == 'undefined') callback = function(status){};
        $this.find('img').remove();
	
        $k.ajax(
        {
            url: 'http://graph.facebook.com/'+FBuid+'?fields=cover',
            dataType: 'jsonp',
            complete: function(jqXHR, textStatus)
            {
                if(textStatus != 'success') callback('failed');
            },
            success: function(data)
            {

			
                if(typeof(data.cover) != 'undefined')
                {
                    $this.append
                    (
                        $k('<img>').css({'width':'inherit'})
                        .hide()
                        .load(function(e)
                        {
                            $this.css({'width':containerWidth, 'height':containerHeight, 'display':'inline-block', 'position':'relative', 'overflow':'hidden'});
                            $k(e.currentTarget).css(
                            {
                                'margin-top':(($k(e.currentTarget).height()-containerHeight)*(data.cover.offset_y*0.01))*-1
                            }).show();
                            callback('success');
                        })
                        .attr('src', data.cover.source)
                    );
                }
                else callback('failed');
            }
        });
        return this;
    };
})(jQuery);
