<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=market
Part=homepage
File=market.index
Hooks=index.tags
Tags=index.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }


$sql = sed_sql_query("SELECT * FROM sed_market AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_state=0 
".$query_string."
ORDER by item_date DESC
LIMIT 4");

	
/* === Hook === */
$extp = sed_getextplugins('market.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	$t->assign(array(
		"PRD_ROW_ODDEVEN" => sed_build_oddeven($jj),
		"PRD_ROW_TITLE" => $item['item_title'],
		"PRD_ROW_TEXT" => $item['item_text'],
		"PRD_ROW_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRD_ROW_IMG" => $item['item_img'],
		"PRD_ROW_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('market', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
		"PRD_ROW_URL" =>  sed_url('plug', 'e=market&m=show&itemid='.$item['item_id']),
		"PRD_ROW_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"PRD_ROW_OWNER" => sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']),
		"PRD_ROW_DATE" => date('d.m.y H:i', $item['item_date']),
		));		
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.MARKET.PRD_ROWS");
	}
	
$t->parse("MAIN.MARKET");	
	
	
?>