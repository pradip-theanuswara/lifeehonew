<?php
/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>
<div class="views-exposed-form">
  <div class="views-exposed-widgets clearfix">
    <?php foreach ($widgets as $id => $widget): ?>
      <div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
        <?php if (!empty($widget->label)): ?>
          <label for="<?php print $widget->id; ?>">
            <?php print $widget->label; ?>
          </label>
        <?php endif; ?>
        <?php if (!empty($widget->operator)): ?>
          <div class="views-operator">
            <?php print $widget->operator; ?>
          </div>
        <?php endif; ?>
        <div class="views-widget">
          <?php print $widget->widget; ?>
        </div>
        <?php if (!empty($widget->description)): ?>
          <div class="description">
            <?php print $widget->description; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    <?php if (!empty($sort_by)): ?>
      <div class="views-exposed-widget views-widget-sort-by">
        <?php print $sort_by; ?>
      </div>
      <div class="views-exposed-widget views-widget-sort-order">
        <?php print $sort_order; ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($items_per_page)): ?>
      <div class="views-exposed-widget views-widget-per-page">
        <?php print $items_per_page; ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($offset)): ?>
      <div class="views-exposed-widget views-widget-offset">
        <?php print $offset; ?>
      </div>
    <?php endif; ?>
    <div class="views-exposed-widget views-submit-button">
      <?php print $button; ?>
    </div>
    <?php if (!empty($reset_button)): ?>
      <div class="views-exposed-widget views-reset-button">
        <?php print $reset_button; ?>
      </div>
    <?php endif; ?>
  </div>
<?php
/*global $abc;
// we want to display total user match count.
$view = views_get_view('community_search');
$view->set_display('default');
$view->set_arguments( array( 1, 2, 3 ) );
$view->pager['items_per_page'] = 0;
//$view->pre_execute();
$view->execute();
$abc = $view->total_rows;
print "dddddddddddddd ".$abc;*/
if(isset($_GET['field_state_tid'])) {
$state_term_id = check_plain($_GET['field_state_tid']);
}
else {
$state_term_id = 'All';
}
if(isset($_GET['field_city_value'])) {
$city = check_plain($_GET['field_city_value']);
}
else {
$city = '';
}
if(isset($_GET['field_what_is_the_name_of_your_o_value'])) {
$organization_name = check_plain($_GET['field_what_is_the_name_of_your_o_value']);
}
else {
$organization_name = '';
}

$query = "SELECT node.nid AS nid, node.title AS node_title, node.uid AS node_uid, node.created AS node_created, 'node' AS field_data_field_thumbnail_upload_node_entity_type, 'node' AS field_data_field_tell_us_about_your_communi_node_entity_type FROM node node INNER JOIN field_data_field_what_is_the_name_of_your_o orgname ON node.nid = orgname.entity_id INNER JOIN field_data_field_city city ON node.nid = city.entity_id INNER JOIN field_data_field_state state ON node.nid = state.entity_id WHERE (( (node.status = '1')";
if($city != '') {
$query .= "AND (city.field_city_value LIKE '%$city%' )";
}
if($state_term_id != 'All') {
$query .= "AND  (state.field_state_tid = '$state_term_id')";
}
if($organization_name != '') {
$query .= "AND (orgname.field_what_is_the_name_of_your_o_value LIKE '%$organization_name%' )";
}
$query .= " AND (node.type IN  ('community_lifeecho')) )) ORDER BY node_created DESC";
$result = db_query("$query");
echo '<span class="match_count">'.$result->rowCount()." MATCHES AVAILABLE".'</span>';
?>
</div>

