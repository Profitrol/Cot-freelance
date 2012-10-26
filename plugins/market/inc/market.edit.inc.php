<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'market', 'RWA');
sed_block($usr['auth_write']);

$itemid = sed_import('itemid','G','INT');

// if (!sed_ispro($usr['profile']['user_protodate']) || $usr['isadmin'])
// {
	// header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=1000", '', true));
	// exit;
// }

if ($a=='update')
{
	$sql1 = sed_sql_query("SELECT * FROM sed_market as p
	LEFT JOIN sed_users AS u ON u.user_id=p.item_userid WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$item = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);
	
	/* === Hook === */
	$extp = sed_getextplugins('market.edit.update.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$delete = sed_import('delete','P','BOL');
	
	$u_tmp_name_img = $_FILES['img']['tmp_name'];
	$u_type_img = $_FILES['img']['type'];
	$u_name_img = $_FILES['img']['name'];
	$u_size_img = $_FILES['img']['size'];
	
	$cat = sed_import('cat','P','INT');
	$title = sed_import('title','P','TXT');
	$text = sed_import('text','P','TXT');
	$cost = sed_import('cost','P','TXT');
	
	$country = sed_import('country','P','INT');
	$region = sed_import('region','P','INT');
	$city = sed_import('city','P','INT');
	
	$error_string .= (empty($cat)) ? "Не выбран раздел<br />" : '';
//	$error_string .= (empty($region)) ? "Не выбран регион<br />" : '';
	$error_string .= (empty($title)) ? "Заголовок не может быть пустым<br />" : '';
	$error_string .= ($u_size_img > 1048576) ? "Размер изображения слишком большой" : '';
	
	if (empty($error_string) || $delete)
	{
		if ($delete)
		{	
			if(file_exists($item['item_img']))
				{
				@unlink($item['item_img']);
				}
			
			if(file_exists(sed_thumb_url('market', $item['item_img'])))
				{
				@unlink(sed_thumb_url('market', $item['item_img']));
				}
				
			$sql = sed_sql_query("DELETE FROM sed_market WHERE item_id='$itemid'");

			$sed_mcat = sed_load_mcat();
			sed_cache_store('sed_mcat', $sed_mcat, 3600);
		
			/* === Hook === */
			$extp = sed_getextplugins('market.edit.delete.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('users', "m=details&id=".$item['item_userid']."&u=".$item['user_name']."&tab=market", '', true));
			exit;
		}
		else
		{
			
			$sql = sed_sql_query("SELECT * FROM sed_market WHERE item_id='$itemid' ");
			$row = sed_sql_fetcharray($sql);
			
			if(!empty($u_tmp_name_img))
			{
				$u_name_img  = str_replace("\'",'',$u_name_img );
				$u_name_img  = trim(str_replace("\"",'',$u_name_img ));
				$dotpos = strrpos($u_name_img,".")+1;
				$f_extension = substr($u_name_img, $dotpos, 5);
				$u_newname_img = time().".".$f_extension;
				$img = "datas/market/".$u_newname_img;
				
				if($f_extension=='jpg' || $f_extension=='jpeg' || $f_extension=='gif' || $f_extension=='png')
				{
				
					if(file_exists($row['item_img']))
						{
						@unlink($row['item_img']);
						}
						
					if(file_exists(sed_thumb_url('market', $row['item_img'])))
						{
						@unlink(sed_thumb_url('market', $row['item_img']));
						}	
					
					move_uploaded_file($u_tmp_name_img, $img);
					@chmod($img, 0766);
					
					ResizeImage($img, 'datas/market/', 'datas/market/tmp/', 900, 900, 1);
					unlink($img);
					rename(str_replace('datas/market/', 'datas/market/tmp/', $img), $img);
					unlink(str_replace('datas/market/', 'datas/market/tmp/', $img));
					
					ResizeImage($img, 'datas/market/', 'datas/market/thumbs/', 200, 200, 1);
				}
				else
				{
					$img = $row['item_img'];
				}
			}
			else
			{
				$img = $row['item_img'];
			}
			
			
			$ssql = "UPDATE sed_market SET
				item_cat = ".(int)$cat.",
				item_title = '".sed_sql_prep($title)."',
				item_text = '".sed_sql_prep($text)."',
				item_cost = '".sed_sql_prep($cost)."',
				item_img = '".sed_sql_prep($img)."',
				item_country = ".(int)$country.",
				item_region = ".(int)$region.",
				item_city = ".(int)$city."
				WHERE item_id='$itemid'";
			$sql = sed_sql_query($ssql);
			
			/* === Hook === */
			$extp = sed_getextplugins('market.edit.update.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=market&m=show&itemid=".$itemid, '', true));
			exit;
		}
	}
}

$sql = sed_sql_query("SELECT * FROM sed_market WHERE item_id='$itemid' LIMIT 1");
sed_die(sed_sql_numrows($sql)==0);
$item = sed_sql_fetcharray($sql);

sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);

/* === Hook === */
$extp = sed_getextplugins('market.edit.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$item_form_delete = "<input type=\"radio\" class=\"radio\" name=\"delete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"delete\" value=\"0\" checked=\"checked\" />".$L['No'];

$mskin = sed_skinfile('market.edit', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('market.edit.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("PRDEDIT_ERROR_BODY",$error_string);
	$t->parse("MAIN.PRDEDIT_ERROR");
}

list($select_country, $select_region, $select_city) = sed_select_location('', $item['item_country'], $item['item_region'], $item['item_city']);

$t->assign(array(
	"PRDEDIT_FORM_SEND" => sed_url('plug', "e=market&m=edit&a=update&itemid=".$item['item_id']."&r=".$r),
	"PRDEDIT_FORM_ID" => $item['item_id'],
	"PRDEDIT_FORM_CAT" => sed_selectbox_mcat('cat', $item['item_cat']),
	"PRDEDIT_FORM_TITLE" => $item['item_title'],
	"PRDEDIT_FORM_TEXT" => $item['item_text'],
	"PRDEDIT_FORM_COST" => $item['item_cost'],
	"PRDEDIT_FORM_COUNTRY" => $select_country,
	"PRDEDIT_FORM_REGION" => $select_region,
	"PRDEDIT_FORM_CITY" => $select_city,
	"PRDEDIT_FORM_OLDIMG" => sed_thumb_url('market', $item['item_img']),
	"PRDEDIT_FORM_OWNERID" => "<input type=\"hidden\" class=\"text\" name=\"userid\" value=\"".htmlspecialchars($item['item_userid'])."\" size=\"32\" maxlength=\"24\" />",
	"PRDEDIT_FORM_DELETE" => $item_form_delete
));

/* === Hook === */
$extp = sed_getextplugins('market.edit.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>