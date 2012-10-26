<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=blogs
Part=global
File=blogs.global
Hooks=global
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if (!$sed_bcat)
{
	$sed_bcat = sed_load_bcat();
	sed_cache_store('sed_bcat', $sed_bcat, 3600);
}


?>
