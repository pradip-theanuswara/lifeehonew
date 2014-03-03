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
<link rel="stylesheet" href="<?php echo base_path().drupal_get_path('theme','lifeecho'); ?>/css/jquery-ui.css" />
<script src="<?php echo base_path().drupal_get_path('theme','lifeecho'); ?>/js/jquery-ui.js"></script>
<script>
var $k = jQuery.noConflict();
$k(function() {
$k( "#tabs" ).tabs();
});
</script>
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
</ul>
</div>
   <div class="second">     
     <div class="inner1communitybanner">              
     <div class="thumb-container">
<?php print render($page['userprofilemybio']); ?>
</div>    
        <?php if($user->uid != 0 && arg(2) != 'edit') { ?>
		<ul id="main-nav">

<?php //print render($page['userprofile_onpagemenu']); ?>

<div class="region region-userprofile-onpagemenu">
    <div id="block-nice-menus-1" class="block block-nice-menus">
<div class="content">
    <ul class="nice-menu nice-menu-down" id="nice-menu-1">

<li class="menu-2767 menuparent  menu-path-front   even  home"><a title="Create" <?php if(check_miniprofile_status() == FALSE ) { ?>style="background-position: center top;" <?php } ?>><?php print t('Create'); ?></a><ul><li class="menu-2771 menu-path-user  first   odd  "><a href="<?php echo url('user/'.$user->uid.'/edit'); ?>" title="Complete profile"><?php print t('Complete Profile'); ?></a></li>
<li class="menu-2772 menu-path-front   even   last "><a href="<?php echo url('user/'.$user->uid.'/edit'); ?>" title="Edit Profile"><?php print t('Edit Profile'); ?></a></li>
</ul></li>

<li class="menu-2768 menuparent  menu-path-front  first   odd"><a title="Connect" <?php if(count(get_logged_user_joined_community_ID()) == 0) { ?>style="background-position: center top;" <?php } ?>><?php print t('Connect'); ?></a><ul>
<?php if($hascommunity_count > 0) { // check logged user has a community */ ?>
<li class="menu-2773 menu-path-community-dashboard  first odd"><a href="#" title="My Community"><?php print t('My Community'); ?></a></li>
<ul id="child-community-display" style="display: block; visibility:visible">
<?php $community_array = get_logged_user_joined_community_ID();
if(count($community_array) > 0) {
for($i=0;$i<count($community_array);$i++) {
$pieces = explode('/',$community_array[$i]);
?>
<li><a href="<?php echo url('node/'.$pieces[0]).'?sparam=1'; ?>" title="My Community"><?php 
if(get_logged_user_community_ID() == $pieces[0])
echo $pieces[1].' (created) ';
else
echo $pieces[1]; 
?></a></li>
<?php
} } ?>
</ul>
<?php
} // END community count check
?>
<li class="menu-2774 menu-path-user-matches   even  "><a href="<?php echo url('userlist/matches'); ?>" title="My Matches"><?php print t('My Matches'); ?></a></li>
<li class="menu-2775 menu-path-searches   odd  ">
<?php
if(count($community_array) > 0) {
?>
<a href="<?php echo url('searches'); ?>" title="Search"><?php print t('Search'); ?></a>
<?php
}else{
?>
<a href="<?php echo url('searches').'#tabs-2'; ?>" title="Search"><?php print t('Search'); ?></a>
<?php
}
?>
</li>
<li class="menu-2776 menu-path-joincommunity   even  "><a href="<?php echo url('joincommunity'); ?>" title="Join a Community"><?php print t('Join a Community'); ?></a></li>
<li class="menu-2777 menu-path-node-add-community-lifeecho   odd   last "><a href="<?php echo url('node/add/community-lifeecho'); ?>" title="Create a Community"><?php print t('Create a Community'); ?></a></li>
</ul></li>

<li class="menu-2769 menuparent  menu-path-front   even   last "><a title="Equip" <?php if(count(get_logged_user_joined_community_ID()) == 1) { ?>style="background-position: center top;" <?php } ?>><?php print t('Equip'); ?></a><ul><li class="menu-2778 menu-path-user  first   odd  "><a href="<?php echo url('discipleship-101'); ?>" title="Discipleship Training Center"><?php print t('Discipleship Training Center'); ?></a></li>
<li class="menu-2779 menu-path-user even last "><a target="_blank" href="https://www.youversion.com/" title="Bible"><?php print t('Bible'); ?></a></li>
</ul></li>

<li class="menu-2770 menuparent  menu-path-front odd"><a title="Disciple"><?php print t('Disciple'); ?></a><ul><li class="menu-2780 menu-path-user  first   odd   last "><a href="<?php echo url('calendar'); ?>" title="Goes to main calendar"><?php print t('Goes to main calendar'); ?></a></li>
</ul></li>

</ul>
  </div>
</div>
  </div>
		</ul>
	<?php } ?>	
		

            </div>
       <div class="third">
           <?php
           global $user;
           if(($user->uid != 0) && arg(2) != 'edit') { ?>
           <div class="imgdiv">
                        <div class="user">
                            <div id="imgdiv1">
<?php
if(arg(0) == 'user' || arg(0) == 'users') {
print l(t('USER DASHBOARD'),'user', array('attributes' => array('class' => 'dashboard-link'))).'</br>';
if($community_count !='' || $community_count_admin > 0) {  // check logged user has a community
print l(t('ADMIN DASHBOARD'),'community/dashboard');
}
}
else {
print l(t('USER DASHBOARD'),'user').'</br>';
if($community_count !='' || $community_count_admin > 0) {  // check logged user has a community
echo '<a class="dashboard-link" href="'.url('community/dashboard').'" >'.t('ADMIN DASHBOARD').'</a>';
}
}
?></div>
                            <div id="calender">
                                <a href="<?php echo url('calendar'); ?>"><img alt="Calender" src="<?php echo base_path().drupal_get_path('theme','lifeecho'); ?>/images/calender.png" /></a>
                            </div>
                        </div>
                        <div class="imgtable">
                         <?php print render($page['userprofilesidebar']); ?>
                            </div>
                    </div><!-- imgdiv end --> <?php } ?>
                    
      <?php if ($messages): ?>
  <?php print $messages; ?>
  <?php endif; ?>
                    <div class="Userdashboard">
