<?php
/**
 * Template file for community roster page.
 */

?>

<div id="MPOuterMost">
<div id="MPOuter">
<div class="header"></div>
<div id="menu">
<?php global $base_url;
$beta =  "/sites/all/themes/lifeecho/beta.png";
?>
        <?php if ($logo): ?>

      <a href="#" title="beta" rel="home" id="logo">
        <img src="<?php echo $beta; ?>" width="50px" height="60px" alt="beta version"/>
      </a>
    <?php endif; ?>
<div class="logo"> <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?></div>
<ul>
    <?php if ($main_menu): ?>
      <li>
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => '',
            'class' => array('', ''),
          ),
          'heading' => array(
            'text' => t('Main menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </li> <!-- /#main-menu -->
    <?php endif; ?>

   
</ul>
</div>
<?php
if(function_exists('get_allcommunities_forauser')) {
$hascommunity_count = 0;
$hascommunity_count = count(get_allcommunities_forauser());
} ?>
<?php
if(function_exists('user_has_community_adminrole')) {
$community_count_admin = 0;
$community_count_admin = user_has_community_adminrole();
} ?>
<?php
if(function_exists('get_logged_user_community_ID')) {
$community_count = '';
$community_count = get_logged_user_community_ID();
} ?>
<div class="second">     
     <div class="inner1communitybanner">              
     <div class="thumb-container">
<?php print render($page['userprofilemybio']); ?>
</div>

            </div>
       <div class="third">
           <?php
           global $user;
           if(($user->uid != 0) && arg(2) != 'edit') { ?>
           <div class="imgdiv" id="community_dasbboard">
                        <div class="user">
                            <div id="imgdiv1">
                              <?php
if(arg(0) == 'user' || arg(0) == 'users') {
print l(t('USER DASHBOARD'),'user', array('attributes' => array('class' => 'dashboard-link'))).'</br>';
if($community_count !='' || $community_count_admin > 0) { // check logged user has a community
print l(t('ADMIN DASHBOARD'),'community/dashboard');
}
}
else {
print l(t('USER DASHBOARD'),'user').'</br>';
if($community_count !='' || $community_count_admin > 0) { // check logged user has a community
echo '<a class="dashboard-link" href="'.url('community/dashboard').'" >'.t('ADMIN DASHBOARD').'</a>';
}
}

?>
</div>
                            <div id="calender">
                                <a href="<?php echo base_path(); ?>calendar"><img alt="" src="<?php echo base_path().drupal_get_path('theme','lifeecho'); ?>/images/calender.png" /></a>
                            </div>
                        </div>
                        <div class="imgtable">
                         <?php print render($page['userprofilesidebar']); ?>
                            </div>
                    </div><!-- imgdiv end --> <?php } ?>
                    
      <?php if ($messages): ?>
  <?php print $messages; ?>
  <?php endif;
  if(($user->uid == 0 && arg(0)== 'user') || (arg(0) == 'user' && arg(2) == 'edit')) {
     print render($page['content']); // display core blocks
    }
    else {
        ?>
                 <?php /* <div class="personalinfoCOMMUNITY">
<?php //print render($page['userprofilecontent']); ?>
                  </div> */ ?>
                    <div class="Userdashboard"><?php print render($page['content']); ?></div>
                    <div class="imgdivCOMMUNITY2">
                    
                    <?php /*<div class="imgdivCOMMUNITY-inner2"></div>
                    <div class="imgdivCOMMUNITY-inner2"></div>*/ ?>
                    </div>
        <?php
    }
    ?>
                    <div style="clear:both;"></div>
                     <div class="lifefooter">
                    <div class="qdisc">
                    <?php print render($page['footer']); ?>
                    </div>
                    
                 
                </div>
      </div><!-- third div end -->
   </div><!-- second div end -->
</div><!-- MPOuter END -->
</div><!-- MPOuterMost END -->
