<?PHP
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net
==================== */

/**
 * @package Cotonti
 * @version 0.0.3
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL');

/* === Hook === */
$extp = sed_getextplugins('footer.first');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$i = explode(' ', microtime());
$sys['endtime'] = $i[1] + $i[0];
$sys['creationtime'] = round(($sys['endtime'] - $sys['starttime']), 3);

$out['creationtime'] = (!$cfg['disablesysinfos']) ? $L['foo_created'].' '.sed_declension($sys['creationtime'],$L['foo_seconds'],$onlyword = false,$canfrac = true) : '';
$out['sqlstatistics'] = ($cfg['showsqlstats']) ? $L['foo_sqltotal'].': '.sed_declension(round($sys['tcount'], 3),$L['foo_seconds'],$onlyword = false,$canfrac = true).' - '.$L['foo_sqlqueries'].': '.$sys['qcount']. ' - '.$L['foo_sqlaverage'].': '.sed_declension(round(($sys['tcount']/$sys['qcount']), 5),$L['foo_seconds'],$onlyword = false,$canfrac = true) : '';
$out['bottomline'] = $cfg['bottomline'];
$out['bottomline'] .= ($cfg['keepcrbottom']) ? '<br />'.$out['copyright'] : '';

if ($cfg['devmode'] && sed_auth('admin', 'a', 'A'))
{
	$out['devmode'] = "<h4>Dev-mode :</h4><table><tr><td><em>SQL query</em></td><td><em>Duration</em></td><td><em>Timeline</em></td><td><em>Query</em></td></tr>";
	$out['devmode'] .= "<tr><td colspan=\"2\">BEGIN</td>";
	$out['devmode'] .= "<td style=\"text-align:right;\">0.000 ms</td><td>&nbsp;</td></tr>";
	foreach ($sys['devmode']['queries'] as $k => $i)
	{
		$out['devmode'] .= "<tr><td>#".$i[0]." &nbsp;</td>";
		$out['devmode'] .= "<td style=\"text-align:right;\">".sprintf("%.3f",round($i[1]*1000, 3))." ms</td>";
		$out['devmode'] .= "<td style=\"text-align:right;\">".sprintf("%.3f",round($sys['devmode']['timeline'][$k]*1000, 3))." ms</td>";
		$out['devmode'] .= "<td style=\"text-align:left;\">".htmlspecialchars($i[2])."</td></tr>";
	}
	$out['devmode'] .= "<tr><td colspan=\"2\">END</td>";
	$out['devmode'] .= "<td style=\"text-align:right;\">".sprintf("%.3f",$sys['creationtime'])." ms</td><td>&nbsp;</td></tr>";
	$out['devmode'] .= "</table><br />Total:".round($sys['tcount'],4)."s - Queries:".$sys['qcount']. " - Average:".round(($sys['tcount']/$sys['qcount']),5)."s/q";
}

/*
========= DEBUG:START =========
if (is_array($sys['auth_log']))
	{ $out['devauth'] .= "AUTHLOG: ".implode(', ',$sys['auth_log']); }
$txt_r = ($usr['auth_read']) ? '1' : '0';
$txt_w = ($usr['auth_write']) ? '1' : '0';
$txt_a = ($usr['isadmin']) ? '1' : '0';
$out['devauth'] .= " &nbsp; AUTH_FINAL_RWA:".$txt_r.$txt_w.$txt_a;
$out['devmode']	 .= $out['devauth'];
========= DEBUG:END =========
*/

if (!SED_AJAX)
{
	/* === Hook === */
	$extp = sed_getextplugins('footer.main');
	if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	if ($cfg['enablecustomhf'])
	{ $mskin = sed_skinfile(array('footer', mb_strtolower($location))); }
	else
	{ $mskin = "skins/".$usr['skin']."/footer.tpl"; }
	$t = new XTemplate($mskin);

	$t->assign(array (
		"FOOTER_BOTTOMLINE" => $out['bottomline'],
		"FOOTER_CREATIONTIME" => $out['creationtime'],
		"FOOTER_COPYRIGHT" => $out['copyright'],
		"FOOTER_SQLSTATISTICS" => $out['sqlstatistics'],
		"FOOTER_LOGSTATUS" => $out['logstatus'],
		"FOOTER_PMREMINDER" => $out['pmreminder'],
		"FOOTER_ADMINPANEL" => $out['adminpanel'],
		"FOOTER_DEVMODE" => $out['devmode']
		));

	/* === Hook === */
	$extp = sed_getextplugins('footer.tags');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	if ($usr['id']>0)
	{ $t->parse("FOOTER.USER"); }
	else
	{ $t->parse("FOOTER.GUEST"); }

	$t->parse("FOOTER");
	$t->out("FOOTER");
}
@ob_end_flush();

sed_sql_close();

/* === Hook === */
$extp = sed_getextplugins('footer.last');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */
?>