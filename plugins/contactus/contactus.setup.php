<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/contactus/contactus.setup.php
Version=102
Updated=2006-apr-27
Type=Plugin
Author=Neocrome
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=contactus
Name=Обратная связь
Description=
Version=100
Date=2006-apr-27
Author=Nickolay
Copyright=
Notes=
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
email=01:text::info@tkimperia.ru:Available recipients (each on new line and must ending with symbol ; !!!)
subjects=02:text::Письмо с сайта:Subjects (each on new line and must ending with symbol ; !!!)
pagealias=03:string::contacts:Alias of contacts page
[END_SED_EXTPLUGIN_CONFIG]

==================== */

if (!defined('SED_CODE')) { sed_diefatal('Wrong URL.'); }

?>
