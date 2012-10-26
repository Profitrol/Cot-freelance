<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=city
Part=global
File=city.global
Hooks=global
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if (!$sed_location)
{
	$sed_location = sed_load_location($cfg['countries']);
	sed_cache_store('sed_location', $sed_location, 3600);
}

//echo "<pre>";
//print_r(sed_getcities(4312));
//echo "</pre>";

?>
