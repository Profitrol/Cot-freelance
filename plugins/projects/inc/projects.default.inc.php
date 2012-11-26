<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'projects', 'RWA');
sed_block($usr['auth_read']);

$d = sed_import('d','G','INT');
$type = sed_import('type','G','INT');
$c = sed_import('c','G','INT');
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;

if (empty($d))
{ $d = '0'; }

$sq = sed_import('sq','G','TXT');
$sq = htmlspecialchars($sq);
$sq = preg_replace('/ +/', ' ', $sq);
$sq = sed_sql_prep($sq);

$country = sed_import('country','G','INT');
$region = sed_import('region','G','INT');
$city = sed_import('city','G','INT');

$t = new XTemplate(sed_skinfile('projects.default', true));

if(!empty($c))
{
	$catsub = sed_pcatsub($c);
	$query_string = " AND item_cat IN ('".implode("','", $catsub)."')";
}

if(!empty($type))
{
	$query_string .= " AND item_type=".$type."";
}

// ==============================================

if(!empty($sq))
{
	$words = explode(' ', $sq);
	$words_count = count($words);
	
	$sqlsearch = implode("%", $words);
	$sqlsearch = "%".$sqlsearch."%";
		
	$query_string .= " AND (p.item_title LIKE '".sed_sql_prep($sqlsearch)."' OR p.item_text LIKE '".sed_sql_prep($sqlsearch)."')";
		
}

if(!empty($country))
{
	$query_string .= " AND item_country=".$country."";
}

if(!empty($region))
{
	$query_string .= " AND item_region=".$region."";
}

if(!empty($city))
{
	$query_string .= " AND item_city=".$city."";
}

list($select_country, $select_region, $select_city) = sed_select_location('', $country, $region, $city);

$t->assign(array(
	"SEARCH_ACTION_URL" => sed_url('plug', "e=projects&c=".$c."&type=".$type, '', true),
	"SEARCH_SQ" => '<input type="text" name="sq" value="'.sed_sql_prep($sq).'" class="schstring">',
	"SEARCH_COUNTRY" => $select_country,
	"SEARCH_REGION" => $select_region,
	"SEARCH_CITY" => $select_city,
));

$t->parse("MAIN.SEARCH");
// ==============================================


$sql = sed_sql_query("SELECT COUNT(*) FROM sed_projects AS p
WHERE item_state=0 ".$query_string."");
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_projects AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_state=0 ".$query_string."
ORDER by item_toptodate DESC, item_date DESC
LIMIT $d, ".$cfg['plugin']['projects']['pagelimit']);



$pages = sed_pagination(sed_url('plug', "e=projects"), $d, $totalitems, $cfg['plugin']['projects']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('plug', "e=projects"), $d, $totalitems, $cfg['plugin']['projects']['pagelimit'], TRUE);

foreach($sed_ptype as $i => $types)
{
	$t->assign(array(
		"PTYPE_ROW_ID" => $i,
		"PTYPE_ROW_TITLE" => $types['title'],
		"PTYPE_ROW_URL" => sed_url('plug', 'e=projects&c='.$c.'&type='.$i),
		"PTYPE_ROW_ACT" => ($type == $i) ? 'act' : ''
	));
	$t->parse("MAIN.PTYPES.PTYPES_ROWS");
}

$t->assign(array(
	"PTYPE_ALL_URL" => sed_url('plug', 'e=projects&c='.$c),
	"PTYPE_ALL_ACT" => (empty($type)) ? 'act' : ''
));

$t->parse("MAIN.PTYPES");

// Вывод количества оставшихся ответов на проеткы
if($usr['id'] > 0 && $usr['profile']['user_maingrp'] == 4 && $cfg['offerslimit'] > 0){
	$countoffersofuser = sed_getcountoffersofuser($usr['id']);
	
	if((!sed_ispro($usr['profile']['user_protodate']))){
		$t->assign(array(
			"COUNTUSEROFFERSLEFT" => sprintf($skinlang['projects']['countoffersofuser'], $cfg['offerslimit'] - $countoffersofuser)
		));
		$t->parse("MAIN.OFFERSLEFT");
	}
}

// Вывод количества оставшихся проеткы
if($usr['id'] > 0 && $usr['profile']['user_maingrp'] == 8 && $cfg['prjlimitforemployers'] > 0){
	$countprjofuser = sed_getcountprjofuser($usr['id']);
	
	if((!sed_ispro($usr['profile']['user_protodate']))){
		$t->assign(array(
			"COUNTUSERPRJLEFT" => sprintf($skinlang['projects']['countprjofuser'], $cfg['prjlimitforemployers'] - $countprjofuser)
		));
		$t->parse("MAIN.PRJLEFT");
	}
}

$t-> assign(array(
	"PAGENAV_PAGES" => $pages,
	"CATALOG" => sed_showpcat($c),
	"CATTITLE" => (!empty($c)) ? $sed_pcat[$c]['title'] : '',
	"CATTEXT" => $sed_pcat[$c]['text'],
	));	

	
/* === Hook === */
$extp = sed_getextplugins('projects.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	
	$t->assign(array(
		"PRJ_ROW_ODDEVEN" => sed_build_oddeven($jj),
		"PRJ_ROW_OWNER" =>  ($usr['id'] > 0) ? sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']) : '',	
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
		"PRJ_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
		"PRJ_ROW_TYPE" => $sed_ptype[$item['item_type']]['title'],
		"PRJ_ROW_COUNTRY" => sed_getcountrybyid($item['item_country']),
		"PRJ_ROW_REGION" => sed_getregionbyid($item['item_region']),
		"PRJ_ROW_CITY" => sed_getcitybyid($item['item_city']),
		"PRJ_ROW_ISTOP" => ($item['item_toptodate'] > $sys['now_offset']) ? 'top' : '',
		"PRJ_ROW_ISPRO" => sed_ispro($item['user_protodate']),
		"PRJ_ROW_PRO" => (sed_ispro($item['user_protodate'])) ? '<img src="images/pro.png" align="absmiddle">' : '',
		));	
	
	// Проверка срока действия платного проекта
	if($item['item_toptodate'] < $sys['now_offset']){
		$sqltopprj = sed_sql_query("UPDATE sed_projects SET item_toptodate=0 WHERE item_id=".$item['item_id'].""); 
	}	
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.PRJ_ROWS");
	}

/* === Hook === */
$extp = sed_getextplugins('projects.default.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	

?>