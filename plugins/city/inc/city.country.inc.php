<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'city', 'RWA');
sed_block($usr['isadmin']);

$d = sed_import('d','G','INT');
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;
$cfg['plugin']['city']['pagelimit'] = 50;

if (empty($d))
{ $d = '0'; }

if($a == 'add'){
	$title = sed_import('title', 'P', 'TXT');
	
	if(!empty($title)){
		$ssql = "INSERT into sed_country
		(country_name)
		VALUES
		('".sed_sql_prep($title)."')";
  		$sql = sed_sql_query($ssql);
		
		$sed_location = sed_load_location($cfg['countries']);
		sed_cache_store('sed_location', $sed_location, 3600);
	
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city', '', true));
		exit;
	}
}

if($a == 'edit'){
	$title = sed_import('title', 'P', 'TXT');
	
	if(!empty($title)){
		$ssql = "UPDATE sed_country SET
			country_name = '".sed_sql_prep($title)."'
			WHERE country_id='$id'";
		$sql = sed_sql_query($ssql);
		
		$sed_location = sed_load_location($cfg['countries']);
		sed_cache_store('sed_location', $sed_location, 3600);
	
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city', '', true));
		exit;
	}
}

$t = new XTemplate(sed_skinfile('city.country', true));


$sql = sed_sql_query("SELECT COUNT(*) FROM sed_country
WHERE 1");
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_country
WHERE 1 ORDER by country_name ASC
LIMIT $d, ".$cfg['plugin']['city']['pagelimit']);

$pages = sed_pagination(sed_url('admin', "m=tools&p=city"), $d, $totalitems, $cfg['plugin']['city']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('admin', "m=tools&p=city"), $d, $totalitems, $cfg['plugin']['city']['pagelimit'], TRUE);

$t-> assign(array(
	"ADD_URL" => sed_url('admin', 'm=tools&p=city&a=addform'),
	"PAGENAV_PAGES" => $pages,
	));	
	
/* === Hook === */
$extp = sed_getextplugins('country.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	
	$t->assign(array(
		"COUNTRY_ROW_NAME" => $item['country_name'],
		"COUNTRY_ROW_URL" => sed_url('admin', 'm=tools&p=city&n=country&id='.$item['country_id']),
		"COUNTRY_ROW_EDIT_URL" => sed_url('admin', 'm=tools&p=city&a=editform&id='.$item['country_id']),
		));		
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.COUNTRY_ROWS");
	}
	
	
if($a == 'addform'){
	$t->assign(array(
		"ADD_FORM_ACTION_URL" => sed_url('admin', 'm=tools&p=city&a=add', '', true),
		"ADD_FORM_TITLE" => $title,
	));
	$t->parse("MAIN.ADDFORM");
}

if($a == 'editform'){
	$sql = sed_sql_query("SELECT * FROM sed_country WHERE country_id=".$id."");
	$country = sed_sql_fetcharray($sql);
	$t->assign(array(
		"EDIT_FORM_ACTION_URL" => sed_url('admin', 'm=tools&p=city&a=edit&id='.$country['country_id'], '', true),
		"EDIT_FORM_TITLE" => $country['country_name']
	));
	$t->parse("MAIN.EDITFORM");
}

/* === Hook === */
$extp = sed_getextplugins('country.default.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	

?>