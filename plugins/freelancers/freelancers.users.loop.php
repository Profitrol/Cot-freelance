<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=users
File=freelancers.users.loop
Hooks=users.loop
Tags=users.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$sql_portfolio_count = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_userid=".$urr['user_id']."");
$portfolio_count = sed_sql_numrows($sql_portfolio_count);

$sql_reviews_negative_summ = sed_sql_query("SELECT SUM(item_score) as summ FROM sed_reviews WHERE item_score<0 AND item_touserid=".$urr['user_id']."");
$reviews_negative_summ = sed_sql_result($sql_reviews_negative_summ, 0, 0);

$sql_reviews_pozitive_summ = sed_sql_query("SELECT SUM(item_score) as summ FROM sed_reviews WHERE item_score>0 AND item_touserid=".$urr['user_id']."");
$reviews_pozitive_summ = sed_sql_result($sql_reviews_pozitive_summ, 0, 0);

$t->assign(array(
	"USERS_ROW_CATTITLE" => $sed_fcat[$urr['user_cat']]['title'],
	"USERS_ROW_ISPRO" => sed_ispro($urr['user_protodate']),
	"USERS_ROW_PRO" => (sed_ispro($urr['user_protodate'])) ? '<img src="images/pro.png" align="absmiddle">' : '',
	"USERS_ROW_PORTFOLIO_COUNT" => $portfolio_count,
	"USERS_ROW_PORTFOLIO_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=portfolio'),
	"USERS_ROW_REVIEWS_NEGATIVE_SUMM" => ($reviews_negative_summ < 0) ? $reviews_negative_summ : '-0',
	"USERS_ROW_REVIEWS_POZITIVE_SUMM" => ($reviews_pozitive_summ > 0) ? $reviews_pozitive_summ : '0',
	"USERS_ROW_COUNTRY" => sed_getcountrybyid($urr['user_country']),
	"USERS_ROW_REGION" => sed_getregionbyid($urr['user_region']),
	"USERS_ROW_CITY" => sed_getcitybyid($urr['user_location']),
	"USERS_ROW_LOCATION_URL" => sed_url('users', 'gm='.$urr['user_maingrp'].'&country='.$urr['user_country'].'&region='.$urr['user_region'].'&city='.$urr['user_location']),
	"USERS_ROW_ONLINE" => sed_userisonline($urr['user_id']) ? '<img src="skins/'.$skin.'/img/online1.gif" align="absmiddle" />' : '<img src="skins/'.$skin.'/img/online0.gif" align="absmiddle" />',
	"USERS_ROW_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name']),
	"USERS_ROW_AVATAR" => sed_build_avatar($urr['user_avatar'], 'thumbs'),
	"USERS_ROW_NAME" => sed_build_uname($urr['user_id'], $urr['user_name'], $urr['user_fname']." ".$urr['user_sname']),
	));	

if($usr['isadmin']){
	if($urr['user_isprosetadmin'] == 0 && $urr['user_ispro'] == 1){
		$t->assign(array(
			"USERS_ROW_SETPRO" => ''
		));
	}
	else{
		$t->assign(array(
			"USERS_ROW_SETPRO" => ($urr['user_isprosetadmin']) ? '<div class="setpro"><a href="'.sed_url('users', 'f='.$f.'&s='.$s.'&w='.$w.'&gm='.$gm.'&setpro=0&userid='.$urr['user_id'].'&'.sed_xg()).'">Отключить PRO</a></div>' : '<div class="setpro"><a href="'.sed_url('users', 'f='.$f.'&s='.$s.'&w='.$w.'&gm='.$gm.'&setpro=1&userid='.$urr['user_id'].'&'.sed_xg()).'">Включить PRO</a></div>'
		));
	}
}

if(!sed_ispro($urr['user_protodate']) && $urr['user_protodate'] > 0)
{
	$sqlresetprodate = sed_sql_query("UPDATE sed_users SET user_protodate=0 WHERE user_id=".$urr['user_id']."");
}



?>