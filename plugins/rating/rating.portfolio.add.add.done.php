<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=portfolio
File=rating.portfolio.add.add.done
Hooks=portfolio.add.add.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

// расчет рейтинга за добавление работы в портфолио

// *********************************************************************
// if($cat != $usr['profile']['user_cat']){
	// $sql = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat WHERE item_userid=".$usr['id']."");
	// while($row = sed_sql_fetcharray($sql)){ $uscats[] = $row['item_scat']; }

	// if(in_array($cat,$uscats)){
		// sed_setrating('portfolioaddtoscat', $usr['id'], $id);
	// }
// }
// else{
	// sed_setrating('portfolioaddtocat', $usr['id'], $id);
// }
// *********************************************************************


sed_setrating('portfolioaddtocat', $usr['id'], $id);

	
?>