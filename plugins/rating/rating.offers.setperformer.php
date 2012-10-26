<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=project.offers
File=rating.offers.setperformer
Hooks=offers.setperformer
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за выбор исполнителем по проекту

sed_setrating('performer', $userinfo['user_id'], $itemid);

if(!empty($oldperformer['item_userid'])){
	sed_setrating('refuse', $oldperformer['item_userid'], $itemid);
}
	
?>