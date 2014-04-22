(function($) {
	
$(document).ready( function() {

// we need to remove '#_=_' from user login url , its due to a bug in facebook connect.

if (window.location.href.indexOf('#_=_') > 0) {
    window.location = window.location.href.replace('#_=_', '');
}

// hide "og-group-ref" field from post message/video pages
$('#community_post_option #community-content-node-form #edit-og-group-ref').hide();
$('#community_post_option #community-video-node-form #edit-og-group-ref--2').hide();

$('#edit-radio-post-message-1').click(function() { 
$('#post_message_wrapper').show();
$('#post_alter_wrapper').hide();
$('#post_video_wrapper').hide();
 });

$('.usermatch_container #tabmatch-1').click(function() {
$('#outside_1').show();
$('#outside_2').hide();
$('#outside_3').hide();
});

$('.usermatch_container #tabmatch-2').click(function() {
$('#outside_1').hide();
$('#outside_2').show();
$('#outside_3').hide();
});

$('.usermatch_container #tabmatch-3').click(function() {
$('#outside_1').hide();
$('#outside_2').hide();
$('#outside_3').show();
});

$('.menu-2773').hover(function() {
$('#child-community-display').show();
 });

$('#block-nice-menus-1').mouseleave(function() {
$('#child-community-display').hide();
 });

$('.menu-2774').hover(function() {
$('#child-community-display').hide();
 });

$('.menu-2775').hover(function() {
$('#child-community-display').hide();
 });

$('.menu-2776').hover(function() {
$('#child-community-display').hide();
 });

$('.menu-2777').hover(function() {
$('#child-community-display').hide();
 });

$('#edit-radio-post-message-2').click(function() {
$('#post_message_wrapper').hide();
$('#post_alter_wrapper').show();
$('#post_video_wrapper').hide();
 });

$('#edit-radio-post-message-3').click(function() { 
$('#post_message_wrapper').hide();
$('#post_alter_wrapper').hide();
$('#post_video_wrapper').show();
 });

$('#belief_container').scroll(function() {
buffer = 30 // # of pixels from bottom of scroll to fire your function. Can be 0
if (belief_container.offsetHeight + belief_container.scrollTop >= belief_container.scrollHeight) {
$('#edit-field-beliveaccept-und').attr("disabled", false);
  }
});

$('#edit-field_beliveaccept-und').attr("disabled", true);


if($('#edit_term').val() =='1')
{
	$('#edit-field_beliveaccept-und').attr("disabled", false);
}



$('#termsscroller').scroll(function() {
buffer = 40 // # of pixels from bottom of scroll to fire your function. Can be 0
if (termsscroller.offsetHeight + termsscroller.scrollTop >= termsscroller.scrollHeight) {
$('#edit-field-accept-und').attr("disabled", false);
  }
});

$('#edit-field-accept-und').attr("disabled", true);

if($('#edit-field-accept-und').attr('checked')) {
$('#edit-field-accept-und').attr("disabled", false);
}
else {
//this script used to chek the place holder valu action in the create community page
$('#edit-field-accept-und').attr("disabled", true);
}

/*$('#edit-field-image-upload-und-0-upload-button').click(function() {

    alert('hello1');
    var imgVal = $('#edit-field-image-upload-und-0-upload').val();
    if(imgVal=='')
    {
        alert("empty input file");

    }

});*/



$('#edit-submit--3').click(function() {
if($('#edit-post-alert').val() == '') {
alert('Please enter an Alert');
return false;
}
else {
return true;
}
});
    
$('#community-lifeecho-node-form #edit-field-what-is-the-name-of-your-o-und-0-value').attr('placeholder','Organization Name');

$('#community-content-node-form .community-content-body').attr('placeholder','Post a message to your community!');

$('#community-post-alert-form #edit-post-alert').attr('placeholder','Post an alert to your community!');

$('#community-lifeecho-node-form #edit-field-city-und-0-value').attr('placeholder','City');

$('#community-lifeecho-node-form #edit-field-state-und-0-value').attr('placeholder','State');

$('#community-lifeecho-node-form #edit-field-zip-und-0-value').attr('placeholder','Zip');

$('#community-lifeecho-node-form #edit-field-website-und-0-value').attr('placeholder','Website Eg. www.sitename.com');

$('#community-lifeecho-node-form #edit-field-address-und-0-value').attr('placeholder','Address');

$('#community-lifeecho-node-form #edit-field-phone-number-und-0-value').attr('placeholder','Phone');

$('#community-lifeecho-node-form #edit-field-email-address-und-0-email').attr('placeholder','Email');

$('#views-exposed-form-searches-block-1 #edit-mail').attr('placeholder','Search by Email Address');
$('#views-exposed-form-searches-block-1 #edit-field-if-what-church-value').attr('placeholder','Search by Church');
$('#views-exposed-form-community-outside-user-search-block-1 #edit-mail').attr('placeholder','Search by Email Address');
$('#views-exposed-form-community-outside-user-search-block-1 #edit-field-if-what-church-value').attr('placeholder','Search by Church');
//$('#community-lifeecho-node-form #edit-field-what-is-your-role-with-thi-und-0-value').attr('placeholder','Leader,Assistant,Administrator...');

$("#edit-field-zip-und-0-value").attr('maxlength','5');
$("#edit-field-user-zip-code-und-0-value").attr('maxlength','5');
$("#edit-field-phone-number-und-0-value").attr('maxlength','12');
$("#edit-field-occupation-und-0-value").attr('maxlength','35');
$("#edit-field-what-is-your-role-with-thi-und-0-value").attr('maxlength','50');
//place holder script ends here

        $('#edit-field-what-is-your-preferred-und-111').click(function() {
            $('#account_mail_container').show();
            $('#txt_sms_container').hide();
            $('#phone_call_container').hide();
            $('#fb_msg_container').hide();
            $('#skype_msg_container').hide();
        });
        
        $('#edit-field-what-is-your-preferred-und-114').click(function() {
            $('#fb_msg_container').show();
            $('#account_mail_container').hide();
            $('#txt_sms_container').hide();
            $('#phone_call_container').hide();
            $('#skype_msg_container').hide();
        });
        
        $('#edit-field-what-is-your-preferred-und-113').click(function() {
            $('#phone_call_container').show();
            $('#account_mail_container').hide();
            $('#txt_sms_container').hide();
            $('#fb_msg_container').hide();
            $('#skype_msg_container').hide();
        });
        
        $('#edit-field-what-is-your-preferred-und-115').click(function() {
            $('#skype_msg_container').show();
            $('#account_mail_container').hide();
            $('#txt_sms_container').hide();
            $('#phone_call_container').hide();
            $('#fb_msg_container').hide();
        });
        
        $('#edit-field-what-is-your-preferred-und-112').click(function() {
            $('#txt_sms_container').show();
            $('#account_mail_container').hide();
            $('#phone_call_container').hide();
            $('#fb_msg_container').hide();
            $('#skype_msg_container').hide();
        });
    
        // upload video
        $('#edit-field-do-you-have-time-to-record-und-117').click(function() {

		$('#video_upload_container').show();
		$('#record_video_container').hide();
		$('#write_testimony').hide();

	     
        });

        // record video
        $('#edit-field-do-you-have-time-to-record-und-116').click(function() {
		$('#record_video_container').show(); 
		$('#video_upload_container').hide();
		$('#write_testimony').hide();
        });

        // write testimony
        $('#edit-field-do-you-have-time-to-record-und-118').click(function() {
		$('#write_testimony').show();
		$('#record_video_container').hide();
		$('#video_upload_container').hide();
        });
        
        $('#showdialog').click(function() {
          $( "#terms_dialog" ).dialog();
        });
        
        $("#edit-field-if-what-church-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,"")); 
        });
        
        /*$("#edit-field-list-christian-organ-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,"")); 
        });*/
        
        $("#edit-field-what-is-your-personal-stat-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,"")); 
        });     
        
        $("#edit-field-what-do-you-want-to-tell-o-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,"")); 
        });
        
        $("#edit-field-write-testimony-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });
        
        $("#edit-field-what-is-the-name-of-your-o-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-\']+/,""));
        });
        
        $("#edit-field-address-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });
        
        $("#edit-field-city-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });
        
      /*  $("#edit-field-what-is-your-role-with-thi-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });
        
        $("#edit-field-tell-us-about-your-communi-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });
        
        $("#edit-field-what-is-your-statement-of-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });
        
        $("#edit-field-what-is-the-purpose-of-thi-und-0-value").keyup(function() {
            var text = $(this).val();
	    $(this).val(text.replace(/[^\w\d\s\:\.\,\_\-]+/,""));
        });*/
        
        $("#edit-field-phone-number-und-0-value").keyup( function() {
            var text = $(this).val();
            $(this).val(text.replace(/[^\d\-]/,""));
        });
        
        $("#edit-field-zip-und-0-value").keyup( function() {
            var text = $(this).val();
            $(this).val(text.replace(/[^\d]/,""));
        });

	$(".remove_btn").click( function() {
		var r=confirm("Do you want to permanently delete this Alert? ");
		if (r==true)
		  {
		 return true;
		  }
		else
		  {
		 return false;
		  }
	});

	$(".relationship_decline").click( function() {
		var r=confirm("Do you want to decline this D-pair request? ");
		if (r==true)
		  {
		 return true;
		  }
		else
		  {
		 return false;
		  }
	});

	$(".leaveuserrelation").click( function() {
		var r=confirm("Do you really want to leave the d-pair? ");
		if (r==true)
		  {
		 return true;
		  }
		else
		  {
		 return false;
		  }
	});

	});
        
})(jQuery);
