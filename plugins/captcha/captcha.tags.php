<?php
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/captcha/captcha.tags.php
Version=100
Updated=2006-apr-21
Type=Plugin
Author=riptide
Description=Plugin to protect the registration process with a CAPTCHA.
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=captcha
Part=register.tags
File=captcha.tags
Hooks=users.register.tags
Tags=users.register.tpl:{USERS_REGISTER_VERIFYIMG},{USERS_REGISTER_VERIFYINPUT}
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die("Wrong URL."); }

$verifyimg = "<img src='plugins/captcha/inc/captcha.php' width='100' height='20' align='absmiddle' alt='CAPTCHA'>";
$verifyinput = "<input name=\"rverify\" type=\"text\" id=\"rverify\" size=\"10\" maxlength=\"6\">";

$t->assign(array(
    "USERS_REGISTER_VERIFYIMG" => $verifyimg,
    "USERS_REGISTER_VERIFYINPUT" => $verifyinput,
    ));

?>
