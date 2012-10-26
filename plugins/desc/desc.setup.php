<?php

/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=desc
Name=Description
Description= Плагин автоматически прописывает Meta Description для главной
Version=1.00
Date=01.02.2010
Author=
Copyright=
Notes=
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=RW
Lock_members=12345
[END_SED_EXTPLUGIN]
[BEGIN_SED_EXTPLUGIN_CONFIG]
desc_index=1:text:::Текст Description для главной
key_index=2:text:::Key для главной через запятую
[END_SED_EXTPLUGIN_CONFIG]
==================== */
if ( !defined('SED_CODE') ) { die("Wrong URL."); }
if($action == 'install')
{
}
elseif($action == 'uninstall')
{

}

?>