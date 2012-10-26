<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uregister
Part=main
File=uregister.users.register.add.first
Hooks=users.register.add.first
Tags=users.register.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$rusername = str_replace('&#160;', '', $rusername);
$rusername = sed_import('rusername','P','TXT', 100, TRUE);
$ruseragreement = sed_import('ruseragreement','P','BOL');
$ruserregtype = sed_import('ruserregtype','P','ALP');

$error_string .= (!eregi("^[a-zA-Z][_a-zA-Z0-9-]*$", $rusername)) ? "В логине разрешено использовать только латинские символы<br />" : '';
$error_string .= (empty($ruserregtype)) ? "Не выбран тип аккаунта<br />" : '';
$error_string .= (!$ruseragreement) ? "Необходимо подтвердить согласие с условиями пользовательского соглашения<br />" : '';


?>
