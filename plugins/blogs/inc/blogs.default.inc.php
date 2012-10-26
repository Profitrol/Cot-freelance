<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'blogs', 'RWA');
sed_block($usr['auth_read']);
	
$d = sed_import('d','G','INT');
$c = sed_import('c','G','INT');

if (empty($d)) { $d = '0'; }

if(!empty($c))
{
	$catsub = sed_bcatsub($c);
	$query_string = " AND item_cat IN ('".implode("','", $catsub)."')";
}


$sql = sed_sql_query("SELECT COUNT(*) FROM sed_blogs WHERE item_state='0'");
$itemcountall = sed_sql_result($sql, 0, 0);

$sql = sed_sql_query("SELECT COUNT(*) FROM sed_blogs WHERE item_state='0' ".$query_string."");
$totallines = sed_sql_result($sql, 0, 0);
$sql = sed_sql_query("SELECT b.*, u.* 
	FROM sed_blogs as b
	LEFT JOIN sed_users AS u ON u.user_id=b.item_userid
	WHERE item_state='0'
	".$query_string."
	ORDER BY item_date DESC LIMIT $d,".$cfg['maxrowsperpage']);


$totalpages = ceil($totallines / $cfg['maxrowsperpage']);
$currentpage= ceil ($d / $cfg['maxrowsperpage'])+1;

$pagination = sed_pagination(sed_url('plug', 'e=blogs&c='.$c, '', true), $d, $totallines, $cfg['maxrowsperpage']);
list($pageprev, $pagenext) = sed_pagination_pn(sed_url('plug', 'e=blogs&c='.$c, '', true), $d, $totallines, $cfg['maxrowsperpage'], TRUE);

$t = new XTemplate(sed_skinfile('blogs.default', true));
	
$t->assign(array(
	"LIST_TOP_PAGINATION" => $pagination,
	"LIST_TOP_PAGEPREV" => $pageprev,
	"LIST_TOP_PAGENEXT" => $pagenext,
	"CATALOG" => sed_showbcat($c),
	"CATTITLE" => (!empty($c)) ? ' / '.$sed_bcat[$c]['title'] : ''
	));	
	
$jj=1;	

while ($item = sed_sql_fetcharray($sql) and ($jj<=$cfg['maxrowsperpage']))
{
	$jj++;
	
	$item_code = 'b'.$item['item_id'];
	
	list($comments_link, $comments_display, $comments_count) = sed_build_comments($item_code, sed_url('plug', 'e=blogs&m=show&id='.$item['item_id'], '', true), 1);

	$t->assign(array(
		"LIST_ROW_OWNER" => sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']),
		"LIST_ROW_SHOW_URL" => sed_url('plug', 'e=blogs&m=show&id='.$item['item_id'], '', true),
		"LIST_ROW_EDIT_URL" => ($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0) ? '<a href="'.sed_url('plug', 'e=blogs&m=edit&itemid='.$item['item_id'], '', true).'">Редактировать</a>' : '',
		"LIST_ROW_ODDEVEN" => sed_build_oddeven($jj),
    	"LIST_ROW_NUM" => $jj,
		"LIST_ROW_ID" => $item['item_id'],
		"LIST_ROW_TITLE" => $item['item_title'],
		"LIST_ROW_TEXT" => sed_parse($item['item_text']),
		"LIST_ROW_SHORTTEXT" => sed_parse(sed_cutstring($item['item_text'], 200)),
		"LIST_ROW_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"LIST_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
		"LIST_ROW_COMMENTS" => "<a href=\"".sed_url('plug', 'e=blogs&m=show&id='.$item['item_id'], '#comments')."\"><img src=\"skins/".$usr['skin']."/img/system/icon-comment.gif\" alt=\"\" /> (".$comments_count.")</a>",
		));

	$t->parse("MAIN.LIST_ROW");
}
	
/* === Hook === */
$extp = sed_getextplugins('blogs.default.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	


?>