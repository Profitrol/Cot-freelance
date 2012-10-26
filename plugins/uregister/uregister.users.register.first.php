<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uregister
Part=main
File=uregister.users.register.first
Hooks=users.register.first
Tags=users.register.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$regtype = sed_import('regtype','G','ALP');
$ruserregtype = sed_import('ruserregtype','P','ALP');

if(empty($regtype) && !empty($ruserregtype)) $regtype = $ruserregtype;

?>
