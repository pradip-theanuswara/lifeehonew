<?php
// devex_service.inc
/**
* Callback for creating devex services.
*
* @param object $data
* @return object
*/
function _devex_service_create($data) {
  //global $user;
	
  unset($data['id']);
 // $data['uid'] = $user->uid;
  $data['created'] = time();
  $data['modified'] = time();
  $data['event_desc'] ='';

  if (!isset($data['subject'])) {
    return services_error('Missing devex attribute subject', 406);
  }

 /* if (!isset($data['devex'])) {
    return services_error('Missing devex attribute devex', 406);
  }*/

  devex_service_write_devex($data);
  
  return (object)array(
    'id' => $data['id']
   // 'uri' => service_service_uri(array('devex', $data['id'])),
  );
}

// devex_service.inc
/**
* Callback for updating devex services.
*
* @param int $id
* @param object $data
* @return object
*/
function _devex_service_update($id, $data) {
	
  global $user;
  $devex = devex_service_get_devex($id);
  $devex =$devex['0'];
	
  unset($data['created']);
  $data['id'] = $id;
  $data['uid'] = $devex->uid;
  $data['modified'] = time();

  devex_service_write_devex($data);
  
  return (object)array(
    'id' => $id
    //'uri' => services_service_uri(array('devex', $id)),
  );
} 
/**
* Callback for retrieving devex services.
*
* @param int $id
* @return object
*/
function _devex_service_retrieve($id) {
  return devex_service_get_devex($id);
}

/**
* Callback for deleting devex services.
*
* @param int $id
* @return object
*/
function _devex_service_delete($id) {
  devex_service_delete_devex($id);
  
  return (object)array(
    'id' => $id,
  );
}

function _devex_service_index($page, $parameters) {
  global $user;
  $devexs = array();
  if($user->uid > 0){
  $res = db_query("SELECT * FROM {devex} 
WHERE uid='".$user->uid."'ORDER BY modified DESC");
}else{
 $res = db_query("SELECT * FROM {devex} 
ORDER BY modified DESC");
}
foreach ($res as $devex) {
    $devexs[] = $devex;
  }	
 return $devexs; 
}

/**
* Access callback for the devex service.
*
* @param string $op
*  The operation that's going to be performed.
* @param array $args
*  The arguments that will be passed to the callback.
* @return bool
*  Whether access is given or not.
*/

function _devex_service_access($op, $args) {
  global $user;
  $access = FALSE;

  switch ($op) {
    case 'view':
      $devex = devex_service_get_devex($args[0]);
      $access = user_access('devex service view any devex');
      $access = $access || $devex->uid == $user->uid && 
      user_access('devex service view own devexs');
      break;
    case 'update':
      $devex = devex_service_get_devex($args[0]->id);
      $access = user_access('devex service edit any devex');
      $access = $access || $devex->uid == $user->uid &&  
      user_access('devex service edit own devexs');
      break;
    case 'delete':
      $devex = devex_service_get_devex($args[0]);
      $access = user_access('devex service delete any devex');
      $access = $access || $devex->uid == $user->uid && 
      user_access('devex service delete own devexs');
      break;
  }
  $access = TRUE;
  
  return $access;
}
?>