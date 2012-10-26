<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=admin
File=rating.admin
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');


		
$t -> parse("MAIN");
$plugin_body .= $t -> text("MAIN");

?>