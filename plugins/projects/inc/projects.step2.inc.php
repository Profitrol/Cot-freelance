<?PHP

defined('SED_CODE') or die('Wrong URL');

$itemid = sed_import('itemid','G','INT');
$r = sed_import('r','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'projects', 'RWA');


if(!$usr['isadmin'])
{
	// Запрет публикации проектов для обычных фрилансеров
	if (!sed_ispro($usr['profile']['user_protodate'], $usr['id']) && $usr['profile']['user_maingrp'] == 4)
	{
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=1003", '', true));
		exit;
	}
	// Запрет публикации проектов для обычных работодателей
	if (!sed_ispro($usr['profile']['user_protodate'], $usr['id']) && $usr['profile']['user_maingrp'] == 8 && $cfg['prjlimitforemployers'] > 0)
	{
		// Проверяем количество оставшихся ответов на проекты	
		$countprjofuser = sed_getcountprjofuser($usr['id']);
		if($countprjofuser >= $cfg['prjlimitforemployers']){
			header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=1002", '', true));
			exit;
		}
	}	
}

sed_block($usr['auth_write']);

/* === Hook === */
$extp = sed_getextplugins('projects.step2.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='buy'){
	$days = sed_import('days','P','INT');
	$prjtop = sed_import('prjtop','P','BOL');

	$sql = sed_sql_query("SELECT p.*, u.* FROM sed_projects AS p
	LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
	WHERE item_id='$itemid'");
	$item = sed_sql_fetcharray($sql);

	sed_block($item['item_userid'] == $usr['id']);
	
	if($prjtop && $days > 0){
		
		$summ = $cfg['plugin']['balance']['cost_prjtop']*$days;		
		
		$sql = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$item['user_id']." AND item_status=1");
		$balance = sed_sql_fetcharray($sql);
		
		if($balance['summ'] >= $summ){
			
			$sql = sed_sql_query("INSERT into sed_balance ( 
				item_userid,
				item_summ,
				item_date,
				item_status,
				item_desc,
				item_itemid
				) 
				VALUES(
				".(int)$usr['id'].", 
				'".-$summ."',
				".(int)$sys['now_offset'].",
				1,
				'prjtop',
				".(int)$itemid."
				)");
				
			$toptodate = ($item['item_toptodate'] > $sys['now_offset']) ? $item['item_toptodate']+$days*24*60*60 : $sys['now_offset']+$days*24*60*60;	
			
			$item_state = 0;
		
			$ssql = "UPDATE sed_projects SET
				item_state = $item_state,
				item_toptodate = ".(int)$toptodate."
				WHERE item_id='$itemid'";
			$sql = sed_sql_query($ssql);
			
			$sed_pcat = sed_load_pcat();
			sed_cache_store('sed_pcat', $sed_pcat, 3600);
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true));
			exit;

		}
		else{
			header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=step2&itemid=".$itemid, '', true));
			exit;
		}
	}
}


if ($a=='save'){
	sed_check_xg();	
		
	$item_state = 0;
	
	$ssql = "UPDATE sed_projects SET
		item_state = $item_state
		WHERE item_id='$itemid'";
	$sql = sed_sql_query($ssql);
	
	$sed_pcat = sed_load_pcat();
	sed_cache_store('sed_pcat', $sed_pcat, 3600);
	
	if(!$usr['isadmin']){
		
		$sql = sed_sql_query("SELECT * FROM sed_projects AS p
		LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
		WHERE item_id='$itemid'");

		$item = sed_sql_fetcharray($sql);

		$rsubject = "Ваш проект опубликован";
		$rbody = "Здравствуйте, ".$item['user_name'].".\nВаш проект \"".sed_sql_prep($item['item_title'])."\" был опубликован на сайте ".SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true)."\n";
		
		sed_mail ($item['user_email'], $rsubject, $rbody);

	}	
	
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true));
	exit;
}

$mskin = sed_skinfile('projects.step2', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('projects.step2.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$sql = sed_sql_query("SELECT p.*, u.* FROM sed_projects AS p
LEFT JOIN sed_users AS u ON u.user_id=p.item_userid
WHERE item_id='$itemid'");


if($item = sed_sql_fetcharray($sql)){

	if ($item['item_state'] == 1 && !$usr['isadmin'] && $usr['id'] != $item['item_userid'])
	{
		sed_log("Attempt to directly access an un-validated", 'sec');
		header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=930", '', true));
		exit;
	}
	
	$sql = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$item['user_id']." AND item_status=1");
	$balance = sed_sql_fetcharray($sql);
	
	if(empty($balance['summ'])) $balance['summ'] = 0;
	
	$jscode = '
	<script type="text/javascript">
		
		function prjtop_checked(){
			if($("#prjtop_checkbox").attr("checked")){
				$("#prjedit_buy").show();
			}
			else{
				$("#prjedit_buy").hide();
			}
		}
		
		function prjtop_calculate_result_amount(days)
		{
			balance = '.$balance['summ'].';
			cost = '.$cfg['plugin']['balance']['cost_prjtop'].'; // Стоимость за 1 день

			var result_amount = 0;

			result_amount = cost*days;	

			if (isNaN(result_amount)) result_amount = 0;
			else result_amount = Math.abs(result_amount);

			document.getElementById("result_amount").innerHTML = result_amount;
			
			if(balance < result_amount) {
				document.getElementById("warning").innerHTML = "У вас не достаточно средств.";
				//$("#prjedit_button").attr("disabled", true);
			}
			else{
				$("#warning").hide();
				// $("#prjedit_button").show();
			}
		}
		
	</script>';
	
	$t->assign(array(
		"PRJ_ID" => $item['item_id'],
		"PRJ_CAT" => $item['item_cat'],
		"PRJ_TITLE" => $item['item_title'],
		"PRJ_TEXT" => sed_parse($item['item_text']),
		"PRJ_COST" => number_format($item['item_cost'], '0', '.', ' '),
		"PRJ_COUNT" => $item['item_count'],
		"PRJ_OWNER" => (sed_ispro($usr['profile']['user_protodate']) || $usr['isadmin']) ? sed_build_user($item['item_userid'], htmlspecialchars($item['user_name'])) : '',
		"PRJ_ISPRO" => (sed_ispro($usr['profile']['user_protodate'])) ? true : false,
		"PRJ_AVATAR" => sed_build_userimage($item['user_avatar'], 'avatar'),
		"PRJ_DATE" => date('d.m H:i', $item['item_date']),
		"PRJ_SHOW_URL" => $cfg['mainurl'].'/'.sed_url('plug', 'e=projects&m=show&id='.$id),
		"PRJ_TYPE" => $sed_ptype[$item['item_type']]['title'],
		"PRJ_REGION" => $sed_location[$item['item_region']]['name'],
		"PRJ_LOCATION" => $sed_location[$item['item_region']]['loc'][$item['item_location']],
		"PRJ_SAVE_URL" => sed_url('plug', 'e=projects&m=step2&a=save&itemid='.$item['item_id'].'&'.sed_xg()),
		"PRJ_EDIT_URL" => sed_url('plug', 'e=projects&m=edit&itemid='.$item['item_id']),
		"PRJ_BUY_ACTION_URL" => sed_url('plug', 'e=projects&m=step2&itemid='.$item['item_id'].'&a=buy'),
	));

	/* === Hook === */
	$extp = sed_getextplugins('projects.tags');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

}

?>