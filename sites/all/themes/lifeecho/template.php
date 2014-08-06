<?php

/**
 * Add body classes if certain regions have content.
 */

function lifeecho_filter_tips($tips, $long = FALSE, $extra = '') {
  return '';
}
function lifeecho_filter_tips_more_info () {
  return '';
}


function lifeecho_preprocess_html(&$variables) {

  // Add conditional stylesheets for IE
  drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
  drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
  
    $description = array(        
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'description',
        'content' => 'LifeEcho is a social media platform designed to connect, equip and multiply Christ-centered discipleship relationships.  Jesus stated, in the Great Commission, "Go therefore and make disciples of all nations, baptizing them in the name of the Father and the Son and the Holy Spirit teaching them to observe all that I commanded you." Matthew 28:19-20.  LifeEcho provides you the tools to harness the power of your story (2 Cor 1:4) by using technology to connect, encourage and equip discipleship relationships within the context of Biblical community.  Christ centered discipleship ensures that your life echoes throughout eternity.',
      )
    );
    drupal_add_html_head($description, 'description');
	
	$description = array(        
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => array(
        'property' => 'og:image',
        'content' => 'http://www.lifeecho.com/sites/all/themes/lifeecho/logo.png',
      )
    );
    drupal_add_html_head($description, 'description');

}

/**
 * Override or insert variables into the page template for HTML output.
 */
function lifeecho_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function lifeecho_process_page(&$variables) {
  // Hook into color.module.
unset($_SESSION['messages']['warning']);
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
  
  if('user' == arg(0) && 'edit' == arg(2)) {
     drupal_add_js(drupal_get_path('theme', 'lifeecho') .'/js/jquery-ui.js', 'file');
     drupal_add_css(drupal_get_path('theme', 'lifeecho') .'/css/jquery-ui.css', 'file');
  }

// we need to change the title of the page.
if(arg(0) == 'node' && arg(1) == 'add' && arg(2) == 'community-content') {
$variables['title'] = 'DISCIPLESHIP 101';
}
if(arg(0) == 'searches') {
//$variables['title'] = 'User Search';
drupal_set_title('User Search Form');
}
// to remove menu and left sidebar jquery conflict we added below jquery migrate file.
if(arg(0) == 'dplan' && is_numeric(arg(1))) {
drupal_add_js(drupal_get_path('theme','lifeecho').'/js/jquery-migrate-1.0.0.js', 'file');
}
  
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function lifeecho_preprocess_maintenance_page(&$variables) {
  // By default, site_name is set to Drupal if no db connection is available
  // or during site installation. Setting site_name to an empty string makes
  // the site and update pages look cleaner.
  // @see template_preprocess_maintenance_page
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'lifeecho') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function lifeecho_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  //$variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  //$variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  $variables['hide_site_name']   = FALSE;
  $variables['hide_site_slogan'] = FALSE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function lifeecho_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function lifeecho_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function lifeecho_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function lifeecho_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}

/* Implements of hook_theme */

function lifeecho_theme($existing, $type, $theme, $path) {
    
  $hooks = array();
  global $user;
  $hooks['user_profile_form'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','lifeecho'),
     'template' => 'user-profile',
  );
  
  $hooks['user_register_form'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','lifeecho'),
     'template' => 'user-profile',
  );
  
   $hooks['community_lifeecho_node_form'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','lifeecho'),
     'template' => 'create-community',
  );
    
     /* $hooks['user_login'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','lifeecho'),
     'template' => 'user-login',
  ); */

   $hooks['community_content_node_form'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','lifeecho').'/templates',
     'template' => 'create-discipleship-101-content',
  );
  
  return $hooks;
}

function lifeecho_menu_link(array $variables) {
global $user;
$variables['menu']['50000 Create 2767']['below']['49951 Edit Profile 2772']['link']['href'] = 'user/1';
return theme_menu_link($variables);
}

/* we want to change the message when user request for a user relationship */

function lifeecho_preprocess_page(&$variables) {
if(arg(0) == 'user' && isset($_SESSION['messages']['status'][0])) {
$a = $_SESSION['messages']['status'][0];
if($a == 'The changes have been saved.') {
//$result = db_query('Call run_score()');
$result ='';
$_SESSION['messages']['status'][0] = 'Your Profile has been Updated Successfully';
}
}

/* we need to override startplan template */
if(arg(0) == 'startdplan') {
$variables['theme_hook_suggestions'][3] = 'page--startdplan';
}

if(arg(0) == 'dplan') {
$variables['theme_hook_suggestions'][3] = 'page--dplan';
}

}

