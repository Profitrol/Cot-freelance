<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'projects', 'RWA');
sed_block($usr['auth_read']);

$itemid = sed_import('itemid','G','INT');
$r = sed_import('r','G','ALP');

$mskin = sed_skinfile('projects.show', true);
$t = new XTemplate($mskin);

$sql = sed_sql_query("SELECT p.*, u.* FROM sed_projects AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_id='$itemid'");

if($item = sed_sql_fetcharray($sql)){

	if(!sed_ispro($usr['profile']['user_protodate']) && $usr['id'] != $item['item_userid'] && !$usr['isadmin'] && $item['item_type'] == 2)
	{
		//sed_log("Attempt to directly access an un-validated", 'sec');
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=930", '', true));
		exit;
	}

	if ($item['item_state'] == 1 && !$usr['isadmin'] && $usr['id'] != $item['item_userid'])
	{
		sed_log("Attempt to directly access an un-validated", 'sec');
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=930", '', true));
		exit;
	}

	if(!$usr['isadmin'] || $cfg['count_admin'])
	{
		$item['item_count']++;
		$sql = (!$cfg['disablehitstats']) ? sed_sql_query("UPDATE sed_projects SET item_count='".$item['item_count']."' WHERE item_id='".$item['item_id']."'") : '';
	}
	
	$t->assign(array(
		"PRJ_OWNER" => (sed_ispro($usr['profile']['user_protodate']) || $usr['isadmin']) ? sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']) : '',
		"PRJ_ID" => $item['item_id'],
		"PRJ_CAT" => $item['item_cat'],
		"PRJ_TITLE" => $item['item_title'],
		"PRJ_TEXT" => sed_parse($item['item_text']),
		"PRJ_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRJ_COUNT" => $item['item_count'],
		"PRJ_ISPRO" => (sed_ispro($usr['profile']['user_protodate'])) ? true : false,
		"PRJ_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"PRJ_DATE" => date('d.m H:i', $item['item_date']),
		"PRJ_SHOW_URL" => $cfg['mainurl'].'/'.sed_url('plug', 'e=projects&m=show&id='.$id),
		"PRJ_TYPE" => $sed_ptype[$item['item_type']]['title'],
		"PRJ_COUNTRY" => sed_getcountrybyid($item['item_country']),
        "PRJ_REGION" => sed_getregionbyid($item['item_region']),
		"PRJ_CITY" => sed_getcitybyid($item['item_city']),
	));
	
	$sqlattachs = sed_sql_query("SELECT * FROM sed_attachs WHERE att_pid=".$itemid."");
	while($att = sed_sql_fetcharray($sqlattachs)){
		$t->assign(array(
			"ATT_ID" => $att['att_id'],
			"ATT_FILE" => $att['att_file'],
		));
		$t->parse("MAIN.ATTACHS.ATT_ROWS");
	}
	$t->parse("MAIN.ATTACHS");

	if ($usr['isadmin'] || $usr['id'] == $item['item_userid'] && $usr['id'] != 0)
	{
		$t->assign(array(
			"PRJ_HIDEPROJECT_URL" => ($item['item_state'] == 1) ? sed_url('plug', 'e=projects&m=edit&itemid='.$itemid.'&a=public') : sed_url('plug', 'e=projects&m=edit&itemid='.$itemid.'&a=hide'),
			"PRJ_HIDEPROJECT_TITLE" => ($item['item_state'] == 1) ? 'Публиковать еще раз' : 'Снять с публикации',
			"PRJ_ADMIN_EDIT" => "<a href=\"".sed_url('plug', 'e=projects&m=edit&itemid='.$item['item_id'])."\">Редактировать</a>"
		));
		$t->parse("MAIN.OWNERMENU");
	}

	if ($usr['isadmin'])
	{

		if($item['item_state'] == 1)
		{
			$validation = "<a href=\"".sed_url('admin', "m=projects&s=queue&a=validate&id=".$item['item_id']."&amp;".sed_xg())."\">".$L['Validate']."</a>";
		}
		else
		{
			$validation = "<a href=\"".sed_url('admin', "m=projects&s=queue&a=unvalidate&id=".$item['item_id']."&amp;".sed_xg())."\">".$L['Putinvalidationqueue']."</a>";
		}
		$t->assign(array(
			"PRJ_ADMIN_COUNT" => $item['item_count'],
			"PRJ_ADMIN_UNVALIDATE" => $validation
		));
	}

	/* === Hook === */
	$extp = sed_getextplugins('projects.tags');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	if($usr['isadmin'])
	{
		$t->parse('MAIN.PRJ_ADMIN');
	}

	if($usr['id'] == 0) $t->parse("MAIN.FORGUEST");
}

?>