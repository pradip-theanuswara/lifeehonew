<?php
/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */

?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php /*if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; */ ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);

       $query = new EntityFieldQuery();
       $members_count = $query
                    ->entityCondition('entity_type', 'og_membership')
                    // Type can be "node" or "user"
                    ->propertyCondition('entity_type', 'user', '=')
                    // This is the group ID
                    ->propertyCondition('gid', $node->nid , '=')
                    // Get only the active members
                    ->propertyCondition('state', OG_STATE_ACTIVE, '=')
                    ->count()
                    ->execute();
      ?>
      <div class="MainCOMMUNITY">
          <div class="community_main">

<?php if(function_exists('node_viewcount_count_view_select')) :
$view_count = node_viewcount_count_view_select($node->nid,$user->uid);
if($view_count == 1):
?>
<div id="community_topvideo">
<iframe width="400" height="260" src="http://www.youtube.com/embed/<?php echo variable_get('community_page_youtubevideoid'); ?>?feature=player_embedded;rel=0;autoplay=1" frameborder="0" allowfullscreen></iframe>
</div>
<?php
endif;
endif; ?>
          <div class="community_thumb">
             <img src="<?php if(isset($node->field_thumbnail_upload[''.$node->language.''][$node->tnid]['uri'])) { echo render(file_create_url($node->field_thumbnail_upload[''.$node->language.''][$node->tnid]['uri'])); } else { echo base_path().drupal_get_path('theme','lifeecho').'/images/nothumbnail.jpeg'; } ?>" width="100" height="100" />
          </div>
          <div class="communityinfo">
              <span><?php  print t('COMMUNITY: '); if(isset($node->field_what_is_the_name_of_your_o[''.$node->language.''][$node->tnid]['value'])) { echo $node->field_what_is_the_name_of_your_o[''.$node->language.''][$node->tnid]['value']; } ?></span>
              <span><?php print t('MEMBERS: '); echo $members_count; ?></span>
              <span><?php print t('LOCATION: '); if(isset($node->field_state[''.$node->language.''][$node->tnid]['taxonomy_term']->name)) { echo $node->field_state[''.$node->language.''][$node->tnid]['taxonomy_term']->name; } ?></span>
              <span><?php print t('WEBSITE: '); if(isset($node->field_website[''.$node->language.''][$node->tnid]['value'])) { echo '<a target="_blank" href="http://'.$node->field_website[''.$node->language.''][$node->tnid]['value'].'">'.$node->field_website[''.$node->language.''][$node->tnid]['value'].'</a>'; } ?></span>
              <span><?php print t('CONTACT: '); if(isset($node->field_phone_number[''.$node->language.''][$node->tnid])) { echo $node->field_phone_number[''.$node->language.''][$node->tnid]['value']; } ?></span>
<?php 
global $user;
if($node->uid == $user->uid) { ?>

<div id="community_deletebtn" ><?php print l(t('Edit'),'node/'.$node->nid.'/edit',array('attributes' => array('class' => 'button'))) ?><?php print l(t('Delete Community'),'node/'.$node->nid.'/delete',array('attributes' => array('class' => 'button')) ); ?></div><?php } ?>

</div>
          </div>
          <div class="clear"></div>
          <div class="community_aboutus"><b><?php  print t('ABOUT US: '); ?></b><?php if(isset($node->field_tell_us_about_your_communi['und'][0])) { echo $node->field_tell_us_about_your_communi[''.$node->language.''][$node->tnid]['value']; } ?></div>
          <div class="clear"></div>
          <div class="community_faith"><b><?php print t('STATEMENT OF FAITH: '); ?></b><?php if(isset($node->field_what_is_your_statement_of_[''.$node->language.''][$node->tnid])) { echo $node->field_what_is_your_statement_of_[''.$node->language.''][$node->tnid]['value']; } ?></div>         
      </div>
  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</div>
