<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=market
Part=main
File=market
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') && defined('SED_PLUG') or die('Wrong URL');



switch($m){
	
	case 'add':
	require('inc/market.add.inc.php');
	break;
	
	case 'edit':
	require('inc/market.edit.inc.php');
	break;
	
	case 'show':
	require('inc/market.show.inc.php');
	break;
	
	default:
	require('inc/market.default.inc.php');
	break;

	}

?>