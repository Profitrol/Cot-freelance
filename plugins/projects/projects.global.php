<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=projects
Part=global
File=projects.global
Hooks=global
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

// if (!$sed_location)
// {
	// $sed_location = sed_load_location();
	// sed_cache_store('sed_location', $sed_location, 3600);
// }


if (!$sed_pcat)
{
	$sed_pcat = sed_load_pcat();
	sed_cache_store('sed_pcat', $sed_pcat, 3600);
}


if (!$sed_ptype)
{
	$sed_ptype = sed_load_ptype();
	sed_cache_store('sed_ptype', $sed_ptype, 3600);
}

?>
