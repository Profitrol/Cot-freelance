<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net
[BEGIN_SED]
File=index.inc.php
Version=101
Updated=2006-mar-15
Type=Core
Author=Neocrome
Description=Home page
[END_SED]
==================== */

defined('SED_CODE') or die('Wrong URL');

/* === Hook === */
$extp = sed_getextplugins('index.first');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('index', 'a');

/* === Hook === */
$extp = sed_getextplugins('index.main');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */


require_once $cfg['system_dir'] . '/header.php';

$mskin = sed_skinfile('index');
$t = new XTemplate($mskin);



/* === Hook === */
$extp = sed_getextplugins('index.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$t->parse("MAIN");
$t->out("MAIN");

require_once $cfg['system_dir'] . '/footer.php';

?>
