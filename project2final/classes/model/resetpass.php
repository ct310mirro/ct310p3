<?php
namespace Model;
class Resetpass extends \Orm\Model
{

	protected static $_table_name = 'password_change_requests';
	
	protected static $_has_many = array('password_change_requests' => array(
	'key_from' => 'id',
	'model_to' => 'Model\change',
	'key_to' => 'UserID',
	'cascade_save' => true,		
	'cascade_delete' => false,
	));
	
	protected static $_properties = array('id', 'UserID', 'hashtoken');
	//protected static $_table_name = 'password_change_requests';
	//protected static $_primary_key = array('id');
	//protected static $_foreign_key = array('UserId');
	

public static function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

public static function rspass($vref, $newpw) {
		$id = $vref;
		
		$demo = Resetpass::find('first', array(
			'where' => array(
				array('hashtoken', $id),
			),
		))['hashtoken'];
	
		if (strcmp($demo, $id) ==0) {
		$uid = Resetpass::find('first', array(
			'where' => array(
				array('hashtoken', $id),
			),
		))['UserID'];
		$entry = new Users();
		$entry = Users::find($uid);
		$entry->password = $newpw;
		$entry-> save();
	
		
	}
		
	
			
}

}
