<?PHP
// *********************************************
// *    CKEditor Plugin for Cotonti            *
// *                                           *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=ckeditor
Name=CKEditor
Description=HTML Wysiwyg editor for Cotonti pages.
Version=0.1.0
Date=2009-sep-02
Author=Alex
Copyright=Alex & Naty Studio - http://portal30.ru
Notes=CKEditor HTML wysiwyg editor for Cotonti pages.
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=RW
Lock_members=12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
onPagesOnly=10:radio::1:Include ckeditor.js only on Page Add/Edit?
useThumbnailviewer=14:radio::0: Use Thumbnailviewer?
skin=16:select:kama,office2003,v2:office2003:Editor skin
width=18:string::775:Editor width
height=20:string::350:Editor height
resize_enabled=26:radio::1:Editor resize enabled?
resize_minWidth=30:string::200:Editor min width
resize_minHeight=34:string::100:Editor min height
resize_maxWidth=30:string::775:Editor max width
resize_maxHeight=34:string::650:Editor max height
useAltFileManager=38:radio::0:Use Alternative File Manager?
altFileManForAdm=40:radio::1:Alternative File Manager for administrators only?
altFolder=42:string::User_Files:Alternative file store folder
altFolder_maxUploadFileSize=46:string::2048:Max file upload size (in Kbytes)
altFolder_allowedExts=50:string::gif,jpg,png,bmp,tif,zip,sit,rar,gz,tar,htm,html,mov,mpg,avi,asf,mpeg,wmv,aif,aiff,wav,mp3,swf,ppt,rtf,doc,pdf,xls,txt,xml,xsl,dtd:Allowed file upload exts
[END_SED_EXTPLUGIN_CONFIG]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if($action == 'install')
{
	
}
elseif($action == 'uninstall')
{

}

?>