<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=city
Part=admin
File=city.admin
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

switch($n){
	
	case 'region':
	require('inc/city.city.inc.php');
	break;
	
	case 'country':
	require('inc/city.region.inc.php');
	break;
	
	default:
	require('inc/city.country.inc.php');
	break;

	}
		
$t -> parse("MAIN");
$plugin_body .= $t -> text("MAIN");

?>