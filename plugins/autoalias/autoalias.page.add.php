<?PHP
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/autoalias/autoalias.page.add.php
Version=121
Updated=2008-mar-15
Type=Plugin
Author=Amro (amro@asvu.ru)
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=autoalias
Part=page
File=autoalias.page.add
Hooks=page.add.tags
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if(!defined('SED_CODE')) { die('Wrong URL.'); }

$t->assign(array(
    "PAGEADD_FORM_TITLE" => "<input type=\"text\" class=\"text\" name=\"newpagetitle\" id=\"newpagetitle\" value=\"".sed_cc($newpagetitle)."\" size=\"56\" onchange=\"genSEF(this, document.forms['newpage'].newpagealias,1)\" onkeyup=\"genSEF(this,document.forms['newpage'].newpagealias,1)\" maxlength=\"255\" />",
    "PAGEADD_FORM_ALIAS" => "<input type=\"text\" class=\"text\" name=\"newpagealias\" id=\"newpagealias\" value=\"".sed_cc($newpagealias)."\" size=\"16\" maxlength=\"255\" />"
));

?>