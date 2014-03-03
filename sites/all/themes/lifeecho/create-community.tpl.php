<div class="community_contentdiv">
    <div class="clear">
    </div><p>
        <?php print t('Congratulations, you are just a few steps away from creating a LifeEcho Community...'); ?></p>
        <div id="notready_create" class="comm_bk_profile clearfix"><a class="profile_navigator lifebtn" href="<?php echo url('user'); ?>"><?php print (t('Go To My Profile')); ?></a><span class="not_ready comm_notice"><?php print t('( Not quite ready to create a community )'); ?></span></div>
    <div class="communityfield_row">
        <?php
        print render($form['field_select_community']);
        ?>     
    </div>
    <div class="clear">
    </div>
<div class="community_form_view">
    <div class="communityfield_row">
        <?php
        print render($form['field_what_is_the_name_of_your_o']);
        ?>
    </div>
    <div class="clear">
    </div>

    <div class="communityfield_row">

        <?php
        print render($form['field_address']);

        print render($form['field_city']);

        print render($form['field_state']);

        print render($form['field_zip']);

        print render($form['field_phone_number']);

        print render($form['field_email_address']);
        
        print render($form['field_website']);
        ?>
    </div>

   </div>

    <div class="clear">
    </div>
        <div class="community_textarea_view">
    <div class="communityfield_row">
        <?php
        print render($form['field_what_is_your_role_with_thi']);
        ?>
    </div>

    <div class="clear">
    </div>
    <div class="communityfield_row">
        <?php
        print render($form['field_tell_us_about_your_communi']);
        ?>
    </div>

    <div class="clear">
    </div>
    <div class="communityfield_row">
        <?php
        print render($form['field_what_is_your_statement_of_']);
        ?>
    </div>

    <div class="clear">
    </div>
    <div class="communityfield_row">
        <?php
        print render($form['field_what_is_the_purpose_of_thi']);
        ?>
    </div>
            </div>
    <div class="clear">
    </div>
             
    <div class="community_upload_view community_marg">
    <div class="communityfield_row">
        <?php
        print render($form['field_image_upload']);
        ?>
    </div>
    <div class="communityfield_row">
    <?php print render($form['field_thumbnail_upload']); ?>
        </div>
    
    <div class="clear">
    </div>
        </div>
     <div class="communityfield_row">
        <?php
        print t('<b>In order to create a LifeEcho Community your organization must belive:</b>');
        print ('<br/>');
       // print t('(Scroll to the bottom to enable checkbox)</b>')
        ?>
    </div>
    <div class="clear">
    </div>

<div id="belief_container" class="community_marg"><?php $node = node_load('17');
//echo $node->body['und'][0]['value']; ?>
<?php print $node->body['und'][0]['value']; 
 
       
        ?>
</div>
    <div class="clear">
    </div>
    <div class="comm_notice"><?php print t('(Scroll to the bottom to enable checkbox)</b>'); ?></div>
       <div class="communityfield_chkbox">
        <?php
       
        print render($form['field_beliveaccept']);
        ?>
    </div>
    <div class="communityfield_chktxt">
        <?php
        global $user;
 print t('I , ' . $user->name . ' and my organization, agree with and believe the Statement of Faith above.  ');
        ?>
<span title="This field is required." class="form-required">*</span>
    </div>
        <div class="clear">
    </div>
    <div class="communityfield_row">
        <?php
        print t('<b>Please accept the Terms and Conditions</b>');
        print ('<br/>');
       // print t('(Scroll to the bottom to enable checkbox)</b>')
        ?>
        <?php $node = node_load('15'); ?>
        <div id="terms_dialog"><p><?php print $node->body['und'][0]['value']; ?></p></div>
    </div>
    <div class="clear">
    </div>
    <div id="termsscroller" class="community_marg"><?php print $node->body['und'][0]['value']; ?></div>
    <div class="clear">
    </div>
    <div class="comm_notice"><?php print t('(Scroll to the bottom to enable checkbox)</b>') ?></div>
    <div class="communityfield_chkbox communityfield_row"><?php print render($form['field_accept']); ?>
</div>
    <div class="communityfield_chktxt">
        <?php
        print t('By checking this box you agree to all LifeEcho Terms and Conditions. ');
        ?>
<span title="This field is required." class="form-required">*</span>
    </div>
    <div class="clear">
    </div>
<?php 
if(arg(2) != 'edit') { ?>
 <div class="community_billing_view">
    <div class="communityfield_row">
        <?php
                 print render($form['amount_options']);
		 print render($form['credit_card_number']);
		 print render($form['expiration_date']);
		 echo "</br>";
		 print render($form['credit_card_cvv']);
        ?>
    </div></div>
<?php } ?>
    <div class="clear">
    </div>
    <div class="communityBtn"><?php print drupal_render($form['actions']['submit']); ?></div>
    <div class="clear">
    </div>

    <div style="display:none"><?php print drupal_render_children($form); ?></div>
</div>
