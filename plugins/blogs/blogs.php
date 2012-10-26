<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=blogs
Part=main
File=blogs
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') && defined('SED_PLUG') or die('Wrong URL');

$m = sed_import('m','G','ALP');

switch($m){
	
	case 'add':
	require('inc/blogs.add.inc.php');
	break;
	
	case 'edit':
	require('inc/blogs.edit.inc.php');
	break;
	
	case 'show':
	require('inc/blogs.show.inc.php');
	break;
	
	default:
	require('inc/blogs.default.inc.php');
	break;

	}
	
?>