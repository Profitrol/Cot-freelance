<?PHP
// *********************************************
// *    CKEditor Plugin for Cotonti            *
// *         PFS Part                          *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************
/* ====================
 Seditio - Website engine
 Copyright Neocrome
 http://www.neocrome.net
 ==================== */

/**
 * Personal File Storage, main usage script, html - inserting
 *
 * @package Cotonti
 * @version 0.0.6
 * @author Neocrome, Cotonti Team, Alex
 * @copyright Copyright (c) 2008-2009 Cotonti Team
 * @license BSD License
 */
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=ckeditor
Part=pfs
File=ckeditor.pfs
Hooks=popup
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
defined('SED_CODE') or die('Wrong URL');

require_once("./datas/extensions.php");

define('SED_PFS', TRUE);
$location = 'PFS';
$z = 'pfs';

sed_dieifdisabled($cfg['disable_pfs']);

switch($m)
	{
	case 'view':
	require_once($cfg['plugins_dir'].'/ckeditor/inc/pfs.view.inc.php');
	break;

	case 'edit':
	require_once($cfg['plugins_dir'].'/ckeditor/inc/ckeditor.pfs.edit.inc.php');
	break;

	case 'editfolder':
	require_once($cfg['plugins_dir'].'/ckeditor/inc/ckeditor.pfs.editfolder.inc.php');
	break;

	default:
	require_once($cfg['plugins_dir'].'/ckeditor/inc/ckeditor.pfs.inc.php');
	break;
	}

?>
