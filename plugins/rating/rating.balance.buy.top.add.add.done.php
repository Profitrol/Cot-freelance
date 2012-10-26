<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=balance
File=rating.balance.buy.top.add.add.done
Hooks=balance.buy.top.add.add.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за покупку места на главной

sed_setrating('top', $usr['id']);
	
?>