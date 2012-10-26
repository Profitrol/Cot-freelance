<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=portfolio
File=rating.portfolio.edit.update.done
Hooks=portfolio.edit.update.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

//require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за перемещение работы в портфолио

// if($item['item_cat'] != $cat){ // Если изменилась категория размещения работы
	
	// if($cat != $item['user_cat'] && $item['item_cat'] == $item['user_cat']){ // Если это не основная специализация, но работа была в основной
	
		// sed_setrating('portfoliodeltocat', $item['item_userid'], $itemid); // Удаляем зачисление за добавление работы в осн. спец-ю.
		
		// $sql = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat WHERE item_userid=".$item['item_userid']."");
		// while($row = sed_sql_fetcharray($sql)){ $uscats[] = $row['item_scat']; }

		// if(in_array($cat,$uscats)){
			// sed_setrating('portfolioaddtoscat', $item['item_userid'], $itemid);
		// }
	// }
	// elseif($cat != $item['user_cat'] && $item['item_cat'] != $item['user_cat']){ // Если это не основная специализация, и работа не была в основной
	
	////	Проверяем старое расположение среди доп. специализаций
		// $sql = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat WHERE item_userid=".$item['item_userid']."");
		// while($row = sed_sql_fetcharray($sql)){ $uscats[] = $row['item_scat']; }

		// if(in_array($item['item_cat'],$uscats)){ // Если работа была в доп. специализации, то удалить начисление за добавление работы в доп. спец-ю.
			// sed_setrating('portfoliodeltoscat', $item['item_userid'], $itemid);
		// }
		
		// if(in_array($cat,$uscats)){ // Если работа перемещена в доп. специализации, то начисление.
			// sed_setrating('portfolioaddtoscat', $item['item_userid'], $itemid);
		// }
	// }
	// if($cat == $item['user_cat']){ // Если это основная специализация, но работа была в доп. спец-и
		
		// $sql = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat WHERE item_userid=".$item['item_userid']."");
		// while($row = sed_sql_fetcharray($sql)){ $uscats[] = $row['item_scat']; }

		// if(in_array($item['item_cat'],$uscats)){
			// sed_setrating('portfoliodeltoscat', $item['item_userid'], $itemid); // Удаляем зачисление за добавление работы в доп. спец-ю.
			// sed_setrating('portfolioaddtocat', $item['item_userid'], $itemid);
		// }
		// else{
			// sed_setrating('portfolioaddtocat', $item['item_userid'], $itemid);
		// }
	// }
	
// }
	
?>