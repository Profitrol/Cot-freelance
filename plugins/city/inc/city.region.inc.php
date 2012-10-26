<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'city', 'RWA');
sed_block($usr['isadmin']);

$d = sed_import('d','G','INT');
$rid = sed_import('rid','G','INT');
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;
$cfg['plugin']['city']['pagelimit'] = 50;

if (empty($d))
{ $d = '0'; }

if($a == 'del'){
	
	$sql = sed_sql_query("DELETE FROM sed_region WHERE region_id='$rid'");
	$sql = sed_sql_query("DELETE FROM sed_city WHERE region_id='$rid'");
	
	$sed_location = sed_load_location($cfg['countries']);
	sed_cache_store('sed_location', $sed_location, 3600);
	
	header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city&n=country&id='.$id, '', true));
	exit;
}


if($a == 'add'){
	$title = sed_import('title', 'P', 'TXT');
	
	if(!empty($title)){
	
		$ssql = "INSERT into sed_region
		(region_name,
		country_id)
		VALUES
		('".sed_sql_prep($title)."',
		".(int)$id.")";
  		$sql = sed_sql_query($ssql);
		
		$sed_location = sed_load_location($cfg['countries']);
		sed_cache_store('sed_location', $sed_location, 3600);
	
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city&n=country&id='.$id, '', true));
		exit;
	}
}

if($a == 'edit'){
	$title = sed_import('title', 'P', 'TXT');
	
	if(!empty($title)){
		$ssql = "UPDATE sed_region SET
			region_name = '".sed_sql_prep($title)."'
			WHERE region_id='$rid'";
		$sql = sed_sql_query($ssql);
		
		$sed_location = sed_load_location($cfg['countries']);
		sed_cache_store('sed_location', $sed_location, 3600);
	
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city&n=country&id='.$id, '', true));
		exit;
	}
}

$t = new XTemplate(sed_skinfile('city.region', true));


$sql = sed_sql_query("SELECT COUNT(*) FROM sed_region
WHERE country_id=".$id);
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_region
WHERE country_id=".$id." ORDER by region_name ASC
LIMIT $d, ".$cfg['plugin']['city']['pagelimit']);

$pages = sed_pagination(sed_url('admin', "m=tools&p=city&n=country&id=".$id), $d, $totalitems, $cfg['plugin']['city']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('admin', "m=tools&p=city&n=country&id=".$id), $d, $totalitems, $cfg['plugin']['city']['pagelimit'], TRUE);

$sql1 = sed_sql_query("SELECT * FROM sed_country
WHERE country_id=".$id."");
$country = sed_sql_fetcharray($sql1);

$t-> assign(array(
	"ADD_URL" => sed_url('admin', 'm=tools&p=city&n=country&id='.$id.'&a=addform'),
	"PAGENAV_PAGES" => $pages,
	"COUNTRY_NAME" => $country['country_name'],
	));	
	
/* === Hook === */
$extp = sed_getextplugins('region.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	
	$t->assign(array(
		"REGION_ROW_NAME" => $item['region_name'],
		"REGION_ROW_URL" => sed_url('admin', 'm=tools&p=city&n=region&id='.$item['region_id']),
		"REGION_ROW_EDIT_URL" => sed_url('admin', 'm=tools&p=city&n=country&id='.$id.'&a=editform&rid='.$item['region_id']),
		"REGION_ROW_DEL_URL" => sed_url('admin', 'm=tools&p=city&n=country&id='.$id.'&a=del&rid='.$item['region_id']),
		));		
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.REGION_ROWS");
	}

if($a == 'addform'){
	$t->assign(array(
		"ADD_FORM_ACTION_URL" => sed_url('admin', 'm=tools&p=city&n=country&id='.$id.'&a=add', '', true),
		"ADD_FORM_TITLE" => $title,
	));
	$t->parse("MAIN.ADDFORM");
}

if($a == 'editform'){
	$sql = sed_sql_query("SELECT * FROM sed_region WHERE region_id=".$rid."");
	$region = sed_sql_fetcharray($sql);
	$t->assign(array(
		"EDIT_FORM_ACTION_URL" => sed_url('admin', 'm=tools&p=city&n=country&id='.$id.'&a=edit&rid='.$region['region_id'], '', true),
		"EDIT_FORM_TITLE" => $region['region_name']
	));
	$t->parse("MAIN.EDITFORM");
}

/* === Hook === */
$extp = sed_getextplugins('region.default.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	

?>