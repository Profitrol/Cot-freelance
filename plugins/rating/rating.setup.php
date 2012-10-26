<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Name=Система рейтингов
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
pro=01:string::0.2:За покупку PRO-аккаунта
top=02:string::0.2:За покупку платного места на главной
performer=03:string::1:За выбор исполнителем по проекту
refuse=04:string::-1:За отказ по проекту
reviewplus=05:string::20:За положительные отзыв
reviewminus=06:string::-20:За отрицательный отзыв
auth=07:string::1:За посещение сайта
portfolioaddtocat=08:string::10:За размещение работы в портфолио
[END_SED_EXTPLUGIN_CONFIG]
==================== */

defined('SED_CODE') or die('Wrong URL');

?>