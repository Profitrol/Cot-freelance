<?php
/**
 * Administration panel - Banlist manager
 *
 * @package Cotonti
 * @version 0.1.0
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

(defined('SED_CODE') && defined('SED_ADMIN')) or die('Wrong URL.');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('users', 'a');
sed_block($usr['isadmin']);

$t = new XTemplate(sed_skinfile('admin.banlist.inc', false, true));

$adminpath[] = array(sed_url('admin', 'm=other'), $L['Other']);
$adminpath[] = array(sed_url('admin', 'm=banlist'), $L['Banlist']);
$adminhelp = $L['adm_help_banlist'];

$d = sed_import('d', 'G', 'INT');
$d = empty($d) ? 0 : (int) $d;
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;

/* === Hook === */
$extp = sed_getextplugins('admin.banlist.first');
if(is_array($extp))
{
	foreach($extp as $k => $pl)
	{
		include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php');
	}
}
/* ===== */

if($a == 'update')
{
	$id = sed_import('id', 'G', 'INT');
	$rbanlistip = sed_import('rbanlistip', 'P', 'TXT');
	$rbanlistemail = sed_sql_prep(sed_import('rbanlistemail', 'P', 'TXT'));
	$rbanlistreason = sed_sql_prep(sed_import('rbanlistreason', 'P', 'TXT'));

	$sql = (!empty($rbanlistip) || !empty($rbanlistemail)) ? sed_sql_query("UPDATE $db_banlist SET banlist_ip='$rbanlistip', banlist_email='$rbanlistemail', banlist_reason='$rbanlistreason' WHERE banlist_id='$id'") : '';

	$adminwarnings = ($sql) ? $L['alreadyupdatednewentry'] : $L['Error'];
}
elseif($a == 'add')
{
	$nbanlistip = sed_import('nbanlistip', 'P', 'TXT');
	$nbanlistemail = sed_sql_prep(sed_import('nbanlistemail', 'P', 'TXT'));
	$nbanlistreason = sed_sql_prep(sed_import('nbanlistreason', 'P', 'TXT'));
	$nexpire = sed_import('nexpire', 'P', 'INT');

	$nbanlistip_cnt = explode('.', $nbanlistip);
	$nbanlistip = (count($nbanlistip_cnt)==4) ? $nbanlistip : '';

	if($nexpire > 0)
	{
		$nexpire += $sys['now'];
	}
	$sql = (!empty($nbanlistip) || !empty($nbanlistemail)) ? sed_sql_query("INSERT INTO $db_banlist (banlist_ip, banlist_email, banlist_reason, banlist_expire) VALUES ('$nbanlistip', '$nbanlistemail', '$nbanlistreason', ".(int)$nexpire.")") : '';

	$adminwarnings = ($sql) ? $L['alreadyaddnewentry'] : $L['Error'];
}
elseif($a == 'delete')
{
	sed_check_xg();
	$id = sed_import('id', 'G', 'INT');

	$sql = sed_sql_query("DELETE FROM $db_banlist WHERE banlist_id='$id'");

	$adminwarnings = ($sql) ? $L['alreadydeletednewentry'] : $L['Error'];
}

$is_adminwarnings = isset($adminwarnings);

$totalitems = sed_sql_rowcount($db_banlist);
if($cfg['jquery'] AND $cfg['turnajax'])
{
	$pagnav = sed_pagination(sed_url('admin','m=banlist'), $d, $totalitems, $cfg['maxrowsperpage'], 'd', 'ajaxSend', "url: '".sed_url('admin','m=banlist&ajax=1')."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'");
	list($pagination_prev, $pagination_next) = sed_pagination_pn(sed_url('admin', 'm=banlist'), $d, $totalitems, $cfg['maxrowsperpage'], TRUE, 'd', 'ajaxSend', "url: '".sed_url('admin','m=banlist&ajax=1')."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'");
}
else
{
	$pagnav = sed_pagination(sed_url('admin','m=banlist'), $d, $totalitems, $cfg['maxrowsperpage']);
	list($pagination_prev, $pagination_next) = sed_pagination_pn(sed_url('admin', 'm=banlist'), $d, $totalitems, $cfg['maxrowsperpage'], TRUE);
}

