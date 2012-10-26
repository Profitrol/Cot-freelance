<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=portfolio
Part=main
File=portfolio
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') && defined('SED_PLUG') or die('Wrong URL');



switch($m){
	
	case 'add':
	require('inc/portfolio.add.inc.php');
	break;
	
	case 'edit':
	require('inc/portfolio.edit.inc.php');
	break;
	
	case 'show':
	require('inc/portfolio.show.inc.php');
	break;
	
	default:
	require('inc/portfolio.default.inc.php');
	break;

	}

?>