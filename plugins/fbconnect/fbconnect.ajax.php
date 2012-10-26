<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=fbconnect
Part=ajax
File=fbconnect.ajax
Hooks=ajax
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

// $login = sed_import('login','G','ALP');

// if(!empty($login)){
	// $sql = sed_sql_query("SELECT COUNT(*) FROM $db_users WHERE user_name='".sed_sql_prep($login)."'");
	// $res1 = sed_sql_result($sql,0,"COUNT(*)");
// }

// if(preg_match('/&#\d+;/', $login) || preg_match('/[<>#\'"\/]/', $login)) 
	// $error = $L['aut_invalidloginchars'].' 1';
	
// if(mb_strlen($login)<2) 
	// $error .= $L['aut_usernametooshort'].' 2';
	
// if($res1>0) 
	// $error .= $L['aut_usernamealreadyindb'].' 3';

// echo json_encode(array("login"=>$login, "error"=>$error));

?>
