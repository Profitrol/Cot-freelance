<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=adminqv
Part=main
File=adminqv
Hooks=admin.home
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

/**
 * Displays quick links for admin
 *
 * @package Cotonti
 * @version 0.0.3
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL');

require_once(sed_langfile('adminqv'));

$t = new XTemplate(sed_skinfile('adminqv', true));

$timeback = $sys['now_offset'] - (7 * 86400);// 7 days
$timeback_stats = 15;// 15 days

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_users WHERE user_regdate>'$timeback'");
$newusers = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_pages WHERE page_date >'$timeback'");
$newpages = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_forum_topics WHERE ft_creationdate>'$timeback'");
$newtopics = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_forum_posts WHERE fp_updated>'$timeback'");
$newposts = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_com WHERE com_date>'$timeback'");
$newcomments = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_date>'$timeback'");
$newpms = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM $db_stats WHERE stat_name LIKE '20%' ORDER BY stat_name DESC LIMIT ".$timeback_stats);
while($row = sed_sql_fetcharray($sql))
{
	$y = mb_substr($row['stat_name'], 0, 4);
	$m = mb_substr($row['stat_name'], 5, 2);
	$d = mb_substr($row['stat_name'], 8, 2);
	$dat = @date('d D', mktime(0,0,0,$m,$d,$y));
	$hits_d[$dat] = $row['stat_value'];
}

if (is_array($hits_d))
{
	$hits_d_max = max($hits_d);
}

$sql = sed_sql_query("SHOW TABLES");

while($row = sed_sql_fetchrow($sql))
{
	$table_name = $row[0];
	$status = sed_sql_query("SHOW TABLE STATUS LIKE '$table_name'");
	$status1 = sed_sql_fetcharray($status);
	$tables[] = $status1;
}

foreach ($tables as $dat)
{
	$table_length = $dat['Index_length']+$dat['Data_length'];
	$total_length += $table_length;
	$total_rows += $dat['Rows'];
	$total_index_length += $dat['Index_length'];
	$total_data_length += $dat['Data_length'];
}

$sql = sed_sql_query("SELECT DISTINCT(pl_code) FROM $db_plugins WHERE 1 GROUP BY pl_code");
$totalplugins = sed_sql_numrows($sql);

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_plugins");
$totalhooks = sed_sql_result($sql, 0, "COUNT(*)");

if (is_array($hits_d))
{
	foreach($hits_d as $day => $hits)
	{
		$percentbar = floor(($hits / $hits_d_max) * 100);
		$t -> assign(array(
			'ADMINQV_DAY' => $day,
			'ADMINQV_HITS' => $hits,
			'ADMINQV_PERCENTBAR' => $percentbar
		));
		$t -> parse('ADMINQV.ADMINQV_ROW');
	}
	}

//Version Checking
if ($cfg['check_updates'])
{
	$update_info = sed_cache_get('update_info');
	if(!$update_info)
	{
		if(ini_get('allow_url_fopen'))
		{
			$update_info = @file_get_contents('http://www.cotonti.com/update-check');
			if($update_info)
			{
				$update_info = json_decode($update_info, TRUE);
				sed_cache_store('update_info', $update_info, 86400, FALSE);
			}
		}
		elseif(function_exists('curl_init'))
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'http://www.cotonti.com/update-check');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			$update_info = curl_exec($curl);
			if($update_info)
			{
				$update_info = json_decode($update_info, TRUE);
				sed_cache_store('update_info', $update_info, 86400, FALSE);
			}
			curl_close($curl);
		}
	}
	if($update_info['update_rev'] > $cfg['revision'])
	{
		$t->assign(array(
			'ADMINQV_UPDATE_REVISION' => sprintf($L['adminqv_update_revision'], $cfg['version'], $cfg['revision'], htmlspecialchars($update_info['update_ver']), (int)$update_info['update_rev']),
			'ADMINQV_UPDATE_MESSAGE' => sed_parse(htmlspecialchars($update_info['update_message']), $cfg['parsebbcodepages'], $cfg['parsesmiliespages'], true),
			));
		$t->parse('ADMINQV.UPDATE');
	}
}

$t -> assign(array(
	'ADMINQV_NEWUSERS_URL' => sed_url('users', 'f=all&s=regdate&w=desc'),
	'ADMINQV_NEWUSERS' => $newusers,
	'ADMINQV_NEWPAGES_URL' => sed_url('admin', 'm=page'),
	'ADMINQV_NEWPAGES' => $newpages,
	'ADMINQV_NEWTOPICS_URL' => sed_url('forums'),
	'ADMINQV_NEWTOPICS' => $newtopics,
	'ADMINQV_NEWPOSTS_URL' => sed_url('forums'),
	'ADMINQV_NEWPOSTS' => $newposts,
	'ADMINQV_NEWCOMMENTS_URL' => sed_url('admin', 'm=comments'),
	'ADMINQV_NEWCOMMENTS' => $newcomments,
	'ADMINQV_NEWPMS' => $newpms,
	'ADMINQV_VERSION' => $cfg['version'],
	'ADMINQV_REVISION' => $L['adminqv_rev'].$cfg['revision'],
	'ADMINQV_DB_VERSION' => $cfg['dbversion'],
	'ADMINQV_DB_TOTAL_ROWS' => $total_rows,
	'ADMINQV_DB_INDEXSIZE' => number_format(($total_index_length/1024),1,'.',' '),
	'ADMINQV_DB_DATASSIZE' => number_format(($total_data_length/1024),1,'.',' '),
	'ADMINQV_DB_TOTALSIZE' => number_format(($total_length/1024),1,'.',' '),
	'ADMINQV_TOTALPLUGINS' => $totalplugins,
	'ADMINQV_TOTALHOOKS' => $totalhooks,
	'ADMINQV_MORE_HITS_URL'=> sed_url('admin', 'm=hits')
));
$t -> parse('ADMINQV');
$adminmain .= $t -> text("ADMINQV");

?>