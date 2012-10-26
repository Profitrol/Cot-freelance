<?PHP
// *********************************************
// *    CKEditor Plugin for Cotonti            *
// *        Header Main                        *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED_EXTPLUGIN]
Code=ckeditor
Part=header.main
File=ckeditor.header.main
Hooks=header.main
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if ($cfg['plugin']['ckeditor']['onPagesOnly']){
	if ($location == "Pages" && ($m == 'edit' || $m == 'add')){
		if (!defined('COT_CKEDITOR')){
			$out['compopup'] .= "\n".'<script type="text/javascript" src="'.$cfg['plugins_dir'].'/ckeditor/ckeditor/ckeditor.js"></script>';
			define('COT_CKEDITOR', TRUE);
		}
	}
}else{
	if (!defined('COT_CKEDITOR')){
		$out['compopup'] .= "\n".'<script type="text/javascript" src="'.$cfg['plugins_dir'].'/ckeditor/ckeditor/ckeditor.js"></script>';
		define('COT_CKEDITOR', TRUE);
	}
}
?>