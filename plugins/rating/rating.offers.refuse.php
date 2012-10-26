<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=project.offers
File=rating.offers.refuse
Hooks=offers.refuse
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за отказ по проекту

sed_setrating('refuse', $userinfo['user_id'], $itemid);
	
?>