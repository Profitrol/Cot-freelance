<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'portfolio', 'RWA');
sed_block($usr['auth_read']);

$d = sed_import('d','G','INT');
$c = sed_import('c','G','INT');
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;

if (empty($d))
{ $d = '0'; }

$t = new XTemplate(sed_skinfile('portfolio.default', true));

$sql = sed_sql_query("SELECT COUNT(*) FROM sed_portfolio 
WHERE item_state=0 ".$query_string." ".$sqlsearch."");
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_portfolio AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_state=0 ".$query_string." ".$sqlsearch."
ORDER by item_date DESC
LIMIT $d, ".$cfg['plugin']['portfolio']['pagelimit']);

$pages = sed_pagination(sed_url('plug', "e=portfolio"), $d, $totalitems, $cfg['plugin']['portfolio']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('plug', "e=portfolio"), $d, $totalitems, $cfg['plugin']['portfolio']['pagelimit'], TRUE);


$t-> assign(array(
	"PAGENAV_PAGES" => $pages,
	));	

	
/* === Hook === */
$extp = sed_getextplugins('portfolio.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	$t->assign(array(
		"PTF_ROW_ODDEVEN" => sed_build_oddeven($jj),
		"PTF_ROW_URL" => sed_url('plug', 'e=portfolio&m=show&itemid='.$item['item_id']),
		"PTF_ROW_TITLE" => $item['item_title'],
		"PTF_ROW_TEXT" => $item['item_text'],
		"PTF_ROW_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
		"PTF_ROW_OWNER" => sed_build_user($item['item_userid'], htmlspecialchars($item['user_name'])),
		"PTF_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
		));		
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.PTF_ROWS");
	}

/* === Hook === */
$extp = sed_getextplugins('portfolio.default.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	

?>