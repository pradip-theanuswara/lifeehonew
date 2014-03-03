<?php
/**
* @file
* Administration page callbacks for the annotate module.
*/
/**
* Form builder. Configure annotations.
*
* @ingroup forms
* @see system_settings_form().
*/


function comunitypricepackage_admin_settings() {

$form['community_price_one'] = array(
'#type' => 'textfield',
'#title' => t('First package price'),
 '#default_value' => variable_get('community_price_one'),
    '#size' => 32,
    '#maxlength' => 30,
    '#description' => t('/year Small Groups'),
    '#required' => TRUE,
	
);


$form['community_price_two'] = array(
'#type' => 'textfield',
'#title' => t('Second package price'),
 '#default_value' => variable_get('community_price_two'),
'#description' => t('/year <1000 in weekly attendance'),
'#size' => 32,
'#required' => TRUE,
);




$form['community_price_three'] = array(
'#type' => 'textfield',
'#title' => t('Third package price'),
 '#default_value' => variable_get('community_price_three'),
'#description' => t('/year between 1000-5000 in weekly attendance'),
'#size' => 32,
'#required' => TRUE,
);


$form['community_price_four'] = array(
'#type' => 'textfield',
'#title' => t('Fourth package price'),
 '#default_value' => variable_get('community_price_four'),
'#description' => t('/year between 5000-10,000 in weekly atttendance'),
'#size' => 32,
'#required' => TRUE,
);


$form['community_price_five'] = array(
'#type' => 'textfield',
'#title' => t('Fifth package price'),
 '#default_value' => variable_get('community_price_five'),
'#description' => t('/year >10,000 in weekly attendance'),
'#size' => 32,
'#required' => TRUE,
);






$form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save price details'),
 
  );
return $form;
}


function comunitypricepackage_admin_settings_submit($element, &$form_state) {


 variable_set('community_price_one', $form_state['values']['community_price_one']);
 variable_set('community_price_two', $form_state['values']['community_price_two']);
 variable_set('community_price_three', $form_state['values']['community_price_three']);
 variable_set('community_price_four', $form_state['values']['community_price_four']);
 variable_set('community_price_five', $form_state['values']['community_price_five']);
 
 
 drupal_set_message(t('Lifeecho community price details has been saved.'));

}

?>
