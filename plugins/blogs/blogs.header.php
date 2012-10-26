<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=blogs
Part=header
File=blogs.header
Hooks=header.main
Tags=
Order=0
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL.');



if($e == 'blogs')
{
	$id = sed_import('id','G','INT');
	$c = sed_import('c','G','INT');
	
	if(!empty($id)){
		$sql = sed_sql_query("SELECT * FROM sed_blogs WHERE item_id=".$id."");
		sed_notfound(sed_sql_numrows($sql)==0);
	}
	
	$title_tags[] = array('{MAINTITLE}', '{DESCRIPTION}', '{SUBTITLE}');
	$title_tags[] = array('%1$s', '%2$s', '%3$s');
	
	if(!empty($c))
	{
		$out['subtitle'] = ($sed_bcat[$c]['mtitle']) ? $sed_bcat[$c]['mtitle'] : $sed_bcat[$c]['title'];
		$out['meta_desc'] = (!empty($sed_bcat[$c]['mdesc'])) ? $sed_bcat[$c]['mdesc'] : '';
		$out['meta_keywords'] = (!empty($sed_bcat[$c]['mkey'])) ? $sed_bcat[$c]['mkey'] : '';
	}
	else
	{
		$out['subtitle'] = $skinlang['blogs']['blogs'];
		//$out['meta_desc'] = '';
	}
	
	if(!empty($id))
	{

		$sql = sed_sql_query("SELECT * FROM sed_blogs WHERE item_state=0 AND item_id=".$id."");
		$item = sed_sql_fetcharray($sql);
		
		//$out['meta_desc'] = sed_cutstring(sed_cc($item['item_text']), 250);
		//$out['meta_keywords']='';

		$out['subtitle'] = $item['item_title'].' - Блог';

	}
	
	$title_data = array($cfg['maintitle'], $cfg['subtitle'], $out['subtitle']);
	$out['fulltitle'] = sed_title('title_header', $title_tags, $title_data);
	
}


?>