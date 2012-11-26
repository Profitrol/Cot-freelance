<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'market', 'RWA');
sed_block($usr['auth_read']);

$d = sed_import('d','G','INT');
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

$t = new XTemplate(sed_skinfile('market.default', true));

if(!empty($c))
{
	$catsub = sed_mcatsub($c);
	$query_string = " AND item_cat IN ('".implode("','", $catsub)."')";
}

// ==============================================

if(!empty($sq))
{
	$words = explode(' ', $sq);
	$words_count = count($words);
	
	$sqlsearch = implode("%", $words);
	$sqlsearch = "%".$sqlsearch."%";
		
	$query_string .= " AND (item_title LIKE '".sed_sql_prep($sqlsearch)."' OR item_text LIKE '".sed_sql_prep($sqlsearch)."')";
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
	"SEARCH_ACTION_URL" => sed_url('plug', "e=market&c=".$c, '', true),
	"SEARCH_SQ" => '<input type="text" name="sq" value="'.sed_sql_prep($sq).'" class="schstring">',
	"SEARCH_COUNTRY" => $select_country,
	"SEARCH_REGION" => $select_region,
	"SEARCH_CITY" => $select_city,
));

$t->parse("MAIN.SEARCH");
// ==============================================

$sql = sed_sql_query("SELECT COUNT(*) FROM sed_market as p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_state=0 
".$query_string."");
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_market AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_state=0 
".$query_string."
ORDER by item_date DESC
LIMIT $d, ".$cfg['plugin']['market']['pagelimit']);

$pages = sed_pagination(sed_url('plug', "e=market"), $d, $totalitems, $cfg['plugin']['market']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('plug', "e=market"), $d, $totalitems, $cfg['plugin']['market']['pagelimit'], TRUE);


$t-> assign(array(
	"PAGENAV_PAGES" => $pages,
	"CATALOG" => sed_showmcat($c),
	"CATTITLE" => (!empty($c)) ? ' / '.$sed_mcat[$c]['title'] : ''
	));	
	
/* === Hook === */
$extp = sed_getextplugins('market.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	
	$t->assign(array(
		"PRD_ROW_ODDEVEN" => sed_build_oddeven($jj),
		"PRD_ROW_OWNER" => sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']),
		"PRD_ROW_TITLE" => $item['item_title'],
		"PRD_ROW_TEXT" => $item['item_text'],
		"PRD_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRD_ROW_IMG" => $item['item_img'],
		"PRD_ROW_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('market', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
		"PRD_ROW_URL" =>  sed_url('plug', 'e=market&m=show&itemid='.$item['item_id']),
		"PRD_ROW_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"PRD_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
		"PRD_ROW_COUNTRY" => sed_getcountrybyid($item['item_country']),
		"PRD_ROW_REGION" => sed_getregionbyid($item['item_region']),
		"PRD_ROW_CITY" => sed_getcitybyid($item['item_city']),
		));		
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.PRD_ROWS");
	}

/* === Hook === */
$extp = sed_getextplugins('market.default.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	

?>