<div class="community_contentdiv">
<div class="communityfield_row"><?php print render($form['body']); ?></div>
<div class="clear"></div>
<?php /*<div class="communityfield_row"><?php print "<a class='button' href='#'  onclick='popup2()'>Video record</a>"; ?></div>
<div class="communityfield_row"><?php print render($form['field_or_link_to_a_youtube_video']); ?></div>*/ ?>
<div class="communityfield_row"><?php print render($form['og_group_ref']); ?></div>
<div class="clear"></div>
<div class="communityfield_row"><?php print render($form['field_checkbox_to_share_your_pos']); ?></div>
<div class="clear"></div>
<div class="communityfield_row"><?php print render($form['field_check_box_to_store_post_in']); ?></div>
<?php print drupal_render($form['actions']['submit']); ?>
<?php print drupal_render_children($form); ?>
<?php /*<script>
function popup2()
	{
		//var poupwin=null;
		poupwin = window.open("<?php echo base_path(); ?>video-record", "mywindow", 'width=414,height=420,scrollbars=no,dialog=yes,maximize=no,alwaystop=yes,copyhistory= no,resizable=no,toolbar=no,titlebar=0,location=yes,menubar=no,directories=no,status=1,left=200,top=200');
		//poupwin.moveTo(50, 50);
	}
</script>*/ ?>
</div>
