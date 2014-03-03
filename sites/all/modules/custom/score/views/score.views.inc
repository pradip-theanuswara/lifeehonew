<?php

 function score_views_data() {
    $data = array();
    $data['scoretable']['table']['group'] = t('scoretable');

    $data['scoretable']['table']['base'] = array(
        'field' => 'user_id1',
        'title' => t('score'),
        'help' => t("score content."),
        'weight' => 1,
    );
 $data['scoretable']['uid'] = array(
        'title' => t('Second User Id uid'),
           'field' => array('handler' => 'views_handler_field'),
    'argument' => array('handler' => 'views_handler_argument_numeric'),
    'filter' => array('handler' => 'views_handler_filter_numeric'),
    'sort' => array('handler' => 'views_handler_sort_numeric'));

$data['scoretable']['table']['join'] = array(
    'users' => array(
      'left_field' => 'uid',
      'field' => 'uid',
     ),
  );

$data['scoretable']['uid'] = array(
    'title' => t('users'),
    'relationship' => array(
      'base' => 'users',
      'field' => 'uid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node id in this table that references a node.'),
    ),
  );

  
    $data['scoretable']['user_id1'] = array(
        'title' => t('First User Id'),
          'field' => array('handler' => 'views_handler_field'),
    'argument' => array('handler' => 'views_handler_argument_numeric'),
    'filter' => array('handler' => 'views_handler_filter_numeric'),
    'sort' => array('handler' => 'views_handler_sort_numeric'));




 $data['scoretable']['score'] = array(
        'title' => t('Final Score'),
        'help' =>t('testing'),
          'field' => array('handler' => 'views_handler_field'),
    'argument' => array('handler' => 'views_handler_argument_numeric'),
    'filter' => array('handler' => 'views_handler_filter_numeric'),
    'sort' => array('handler' => 'views_handler_sort'));
    

    return $data;
}

?>