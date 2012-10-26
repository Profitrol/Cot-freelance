<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=auth
File=rating.users.auth.check.done
Hooks=users.auth.check.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// ƒобавление рейтинга за посещение в сутки

$sql = sed_sql_query("SELECT * FROM $db_users WHERE user_id=".$ruserid."");
if ($row = sed_sql_fetcharray($sql)){
	
	// Ќачисление бонуса за посещение в день	
	if($row['user_logcount'] > 0){
		$sql_lastlog = sed_sql_query("SELECT * FROM sed_rating WHERE item_userid=".$ruserid." AND item_type='auth' ORDER by item_date DESC LIMIT 1");
			$lastlog = sed_sql_fetcharray($sql_lastlog);
			
			list($year, $month, $day) = explode('-', @date('Y-m-d', $sys['now_offset']));
			
			$today = sed_mktime(0, 0, 0, $month, $day, $year);
			
			if($lastlog['item_date'] < $today){
				sed_setrating('auth', $ruserid);
			}
	}
			
}
	
?>