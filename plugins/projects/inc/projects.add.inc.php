<?PHP

defined('SED_CODE') or die('Wrong URL');

$id = sed_import('id','G','INT');
$r = sed_import('r','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'projects', 'RWA');
sed_block($usr['auth_write']);

if(!$usr['isadmin'])
{
	// Запрет публикации проектов для обычных фрилансеров
	if (!sed_ispro($usr['profile']['user_protodate'], $usr['id']) && $usr['profile']['user_maingrp'] == 4)
	{
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=1001", '', true));
		exit;
	}
	// Запрет публикации проектов для обычных работодателей
	if (!sed_ispro($usr['profile']['user_protodate'], $usr['id']) && $usr['profile']['user_maingrp'] == 8 && $cfg['prjlimitforemployers'] > 0)
	{
		// Проверяем количество оставшихся ответов на проекты	
		$countprjofuser = sed_getcountprjofuser($usr['id']);
		if($countprjofuser >= $cfg['prjlimitforemployers']){
			header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=1002", '', true));
			exit;
		}
	}	
}

/* === Hook === */
$extp = sed_getextplugins('projects.add.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='add')
{
	sed_shield_protect();
	
	/* === Hook === */
	$extp = sed_getextplugins('projects.add.add.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$cat = sed_import('cat','P','INT');
	$type = sed_import('type','P','INT');
	$title = sed_import('title','P','TXT');
	$text = sed_import('text','P','TXT');
	$cost = sed_import('cost','P','TXT');
	$country = sed_import('country','P','INT');
	$region = sed_import('region','P','INT');
	$city = sed_import('city','P','INT');
	
	$error_string .= (empty($cat)) ? "Не выбран раздел<br />" : '';
//	$error_string .= (empty($region)) ? "Не выбран регион<br />" : '';
	$error_string .= (empty($title)) ? "Заголовок не может быть пустым<br />" : '';
	$error_string .= (empty($text)) ? "Объявление не может быть пустым<br />" : '';
	
	if (empty($error_string))
	{
			
//		if ($usr['isadmin'] && $cfg['autovalidate'])
//		{
//			$rpublish = sed_import('rpublish', 'P', 'ALP');
//			if ($rpublish == 'OK' )
//			{
//				$item_state = 0;
//			}
//			else
//			{
//				$item_state = 1;
//			}
//		}
//		else
//		{
//			$item_state = 1;
//		}

		$item_state = 1;

		/* === Hook === */
		$extp = sed_getextplugins('projects.add.add.query');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */
		
		$ssql = "INSERT into sed_projects
		(item_userid,
		item_date,
		item_cat,
		item_type,
		item_title,
		item_text,
		item_cost,
		item_country,
		item_region,
		item_city,
		item_state)
		VALUES
		(".(int)$usr['id'].",
		".(int)$sys['now_offset'].",
		".(int)$cat.",
		".(int)$type.",
		'".sed_sql_prep($title)."',
		'".sed_sql_prep($text)."',
		'".sed_sql_prep($cost)."',
		".(int)$country.",
		".(int)$region.",
		".(int)$city.",
		".(int)$item_state.")";
  		$sql = sed_sql_query($ssql);

		$id = sed_sql_insertid();
		
		$sed_pcat = sed_load_pcat();
		sed_cache_store('sed_pcat', $sed_pcat, 3600);
		
		for($i = 0; $i < 10; $i++){
			if($_FILES["file"]['size'][$i] > 0 && $_FILES["file"]['error'][$i] == 0){
				
				$u_tmp_name_file = $_FILES['file']['tmp_name'][$i];
				$u_type_file = $_FILES['file']['type'][$i];
				$u_name_file = $_FILES['file']['name'][$i];
				$u_size_file = $_FILES['file']['size'][$i];
				
				if(!empty($u_tmp_name_file)){
					$u_name_file  = str_replace("\'",'',$u_name_file );
					$u_name_file  = trim(str_replace("\"",'',$u_name_file ));
					$dotpos = strrpos($u_name_file,".")+1;
					$f_extension = substr($u_name_file, $dotpos, 5);
					$u_newname_file = md5(uniqid(rand(),true)).".".$f_extension;
					$file = "datas/attachs/".$u_newname_file;
					
					move_uploaded_file($u_tmp_name_file, $file);
					@chmod($file, 0766);
					
					$sql = sed_sql_query("INSERT INTO sed_attachs (
					att_pid,
					att_file
					) VALUES(
					".(int)$id.",
					'".sed_sql_prep($file)."'
					)");
				}
			}
		}
			
		$r_url = sed_url('plug', "e=projects&m=step2&itemid=".$id, '', true);
			
		/* === Hook === */
		$extp = sed_getextplugins('projects.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */	
		
		header("Location: " . SED_ABSOLUTE_URL . $r_url);
		exit;
	}
}

$mskin = sed_skinfile('projects.add', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('projects.add.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("PRJADD_ERROR_BODY",$error_string);
	$t->parse("MAIN.PRJADD_ERROR");
}

list($select_country, $select_region, $select_city) = sed_select_location('', $country, $region, $city);

$t->assign(array(
	"PRJADD_FORM_SEND" => sed_url('plug', "e=projects&m=add&a=add"),
	"PRJADD_FORM_OWNERID" => $usr['id'],
	"PRJADD_FORM_CAT" => sed_selectbox_pcat('cat', $cat),
	"PRJADD_FORM_TYPE" => sed_selectbox_ptype('type', $type),
	"PRJADD_FORM_COUNTRY" => $select_country,
	"PRJADD_FORM_REGION" => $select_region,
	"PRJADD_FORM_CITY" => $select_city,
	"PRJADD_FORM_TITLE" => $title,
	"PRJADD_FORM_TEXT" => $text,
	"PRJADD_FORM_COST" => $cost,
));

/* === Hook === */
$extp = sed_getextplugins('projects.add.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>