$sql = sed_sql_query("SELECT * FROM $db_banlist ORDER by banlist_expire DESC, banlist_ip LIMIT $d, ".$cfg['maxrowsperpage']);

$ii = 0;

/* === Hook - Part1 : Set === */
$extp = sed_getextplugins('admin.banlist.loop');
/* ===== */

while($row = sed_sql_fetcharray($sql))
{
	$t -> assign(array(
		"ADMIN_BANLIST_ID_ROW" => $row['banlist_id'],
		"ADMIN_BANLIST_URL" => sed_url('admin', 'm=banlist&a=update&id='.$row['banlist_id'].'&d='.$d),
		"ADMIN_BANLIST_URL_AJAX" => ($cfg['jquery'] AND $cfg['turnajax']) ? " onsubmit=\"return ajaxSend({method: 'POST', formId: 'savebanlist_".$row['banlist_id']."', url: '".sed_url('admin','m=banlist&a=update&ajax=1&id='.$row['banlist_id'].'&d='.$d)."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'});\"" : "",
		"ADMIN_BANLIST_DELURL" => sed_url('admin', 'm=banlist&a=delete&id='.$row['banlist_id'].'&'.sed_xg()),
		"ADMIN_BANLIST_DELURL_AJAX" => ($cfg['jquery'] AND $cfg['turnajax']) ? " onclick=\"return ajaxSend({url: '".sed_url('admin','m=banlist&ajax=1&a=delete&id='.$row['banlist_id'].'&'.sed_xg())."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'});\"" : "",
		"ADMIN_BANLIST_EXPIRE" => ($row['banlist_expire']>0) ? date($cfg['dateformat'],$row['banlist_expire'])." GMT" : $L['adm_neverexpire'],
		"ADMIN_BANLIST_IP" => $row['banlist_ip'],
		"ADMIN_BANLIST_EMAIL" => $row['banlist_email'],
		"ADMIN_BANLIST_REASON" => $row['banlist_reason'],
        "ADMIN_BANLIST_ODDEVEN" => sed_build_oddeven($ii)
	));

	/* === Hook - Part2 : Include === */
	if(is_array($extp))
	{
		foreach($extp as $k => $pl)
		{
			include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php');
		}
	}
	/* ===== */

	$t -> parse("BANLIST.ADMIN_BANLIST_ROW");
	$ii++;
}

$t -> assign(array(
	"ADMIN_BANLIST_ADMINWARNINGS" => $adminwarnings,
	"ADMIN_BANLIST_PAGINATION_PREV" => $pagination_prev,
	"ADMIN_BANLIST_PAGNAV" => $pagnav,
	"ADMIN_BANLIST_PAGINATION_NEXT" => $pagination_next,
	"ADMIN_BANLIST_TOTALITEMS" => $totalitems,
	"ADMIN_BANLIST_COUNTER_ROW" => $ii,
	"ADMIN_BANLIST_INC_URLFORMADD" => sed_url('admin', 'm=banlist&a=add'),
	"ADMIN_BANLIST_INC_URLFORMADD_AJAX" => ($cfg['jquery'] AND $cfg['turnajax']) ? " onsubmit=\"return ajaxSend({method: 'POST', formId: 'addbanlist', url: '".sed_url('admin','m=banlist&ajax=1&a=add')."', divId: 'pagtab', errMsg: '".$L['ajaxSenderror']."'});\"" : ""
));

/* === Hook  === */
$extp = sed_getextplugins('admin.banlist.tags');
if(is_array($extp))
{
	foreach($extp as $k => $pl)
	{
		include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php');
	}
}
/* ===== */

$t -> parse("BANLIST");
$adminmain = $t -> text("BANLIST");

if($ajax)
{
	sed_sendheaders();
	echo $adminmain;
	exit;
}

?>