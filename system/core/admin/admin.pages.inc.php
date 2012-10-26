<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net
[BEGIN_SED]
File=admin.pages.inc.php
Version=101
Updated=
Type=Core.admin
Author=
Description=
[END_SED]
==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) { die('Wrong URL.'); }

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('page', 'any');
sed_block($usr['isadmin']);

$c = sed_import('c', 'G', 'ALP');

$d = sed_import('d', 'G', 'INT');
$d = empty($d) ? 0 : (int) $d;
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;

if (empty($s))
{
	$s = $sed_cat[$c]['order'];
	$w = $sed_cat[$c]['way'];
}
if (empty($s)) { $s = 'title'; }
if (empty($w)) { $w = 'asc'; }

$t = new XTemplate(sed_skinfile('admin.pages.inc', false, true));

$adminpath[] = array ("admin.php?m=pages", $L['Pages']);
$adminhelp = $L['adm_help_page'];


while (list($i,$x) = each($sed_cat))
{

		$sql4 = sed_sql_query("SELECT SUM(structure_pagecount) FROM $db_structure
		WHERE structure_path LIKE '".$sed_cat[$i]['rpath']."%' ");
		$sub_count = sed_sql_result($sql4,0,"SUM(structure_pagecount)");

		$pointcount = substr_count($x['path'], '.');
		for($j=1; $j<=$pointcount; $j++){ $otstup .= "&nbsp;&nbsp;&nbsp;"; }
		
		$t-> assign(array(
		"LIST_ROWCAT_URL" => sed_url('admin', 'm=pages&c='.$i),
		"LIST_ROWCAT_TITLE" => $x['title'],
		"LIST_ROWCAT_DESC" => $x['desc'],
		"LIST_ROWCAT_ICON" => $x['icon'],
		"LIST_ROWCAT_COUNT" => $sub_count,
		"LIST_ROWCAT_ODDEVEN" => sed_build_oddeven($kk),
        "LIST_ROWCAT_NUM" => $kk,
		"LIST_ROWCAT_OTSTUP" => $otstup,
		"LIST_ROWCAT_ACT" => ($c == $i) ? 'class="act"' : ''
		));

		/* === Hook - Part2 : Include === */
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */

		unset($otstup);
		
		$t->parse("PAGES.LIST_ROWCAT");
		$kk++;

}


//$totalitems = sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM $db_pages WHERE page_cat='$c'"), 0, 0);

//if($cfg['jquery'] AND $cfg['turnajax'])
//{
//	$pagnav = sed_pagination(sed_url('admin','m=pages'), $d, $totalitems, $cfg['maxrowsperpage'], 'd', 'ajaxSend', "url: '".sed_url('admin','m=pages&ajax=1')."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'");
//	list($pagination_prev, $pagination_next) = sed_pagination_pn(sed_url('admin', 'm=pages'), $d, $totalitems, $cfg['maxrowsperpage'], TRUE, 'd', 'ajaxSend', "url: '".sed_url('admin','m=pages&ajax=1')."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'");
//}
//else
//{
//	$pagnav = sed_pagination(sed_url('admin','m=pages'), $d, $totalitems, $cfg['maxrowsperpage']);
//	list($pagination_prev, $pagination_next) = sed_pagination_pn(sed_url('admin', 'm=pages'), $d, $totalitems, $cfg['maxrowsperpage'], TRUE);
//}

if(!empty($c))
{
$catsub = getcatsubofcat($c);

$sql = sed_sql_query("SELECT p.*, u.user_name 
	FROM $db_pages as p 
	LEFT JOIN $db_users AS u ON u.user_id=p.page_ownerid 
	WHERE page_cat IN ('".implode("','", $catsub)."') ORDER by page_cat ASC, page_$s $w");
}
else
{
$sql = sed_sql_query("SELECT p.*, u.user_name 
	FROM $db_pages as p 
	LEFT JOIN $db_users AS u ON u.user_id=p.page_ownerid 
	WHERE 1 ORDER by page_cat ASC, page_$s $w");

}
	
$ii = 0;
while ($row = sed_sql_fetcharray($sql))
	{
	
	$t -> assign(array(
		"ADMIN_PAGES_URL" => (!empty($row['page_alias'])) ? sed_url('page', "al=".$row['page_alias']) : sed_url('page', "id=".$row['page_id']),
		"ADMIN_PAGES_TITLE" => htmlspecialchars($row['page_title']),
		"ADMIN_PAGES_ID" => $row['page_id'],
		"ADMIN_PAGES_CAT_TITLE" => $sed_cat[$row['page_cat']]['title'],
		"ADMIN_PAGES_CAT" => $row["page_cat"],
		"ADMIN_PAGES_CATDESC" => $sed_cat[$row['page_cat']]['desc'],
		"ADMIN_PAGES_CATICON" => $sed_cat[$row['page_cat']]['icon'],
		"ADMIN_PAGES_DESC" => htmlspecialchars($row['page_desc']),
		"ADMIN_PAGES_AUTHOR" => htmlspecialchars($row['page_author']),
		"ADMIN_PAGES_OWNER" => sed_build_user($row['page_ownerid'], htmlspecialchars($row['user_name'])),
		"ADMIN_PAGES_DATE" => date($cfg['dateformat'], $row['page_date'] + $usr['timezone'] * 3600),
		"ADMIN_PAGES_BEGIN" => date($cfg['dateformat'], $row['page_begin'] + $usr['timezone'] * 3600),
		"ADMIN_PAGES_EXPIRE" => date($cfg['dateformat'], $row['page_expire'] + $usr['timezone'] * 3600),
		"ADMIN_PAGES_ADMIN_COUNT" => $row['page_count'],
		"ADMIN_PAGES_FILE" => $sed_yesno[$row['page_file']],
		"ADMIN_PAGES_FILE_URL" => $row['page_url'],
		"ADMIN_PAGES_FILE_NAME" => basename($row['page_url']),
		"ADMIN_PAGES_FILE_SIZE" => $row['page_size'],
		"ADMIN_PAGES_FILE_COUNT" => $row['page_filecount'],
		"ADMIN_PAGES_KEY" => htmlspecialchars($row['page_key']),
		"ADMIN_PAGES_ALIAS" => htmlspecialchars($row['page_alias']),
		"ADMIN_PAGES_URL_FOR_QUEUE" => ($row['page_state']) ? '<a href="'.sed_url('admin', "m=page&s=queue&a=validate&id=".$row['page_id']."&d=".$d."&".sed_xg()).'" title="Страница отключена. Кликните по ссылке, чтобы включить страницу.">Показать</a>' : '<a href="'.sed_url('admin', "m=page&s=queue&a=unvalidate&id=".$row['page_id']."&d=".$d."&".sed_xg()).'" title="Страница включена. Кликните по ссылке, чтобы отключить страницу.">Скрыть</a>',
		"ADMIN_PAGES_URL_FOR_EDIT" => sed_url('admin', "m=page&s=edit&id=".$row["page_id"]."&r=adm"),
		"ADMIN_PAGES_ODDEVEN" => sed_build_oddeven($ii),
	));

	$t -> parse("PAGES.PAGES_ROW");
	$ii++;
	}

$is_row_empty = (sed_sql_numrows($sql) == 0) ? true : false ;

$t -> assign(array(
	"ADMIN_PAGES_AJAX_OPENDIVID" => 'pagtab',
	"ADMIN_PAGES_ADMINWARNINGS" => $adminwarnings,
	"ADMIN_PAGES_PAGINATION_PREV" => $pagination_prev,
	"ADMIN_PAGES_PAGNAV" => $pagnav,
	"ADMIN_PAGES_PAGINATION_NEXT" => $pagination_next,
	"ADMIN_PAGES_TOTALITEMS" => $totalitems,
	"ADMIN_PAGES_ON_PAGE" => $ii
));
	
$t -> parse("PAGES");
$adminmain = $t -> text("PAGES");

if($ajax)
{
	sed_sendheaders();
	echo $adminmain;
	exit;
}	


?>
