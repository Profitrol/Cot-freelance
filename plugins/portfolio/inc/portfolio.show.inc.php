<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'portfolio', 'RWA');
sed_block($usr['auth_read']);

$itemid = sed_import('itemid','G','INT');
$r = sed_import('r','G','ALP');

$mskin = sed_skinfile('portfolio.show', true);
$t = new XTemplate($mskin);

$sql = sed_sql_query("SELECT p.*, u.* FROM sed_portfolio AS p
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
		"PTF_ID" => $item['item_id'],
		"PTF_USER_PTFURL" => sed_url('users', 'm=details&id='.$item['item_userid'].'&u='.$item['user_name'].'&tab=portfolio'),
		"PTF_TITLE" => $item['item_title'],
		"PTF_TEXT" => sed_parse($item['item_text']),
		"PTF_IMG" => $item['item_img'],
		"PTF_USER" => sed_build_uname('', $item['user_name'], $item['user_fname']." ".$item['user_sname']),
		"PTF_OWNER" => (sed_ispro($usr['profile']['user_protodate']) || $usr['isadmin']) ? sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']) : '',
		"PTF_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
		"PTF_DATE" => date('d.m H:i', $item['item_date']),
		"PTF_SHOW_URL" => $cfg['mainurl'].'/'.sed_url('plug', 'e=portfolio&m=show&id='.$id),
		"PTF_OWNER" => sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname'].' '.$item['user_sname']),
		"PTF_USER" => sed_build_uname('', $item['user_name'], $item['user_fname'].' '.$item['user_sname']),
		));	

	if ($usr['isadmin'] || $usr['id'] == $item['item_userid'] && $usr['id'] != 0)
	{
		$t->assign("PTF_ADMIN_EDIT",
			"<a href=\"".sed_url('plug', 'e=portfolio&m=edit&itemid='.$item['item_id'])."\">Редактировать</a>");
	}


	/* === Hook === */
	$extp = sed_getextplugins('portfolio.tags');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	if($usr['isadmin'])
	{
		$t->parse('MAIN.PTF_ADMIN');
	}
}


?>