<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/lifeecho.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see lifeecho_process_page()
 * @see html.tpl.php
 */

?>

<div id="MPOuterMost">
<div id="MPOuter">
<div class="header"></div>
<div id="menu">

    <?php global $base_url;
$beta =  "/sites/all/themes/lifeecho/beta.png";
$extrastyle='';
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
<?php
 if ($title): 
	if($title == 'Invitations'){
	$extrastyle='style="width:503px !important;float:left !important;"';
	?>
    <div class="inner1communitybanner">              
		<div class="thumb-container">
			<?php print render($page['userprofilemybio']); ?>
		</div>    
    </div>
	
	<?php
           global $user;
           if(($user->uid != 0) && arg(2) != 'edit') { ?>
           <div class="imgdiv" id="community_dasbboard">
                        <div class="user">
                            <div id="imgdiv1">
								<?php
								if(arg(0) == 'user' || arg(0) == 'users') {
									print l(t('USER DASHBOARD'),'user', array('attributes' => array('class' => 'dashboard-link'))).'</br>';
									if($community_count != '' || $community_count_admin > 0) { // check logged user has a community
										print l(t('ADMIN DASHBOARD'),'community/dashboard');
									}
								}
								else {

									print l(t('USER DASHBOARD'),'user').'</br>';
									if($community_count != '' || $community_count_admin > 0) { // check logged user has a community
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
					
<?php }
endif;
?>

<div class="innerPagecontentdiv adjustablewidth" <?php echo $extrastyle; ?>>
      <?php if ($messages): ?>
    <div id="messages"><div class="section clearfix">
      <?php print $messages; ?>
    </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>
    <div class="contentinner">
<div class="section">
      
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if ($tabs): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>

    </div><!-- /.section, /#content -->
   
    </div>
</div>
<?php
 if ($title): 
	if($title == 'Invitations'){
	?>
<div class="imgdivCOMMUNITY2">
   <div class="imgdivCOMMUNITY-inner2" style="width:257px !important;float:right !important;margin:0px !important"><?php print render($page['sidebar_ad1']); ?></div>
          <div class="imgdivCOMMUNITY-inner2"><?php print render($page['sidebar_ad2']); ?></div>
         <div class="imgdivCOMMUNITY-inner2"><?php print render($page['sidebar_ad3']); ?></div>
        <!--  <div class="imgdivCOMMUNITY-inner4"><?php //print render($page['sidebar_ad4']); ?></div> -->
         <!-- <div class="imgdivCOMMUNITY-inner4"><?php //print render($page['sidebar_ad5']); ?></div>  -->  
</div>
<?php }
endif;
?>
 <div class="lifefooter">
                    <div class="qdisc">
                    <?php print render($page['footer']); ?>
                    </div>
			</div>
</div>
<div id="video">
    <div class="footerlist">
     <?php  print render($page['videofooter']); ?>
    </div>
</div>

</div>

</div>
