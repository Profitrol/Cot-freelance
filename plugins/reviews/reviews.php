<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=reviews
Part=main
File=reviews
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') && defined('SED_PLUG') or die('Wrong URL');



switch($m){
	
	case 'add':
	require('inc/reviews.add.inc.php');
	break;
	
	case 'edit':
	require('inc/reviews.edit.inc.php');
	break;

	}

?>