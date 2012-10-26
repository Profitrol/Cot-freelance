<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'blogs', 'RWA');
sed_block($usr['auth_write']);

$itemid = sed_import('itemid','G','INT');

if ($a=='update')
{
	$sql1 = sed_sql_query("SELECT * FROM sed_blogs WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$row1 = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $row1['item_userid'] && $usr['id'] != 0);
	
	/* === Hook === */
	$extp = sed_getextplugins('blogs.edit.update.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$rblogsdelete = sed_import('rblogsdelete','P','BOL');
	
	$cat = sed_import('cat','P','INT');
	
	$rblogstitle = sed_import('rblogstitle','P','HTM');
	$rblogstext = sed_import('rblogstext','P','HTM');
	
	$error_string .= (empty($rblogstitle)) ? "Заголовок не может быть пустым<br />" : '';
	$error_string .= (empty($rblogstext)) ? "Сообщение не может быть пустым<br />" : '';
	
	if (empty($error_string) || $rblogsdelete)
	{
		if ($rblogsdelete)
		{
			$sql = sed_sql_query("SELECT * FROM sed_blogs WHERE item_id='$itemid' LIMIT 1");

			if ($row = sed_sql_fetchassoc($sql))
			{	
				
				$sql = sed_sql_query("DELETE FROM sed_blogs WHERE item_id='$itemid'");
				
				$sed_bcat = sed_load_bcat();
				sed_cache_store('sed_bcat', $sed_bcat, 3600);
			
				/* === Hook === */
				$extp = sed_getextplugins('blogs.edit.delete.done');
				if (is_array($extp))
				{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
				/* ===== */
				
				header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', 'e=blogs', '', true));
				exit;
			}
		}
		else
		{

			$sql = sed_sql_query("SELECT * FROM sed_blogs WHERE item_id='$itemid' ");
			$row = sed_sql_fetcharray($sql);
				
			if ($usr['isadmin'] && $cfg['autovalidate'])
			{
				$rpublish = sed_import('rpublish', 'P', 'ALP');
				if ($rpublish == 'OK' )
				{
					$item_state = 0;
				}
				else
				{
					$item_state = 1;
				}
			}
			else
			{
				$item_state = 1;
			}
			
			$item_state = 0;
			
			//echo($cat);
			
			$ssql = "UPDATE sed_blogs SET
				item_cat = ".(int)$cat.",
				item_title = '".sed_sql_prep($rblogstitle)."',
				item_text = '".sed_sql_prep($rblogstext)."',
				item_state = $item_state
				WHERE item_id='$itemid'";
			$sql = sed_sql_query($ssql);
			
			$sed_bcat = sed_load_bcat();
			sed_cache_store('sed_bcat', $sed_bcat, 3600);
				
			/* === Hook === */
			$extp = sed_getextplugins('blogs.edit.update.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=blogs&m=show&id=".$itemid, '', true));
			exit;
		}
	}
}

$sql = sed_sql_query("SELECT * FROM sed_blogs WHERE item_id='$itemid' LIMIT 1");
sed_die(sed_sql_numrows($sql)==0);
$item = sed_sql_fetcharray($sql);

sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);

/* === Hook === */
$extp = sed_getextplugins('blogs.edit.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$item_form_delete = "<input type=\"radio\" class=\"radio\" name=\"rblogsdelete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"rblogsdelete\" value=\"0\" checked=\"checked\" />".$L['No'];

$mskin = sed_skinfile('blogs.edit', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('blogs.edit.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("BLOGEDIT_ERROR_BODY",$error_string);
	$t->parse("MAIN.BLOGEDIT_ERROR");
}

$pfs = sed_build_pfs($usr['id'], 'update', 'rblogstext',$L['Mypfs']);
$pfs .= (sed_auth('pfs', 'a', 'A')) ? " &nbsp; ".sed_build_pfs(0, 'update', 'rblogstext', $L['SFS']) : '';
$pfs_form_url_myfiles = (!$cfg['disable_pfs']) ? sed_build_pfs($usr['id'], "update", "newpageurl", $L['Mypfs']) : '';
$pfs_form_url_myfiles .= (sed_auth('pfs', 'a', 'A')) ? ' '.sed_build_pfs(0, 'update', 'newpageurl', $L['SFS']) : '';


$t->assign(array(
	"BLOGEDIT_FORM_SEND" => sed_url('plug', "e=blogs&m=edit&a=update&itemid=".$item['item_id']."&r=".$r),
	"BLOGEDIT_FORM_ID" => $item['item_id'],
	"BLOGEDIT_FORM_CAT" => sed_selectbox_bcat('cat', $item['item_cat']),
	"BLOGEDIT_FORM_STATE" => $item['item_state'],
	"BLOGEDIT_FORM_TITLE" => $item['item_title'],
	"BLOGEDIT_FORM_TEXT" => $item['item_text'],
	"BLOGEDIT_FORM_PFS" => $pfs,
	"BLOGEDIT_FORM_OWNERID" => "<input type=\"hidden\" class=\"text\" name=\"rblogsuserid\" value=\"".htmlspecialchars($item['item_userid'])."\" size=\"32\" maxlength=\"24\" />",
	"BLOGEDIT_FORM_DELETE" => $item_form_delete
));

/* === Hook === */
$extp = sed_getextplugins('blogs.edit.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>