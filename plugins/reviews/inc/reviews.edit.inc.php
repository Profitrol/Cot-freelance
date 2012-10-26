<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'reviews', 'RWA');
sed_block($usr['auth_write']);

$itemid = sed_import('itemid','G','INT');

if ($a=='update')
{
	$sql1 = sed_sql_query("SELECT * FROM sed_reviews as r
	LEFT JOIN sed_users as u ON u.user_id=r.item_touserid WHERE item_id='$itemid' LIMIT 1");
	sed_die(sed_sql_numrows($sql1)==0);
	$item = sed_sql_fetcharray($sql1);
	
	sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);
	
	/* === Hook === */
	$extp = sed_getextplugins('reviews.edit.update.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$delete = sed_import('delete','P','BOL');

	$text = sed_import('text','P','TXT');
	$score = sed_import('score','P','INT');
	
	$error_string .= (empty($text)) ? "Отзыв не может быть пустым<br />" : '';
	$error_string .= (empty($score)) ? "Укажите оценку<br />" : '';
	
	if (empty($error_string) || $rreviewsdelete)
	{
		if ($delete)
		{
			$sql = sed_sql_query("SELECT * FROM sed_reviews WHERE item_id='$itemid' LIMIT 1");

			if ($row = sed_sql_fetchassoc($sql))
			{	
				
				$sql = sed_sql_query("DELETE FROM sed_reviews WHERE item_id='$itemid'");
	
				/* === Hook === */
				$extp = sed_getextplugins('reviews.edit.delete.done');
				if (is_array($extp))
				{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
				/* ===== */
				
				header("Location: " . SED_ABSOLUTE_URL . sed_url('users', "m=details&id=".$item['item_touserid']."&u=".$item['user_name']."&tab=reviews", '', true));
				exit;
			}
		}
		else
		{
			
			$sql = sed_sql_query("SELECT * FROM sed_reviews as s
			LEFT JOIN sed_users as u ON u.user_id=s.item_touserid 
			WHERE item_id='$itemid' ");
			$row = sed_sql_fetcharray($sql);

			$ssql = "UPDATE sed_reviews SET
				item_text = '".sed_sql_prep($text)."',
				item_score = ".(int)$score."
				WHERE item_id='$itemid'";
			$sql = sed_sql_query($ssql);
			
			/* === Hook === */
			$extp = sed_getextplugins('reviews.edit.update.done');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('users', "m=details&id=".$row['item_userid']."&u=".$row['user_name']."&tab=reviews", '', true));
			exit;
		}
	}
}

$sql = sed_sql_query("SELECT * FROM sed_reviews WHERE item_id='$itemid' LIMIT 1");
sed_die(sed_sql_numrows($sql)==0);
$item = sed_sql_fetcharray($sql);

sed_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $item['item_userid'] && $usr['id'] != 0);

/* === Hook === */
$extp = sed_getextplugins('reviews.edit.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$item_form_delete = "<input type=\"radio\" class=\"radio\" name=\"delete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"delete\" value=\"0\" checked=\"checked\" />".$L['No'];

$mskin = sed_skinfile('reviews.edit', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('reviews.edit.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("REVIEWEDIT_ERROR_BODY",$error_string);
	$t->parse("MAIN.REVIEWEDIT_ERROR");
}

$t->assign(array(
	"REVIEWEDIT_FORM_SEND" => sed_url('plug', "e=reviews&m=edit&a=update&itemid=".$item['item_id']."&r=".$r),
	"REVIEWEDIT_FORM_ID" => $item['item_id'],
	"REVIEWEDIT_FORM_TEXT" => $item['item_text'],
	"REVIEWEDIT_FORM_SCORE" => $item['item_score'],
	"REVIEWEDIT_FORM_OWNERID" => "<input type=\"hidden\" class=\"text\" name=\"userid\" value=\"".htmlspecialchars($item['item_userid'])."\" size=\"32\" maxlength=\"24\" />",
	"REVIEWEDIT_FORM_DELETE" => $item_form_delete
));

/* === Hook === */
$extp = sed_getextplugins('reviews.edit.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>