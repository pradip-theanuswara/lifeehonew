<?php
global $user;
$form['field_select_one_of_followin']['und']['#printed'] = FALSE;
$contact_medium = '';
$user_opt = '';
$user_opt_coll = array();
if(isset($form['field_what_is_your_preferred']['und']['#entity']->field_what_is_your_preferred['und'][0]['tid'])) {
$contact_medium = $form['field_what_is_your_preferred']['und']['#entity']->field_what_is_your_preferred['und'][0]['tid'];
}
if(isset($form['field_do_you_have_time_to_record']['und']['#entity']->field_do_you_have_time_to_record['und'])) {
$user_opt = $form['field_do_you_have_time_to_record']['und']['#entity']->field_do_you_have_time_to_record['und'];
}
if($user_opt != '') {
foreach($user_opt as $value => $key) {
   $user_opt_coll[] = $key['tid'];
}
}
?>
<?php 
/* first login check */
//if($user->created == $user->login) { 
// 08-12
if(check_miniprofile_status() == FALSE && $page['headervideo'] != "") { ?>

<div id="miniprofile_video">
<!--
    <iframe width="400" height="260" src="http://www.youtube.com/embed/<?php //echo variable_get('miniprofile_youtubevideoid'); ?>?feature=player_embedded;rel=0;autoplay=1" frameborder="0" allowfullscreen></iframe>
-->
<?php print render($page['headervideo']); ?>
</div>
<div class="clear"></div>
<p class="congrats_txt"><?php print t('Congratulations, in a few short minutes you\'ll have a LifeEcho profile!'); ?></p>
<p class="congrats_txt"><?php print t('COMPLETE MINI-PROFILE LOG IN TO OPEN YOUR LifeEcho)) HOMEPAGE!'); ?><p>
<div class="checkboxfirst"><?php print render($form['field_select_one_of_followin']); ?></div>
<div class="clear-left" id="do_your_beliefs"><?php print t('How closely do your beliefs match this statement'); ?> <span title="This field is required." class="form-required">*</span></div>
<div class="clear"></div>
<div class="belief_container"><?php $node = node_load('17');
echo $node->body['und'][0]['value']; ?></div>
<div class="clear"></div>
<div class="checkboxfirst"><?php print render($form['field_how_closely_do_belief']); ?></div>
<div class="clear-left"><?php print render($form['field_how_do_want_to_use_lif']); ?></div>
<div class="txt-box"><?php print render($form['field_email_adrs']); ?></div>
<div class="select-box"><?php print render($form['field_user_city']); ?></div>
<div class="select-box"><?php print render($form['field_user_state']); ?></div>
<div class="select-box"><?php print render($form['field_user_zip_code']); ?></div>
<div class="select-box"><?php print render($form['field_gender']); ?></div>
<div class="select-box"><?php print render($form['field_age']); ?></div>
<?php }
/* first login check else case */
else { ?>
<div class="checkboxfirst"><?php print render($form['field_select_one_of_followin']); ?></div>
<div class="clear-left" id="do_your_beliefs"><?php print t('How closely do your beliefs match this statement:'); ?> <span title="This field is required." class="form-required">*</span></div>
<div class="clear"></div>
<div class="belief_container"><?php $node = node_load('17');
echo $node->body['und'][0]['value']; ?></div>
<div class="clear"></div>
<div class="checkboxfirst"><?php print render($form['field_how_closely_do_belief']); ?></div>
<div class="checkBoxSecond"><?php print render($form['field_how_would_you_describe']); ?></div>
<div class="checkBoxSecond"><?php print render($form['field_where_have_seen_christ']); ?></div>
<div class="checkBoxSecond"><?php print render($form['field_where_do_face_current_']); ?></div>
<div class="checkBoxSecond"><?php print render($form['field_what_are_hobbies_and_']); ?></div>
<div class="checkBoxSecond"><?php print render($form['field_do_you_attend_a_church_']); ?></div>
<div class="clear-left"><?php print render($form['field_if_what_church_']); ?></div>
<div class="clear-left"><?php print render($form['field_list_christian_organ']); ?></div>
<div class="clear-left"><?php print render($form['field_what_is_your_personal_stat']); ?></div>
<div class="clear-left"><?php print render($form['field_what_do_you_want_to_tell_o']); ?></div>
<div class="select-box"><?php print render($form['field_gender']); ?></div>
<div class="select-box"><?php print render($form['field_marital_status']); ?></div>
<div class="select-box"><?php print render($form['field_children']); ?></div>
<div class="txt-box"><?php print render($form['field_occupation']); ?></div>
<div class="select-box"><?php print render($form['field_age']); ?></div>
<div class="txt-box"><?php print render($form['field_email_adrs']); ?></div>
<div class="select-box"><?php print render($form['field_user_city']); ?></div>
<div class="select-box"><?php print render($form['field_user_state']); ?></div>
<div class="select-box"><?php print render($form['field_user_zip_code']); ?></div>
<div class="clear"></div>
<div class="clear-left"><?php print render($form['field_how_do_want_to_use_lif']); ?></div>
<div class="clear-left"><?php print render($form['field_what_is_your_preferred']); ?></div>
<div id="txt_sms_container" class="clear-left" <?php if($contact_medium == '112') { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>><?php print render($form['field_text_sms']); ?></div>
<div id="phone_call_container" class="clear-left" <?php if($contact_medium == '113') { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>><?php print render($form['field_phone_call_data']); ?></div>
<div id="fb_msg_container" class="clear-left" <?php if($contact_medium == '114') { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>></div>
<div id="skype_msg_container" class="clear-left" <?php if($contact_medium == '115') { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>><?php print render($form['field_skype_message']); ?></div>
<div id="account_mail_container" class="clear-left" <?php if($contact_medium == '111') { echo 'style="display:block"'; } else { echo 'style="display:none"'; }  ?>><?php print render($form['account']['mail']); ?></div>
<div class="clear-left"><?php print render($form['field_do_you_have_time_to_record']); ?></div>
<div id="video_upload_container" class="clear-left" <?php if(count($user_opt_coll) > 0) { if(in_array("117", $user_opt_coll)) {
    echo 'style="display:block"';
}
else { echo 'style="display:none"'; } } else { echo 'style="display:none"'; } ?>><?php 
echo "<a href='javascript:void(0)'  class='button' onclick='popup(); return false;'>Upload to Youtube</a>";

//$block = block_load('Youtubeupload', 'youtube_upload');
//$block = module_invoke('Youtubeupload', 'block_view', 'youtube_upload');
//print render($block['content']);
//print $output;

?></div>
<div id="record_video_container" class="clear-left" <?php if(count($user_opt_coll) > 0) {  if(in_array("116", $user_opt_coll)) {
    echo 'style="display:block"';
}
else { echo 'style="display:none"'; } } else { echo 'style="display:none"'; } ?>><?php echo "<a href='javascript:void(0)' class='button' onclick='popup2(); return false;'>Video record</a>"; ?></div>
<div id="write_testimony" class="clear-left" <?php if(count($user_opt_coll) > 0) {  if(in_array("118", $user_opt_coll)) {
    echo 'style="display:block"';
}
else { echo 'style="display:none"'; } } else { echo 'style="display:none"'; } ?>><?php print render($form['field_write_testimony']); ?></div>

<?php /*<div class="clear-left" >
    <p>By checking this box you agree to all LifeEcho <span class="termsdialog_link" id="showdialog">Terms and Conditions</span></p>
</div>*/ ?>
<?php } /* first login check end */ ?>
<div id="terms_dialog"><p><?php $node = node_load('15'); print $node->body['und'][0]['value']; ?></p></div>
<div class="clear"></div>
<div class="checkboxfirst"><?php print render($form['field_last_step_please_accept_th']); ?></div>
<?php
print render($form['field_youtube_upload_response']);
print render($form['field_youtube_record_response']);
?>
<div class="Btn"><?php print drupal_render($form['actions']['submit']); ?></div>
<div style="display:none"><?php print drupal_render_children($form); ?></div>
<script>

	function popup()
	{
		
		//var poupwin=null;
		poupwin = window.open("<?php echo base_path(); ?>?q=youtube-upload", "mywindow", 'width=414,height=320,scrollbars=no,dialog=yes,maximize=no,alwaystop=yes,copyhistory= no,resizable=no,toolbar=no,titlebar=0,location=yes,menubar=no,directories=no,status=1,left=200,top=200');
		//poupwin.moveTo(50, 50);	
	}
	
	
	function popup2()
	{
		
		//var poupwin=null;
		
		poupwin = window.open("<?php echo base_path(); ?>?q=video-record", "mywindow", 'width=414,height=420,scrollbars=no,dialog=yes,maximize=no,alwaystop=yes,copyhistory= no,resizable=no,toolbar=no,titlebar=0,location=yes,menubar=no,directories=no,status=1,left=200,top=200');
		//poupwin.moveTo(50, 50);
	}

</script>
