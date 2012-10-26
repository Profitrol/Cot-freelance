<?PHP

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'city', 'RWA');
sed_block($usr['isadmin']);

$d = sed_import('d','G','INT');
$cid = sed_import('cid','G','INT');
$ajax = sed_import('ajax', 'G', 'INT');
$ajax = empty($ajax) ? 0 : (int) $ajax;
$cfg['plugin']['city']['pagelimit'] = 50;

if (empty($d))
{ $d = '0'; }


if($a == 'del'){

	$sql = sed_sql_query("DELETE FROM sed_city WHERE city_id='$cid'");
	
	$sed_location = sed_load_location($cfg['countries']);
	sed_cache_store('sed_location', $sed_location, 3600);
	
	header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city&n=region&id='.$id, '', true));
	exit;
}

if($a == 'add'){
	$title = sed_import('title', 'P', 'TXT');
	$list = sed_import('list', 'P', 'TXT');
	$list = sed_parse($list);
	$cities = explode('<br />', $list);
	
	if(!empty($title) || count($cities) > 0){
	
		$sql = sed_sql_query("SELECT * FROM sed_region WHERE region_id=".$id."");
		$region = sed_sql_fetcharray($sql);
		
		if(!empty($title)){
			
			$ssql = "INSERT into sed_city
			(city_name,
			country_id,
			region_id)
			VALUES
			('".sed_sql_prep($title)."',
			".(int)$region['country_id'].",
			".(int)$id.")";
			$sql = sed_sql_query($ssql);
		}
		elseif(count($cities) > 0){
			foreach($cities as $ctitle){
				if(!empty($ctitle)){
					$ssql = "INSERT into sed_city
					(city_name,
					country_id,
					region_id)
					VALUES
					('".sed_sql_prep($ctitle)."',
					".(int)$region['country_id'].",
					".(int)$id.")";
					$sql = sed_sql_query($ssql);
				}
			}
		}
		
		$sed_location = sed_load_location($cfg['countries']);
		sed_cache_store('sed_location', $sed_location, 3600);
	
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city&n=region&id='.$id, '', true));
		exit;
	}
}

if($a == 'edit'){
	$title = sed_import('title', 'P', 'TXT');
	
	if(!empty($title)){
		$ssql = "UPDATE sed_city SET
			city_name = '".sed_sql_prep($title)."'
			WHERE city_id='$cid'";
		$sql = sed_sql_query($ssql);
		
		$sed_location = sed_load_location($cfg['countries']);
		sed_cache_store('sed_location', $sed_location, 3600);
	
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=city&n=region&id='.$id, '', true));
		exit;
	}
}

$t = new XTemplate(sed_skinfile('city.city', true));


$sql = sed_sql_query("SELECT COUNT(*) FROM sed_city
WHERE region_id=".$id);
$totalitems = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_city
WHERE region_id=".$id." ORDER by city_name ASC
LIMIT $d, ".$cfg['plugin']['city']['pagelimit']);

$pages = sed_pagination(sed_url('admin', "m=tools&p=city&n=region&id=".$id), $d, $totalitems, $cfg['plugin']['city']['pagelimit']);
list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('admin', "m=tools&p=city&n=region&id=".$id), $d, $totalitems, $cfg['plugin']['city']['pagelimit'], TRUE);

$sql1 = sed_sql_query("SELECT * FROM sed_region as r
LEFT JOIN sed_country as country ON country.country_id=r.country_id
WHERE region_id=".$id."");
$region = sed_sql_fetcharray($sql1);
		
$t-> assign(array(
	"ADD_URL" => sed_url('admin', 'm=tools&p=city&n=region&id='.$id.'&a=addform'),
	"PAGENAV_PAGES" => $pages,
	"COUNTRY_NAME" => $region['country_name'],
	"REGION_NAME" => $region['region_name']
	));	
	
/* === Hook === */
$extp = sed_getextplugins('city.default.loop');
/* ===== */	
	
while($item = sed_sql_fetcharray($sql)){
	$jj++;
	
	$t->assign(array(
		"CITY_ROW_NAME" => $item['city_name'],
		"CITY_ROW_EDIT_URL" => sed_url('admin', 'm=tools&p=city&n=region&id='.$id.'&a=editform&cid='.$item['city_id']),
		"CITY_ROW_DEL_URL" => sed_url('admin', 'm=tools&p=city&n=region&id='.$id.'&a=del&cid='.$item['city_id']),
		));		
		
	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
		
	$t->parse("MAIN.CITY_ROWS");
	}

if($a == 'addform'){
	$t->assign(array(
		"ADD_FORM_ACTION_URL" => sed_url('admin', 'm=tools&p=city&n=region&id='.$id.'&a=add', '', true),
		"ADD_FORM_TITLE" => $title,
	));
	$t->parse("MAIN.ADDFORM");
}

if($a == 'editform'){
	$sql = sed_sql_query("SELECT * FROM sed_city WHERE city_id=".$cid."");
	$city = sed_sql_fetcharray($sql);
	$t->assign(array(
		"EDIT_FORM_ACTION_URL" => sed_url('admin', 'm=tools&p=city&n=region&id='.$id.'&a=edit&cid='.$city['city_id'], '', true),
		"EDIT_FORM_TITLE" => $city['city_name']
	));
	$t->parse("MAIN.EDITFORM");
}

/* === Hook === */
$extp = sed_getextplugins('city.default.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */	

?>