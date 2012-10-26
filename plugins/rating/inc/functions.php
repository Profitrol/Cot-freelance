<?php

$sed_ratingpoints['portfoliodeltocat'] = -$cfg['plugin']['rating']['portfolioaddtocat'];
$sed_ratingpoints['portfoliodeltoscat'] = -$cfg['plugin']['rating']['portfolioaddtoscat'];

// Получение рейтинга пользователя
function sed_getuserrating($userid){
	$userinfo = sed_userinfo($userid);
	
	return $userinfo['user_rating'];
}

// Вычисление рейтинга пользователя и сохранение результата в таблице sed_users
function sed_setuserrating($userid){
	$sql = sed_sql_query("SELECT SUM(item_point) as summ FROM sed_rating WHERE item_userid=".$userid."");
	if($urating = sed_sql_fetcharray($sql)){
		$sql = sed_sql_query("UPDATE sed_users SET user_rating=".$urating['summ']." WHERE user_id=".$userid."");
		return true;
	}
	else
		return false;
}

// Операция по установке рейтинга по событию
function sed_setrating($type, $userid, $itemid=0){
	
	global $L, $cfg, $sys, $db_users, $db_pages, $sed_ratingpoints;
	
	switch($type){
		
		case "auth":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'auth',
			".$cfg['plugin']['rating']['auth']."
			)");
		break;
		
		case "pro":
			
			$sumrating = $cfg['plugin']['rating']['pro']*sed_getuserrating($userid);

			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'pro',
			".$sumrating."
			)");
		break;
		
		case "top":
			
			$sumrating = $cfg['plugin']['rating']['top']*sed_getuserrating($userid);
			
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'top',
			".$sumrating."
			)");
		break;
		
		case "performer":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'performer',
			".$cfg['plugin']['rating']['performer'].",
			".$itemid."
			)");
		break;
		
		case "refuse":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'refuse',
			".$cfg['plugin']['rating']['refuse'].",
			".$itemid."
			)");
		break;
		
		case "reviewplus":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'reviewplus',
			".$cfg['plugin']['rating']['reviewplus'].",
			".$itemid."
			)");
		break;
		
		case "reviewminus":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'reviewminus',
			".$cfg['plugin']['rating']['reviewminus'].",
			".$itemid."
			)");
		break;
		
		case "portfolioaddtocat":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'portfolioaddtocat',
			".$cfg['plugin']['rating']['portfolioaddtocat'].",
			".$itemid."
			)");
		break;
		
		case "portfoliodeltocat":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'portfoliodeltocat',
			".$sed_ratingpoints['portfoliodeltocat'].",
			".$itemid."
			)");
		break;
		
		case "portfolioaddtoscat":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'portfolioaddtoscat',
			".$cfg['plugin']['rating']['portfolioaddtoscat'].",
			".$itemid."
			)");
		break;
		
		case "portfoliodeltoscat":
			$sql = sed_sql_query("INSERT INTO sed_rating (
			item_userid,
			item_date,
			item_type,
			item_point,
			item_itemid
			) VALUES(
			".$userid.",
			".$sys['now_offset'].",
			'portfoliodeltoscat',
			".$sed_ratingpoints['portfoliodeltoscat'].",
			".$itemid."
			)");
		break;
		
	}
	
	sed_setuserrating($userid);
}


?>
