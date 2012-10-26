<?PHP
// *********************************************
// *    CKEditor Plugin for Cotonti            *
// *         Page Edit Part                    *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=ckeditor
Part=page.edit
File=ckeditor.page.edit
Hooks=page.edit.tags
Tags=page.edit.tpl:{PAGEEDIT_FORM_TEXT},{PAGEEDIT_FORM_PFS_TEXT_USER},{PAGEEDIT_FORM_PFS_TEXT_SITE}
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$fileBroser = "";
unset ($_SESSION['FileBroserFolder']);
$_SESSION['FileBroserMaxUploadFileSize'] = 0;
$_SESSION['FileBroserAllowedExts'] = '';

if ($cfg['plugin']['ckeditor']['useAltFileManager']){
	$fileBroser = "
		filebrowserBrowseUrl : '/plugins/ckeditor/ajaxfilemanager/ajaxfilemanager.php?editor=ckeditor',
        filebrowserWindowWidth : '782',
        filebrowserWindowHeight : '500',";

	// Заряжаем настройки для AjaxFileManager
	$_SESSION['FileBroserFolder'] = $cfg['plugin']['ckeditor']['altFolder'];
	$_SESSION['FileBroserMaxUploadFileSize'] = $cfg['plugin']['ckeditor']['altFolder_maxUploadFileSize']*1024;
	$_SESSION['FileBroserAllowedExts'] = $cfg['plugin']['ckeditor']['altFolder_allowedExts'];

	// TODO проверка прав пользователя на использование Ajax FileManajer
	if ($cfg['plugin']['ckeditor']['altFileManForAdm'] && !$usr['isadmin']){
		$fileBroser = "";
		unset ($_SESSION['FileBroserFolder']);
		$_SESSION['FileBroserMaxUploadFileSize'] = 0;
		$_SESSION['FileBroserAllowedExts'] = '';
	}
}

$smiley_descriptions = '';
$smiley_images = '';
$i = 0;
$smiles = '';
if (is_array($sed_smilies)){
	foreach($sed_smilies as $smile){
		if ($i > 0){
			$smiley_descriptions .= ",";
			$smiley_images .=  ",";
		}
		$smiley_descriptions .= "'".$smile["code"]."'";
		$smiley_images .=  "'".$smile["file"]."'";
		$i++;
	}
	$smiles = "smiley_descriptions : [$smiley_descriptions],
			   smiley_images : [$smiley_images],
			   smiley_path : '/images/smilies/'";
}
$pfsUser = '';
$pfsSite = '';
if ($sed_groups[$usr['maingrp']]['pfs_maxtotal']>0 && $sed_groups[$usr['maingrp']]['pfs_maxfile']>0 && sed_auth('pfs', 'a', 'R')){ 
	if (!$cfg['disable_pfs']){
		$pfsUser = "<a href=\"javascript:popup('ckeditor&userid=".$usr['id']."&c1=update&c2=rpagetext', 754, 512);\">".$L['Mypfs']."</a>"; 
	}
}

if ($sed_groups[$usr['maingrp']]['pfs_maxtotal']>0 && $sed_groups[$usr['maingrp']]['pfs_maxfile']>0 && sed_auth('pfs', 'a', 'R')){ 
		$pfsSite = (sed_auth('pfs', 'a', 'A')) ?  "<a href=\"javascript:popup('ckeditor&userid=0&c1=update&c2=rpagetext', 754, 512);\">".$L['SFS']."</a>" : ""; 
}

$resize = ($cfg['plugin']['ckeditor']['resize_enabled']) ? 'true' : 'false';
$editt = "
<textarea name=\"rpagetext\" id=\"rpagetext\">".sed_cc($pag['page_text'])."</textarea>
<script type=\"text/javascript\">
	CKEDITOR.replace( 'rpagetext',{
		baseHref : '".$cfg['mainurl']."',
		enterMode : CKEDITOR.ENTER_BR,
		contentsCss : '".$cfg['mainurl']."/skins/".$skin."/".$skin.".css',
		height : ".$cfg['plugin']['ckeditor']['height'].",
        $fileBroser
		resize_enabled : $resize,
		resize_maxHeight : ".$cfg['plugin']['ckeditor']['resize_maxHeight'].",
		resize_maxWidth : ".$cfg['plugin']['ckeditor']['resize_maxWidth'].",
		resize_minHeight : ".$cfg['plugin']['ckeditor']['resize_minHeight'].",
		resize_minWidth : ".$cfg['plugin']['ckeditor']['resize_minWidth'].",
		skin : '".$cfg['plugin']['ckeditor']['skin']."',
		".$smiles."
	});		
</script>
";

$t->assign(array(
            "PAGEEDIT_FORM_TEXT" => $editt,
            'PAGEEDIT_FORM_PFS_TEXT_USER' => $pfsUser,
			'PAGEEDIT_FORM_PFS_TEXT_SITE' => $pfsSite
    ));
?>