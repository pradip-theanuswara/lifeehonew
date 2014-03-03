<?php

 function discipler_views_data() {
    $data = array();
    $data['lifeecho_og_discipler']['table']['group'] = t('lifeechoogdiscipler');

    $data['lifeecho_og_discipler']['table']['base'] = array(
        'field' => 'uid',
        'title' => t('lifeecho_og_discipler gid'),
        'help' => t("rid id in the system"),
        'weight' => 1,
    );


$data['lifeecho_og_discipler']['table']['join'] = array(
    'users' => array(
       'handler' => 'views_join', // this is actually optional
       'left_table' => 'users',
      'left_field' => 'uid',
      'field' => 'uid',
     ),
  );

$data['lifeecho_og_discipler']['uid'] = array(
    'title' => t('lifeecho og discipler'),
    'relationship' => array(
      'base' => 'users',
      'field' => 'uid',
      'handler' => 'views_handler_relationship',
      'label' => t('uid id in this table that references a lod.'),
    ),
  );



 $data['lifeecho_og_discipler']['gid'] = array(
        'title' => t('User group id for lifeecho og discipler'),
        'help' =>t('User group id for lifeecho og discipler'),
          'field' => array('handler' => 'views_handler_field'),
    'argument' => array('handler' => 'views_handler_argument_numeric'),
    'filter' => array('handler' => 'views_handler_filter_numeric'),
    'sort' => array('handler' => 'views_handler_sort'));
    
 
    return $data;
}

?>