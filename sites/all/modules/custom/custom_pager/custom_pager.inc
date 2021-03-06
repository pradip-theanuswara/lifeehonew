<?php
function _potential_contacts_callback() {
return "aDASG ADSAGFH";
}

function potential_contacts() {

	header("Content-type: text/html");
	header("Expires: Wed, 29 Jan 1975 04:15:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

 global $user;
 $string = '';
 $uid = $user->uid;
 $result = get_allcommunities_forauser($uid); // GET ALL COMMUNITIES
 $relationRes = get_userRelation_relationships($uid);
   
	for($i=0;$i<count($result['nids']);$i++) {

		$key[] = $result['nids'][$i];
		if($i < count($result['nids'])-1) {
		$string .= $key[$i].',';
		}
		else {
		$string .= $key[$i];
		}

	}
$stringres = explode(',',$string);
	if(check_miniprofile_status() == FALSE ) {
	die('<p>'.t('Complete your mini profile to view your potential contacts.').'</p>');
	}
     
        $stringnew = '';
        $result = get_user_answer_howtouselifeecho($uid);


	if(in_array('108',$result))
	$roleid[] = '109';

	if(in_array('109',$result))
	$roleid[] = '108';

	if(in_array('110',$result))
	$roleid[] = '110';

	for($i=0;$i<count($roleid);$i++) {
		$key1[] = $roleid[$i];
		$stringnew .= $key1[$i].',';
	}

	$stringnew=substr($stringnew, 0, -1);


	$query1 = db_select('users','users');
	
	$query1->join('og_membership','og','users.uid = og.etid');
	$query1->join('field_data_field_how_do_want_to_use_lif','f','f.entity_id=users.uid');
	$query1->join('user_relationships','ur','ur.requestee_id != users.uid');
        $not_in_uid = array($uid,'1',$relationRes); // here 1 is admin uid
        $query1 = $query1->condition('f.field_how_do_want_to_use_lif_tid', $roleid ,'IN')
	->condition('og.gid', $stringres ,'IN')
	->condition('users.uid', $not_in_uid ,'NOT IN')
	->condition('users.status', 1)   // user status active
	->groupBy('users.uid')
	->extend('PagerDefault')	//Pager Extender
	->limit(2)			//10 results per page
	->fields ('users', array (
					'uid',
					'name'
				));

	$gender=get_user_gender();
	if($gender!="")
	{
  		$query1->join('field_data_field_gender','ugender','users.uid = ugender.entity_id');
  		$query1->condition('ugender.field_gender_value', $gender,'=');
	}

//print_r($roleid);
//print_r(array($string));
//print_r($not_in_uid);
//echo $query1->__toString();

$results = $query1->execute();
$rows_count = $results->rowCount();

if($rows_count > 0) {
	$rowss = array();
foreach($results as $records) {

$status = check_allready_relation($user->uid,$records->uid);

$fbuid = get_facebookid_from_userid($records->uid);
$fb_avatar = get_user_avatar($fbuid,'small','45','45');
$username = explode( ' ',$records->name) ;       
$rowss[] = array(
		'data' => array(
      '<a href="'.$status.'">'.$fb_avatar.'</a>'
));
$rowss[] = array(
		'data' => array(
      '<a href="'.$status.'">'.$username[0].'...</a>'
));
 }
$html = theme('table', array(
  'rows' => $rowss
));
$html .= theme('views_mini_pager');
}
else { $html = '<div class="view-empty">'.t('There are no potential Contacts.').'</div>'; }
die ($html);
}


if(!function_exists("get_user_gender"))
{
  function get_user_gender()
  {
  	global $user;
    $uid = $user->uid;
    
    $query = db_select('field_data_field_gender','g');
    $query->fields('g', array('entity_id', 'field_gender_value'));
    $query->condition('g.entity_id', $uid); 
    $result = $query->execute()->fetchAssoc();
    if(isset($result['field_gender_value']))
    {
      $gender=$result['field_gender_value'];
    }
    else $gender=null;
    return $gender;
  }
}