<?php
   global $user;
   $query =   db_select('node', 'n');
			 $query->join('field_data_field_what_is_the_name_of_your_o', 'fi', 'n.nid = fi.entity_id');
                         $query->fields('fi',array('field_what_is_the_name_of_your_o_value'));
                         $query->condition('uid', $user->uid );
                         $query->condition('type','community_lifeecho');
                         $query->orderBy('created', 'DESC'); //ORDER BY created
                         $query->range(0,1); //LIMIT to 1 record
          $result = $query->execute();
          $row_count = $result->rowCount();
          while($record = $result->fetchAssoc()) {
          $community_name = $record['field_what_is_the_name_of_your_o_value'];
          }
?>
<div id="tabs" class="usermatch_container">
<ul>
<?php if($hascommunity_count > 0) { // check logged user has a community ?>
<?php /* if($row_count > 0) { echo $community_name; } */ ?>
<li><a href="#tabs-1" id="tabs1" ><?php print t('INSIDE COMMUNITY'); ?></a></li>
<?php } ?>
<?php if($hascommunity_count == 0) { // check logged user has a community ?>
<li style="width:0px;height:0px;"><a href="#tabs-1" id="tabs1"></a></li>
<li><a href="#tabs-2" id="tabs2" style="width:423px;background-color:#AFC486;color:#000000;"><?php print t('OUTSIDE OF YOUR COMMUNITY'); ?></a></li>
<?php } else { ?>
<li><a href="#tabs-2" id="tabs2" ><?php print t('OUTSIDE OF YOUR COMMUNITY'); ?></a></li>
<?php } ?>
</ul>
<div id="tabs-1" class="tab1-in">
<?php 
//$block = module_invoke('views', 'block_view', 'searches-block_1');
print render($page['content']);
?>
</div>
<div id="tabs-2" class="tab2-os">
<?php

$block = module_invoke('outsideusersearch', 'block_view', 'outsideusersearch');
print render($block['content']);
//print render($page['content']);
?>
</div>
</div>
</div>
                    <div class="imgdivCOMMUNITY2">
<div class="imgdivCOMMUNITY-inner1" style="width:257px !important;float:right !important;margin:0px !important"><?php print render($page['sidebar_ad1']); ?></div>
               <div class="imgdivCOMMUNITY-inner2"><?php print render($page['sidebar_ad2']); ?></div>
               <div class="imgdivCOMMUNITY-inner2"><?php print render($page['sidebar_ad3']); ?></div>
    <!--   <div class="imgdivCOMMUNITY-inner4"><?php //print render($page['sidebar_ad4']); ?></div>
<div class="imgdivCOMMUNITY-inner4"><?php //print render($page['sidebar_ad5']); ?></div>      -->       
</div>
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
