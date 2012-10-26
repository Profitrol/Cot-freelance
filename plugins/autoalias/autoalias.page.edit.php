<?PHP
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/autoalias/autoalias.page.edit.php
Version=121
Updated=2008-mar-15
Type=Plugin
Author=Amro (amro@asvu.ru)
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=autoalias
Part=page
File=autoalias.page.edit
Hooks=page.edit.tags
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if(!defined('SED_CODE')) { die('Wrong URL.'); }

$t->assign(array(
    "PAGEEDIT_FORM_TITLE" => "<input type=\"text\" class=\"text\" name=\"rpagetitle\" id=\"rpagetitle\" value=\"".sed_cc($pag['page_title'])."\" size=\"56\" onchange=\"genSEF(this, document.forms['update'].rpagealias,1)\" onkeyup=\"genSEF(this,document.forms['update'].rpagealias,1)\" maxlength=\"255\" />",
    "PAGEEDIT_FORM_ALIAS" => "<input type=\"text\" class=\"text\" name=\"rpagealias\" id=\"rpagealias\" value=\"".sed_cc($pag['page_alias'])."\" size=\"16\" maxlength=\"255\" />"
 ));

?>