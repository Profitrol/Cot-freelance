<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=portfolio
File=rating.portfolio.edit.delete.done
Hooks=portfolio.edit.delete.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за удаление работы из портфолио

// *********************************************************************
// if($item['item_cat'] != $item['user_cat']){ // ≈сли изменилась категори€ размещени€ работы

	// $sql = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat WHERE item_userid=".$item['item_userid']."");
	// while($row = sed_sql_fetcharray($sql)){ $uscats[] = $row['item_scat']; }

	// if(in_array($item['item_cat'],$uscats)){
		// sed_setrating('portfoliodeltoscat', $item['item_userid'], $itemid);
	// }
	
// }
// else{
	// sed_setrating('portfoliodeltocat', $item['item_userid'], $itemid);
// }
// *********************************************************************


sed_setrating('portfoliodeltocat', $item['item_userid'], $itemid);
	
?>