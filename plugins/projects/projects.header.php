<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=projects
Part=header
File=projects.header
Hooks=header.main
Tags=
Order=0
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL.');

if($e == 'projects')
{
	$itemid = sed_import('itemid','G','INT');
	$c = sed_import('c','G','INT');
	
	if(!empty($itemid)){
		$sql = sed_sql_query("SELECT * FROM sed_projects WHERE item_id=".$itemid."");
		sed_notfound(sed_sql_numrows($sql)==0);
	}
	
	$country = sed_import('country','G','INT');
	$region = sed_import('region','G','INT');
	$city = sed_import('city','G','INT');
	
	$title_tags[] = array('{MAINTITLE}', '{DESCRIPTION}', '{SUBTITLE}');
	$title_tags[] = array('%1$s', '%2$s', '%3$s');
	
	if(!empty($c))
	{
		$out['subtitle'] = ($sed_pcat[$c]['mtitle']) ? $sed_pcat[$c]['mtitle'] : $sed_pcat[$c]['title'];
		$out['meta_desc'] = (!empty($sed_pcat[$c]['mdesc'])) ? $sed_pcat[$c]['mdesc'] : '';
		$out['meta_keywords'] = (!empty($sed_pcat[$c]['mkey'])) ? $sed_pcat[$c]['mkey'] : '';
	}
	else
	{
		$out['subtitle'] = $skinlang['projects']['projects'];
		$out['meta_desc'] = '';
		$out['meta_keywords'] = '';
	}
	
	$out['subtitle'] .= (!empty($country)) ? ' - '.  sed_getcountrybyid($country) : '';
	$out['subtitle'] .= (!empty($city)) ? ' - '.  sed_getcitybyid($city) : '';
	$out['subtitle'] .= (!empty($region)) ? ' - '.  sed_getregionbyid($region) : '';
	
	
	if(!empty($itemid))
	{
		$sql = sed_sql_query("SELECT * FROM sed_projects
		WHERE item_id='$itemid'");
		$item = sed_sql_fetcharray($sql);

		$out['subtitle'] = $item['item_title'];
		$out['subtitle'] .= ' - '.$sed_pcat[$item['item_cat']]['title'];
		$out['subtitle'] .= ' - '.$sed_ptype[$item['item_type']]['title'];
		$out['subtitle'] .= (!empty($item['item_country'])) ? ' - '.sed_getcountrybyid($item['item_country']) : '';
		$out['subtitle'] .= (!empty($item['item_city'])) ? ' - '.sed_getcitybyid($item['item_city']) : '';
		$out['subtitle'] .= (!empty($item['item_region'])) ? ' - '.sed_getregionbyid($item['item_region']) : '';

		$out['meta_desc'] = sed_cutstring($item['item_text'], 250);

		$out['meta_keywords'] = '';

	}
	
	$title_data = array($cfg['maintitle'], $cfg['subtitle'], $out['subtitle']);
	$out['fulltitle'] = sed_title('title_header', $title_tags, $title_data);
	
}

?>