<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=users
File=freelancers.users.first
Hooks=users.first
Tags=users.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$c = sed_import('c', 'G', 'INT');

$country = sed_import('country','G','INT');
$region = sed_import('region','G','INT');
$city = sed_import('city','G','INT');

?>