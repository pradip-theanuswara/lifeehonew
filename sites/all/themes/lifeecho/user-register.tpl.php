<?php
print '<pre>';
print_r($form['field_what_is_your_preferred_ini']);
?>
<div id="user_register_form">
<div class="clear-left"><?php print render($form['account']['name']); ?></div>
<div class="clear-left"><?php print render($form['account']['mail']); ?></div>
<div class="clear-left"><?php print render($form['field_select_one_of_the_followin']); ?></div>
<div class="clear-left"><?php print render($form['field_how_closely_belief']); ?></div>
<div class="clear-left"><?php print render($form['field_how_would_you_describe_you']); ?></div>
<div class="clear-left"><?php print render($form['field_where_have_you_seen_christ']); ?></div>
<div class="clear-left"><?php print render($form['field_where_do_you_face_current_']); ?></div>
<div class="clear-left"><?php print render($form['field_what_are_your_hobbies_and_']); ?></div>
<div class="clear-left"><?php print render($form['field_do_attend_a_church']); ?></div>
<div class="clear-left"><?php print render($form['field_if_what_church_']); ?></div>
<div class="clear-left"><?php print render($form['field_list_christian_organ']); ?></div>
<div class="clear-left"><?php print render($form['field_what_is_your_personal_stat']); ?></div>
<div class="clear-left"><?php print render($form['field_what_do_you_want_to_tell_o']); ?></div>
<div class="clear-left"><?php print render($form['field_how_do_you_want_to_use_lif']); ?></div>
<div class="clear-left"><?php print render($form['field_what_is_your_preferred_ini']); ?></div>
<div class="clear-left"><?php print render($form['field_do_you_have_time_to_record']); ?></div>
<div class="clear-left" id=""><?php print render($form['field_last_step_please_accept_th']); ?></div>
<div class="clear-left"><?php print drupal_render($form['actions']['submit']); ?></div>
<div style="display:none"><?php print drupal_render_children($form); ?></div>
</div>