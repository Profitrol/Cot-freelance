<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=whosonline
Name=Who's online
Description=Lists the members online
Version=0.0.3
Date=2009-jan-03
Author=Neocrome & Cotonti Team
Copyright=Partial copyright (c) 2008-2009 Cotonti Team
Notes=BSD License
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
showavatars=01:radio::1:Display avatars of users?
miniavatar_x=02:string::16:The size of a mini-avatars on the axis x, in pixels
miniavatar_y=03:string::16:The size of a mini-avatars on the axis y, in pixels
[END_SED_EXTPLUGIN_CONFIG]
==================== */

/**
 * Lists the members online
 *
 * @package Cotonti
 * @version 0.0.3
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL');

?>