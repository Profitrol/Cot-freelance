<?PHP
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/autoalias/autoalias.header.php
Version=121
Updated=2008-mar-15
Type=Plugin
Author=Amro (amro@asvu.ru)
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=autoalias
Part=page
File=autoalias.header
Hooks=header.tags
Tags=header.tpl:{HEADER_AUTOALIAS}
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]
==================== */
if(!defined('SED_CODE')) { die('Wrong URL.'); }

$t->assign(array(
    "HEADER_AUTOALIAS" => "<script type=\"text/javascript\" src=\"{$cfg['plugins_dir']}/autoalias/autoalias.js\"></script>"
));

?>