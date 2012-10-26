<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=market
Part=admin
File=market.admin
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

$plugin_title = "Магазин";


$d = sed_import('d','G','INT');
$c = sed_import('c','G','INT');
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;

if (empty($d))
{ $d = '0'; }

$sq = sed_import('sq','G','TXT');
$country = sed_import('country','G','INT');
$region = sed_import('region','G','INT');
$city = sed_import('city','G','INT');

$t = new XTemplate(sed_skinfile('market.admin', true));

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
	
	$sqlsearch = str_replace(" ", "%' OR item_title LIKE '%", sed_sql_prep($sq));
	
	$query_string .= " AND (item_title LIKE '%".$sqlsearch."%' OR item_text LIKE '%".$sqlsearch."%')";
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
	"SEARCH_ACTION_URL" => sed_url('admin', "m=tools&p=market&c=".$c),
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

$pages = sed_pagination(sed_url('admin', "m=tools&p=market"), $d, $totalitems, $cfg['plugin']['market']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('admin', "m=tools&p=market"), $d, $totalitems, $cfg['plugin']['market']['pagelimit'], TRUE);


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
		"PRD_ROW_TITLE" => $item['item_title'],
		"PRD_ROW_TEXT" => $item['item_text'],
		"PRD_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRD_ROW_IMG" => $item['item_img'],
		"PRD_ROW_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('market', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
		"PRD_ROW_URL" =>  sed_url('plug', 'e=market&m=show&itemid='.$item['item_id']),
		"PRD_ROW_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
		"PRD_ROW_OWNER" => sed_build_user($item['item_userid'], htmlspecialchars($item['user_name'])),
		"PRD_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
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
		
$t -> parse("MAIN");
$plugin_body .= $t -> text("MAIN");

?>