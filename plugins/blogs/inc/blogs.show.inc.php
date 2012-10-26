<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'blogs', 'RWA');
sed_block($usr['auth_read']);

$id = sed_import('id','G','INT');
$r = sed_import('r','G','ALP');

$mskin = sed_skinfile('blogs.show', true);
$t = new XTemplate($mskin);

$sql = sed_sql_query("SELECT b.*, u.* FROM sed_blogs AS b
LEFT JOIN sed_users AS u ON u.user_id=b.item_userid
WHERE item_id='$id'");

if($item = sed_sql_fetcharray($sql)){

	if ($item['item_state'] == 1 && !$usr['isadmin'] && $usr['id'] != $item['item_userid'])
	{
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=930", '', true));
		exit;
	}

	if(!$usr['isadmin'] || $cfg['count_admin'])
	{
		$item['item_count']++;
		$sql = (!$cfg['disablehitstats']) ? sed_sql_query("UPDATE sed_blogs SET item_count='".$item['item_count']."' WHERE item_id='".$item['item_id']."'") : '';
	}

	$item_code = 'b'.$item['item_id'];
	list($comments_link, $comments_display, $comments_count) = sed_build_comments($item_code, sed_url('plug', 'e=blogs&m=show&id='.$item['item_id'], '', true), 1);
	
	
	$t->assign(array(
		"BLOG_OWNER" => sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']),
		"BLOG_ID" => $item['item_id'],
		"BLOG_STATE" => $item['item_state'],
		"BLOG_TITLE" => $item['item_title'],
		"BLOG_TEXT" => sed_parse(htmlspecialchars($item['item_text']), $cfg['parsebbcodepages'], $cfg['parsesmiliespages'], true),
		"BLOG_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"BLOG_DATE" => date('d.m H:i', $item['item_date']),
		"BLOG_SHOW_URL" => $cfg['mainurl'].'/'.sed_url('plug', 'e=blogs&m=show&id='.$id),
		"BLOG_COMMENTS_DISPLAY" => $comments_display,
		"BLOG_COMMENTS_COUNT" => $comments_count,
	));

	if ($usr['isadmin'] || $usr['id'] == $item['item_userid'] && $usr['id'] != 0)
	{
		$t->assign("BLOG_ADMIN_EDIT",
			"<a href=\"".sed_url('plug', 'e=blogs&m=edit&itemid='.$item['item_id'])."\">Редактировать</a>");
	}

	if ($usr['isadmin'])
	{

		if($item['item_state'] == 1)
		{
			$validation = "<a href=\"".sed_url('admin', "m=blogs&s=queue&a=validate&id=".$item['item_id']."&amp;".sed_xg())."\">".$L['Validate']."</a>";
		}
		else
		{
			$validation = "<a href=\"".sed_url('admin', "m=blogs&s=queue&a=unvalidate&id=".$item['item_id']."&amp;".sed_xg())."\">".$L['Putinvalidationqueue']."</a>";
		}
		$t->assign(array(
			"BLOG_ADMIN_COUNT" => $item['item_count'],
			"BLOG_ADMIN_UNVALIDATE" => $validation
		));
	}

	/* === Hook === */
	$extp = sed_getextplugins('blogs.tags');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	if($usr['isadmin'])
	{
		$t->parse('MAIN.BLOG_ADMIN');
	}
}

?>