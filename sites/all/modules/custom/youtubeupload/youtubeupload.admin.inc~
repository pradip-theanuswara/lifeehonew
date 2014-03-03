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




   
     
	  $sdk_path = DRUPAL_ROOT . '/Zend/Loader.php';
      $library = array('loaded' => file_exists($sdk_path));
     
	  //echo $sdk_path;
        require $sdk_path;
     




function youtubeupload_admin_settings() {

$form['youtubeupload_email_id'] = array(
'#type' => 'textfield',
'#title' => t('Your Google email id'),
 '#default_value' => variable_get('youtubeupload_email_id'),
    '#size' => 32,
    '#maxlength' => 30,
    '#description' => t('Enter Google email for Youtube Uploading.'),
    '#required' => TRUE,
	'#element_validate' => array('MODULE_email_element_validate'),
);

if(variable_get('youtubeupload_password_id')!='')
{
$form['youtubeupload_password_id'] = array(
'#type' => 'password',
'#title' => t('Your Google Password'),
 '#default_value' => variable_get('youtubeupload_password_id'),
'#description' => t('* Password is alreday stored in our database,Kindly enter new password in case you have changed your Google username/password.Password is not visible for security issues.'),
'#size' => 32,
'#required' => TRUE,
);
}

else {

$form['youtubeupload_password_id'] = array(
'#type' => 'password',
'#title' => t('Your Google Password'),
 '#default_value' => variable_get('youtubeupload_password_id'),
'#description' => t('Enter Google Password for Youtube Uploading.Password will not visible for security issues.'),
'#size' => 32,
'#required' => TRUE,
);

}





$form['youtubeupload_developer_id'] = array(
'#type' => 'textfield',
'#title' => t('Your Google developer key'),
 '#default_value' => variable_get('youtubeupload_developer_id'),
'#description' => t('Enter Google developer key for Youtube uploading'),
'#size' => 150,
'#required' => TRUE,
);




//echo  variable_get('youtubeupload_password_id');
$form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save Youtube configuration'),
 
  );
return $form;
}

/*
* Google user verification  and data submit
*/

function youtubeupload_admin_settings_submit($element, &$form_state) {

 $authError='';
 $user = $form_state['values']['youtubeupload_email_id'];

 $pass  = $form_state['values']['youtubeupload_password_id'];
 $devkey = $form_state['values']['youtubeupload_developer_id'];

 
Zend_Loader::loadClass('Zend_Gdata_ClientLogin'); 
Zend_Loader::loadClass('Zend_Gdata_YouTube');
$service ='youtube'; 

// Create an authenticated HTTP client 
try {
$client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$service); 
$yt = new Zend_Gdata_YouTube($client, '12', '12', $devkey);
}
catch (Exception $e)
{

$authError = $e->getMessage();

}


	
 
 if($authError=='')
 {
 variable_set('youtubeupload_email_id', $form_state['values']['youtubeupload_email_id']);
 variable_set('youtubeupload_password_id', $form_state['values']['youtubeupload_password_id']);
 variable_set('youtubeupload_developer_id', $form_state['values']['youtubeupload_developer_id']);
 
 
 drupal_set_message(t('Your Youtube configuration has been saved.'));
 }
 else
 {

drupal_get_messages('error');
drupal_set_message(t($authError),'error');
 
 }

}




function MODULE_email_element_validate($element, &$form_state, $form) {
   if (!valid_email_address($element['#value'])) {
     form_error($element, t('Please enter a valid email address.'));
   }
   if($element['#value'])
   {
   $strings[1]='';
   $strings = explode('@',$element['#value']);
	   if($strings[1]!='gmail.com')
	   {
	    form_error($element, t('Please enter your  gmail address.'));
	   }
   }
}
?>
