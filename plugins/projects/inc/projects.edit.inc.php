<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'projects', 'RWA');
sed_block($usr['auth_write']);

$itemid = sed_import('itemid','G','INT');
$attid = sed_import('attid','G','INT');

if ($a=='update')
{
	$sql1 = sed_sql_query("SELECT item_userid FROM sed_projects WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$row1 = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $row1['item_userid'] && $usr['id'] != 0);
	
	/* === Hook === */
	$extp = sed_getextplugins('projects.edit.update.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$delete = sed_import('delete','P','BOL');

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
	
	if (empty($error_string) || $rprojectsdelete)
	{
		if ($delete)
		{
			$sql = sed_sql_query("SELECT * FROM sed_projects WHERE item_id='$itemid' LIMIT 1");

			if ($row = sed_sql_fetchassoc($sql))
			{	
				
				$sql = sed_sql_query("DELETE FROM sed_projects WHERE item_id='$itemid'");
				
				$sql = sed_sql_query("DELETE FROM sed_offers WHERE item_pid='$itemid'");
				
				$sql = sed_sql_query("DELETE FROM sed_projects_posts WHERE post_pid='$itemid'");
				
				$sql_att = sed_sql_query("SELECT * FROM sed_attachs WHERE att_pid='$itemid'");
				while($att = sed_sql_fetcharray($sql_att)){
					if(file_exists($att['att_file'])){
						@unlink($att['att_file']);
					}
				}
				$sql = sed_sql_query("DELETE FROM sed_attachs WHERE att_pid='$itemid'");
				
				$sed_pcat = sed_load_pcat();
				sed_cache_store('sed_pcat', $sed_pcat, 3600);
	
				/* === Hook === */
				$extp = sed_getextplugins('projects.edit.delete.done');
				if (is_array($extp))
				{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
				/* ===== */
				
				header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', 'e=projects', '', true));
				exit;
			}
		}
		else
		{

			$sql = sed_sql_query("SELECT * FROM sed_projects WHERE item_id='$itemid' ");
			$row = sed_sql_fetcharray($sql);
				
//			if ($usr['isadmin'] && $cfg['autovalidate'])
//			{
//				$rpublish = sed_import('rpublish', 'P', 'ALP');
//				if ($rpublish == 'OK' )
//				{
//					$item_state = 0;
//				}
//				else
//				{
//					$item_state = 1;
//				}
//			}
//			else
//			{
//				$item_state = 1;
//			}
			
			$item_state = 1;
			
			$ssql = "UPDATE sed_projects SET
				item_cat = ".(int)$cat.",
				item_type = ".(int)$type.",
				item_title = '".sed_sql_prep($title)."',
				item_text = '".sed_sql_prep($text)."',
				item_cost = '".sed_sql_prep($cost)."',
				item_country = ".(int)$country.",
				item_region = ".(int)$region.",
				item_city = ".(int)$city.",
				item_state = $item_state
				WHERE item_id='$itemid'";
			$sql = sed_sql_query($ssql);
			
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
						".(int)$itemid.",
						'".sed_sql_prep($file)."'
						)");
					}
				}
			}
			
			/* === Hook === */
			$extp = sed_getextplugins('projects.edit.update.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=step2&itemid=".$itemid, '', true));
			exit;
		}
	}
}

if ($a=='delattach' && !empty($attid)){
	
	$sqlattachs = sed_sql_query("SELECT * FROM sed_attachs WHERE att_pid=".$itemid." AND att_id=".$attid."");
	$attach = sed_sql_fetcharray($sqlattachs);
	
	if(file_exists($attach['att_file'])){
		@unlink($attach['att_file']);
	}
	
	$sql = sed_sql_query("DELETE FROM sed_attachs WHERE att_pid=".$itemid." AND att_id=".$attid."");
	
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=edit&itemid=".$itemid, '', true));
	exit;
}

