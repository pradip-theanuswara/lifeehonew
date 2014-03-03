<?php
/**
* Template file for "What are LifeEcho Communities?" page.
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
<div class="header1"></div>
<div class="videodiv">
	<div class="video">
	<?php print render($page['headervideo']); ?>
        </div>
    <div class="rightsidecontent">
        <div class="contentpartInner">
            <?php print render($page['content']); ?>
        </div>
 <?php
global $user;
if($user->uid != 0) { // query to get number of communities owned by a logined user
    $query =   db_select('node', 'n')
               ->fields('n',array('title','nid'))
               ->condition('uid', $user->uid )
               ->condition('type','community_lifeecho');
    $result = $query->execute();
    $own_community_count = $result->rowCount();
        ?>
        <?php if($own_community_count > 0) {
          while($record = $result->fetchAssoc()) {
            ?>
        <a href="<?php echo url('node/add/community-lifeecho'); ?>"><div class="btn2">
                &nbsp;</div></a>  
        <?php }  } else { 
		
		?>
	<a  href="<?php echo url('node/add/community-lifeecho'); ?>"><div class="btn2">
                &nbsp;</div></a>
    <?php } } else {
	
	echo "</pre>";
	//echo $_SERVER["HTTP_REFERER"];
	
		
	 ?>
        <a  onclick="testing();" href="<?php echo url('custom/login'); ?>"><div class="btn2">
                &nbsp;</div></a>
<?php
}
?>
</div>
</div>
<div class="bottomcontentdiv">
<div id="video1" style="border-bottom: solid 1px #C1C1C1;">
<?php  print render($page['videofooter']); ?>
</div>
</div>
</div>
</div>
<script>
function testing() {

var now = new Date();
var time = now.getTime();
var expireTime = time + 1000*36000;
now.setTime(expireTime);
var tempExp = 'Wed, 31 Oct 2012 08:50:17 GMT';
document.cookie = 'cookie=ok;expires='+now.toGMTString()+';path=/';
}
</script>