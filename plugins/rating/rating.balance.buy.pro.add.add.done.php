<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=balance
File=rating.balance.buy.pro.add.add.done
Hooks=balance.buy.pro.add.add.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за покупку PRO-аккаунта

if(!empty($touser))
	sed_setrating('pro', $user['user_id']);
else
	sed_setrating('pro', $usr['id']);
	
?>