if ($a=='public')
{
	$sql1 = sed_sql_query("SELECT item_userid FROM sed_projects WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$item = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);

			
	$ssql = "UPDATE sed_projects SET
		item_state = 0
		WHERE item_id='$itemid'";
	$sql = sed_sql_query($ssql);
	
	$sed_pcat = sed_load_pcat();
	sed_cache_store('sed_pcat', $sed_pcat, 3600);
	
	if(!$usr['isadmin']){

		$rsubject = "Ваш проект опубликован";
		$rbody = "Здравствуйте, ".$item['user_name'].".\nВаш проект \"".sed_sql_prep($item['item_title'])."\" был опубликован на сайте ".SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true)."\n";
		
		sed_mail ($item['user_email'], $rsubject, $rbody);

	}	
	
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true));
	exit;
}

if ($a=='hide')
{
	$sql1 = sed_sql_query("SELECT item_userid FROM sed_projects WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$row1 = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $row1['item_userid'] && $usr['id'] != 0);

			
	$ssql = "UPDATE sed_projects SET
		item_state = 1
		WHERE item_id='$itemid'";
	$sql = sed_sql_query($ssql);
	
	$sed_pcat = sed_load_pcat();
	sed_cache_store('sed_pcat', $sed_pcat, 3600);
	
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true));
	exit;
}

$sql = sed_sql_query("SELECT * FROM sed_projects WHERE item_id='$itemid' LIMIT 1");
sed_die(sed_sql_numrows($sql)==0);
$item = sed_sql_fetcharray($sql);

sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);

/* === Hook === */
$extp = sed_getextplugins('projects.edit.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$item_form_delete = "<input type=\"radio\" class=\"radio\" name=\"delete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"delete\" value=\"0\" checked=\"checked\" />".$L['No'];

$mskin = sed_skinfile('projects.edit', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('projects.edit.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("PRJEDIT_ERROR_BODY",$error_string);
	$t->parse("MAIN.PRJEDIT_ERROR");
}

list($select_country, $select_region, $select_city) = sed_select_location('', $item['item_country'], $item['item_region'], $item['item_city']);

$t->assign(array(
	"PRJEDIT_FORM_SEND" => sed_url('plug', "e=projects&m=edit&a=update&itemid=".$item['item_id']."&r=".$r),
	"PRJEDIT_FORM_ID" => $item['item_id'],
	"PRJEDIT_FORM_CAT" => sed_selectbox_pcat('cat', $item['item_cat']),
	"PRJEDIT_FORM_TYPE" => sed_selectbox_ptype('type', $item['item_type']),
	"PRJEDIT_FORM_COUNTRY" => $select_country,
	"PRJEDIT_FORM_REGION" => $select_region,
	"PRJEDIT_FORM_CITY" => $select_city,
	"PRJEDIT_FORM_TITLE" => $item['item_title'],
	"PRJEDIT_FORM_TEXT" => $item['item_text'],
	"PRJEDIT_FORM_COST" => $item['item_cost'],
	"PRJEDIT_FORM_STATE" => $item['item_state'],
	"PRJEDIT_FORM_OWNERID" => "<input type=\"hidden\" class=\"text\" name=\"userid\" value=\"".htmlspecialchars($item['item_userid'])."\" size=\"32\" maxlength=\"24\" />",
	"PRJEDIT_FORM_DELETE" => $item_form_delete
));

$sqlattachs = sed_sql_query("SELECT * FROM sed_attachs WHERE att_pid=".$item['item_id']."");
$countfiles = 0;
while($att = sed_sql_fetcharray($sqlattachs)){
	$t->assign(array(
		"ATT_ID" => $att['att_id'],
		"ATT_FILE" => $att['att_file'],
		"ATT_DEL_URL" => sed_url('plug', 'e=projects&m=edit&itemid='.$item['item_id'].'&attid='.$att['att_id'].'&a=delattach')
	));
	$t->parse("MAIN.ATTACHS.ATT_ROWS");
	$countfiles++;
}
if($countfiles > 0) $t->parse("MAIN.ATTACHS");

/* === Hook === */
$extp = sed_getextplugins('projects.edit.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>