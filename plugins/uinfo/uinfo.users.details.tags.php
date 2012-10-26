<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uinfo
Part=main
File=uinfo.users.details.tags
Hooks=users.details.tags
Tags=users.details.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$tab = sed_import('tab', 'G', 'ALP');
$sub = sed_import('sub', 'G', 'ALP');

$sql_portfolio_count = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_userid=".$urr['user_id']."");
$portfolio_count = sed_sql_numrows($sql_portfolio_count);

$sql_market_count = sed_sql_query("SELECT * FROM sed_market WHERE item_userid=".$urr['user_id']."");
$market_count = sed_sql_numrows($sql_market_count);

$sql_reviews_negative_summ = sed_sql_query("SELECT SUM(item_score) as summ FROM sed_reviews WHERE item_score<0 AND item_touserid=".$urr['user_id']."");
$reviews_negative_summ = sed_sql_result($sql_reviews_negative_summ, 0, 0);

$sql_reviews_pozitive_summ = sed_sql_query("SELECT SUM(item_score) as summ FROM sed_reviews WHERE item_score>0 AND item_touserid=".$urr['user_id']."");
$reviews_pozitive_summ = sed_sql_result($sql_reviews_pozitive_summ, 0, 0);

$t->assign(array(
	"USERS_DETAILS_PRO" => (sed_ispro($urr['user_protodate'])) ? '<img src="images/pro.png" align="absmiddle">' : '',
	"USERS_DETAILS_PORTFOLIO_COUNT" => $portfolio_count,
	"USERS_DETAILS_MARKET_COUNT" => $market_count,
	"USERS_DETAILS_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name']),
	"USERS_DETAILS_PORTFOLIO_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=portfolio'),
	"USERS_DETAILS_PROJECTS_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=projects'),
	"USERS_DETAILS_REVIEWS_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=reviews'),
	"USERS_DETAILS_MARKET_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=market'),
	"USERS_DETAILS_SKILLS_ADDURL" => ($usr['id'] == $urr['user_id']) ? '<a href="'.sed_url('plug', 'e=skills&m=add').'">Добавить навык</a>' : '',
	"USERS_DETAILS_REVIEWS_ADDURL" => sed_url('plug', 'e=reviews&m=add&id='.$urr['user_id']),
	"USERS_DETAILS_REVIEWS_SUMM" => $reviews_summ,
	"USERS_DETAILS_REVIEWS_NEGATIVE_SUMM" => ($reviews_negative_summ < 0) ? $reviews_negative_summ : '-0',
	"USERS_DETAILS_REVIEWS_POZITIVE_SUMM" => ($reviews_pozitive_summ > 0) ? $reviews_pozitive_summ : '0',
	"USERS_DETAILS_REVIEWS_SUMM" => $reviews_summ,
	"USERS_DETAILS_CAT" => $sed_fcat[$urr['user_cat']]['title'],
	"USERS_DETAILS_COUNTRY" => sed_getcountrybyid($urr['user_country']),
	"USERS_DETAILS_REGION" => sed_getregionbyid($urr['user_region']),
	"USERS_DETAILS_LOCATION_URL" => sed_url('users', 'gm='.$urr['user_maingrp'].'&country='.$urr['user_country'].'&region='.$urr['user_region'].'&city='.$urr['user_city']),
	"USERS_DETAILS_CITY" => sed_getcitybyid($urr['user_location']),
	"USERS_DETAILS_PROFILE_INFO_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=profile&sub=info'),
	"USERS_DETAILS_PROFILE_SPECIALITY_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=profile&sub=speciality'),
	"USERS_DETAILS_ONLINE" => sed_userisonline($urr['user_id']) ? '<img src="skins/'.$skin.'/img/online1.gif" align="absmiddle" />' : '<img src="skins/'.$skin.'/img/online0.gif" align="absmiddle" />',
	"USERS_DETAILS_BAVATAR" => sed_build_avatar($urr['user_avatar'], 'bthumbs'),
	"USERS_DETAILS_AVATAR" => sed_build_avatar($urr['user_avatar'], 'thumbs'),
	"USERS_DETAILS_REGDATE" => date('d.m.Y', $urr['user_regdate']),
	"USERS_DETAILS_NAME" => sed_build_uname('', $urr['user_name'], $urr['user_fname'].' '.$urr['user_sname']),
	));	


	$sql = sed_sql_query("SELECT * FROM sed_freelancers_scat WHERE item_userid=".$urr['user_id']."");
	while($scats = sed_sql_fetcharray($sql)){
		$t->assign(array(
			"SCAT_TITLE" => $sed_fcat[$scats['item_scat']]['title']
		));
		$t->parse("MAIN.SCATS");
	}
	

