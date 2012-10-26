<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'portfolio', 'RWA');
sed_block($usr['auth_write']);

$itemid = sed_import('itemid','G','INT');

if ($a=='update')
{
	$sql1 = sed_sql_query("SELECT * FROM sed_portfolio as p
	LEFT JOIN sed_users AS u ON u.user_id=p.item_userid WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$item = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);
	
	/* === Hook === */
	$extp = sed_getextplugins('portfolio.edit.update.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$delete = sed_import('delete','P','BOL');
	
	$u_tmp_name_img = $_FILES['img']['tmp_name'];
	$u_type_img = $_FILES['img']['type'];
	$u_name_img = $_FILES['img']['name'];
	$u_size_img = $_FILES['img']['size'];
	
	$title = sed_import('title','P','TXT');
	$text = sed_import('text','P','TXT');
	$cat = sed_import('cat','P','INT');
	
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
			
			if(file_exists(sed_thumb_url('portfolio', $item['item_img'])))
				{
				@unlink(sed_thumb_url('portfolio', $item['item_img']));
				}
				
			$sql = sed_sql_query("DELETE FROM sed_portfolio WHERE item_id='$itemid'");


			/* === Hook === */
			$extp = sed_getextplugins('portfolio.edit.delete.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('users', "m=details&id=".$item['item_userid']."&u=".$item['user_name']."&tab=portfolio", '', true));
			exit;
		}
		else
		{
			
			$sql = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_id='$itemid' ");
			$row = sed_sql_fetcharray($sql);
			
			if(!empty($u_tmp_name_img))
			{
				$u_name_img  = str_replace("\'",'',$u_name_img );
				$u_name_img  = trim(str_replace("\"",'',$u_name_img ));
				$dotpos = strrpos($u_name_img,".")+1;
				$f_extension = substr($u_name_img, $dotpos, 5);
				$u_newname_img = time().".".$f_extension;
				$img = "datas/portfolio/".$u_newname_img;
				
				if($f_extension=='jpg' || $f_extension=='jpeg' || $f_extension=='gif' || $f_extension=='png')
				{
				
					if(file_exists($row['item_img']))
						{
						@unlink($row['item_img']);
						}
						
					if(file_exists(sed_thumb_url('portfolio', $row['item_img'])))
						{
						@unlink(sed_thumb_url('portfolio', $row['item_img']));
						}	
					
					move_uploaded_file($u_tmp_name_img, $img);
					@chmod($img, 0766);
					
					ResizeImage($img, 'datas/portfolio/', 'datas/portfolio/tmp/', 900, 900, 2);
					unlink($img);
					rename(str_replace('datas/portfolio/', 'datas/portfolio/tmp/', $img), $img);
					unlink(str_replace('datas/portfolio/', 'datas/portfolio/tmp/', $img));
					
					ResizeImage($img, 'datas/portfolio/', 'datas/portfolio/thumbs/', 200, 200, 1);
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
			
			
			$ssql = "UPDATE sed_portfolio SET
				item_cat = ".(int)$cat.",
				item_title = '".sed_sql_prep($title)."',
				item_text = '".sed_sql_prep($text)."',
				item_img = '".sed_sql_prep($img)."'
				WHERE item_id='$itemid'";
			$sql = sed_sql_query($ssql);
			
			/* === Hook === */
			$extp = sed_getextplugins('portfolio.edit.update.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=portfolio&m=show&itemid=".$itemid, '', true));
			exit;
		}
	}
}

$sql = sed_sql_query("SELECT * FROM sed_portfolio WHERE item_id='$itemid' LIMIT 1");
sed_die(sed_sql_numrows($sql)==0);
$item = sed_sql_fetcharray($sql);

sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);

/* === Hook === */
$extp = sed_getextplugins('portfolio.edit.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$item_form_delete = "<input type=\"radio\" class=\"radio\" name=\"delete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"delete\" value=\"0\" checked=\"checked\" />".$L['No'];

$mskin = sed_skinfile('portfolio.edit', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('portfolio.edit.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("PTFEDIT_ERROR_BODY",$error_string);
	$t->parse("MAIN.PTFEDIT_ERROR");
}

$t->assign(array(
	"PTFEDIT_FORM_SEND" => sed_url('plug', "e=portfolio&m=edit&a=update&itemid=".$item['item_id']."&r=".$r),
	"PTFEDIT_FORM_ID" => $item['item_id'],
	"PTFEDIT_FORM_CAT" => sed_selectbox_fcat('cat', $item['item_cat']),
	"PTFEDIT_FORM_TITLE" => $item['item_title'],
	"PTFEDIT_FORM_TEXT" => $item['item_text'],
	"PTFEDIT_FORM_OLDIMG" => sed_thumb_url('portfolio', $item['item_img']),
	"PTFEDIT_FORM_OWNERID" => "<input type=\"hidden\" class=\"text\" name=\"userid\" value=\"".htmlspecialchars($item['item_userid'])."\" size=\"32\" maxlength=\"24\" />",
	"PTFEDIT_FORM_DELETE" => $item_form_delete
));

/* === Hook === */
$extp = sed_getextplugins('portfolio.edit.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>