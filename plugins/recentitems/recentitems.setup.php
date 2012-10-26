<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=recentitems
Name=Recent items
Description=Recent pages and topics in forums
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
maxpages=01:select:0,1,2,3,4,5,6,7,8,9,10,15,20,25,30:5:Recent pages displayed
maxtopics=02:select:0,1,2,3,4,5,6,7,8,9,10,15,20,25,30:5:Recent topics in forums displayed
fd=03:select:Standard, Parent only, Subforums with Master Forums, Just Topics:Standard:Topic path display
redundancy=05:select:1,2,3,4,5:2:Redundancy to come over "private topics" problem
[END_SED_EXTPLUGIN_CONFIG]
==================== */

/**
 * Recent pages and topics in forums
 *
 * @package Cotonti
 * @version 0.0.3
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL');

?>