if(empty($tab))
{
	$t->assign(array(
		"USERS_DETAILS_ABOUT" => sed_parse($urr['user_about'])
	));
	
	// Проекты работодателя
//	if($urr['user_maingrp'] == 8)
//	{	
	if($usr['id'] == 0 || $usr['id'] != $urr['user_id'] && !$usr['isadmin']){
		$sql = sed_sql_query("SELECT * FROM sed_projects AS p
		LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
		WHERE item_state=0 AND item_userid=".$urr['user_id']."
		ORDER by item_date DESC");
	}
	else{
		$sql = sed_sql_query("SELECT * FROM sed_projects AS p
		LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
		WHERE item_userid=".$urr['user_id']."
		ORDER by item_date DESC");
	}
		
		$userprjcount = sed_sql_numrows($sql);
		
		while($item = sed_sql_fetcharray($sql)){
			$jj++;
			
			if ($usr['isadmin'] || $usr['id'] == $item['item_userid'] && $usr['id'] != 0)
			{
				$t->assign(array(
					"PRJ_ROW_HIDEPROJECT_URL" => ($item['item_state'] == 1) ? sed_url('plug', 'e=projects&m=edit&itemid='.$item['item_id'].'&a=public') : sed_url('plug', 'e=projects&m=edit&itemid='.$item['item_id'].'&a=hide'),
					"PRJ_ROW_HIDEPROJECT_TITLE" => ($item['item_state'] == 1) ? 'Публиковать еще раз' : 'Снять с публикации',
					"PRJ_ROW_ADMIN_EDIT" => "<a href=\"".sed_url('plug', 'e=projects&m=edit&itemid='.$item['item_id'])."\">Редактировать</a>"
				));
				$t->parse("MAIN.INFO.PROJECTS.PRJ_ROWS.OWNERMENU");
			}
			
			$t->assign(array(
				"PRJ_ROW_ODDEVEN" => sed_build_oddeven($jj),
				"PRJ_ROW_URL" => sed_url('plug', 'e=projects&m=show&itemid='.$item['item_id']),
				"PRJ_ROW_CAT" => $item['item_cat'],
				"PRJ_ROW_TITLE" => $item['item_title'],
				"PRJ_ROW_TEXT" => $item['item_text'],
				"PRJ_ROW_SHORTTEXT" => sed_cutstring($item['item_text'], 200),
				"PRJ_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
				"PRJ_ROW_COUNT" => $item['item_count'],
				"PRJ_ROW_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
				"PRJ_ROW_OWNER" => sed_build_user($item['item_userid'], htmlspecialchars($item['user_name'])),
				"PRJ_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
				"PRJ_ROW_TYPE" => $sed_ptype[$item['item_type']]['title'],
				"PRJ_ROW_COUNTRY" => sed_getcountrybyid($item['item_country']),
				"PRJ_ROW_REGION" => sed_getregionbyid($item['item_region']),
				"PRJ_ROW_CITY" => sed_getcitybyid($item['item_city']),
				));		
				
			$t->parse("MAIN.INFO.PROJECTS.PRJ_ROWS");
			}	
			
		if($userprjcount > 0) $t->parse("MAIN.INFO.PROJECTS");	
//	}
	
	// ===========================================
	
//	if($urr['user_maingrp'] == 4)
//	{
		$t->assign(array(
			"PTF_ADDWORK_URL" => sed_url('plug', 'e=portfolio&m=add'),
			"PTF_ALLWORK_URL" => sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=portfolio'),
		));
		
		$sql = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_userid=".$urr['user_id']." ORDER by item_sort DESC LIMIT 4");
		$userptfcount = sed_sql_numrows($sql);
		if($userptfcount > 0){
			while($item = sed_sql_fetcharray($sql))
			{
				//unlink(sed_thumb_url('portfolio', $item['item_img']));
				if(file_exists($item['item_img'])){
					if(file_exists(sed_thumb_url('portfolio', $item['item_img']))){
						$imagesize = getimagesize(sed_thumb_url('portfolio', $item['item_img']));
						if($imagesize[0] > 200 || $imagesize[1] > 200){
							unlink(sed_thumb_url('portfolio', $item['item_img']));
							ResizeImage($item['item_img'], 'datas/portfolio/', 'datas/portfolio/thumbs/', 200, 200, 1);
						}
					}
					else{
						ResizeImage($item['item_img'], 'datas/portfolio/', 'datas/portfolio/thumbs/', 200, 200, 1);
					}
				}
				
				$t->assign(array(
					"PTF_ROW_TITLE" => $item['item_title'],
					"PTF_ROW_TEXT" => sed_parse($item['item_text']),
					"PTF_ROW_IMG" => $item['item_img'],
					"PTF_ROW_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('portfolio', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
					"PTF_ROW_URL" =>  sed_url('plug', 'e=portfolio&m=show&itemid='.$item['item_id']),
				));
				$t->parse("MAIN.INFO.PORTFOLIO.PTF_ROWS");
			}
			$t->parse("MAIN.INFO.PORTFOLIO");
		}
	
//	}	
	// ===========================================
	
	$t->parse("MAIN.INFO");
}
elseif($tab == 'projects')
{
	
	$t->assign(array(
		"PRJ_ADDPRJ_URL" => sed_url('plug', 'e=projects&m=add'),
	));
			
	if($usr['id'] == 0 || $usr['id'] != $urr['user_id'] && !$usr['isadmin']){
		$sql = sed_sql_query("SELECT * FROM sed_projects AS p
		LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
		WHERE item_state=0 AND item_userid=".$urr['user_id']."
		ORDER by item_date DESC");
	}
	else{
		$sql = sed_sql_query("SELECT * FROM sed_projects AS p
		LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
		WHERE item_userid=".$urr['user_id']."
		ORDER by item_date DESC");
	}
		
	while($item = sed_sql_fetcharray($sql)){
		$jj++;
		$t->assign(array(
			"PRJ_ROW_ODDEVEN" => sed_build_oddeven($jj),
			"PRJ_ROW_URL" => sed_url('plug', 'e=projects&m=show&itemid='.$item['item_id']),
			"PRJ_ROW_CAT" => $item['item_cat'],
			"PRJ_ROW_TITLE" => $item['item_title'],
			"PRJ_ROW_TEXT" => $item['item_text'],
			"PRJ_ROW_SHORTTEXT" => sed_cutstring($item['item_text'], 200),
			"PRJ_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
			"PRJ_ROW_COUNT" => $item['item_count'],
			"PRJ_ROW_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
			"PRJ_ROW_OWNER" => sed_build_user($item['item_userid'], htmlspecialchars($item['user_name'])),
			"PRJ_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
			"PRJ_ROW_TYPE" => $sed_ptype[$item['item_type']]['title'],
			"PRJ_ROW_COUNTRY" => sed_getcountrybyid($item['item_country']),
			"PRJ_ROW_REGION" => sed_getregionbyid($item['item_region']),
			"PRJ_ROW_CITY" => sed_getcitybyid($item['item_city']),
			));		
			
		$t->parse("MAIN.PROJECTS.PRJ_ROWS");
		}
	$t->parse("MAIN.PROJECTS");		
}
elseif($tab == 'portfolio')
{
	
	$t->assign(array(
		"PTF_ADDWORK_URL" => sed_url('plug', 'e=portfolio&m=add'),
	));
			
	$sql = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_userid=".$urr['user_id']." ORDER by item_sort DESC");
	while($item = sed_sql_fetcharray($sql))
	{	
		//unlink(sed_thumb_url('portfolio', $item['item_img']));
		if(file_exists($item['item_img'])){
			if(file_exists(sed_thumb_url('portfolio', $item['item_img']))){
				$imagesize = getimagesize(sed_thumb_url('portfolio', $item['item_img']));
				if($imagesize[0] > 200 || $imagesize[1] > 200){
					unlink(sed_thumb_url('portfolio', $item['item_img']));
					ResizeImage($item['item_img'], 'datas/portfolio/', 'datas/portfolio/thumbs/', 200, 200, 1);
				}
			}
			else{
				ResizeImage($item['item_img'], 'datas/portfolio/', 'datas/portfolio/thumbs/', 200, 200, 1);
			}
		}
			
		$t->assign(array(
			"PTF_ROW_TITLE" => $item['item_title'],
			"PTF_ROW_TEXT" => sed_parse($item['item_text']),
			"PTF_ROW_IMG" => $item['item_img'],
			"PTF_ROW_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('portfolio', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
			"PTF_ROW_URL" =>  sed_url('plug', 'e=portfolio&m=show&itemid='.$item['item_id']),
		));
		$t->parse("MAIN.PORTFOLIO.PTF_ROWS");
	}
	
	$t->parse("MAIN.PORTFOLIO");
}
elseif($tab == 'market')
{
	
	$t->assign(array(
		"PRD_ADDPRD_URL" => sed_url('plug', 'e=market&m=add'),
	));
			
	$sql = sed_sql_query("SELECT * FROM sed_market WHERE item_userid=".$urr['user_id']." ORDER by item_date DESC");
	while($item = sed_sql_fetcharray($sql))
	{
		$t->assign(array(
			"PRD_ROW_TITLE" => $item['item_title'],
			"PRD_ROW_TEXT" => sed_parse($item['item_text']),
			"PRD_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
			"PRD_ROW_IMG" => $item['item_img'],
			"PRD_ROW_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('market', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
			"PRD_ROW_URL" =>  sed_url('plug', 'e=market&m=show&itemid='.$item['item_id']),
		));
		$t->parse("MAIN.MARKET.PRD_ROWS");
	}
	
	$t->parse("MAIN.MARKET");
}
elseif($tab == 'reviews')
{
	$sql = sed_sql_query("SELECT * FROM sed_reviews as r
	LEFT JOIN sed_users as u ON u.user_id=r.item_userid 
	WHERE item_touserid=".$urr['user_id']." ORDER by item_date ASC");
	while($item = sed_sql_fetcharray($sql))
	{	
		$sql1 = sed_sql_query("SELECT * FROM sed_reviews 
		WHERE item_userid=".$usr['id']." AND item_pid=".$item['item_pid']."");
		if(sed_sql_numrows($sql1) > 0) 
			$review_isset = 1;
		else
			$review_isset = 0;
		
		
		$t->assign(array(
			"REVIEW_ROW_TEXT" => $item['item_text'],
			"REVIEW_ROW_TOUSER" => $item['item_touser'],
			"REVIEW_ROW_OWNERID" => $item['item_userid'],
			"REVIEW_ROW_OWNER" => sed_build_user($item['item_userid'], htmlspecialchars($item['user_name'])),
			"REVIEW_ROW_SCORE" => ($item['item_score'] > 0) ? '+'.$item['item_score'] : $item['item_score'],
			"REVIEW_ROW_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
			"REVIEW_ROW_EDIT_URL" => sed_url('plug', 'e=reviews&m=edit&itemid='.$item['item_id']),
			"REVIEW_ROW_SEND_REVIEW_TO" => sed_url('plug', 'e=reviews&m=add&pid='.$item['item_pid'].'&touser='.$item['item_userid']),
			"REVIEW_ROW_ISSET" => $review_isset
		));
		$t->parse("MAIN.REVIEWS.REVIEWS_ROWS");
	}
	$t->parse("MAIN.REVIEWS");
}
elseif($tab == 'profile')
{
	list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('users', 'a');
	sed_block($usr['auth_write']);
	
	if(!$usr['isadmin']){
		if($urr['user_id'] != $usr['id']){
			header("Location: " . SED_ABSOLUTE_URL . sed_url('users', 'm=details&id='.$usr['id'].'&u='.$usr['name'].'&tab=profile&sub=info'));
			exit;
		}
	}
	
	switch($sub){
	
		case 'info':
		require('inc/uinfo.profile.info.inc.php');
		break;
		
		case 'speciality':
		require('inc/uinfo.profile.speciality.inc.php');
		break;
		
		default:
		//require('inc/freelancers.default.inc.php');
		break;

	}
	
	$profile->parse("PROF");

	$res .= $profile->text("PROF");
	$t->assign('PCONTENT', $res);
	
	$t->parse("MAIN.PROFILE");
}

?>
