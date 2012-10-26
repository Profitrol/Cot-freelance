<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=global
File=freelancers.global
Hooks=global
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if (!$sed_fcat)
{
	$sed_fcat = sed_load_fcat();
	sed_cache_store('sed_fcat', $sed_fcat, 3600);
}

?>
