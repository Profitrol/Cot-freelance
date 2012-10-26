<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=projectsposts
Part=plug
File=projectsposts.offers.loop
Hooks=projects.show.offers.loop
Tags=projects.show.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if($usr['id'] == $offers['item_userid'] || $usr['id'] == $item['item_userid'] || $usr['isadmin']){
	
	if($a == 'addpost'){
		
		$oid = sed_import('oid', 'G', 'INT');
		$posttext = sed_import('posttext', 'P', 'TXT');
		
		if(!empty($posttext)){
			$sql_prjposts = sed_sql_query("INSERT INTO sed_projects_posts 
			(
			post_pid,
			post_oid,
			post_userid,
			post_date,
			post_text
			)
			VALUES
			(
			".(int)$itemid.",
			".(int)$oid.",
			".(int)$usr['id'].",
			".$sys['now_offset'].",
			'".sed_sql_prep($posttext)."'
			)
			");
			
			if($usr['id'] == $offers['item_userid']){
			// Если сообщение оставил фрилансер, то уведомление автора проекта
				$rsubject = "Новое сообщение по Вашему проекту";
				$rbody = "Здравствуйте, ".$item['user_name'].".\nПользователь ".$usr['profile']['user_name']." оставил вам сообщение по проекту «".$item['item_title']."».\n".SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true)."\n";
				
				sed_mail ($item['user_email'], $rsubject, $rbody);
			}
			else{
			// Если сообщение оставил автора проекта
				$rsubject = "Новое сообщение по проекту «".$item['item_title']."»";
				$rbody = "Здравствуйте, ".$offers['user_name'].".\nПользователь ".$usr['profile']['user_name']." оставил вам сообщение по проекту «".$item['item_title']."».\n".SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true)."\n";
				
				sed_mail ($offers['user_email'], $rsubject, $rbody);
			}
			
		}
		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', 'e=projects&m=show&itemid='.$itemid));
		exit;
	}
	
	$pst = new XTemplate(sed_skinfile('projectsposts', true));
	
	
	$sql_prjposts = sed_sql_query("SELECT * FROM sed_projects_posts as p
	LEFT JOIN sed_users as u ON u.user_id=p.post_userid
	WHERE post_pid=".$itemid." AND post_oid=".$offers['item_id']."");
	
	
	
	while($posts = sed_sql_fetcharray($sql_prjposts)){
	
		// echo "<pre>";
		// print_r($posts);
		// echo "</pre>";
		
		if(!empty($posts['user_fname']) || !empty($posts['user_sname']))
		{
			$pst->assign(array(
				"POST_ROW_OWNER" => sed_build_uname($posts['user_id'], $posts['user_name'], $posts['user_fname']." ".$posts['user_sname']),
			));	
		}
		else{
			$pst->assign(array(
				"POST_ROW_OWNER" => sed_build_user($posts['user_id'], $posts['user_name']),
			));
		}
		
		$pst->assign(array(
			"POST_ROW_TEXT" => sed_parse($posts['post_text']),
			"POST_ROW_AVATAR" => sed_build_avatar($posts['user_avatar'], 'thumbs'),
			"POST_ROW_DATE" => date('d.m.y H:i', $posts['post_date']),
		));
		$pst->parse("POSTS.POSTS_ROWS");
	}
	
	$pst->assign(array(
		"ADDPOST_ACTION_URL" => sed_url('plug', 'e=projects&m=show&itemid='.$itemid.'&oid='.$offers['item_id'].'&a=addpost'),
		"ADDPOST_TEXT" => $posttext,
		"ADDPOST_OFFERID" =>  $offers['item_id'],
	));
	$pst->parse("POSTS.POSTFORM");
	
	$pst->parse("POSTS");

	$res = $pst->text("POSTS");
	$t->assign('PROJECTS_POSTS', $res);

}
else{
	$t->assign('PROJECTS_POSTS', '');
}

?>