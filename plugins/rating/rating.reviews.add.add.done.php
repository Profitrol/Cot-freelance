<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=reviews
File=rating.reviews.add.add.done
Hooks=reviews.add.add.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за отзыв

if($score < 0){
	sed_setrating('reviewminus', $id);
}
elseif($score > 0){
	sed_setrating('reviewplus', $id);
}
	
?>