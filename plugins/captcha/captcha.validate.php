<?php
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/captcha/captcha.validate.php
Version=100
Updated=2006-apr-21
Type=Plugin
Author=riptide
Description=Plugin to protect the registration process with a CAPTCHA.
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=captcha
Part=validation
File=captcha.validate
Hooks=users.register.add.first
Tags=
Order=10
[END_SED_EXTPLUGIN]

==================== */

$rverify  = sed_import('rverify','P','TXT');

require("inc/php-captcha.inc.php");
require('lang/captcha.'.$usr['lang'].'.lang.php');

if (!PhpCaptcha::Validate($rverify))
	{
	$error_string .= $L['plu_verification_failed']."<br />";
	}

?>
