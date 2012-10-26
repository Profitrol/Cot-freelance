<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=projects
Part=main
File=projects
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') && defined('SED_PLUG') or die('Wrong URL');



switch($m){
	
	case 'add':
	require('inc/projects.add.inc.php');
	break;
	
	case 'step2':
	require('inc/projects.step2.inc.php');
	break;
	
	case 'edit':
	require('inc/projects.edit.inc.php');
	break;
	
	case 'show':
	require('inc/projects.show.inc.php');
	break;
	
	default:
	require('inc/projects.default.inc.php');
	break;

	}

?>