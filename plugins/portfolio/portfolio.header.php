<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=portfolio
Part=header
File=portfolio.header
Hooks=header.main
Tags=
Order=0
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL.');

if($e == 'portfolio')
{
	$itemid = sed_import('itemid','G','INT');
	$c = sed_import('c','G','INT');
	
	if(!empty($itemid)){
		$sql = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_id=".$itemid."");
		sed_notfound(sed_sql_numrows($sql)==0);
	}
	
	$region = sed_import('region','G','INT');
	$slocation = sed_import('slocation','G','INT');
	
	$title_tags[] = array('{MAINTITLE}', '{DESCRIPTION}', '{SUBTITLE}');
	$title_tags[] = array('%1$s', '%2$s', '%3$s');
	
	if(!empty($c))
	{
		$out['subtitle'] = $sed_mcat[$c]['title'].' ';
	}
	else
	{
		$out['subtitle'] = '';
	}
	
	$out['subtitle'] .= (!empty($region) && !empty($slocation)) ? ' - '.$sed_location[$region]['loc'][$slocation] : '';
	$out['subtitle'] .= (!empty($region)) ? ' - '.$sed_location[$region]['name'] : '';
	
	
	if(!empty($itemid))
	{
		$sql = sed_sql_query("SELECT * FROM sed_portfolio
		WHERE item_id='$itemid'");
		$item = sed_sql_fetcharray($sql);
		
		$out['subtitle'] = $item['item_title'];
		$out['subtitle'] .= (!empty($item['item_region']) && !empty($item['item_location'])) ? ' - '.$sed_location[$item['item_region']]['loc'][$item['item_location']] : '';
		$out['subtitle'] .= (!empty($item['item_region'])) ? ' - '.$sed_location[$item['item_region']]['name'] : '';
		
		$out['meta_desc'] = sed_cutstring($item['item_text'], 250);
	}
	
	$title_data = array($cfg['maintitle'], $cfg['subtitle'], $out['subtitle']);
	$out['fulltitle'] = sed_title('title_header', $title_tags, $title_data);
	
}

?>