/* mini pager customization - function written in views module */

function lifeecho_views_mini_pager($vars) {
  global $pager_page_array, $pager_total;

  $tags = $vars['tags'];
  $element = $vars['element'];
  $parameters = $vars['parameters'];
  $quantity = $vars['quantity'];

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.



  if ($pager_total[$element] > 1) {

    $li_previous = theme('pager_previous',
      array(
        'text' => (isset($tags[1]) ? $tags[1] : '<img src="'.base_path().drupal_get_path('theme','lifeecho').'/images/pager_left.gif'.'" />'),
        'element' => $element,
        'interval' => 1,
        'parameters' => $parameters,
      )
    );
    if (empty($li_previous)) {
      $li_previous = "&nbsp;";
    }

    $li_next = theme('pager_next',
      array(
        'text' => (isset($tags[3]) ? $tags[3] : '<img src="'.base_path().drupal_get_path('theme','lifeecho').'/images/pager_right.gif'.'" />'),
        'element' => $element,
        'interval' => 1,
        'parameters' => $parameters,
      )
    );

    if (empty($li_next)) {
      $li_next = "&nbsp;";
    }

    $items[] = array(
      'class' => array('pager-previous'),
      'data' => $li_previous,
    );
/*
to get 1 0f 2   

  $items[] = array(
      'class' => array('pager-current'),
      'data' => t('@current of @max', array('@current' => $pager_current, '@max' => $pager_max)),
    );


*/
    $items[] = array(
      'class' => array('pager-next'),
      'data' => $li_next,
    );
    return theme('item_list',
      array(
        'items' => $items,
        'title' => NULL,
        'type' => 'ul',
        'attributes' => array('class' => array('pager')),
      )
    );
  }
}

function lifeecho_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('« First') => t('Go to first page'),
        t('‹ Previous') => t('Go to previous page'),
        t('Next ›') => t('Go to next page'),
        t('Last »') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }

  // @todo l() cannot be used here, since it adds an 'active' class based on the
  //   path only (which is always the current path for pager links). Apparently,
  //   none of the pager links is active at any time - but it should still be
  //   possible to use l() here.
  // @see http://drupal.org/node/1410574
  $attributes['href'] = url($_GET['q'], array('query' => $query));
  return '<a' . drupal_attributes($attributes) . '>' . $text . '</a>';
}

// We need to display user avatar on main menu "Signout" link.
function lifeecho_links($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';
	global $user;
	$fbuid = get_facebookid_from_userid($user->uid);
	$userimage = get_user_avatar($fbuid,'large',46,46);
      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
if(($user->uid <> 0) && ($link['href'] == 'custom/logout')) {
        $output .= '<a href="'.url('user/'.$user->uid).'">'.$userimage.'</a>'.l($link['title'], $link['href'], $link);
}
else {
$output .= l($link['title'], $link['href'], $link);
}
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

// function overrides theme_pager function

function lifeecho_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« First')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ Previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('Next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('Last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'),
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pager')),
    ));
  }
}

/**
 * Returns HTML for a date_select 'year' label.
 */
function lifeecho_date_part_label_year($variables) {
if($variables['element']['#value']['year'] == '') { // newly added.
  return t('Type the year', array(), array('context' => 'datetime'));
}
else {
  return t('Type the year', array(), array('context' => 'datetime'));
}
}

/**
 * Returns HTML for a date_select 'month' label.
 */
function lifeecho_date_part_label_month($variables) {
if($variables['element']['#value']['month'] == '') { // newly added.
  return t('Month', array(), array('context' => 'datetime'));
}
else {
  return t('Month', array(), array('context' => 'datetime'));
}

}

/**
 * Returns HTML for a date_select 'day' label.
 */
function lifeecho_date_part_label_day($variables) {

if($variables['element']['#value']['day'] == '') { // newly added.
  return t('Day', array(), array('context' => 'datetime'));
}
else {
return t('Day', array(), array('context' => 'datetime'));
}

}
