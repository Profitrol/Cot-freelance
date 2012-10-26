<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uinfo
Part=main
File=uinfo.users.profile.update.done
Hooks=profile.update.done
Tags=profile.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$sed_fcat = sed_load_fcat();
sed_cache_store('sed_fcat', $sed_fcat, 3600);
		

?>
