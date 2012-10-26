<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=balance
Name=Мой счет
Description=
Version=
Date=
Author=
Copyright=
Notes=
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=RW
Lock_members=12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
mrh_login=01:string::demo:mrh_login
mrh_pass1=02:string::demo:mrh_pass1
mrh_pass2=03:string::demo:mrh_pass2
testmode=04:radio::1:Включить тестовый режим?
cost_pro=05:string::500:Стоимость PRO-аккаунта за месяц
cost_top=06:string::200:Стоимость платного размещения на главной за месяц
cost_prjtop=07:string::200:Стоимость платного размещения проекта за день
[END_SED_EXTPLUGIN_CONFIG]
==================== */

defined('SED_CODE') or die('Wrong URL');

?>