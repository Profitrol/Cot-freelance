<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/slimbox/slimbox.setup.php
Version=1
Date=2009-mar-4
Type=Plugin
Author=Kilandor
Description=Slimbox+ImageScale Jquery Plugins
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=slimbox
Name=Slimbox+ImageScale
Description=Slimbox+ImageScale Jquery Plugins
Version=1
Date=2009-mar-4
Author=Kilandor
Copyright=
Notes=Uses Jquery Slimbox(lightbox clone), and ImageScale plugins, to manipulate image, to do in page previews.<br />Slimbox is set to auto find any links, that link to an image, and load it up for preview on click. Also, any other links in that element, will automatically be linked together, as a mini-gallery.<br /><br /> ImageScaling will reduce the size of images to desired size, this can be used to prevent, tacky scrollbars.<br /><br /> Img bbcode is changed on install to support this plugin.  On un-install the orginal Cotonti default is restored. On either action, all HTML cache will be reset(needed to work).<br /><br />For more possible modifications/details<br />http://code.google.com/p/slimbox/wiki/jQueryManual - SlimBox Manual<br /><br />http://www.javascriptkit.com/script/script2/jscale/index.shtml -ImageScale Homepage<br />(please note the included Image Scale Script, was modified to prevent Upsizing of images)
SQL=Auto-Un/Installed
Auth_guests=R
Lock_guests=12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
scale=01:radio::1:Enable Image Scaling
scalewpx=02:string:::Scale Image Width to X px (do not add "px")
scalehpx=03:string:::Scale Image Height to X px do not add "px")
scalelspx=04:string::550:Scale Image Longest Side to X px (if set is used instead of width or height, do not add "px")
scalespeed=05:string:::Scale Image Speed, animates the scaling process (in milliseconds)
[END_SED_EXTPLUGIN_CONFIG]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }
if($action == 'install')
{
	// Install
	sed_sql_query("UPDATE $db_bbcode SET `bbc_replacement` = '<a href=\"$1\"><img src=\"$1\" alt=\"\" class=\"scale\" /></a>' WHERE `sed_bbcode`.`bbc_id` =27 LIMIT 1 ;");
	sed_sql_query("UPDATE $db_bbcode SET `bbc_replacement` = '<a href=\"$1\"><img src=\"$2\" alt=\"\" class=\"scale\" /></a>' WHERE `sed_bbcode`.`bbc_id` =28 LIMIT 1 ;");
	sed_sql_query("UPDATE $db_pages SET page_html = ''");
	sed_sql_query("UPDATE $db_forum_posts SET fp_html = ''");
	sed_sql_query("UPDATE $db_pm SET pm_html = ''");

}
elseif($action == 'uninstall')
{
	// Uninstall
	sed_sql_query("UPDATE $db_bbcode SET `bbc_replacement` = '<img src=\"$1\" alt=\"\" />' WHERE `sed_bbcode`.`bbc_id` = 27;");
	sed_sql_query("UPDATE $db_bbcode SET `bbc_replacement` = '<a href=\"$1\"><img src=\"$2\" alt=\"\" /></a>' WHERE `sed_bbcode`.`bbc_id` = 28;");
	sed_sql_query("UPDATE $db_pages SET page_html = ''");
	sed_sql_query("UPDATE $db_forum_posts SET fp_html = ''");
	sed_sql_query("UPDATE $db_pm SET pm_html = ''");
}
?>