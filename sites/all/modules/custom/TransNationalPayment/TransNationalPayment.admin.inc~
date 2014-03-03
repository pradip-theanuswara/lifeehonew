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


function TransNationalPayment_admin_settings() {

$form['Bancard_user_id'] = array(
'#type' => 'textfield',
'#title' => t('Your TransNational Payment user name'),
 '#default_value' => variable_get('Bancard_user_id'),
    '#size' => 32,
    '#maxlength' => 30,
    '#description' => t('Enter your TransNational Payment user name.'),
    '#required' => TRUE,
	
);

if(variable_get('Bancard_password_id')!='')
{
$form['Bancard_password_id'] = array(
'#type' => 'password',
'#title' => t('Your TransNational Payment Password'),
 '#default_value' => variable_get('Bancard_password_id'),
'#description' => t('* Password is alreday stored in our database,Kindly enter new password in case you have changed your TransNational Payment details.Password is not visible for security issues.'),
'#size' => 32,
'#required' => TRUE,
);
}

else {

$form['Bancard_password_id'] = array(
'#type' => 'password',
'#title' => t('Your TransNational Payment Password'),
 '#default_value' => variable_get('Bancard_password_id'),
'#description' => t('Enter TransNational Payment details.Password will not visible for security issues.'),
'#size' => 32,
'#required' => TRUE,
);

}




$form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save TransNationalPayment configuration'),
 
  );
return $form;
}


function TransNationalPayment_admin_settings_submit($element, &$form_state) {

 // transnational bankcard userID save
 variable_set('Bancard_user_id', $form_state['values']['Bancard_user_id']);
 // transnational bankcard Password save
 variable_set('Bancard_password_id', $form_state['values']['Bancard_password_id']);
 
 
 drupal_set_message(t('Your TransNationalPayment configuration has been saved.'));

}

?>
