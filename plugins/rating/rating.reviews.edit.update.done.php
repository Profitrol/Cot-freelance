<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=reviews
File=rating.reviews.edit.update.done
Hooks=reviews.edit.update.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за отзыв

if($row['item_score'] < $score){
	sed_setrating('reviewplus', $row['item_touserid']);
}
elseif($row['item_score'] > $score){
	sed_setrating('reviewminus', $row['item_touserid']);
}
	
?>