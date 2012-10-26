<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'market', 'RWA');
sed_block($usr['auth_read']);

$itemid = sed_import('itemid','G','INT');
$r = sed_import('r','G','ALP');

$mskin = sed_skinfile('market.show', true);
$t = new XTemplate($mskin);

$sql = sed_sql_query("SELECT p.*, u.* FROM sed_market AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_id='$itemid'");
	
if($item = sed_sql_fetcharray($sql)){

	if ($item['item_state'] == 1 && !$usr['isadmin'] && $usr['id'] != $item['item_userid'])
	{
		sed_log("Attempt to directly access an un-validated", 'sec');
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=930", '', true));
		exit;
	}

	$t->assign(array(
		"PRD_OWNER" => (sed_ispro($usr['profile']['user_protodate']) || $usr['isadmin']) ? sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']) : '',
		"PRD_ID" => $item['item_id'],
		"PRD_USER_PRDURL" => sed_url('users', 'm=details&id='.$item['item_userid'].'&u='.$item['user_name'].'&tab=market'),
		"PRD_TITLE" => $item['item_title'],
		"PRD_TEXT" => sed_parse($item['item_text']),
		"PRD_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRD_IMG" => $item['item_img'],
		"PRD_THUMB" => (!empty($item['item_img'])) ? '<img src="'.sed_thumb_url('market', $item['item_img']).'" alt="'.$item['item_title'].'" />' : '',
		"PRD_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"PRD_DATE" => date('d.m H:i', $item['item_date']),
		"PRD_SHOW_URL" => $cfg['mainurl'].'/'.sed_url('plug', 'e=market&m=show&id='.$id),
		"PRD_COUNTRY" => sed_getcountrybyid($item['item_country']),
        "PRD_REGION" => sed_getregionbyid($item['item_region']),
		"PRD_CITY" => sed_getcitybyid($item['item_city']),
	));


	if ($usr['isadmin'] || $usr['id'] == $item['item_userid'] && $usr['id'] != 0)
	{
		$t->assign("PRD_ADMIN_EDIT",
			"<a href=\"".sed_url('plug', 'e=market&m=edit&itemid='.$item['item_id'])."\">Редактировать</a>");
	}


	/* === Hook === */
	$extp = sed_getextplugins('market.tags');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	if($usr['isadmin'])
	{
		$t->parse('MAIN.PRD_ADMIN');
	}
}


?>