<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=projects
Part=homepage
File=projects.index
Hooks=index.tags
Tags=index.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$d = sed_import('d','G','INT');
if (empty($d))
{ $d = '0'; }

foreach($sed_ptype as $i => $types)
{
	$t->assign(array(
		"PTYPE_ROW_ID" => $i,
		"PTYPE_ROW_TITLE" => $types['title'],
		"PTYPE_ROW_URL" => sed_url('plug', 'e=projects&type='.$i),
	));
	$t->parse("MAIN.PROJECTS.PTYPES.PTYPES_ROWS");
}

$t->assign(array(
	"PTYPE_ALL_URL" => sed_url('plug', 'e=projects'),
));

$t->parse("MAIN.PROJECTS.PTYPES");

// Вывод количества оставшихся ответов на проеткы
if($usr['id'] > 0 && $usr['profile']['user_maingrp'] == 4 && $cfg['offerslimit'] > 0){
	$countoffersofuser = sed_getcountoffersofuser($usr['id']);
	
	if((!sed_ispro($usr['profile']['user_protodate']))){
		$t->assign(array(
			"COUNTUSEROFFERSLEFT" => sprintf($skinlang['projects']['countoffersofuser'], $cfg['offerslimit'] - $countoffersofuser)
		));
		$t->parse("MAIN.PROJECTS.OFFERSLEFT");
	}
}

// Вывод количества оставшихся проеткы
if($usr['id'] > 0 && $usr['profile']['user_maingrp'] == 8 && $cfg['prjlimitforemployers'] > 0){
	$countprjofuser = sed_getcountprjofuser($usr['id']);
	
	if((!sed_ispro($usr['profile']['user_protodate']))){
		$t->assign(array(
			"COUNTUSERPRJLEFT" => sprintf($skinlang['projects']['countprjofuser'], $cfg['prjlimitforemployers'] - $countprjofuser)
		));
		$t->parse("MAIN.PROJECTS.PRJLEFT");
	}
}

// ==============================================

list($select_country, $select_region, $select_city) = sed_select_location('', $country, $region, $city);

$t->assign(array(
	"SEARCH_ACTION_URL" => sed_url('plug', "e=projects", '', true),
	"SEARCH_SQ" => '<input type="text" name="sq" value="'.sed_sql_prep($sq).'" class="schstring">',
	"SEARCH_COUNTRY" => $select_country,
	"SEARCH_REGION" => $select_region,
	"SEARCH_CITY" => $select_city,
));

$t->parse("MAIN.PROJECTS.SEARCH");
// ==============================================

$sql = sed_sql_query("SELECT COUNT(*) FROM sed_projects 
WHERE item_state=0 ".$sqlsearch."");
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_projects AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_state=0 ".$sqlsearch."
ORDER by item_toptodate DESC, item_date DESC
LIMIT $d, ".$cfg['plugin']['projects']['indexlimit']);

$pages = sed_pagination(sed_url('index', ""), $d, $totalitems, $cfg['plugin']['projects']['indexlimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('index', ""), $d, $totalitems, $cfg['plugin']['projects']['indexlimit'], TRUE);

$t-> assign(array(
	"PAGENAV_PAGES" => $pages,
	));	

/* === Hook === */
$extp = sed_getextplugins('projects.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	$t->assign(array(
		"PRJ_ROW_ODDEVEN" => sed_build_oddeven($jj),
		"PRJ_ROW_URL" => sed_url('plug', 'e=projects&m=show&itemid='.$item['item_id']),
		"PRJ_ROW_CAT" => $item['item_cat'],
		"PRJ_ROW_CATTITLE" => $sed_pcat[$item['item_cat']]['title'],
		"PRJ_ROW_CATURL" => sed_url('plug', 'e=projects&c='.$item['item_cat']),
		"PRJ_ROW_TITLE" => $item['item_title'],
		"PRJ_ROW_TEXT" => $item['item_text'],
		"PRJ_ROW_SHORTTEXT" => sed_cutstring($item['item_text'], 200),
		"PRJ_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRJ_ROW_COUNT" => $item['item_count'],
		"PRJ_ROW_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
		"PRJ_ROW_OWNER" =>  ($usr['id'] > 0) ? sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']) : '',	
		"PRJ_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
		"PRJ_ROW_TYPE" => $sed_ptype[$item['item_type']]['title'],
		"PRJ_ROW_COUNTRY" => sed_getcountrybyid($item['item_country']),
		"PRJ_ROW_REGION" => sed_getregionbyid($item['item_region']),
		"PRJ_ROW_CITY" => sed_getcitybyid($item['item_city']),
		"PRJ_ROW_ISTOP" => ($item['item_toptodate'] > $sys['now_offset']) ? 'top' : ''
		));	
	
	// Проверка срока действия платного проекта
	if($item['item_toptodate'] < $sys['now_offset']){
		$sqltopprj = sed_sql_query("UPDATE sed_projects SET item_toptodate=0 WHERE item_id=".$item['item_id'].""); 
	}
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.PROJECTS.PRJ_ROWS");
	}
$t->parse("MAIN.PROJECTS");	

$t->assign(array(
	"PROJECTS_CATALOG" => sed_showpcat()
));

?>