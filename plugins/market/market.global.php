<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=market
Part=global
File=market.global
Hooks=global
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if (!$sed_mcat)
{
	$sed_mcat = sed_load_mcat();
	sed_cache_store('sed_mcat', $sed_mcat, 3600);
}


?>
