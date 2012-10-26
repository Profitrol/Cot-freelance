<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=offers
Part=plug
File=offers.projects.tags
Hooks=projects.tags
Tags=projects.show.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$user = sed_import('user','G','ALP');

if($a == 'addoffer')
{

	sed_shield_protect();

	list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'projects', 'RWA');
	sed_block($usr['auth_write']);

	$costmin = sed_import('costmin', 'P', 'INT');
	$costmax = sed_import('costmax', 'P', 'INT');
	$timemin = sed_import('timemin', 'P', 'INT');
	$timemax = sed_import('timemax', 'P', 'INT');
	$timetype = sed_import('timetype', 'P', 'INT');
	$hidden = sed_import('hidden', 'P', 'BOL');

	$offertext = sed_import('offertext', 'P', 'HTM');

	$error_string = (empty($offertext)) ? 'Предложение не может быть пустым' : '';

	if (empty($error_string))
	{
		$ssql = "INSERT into sed_offers
		(
		item_pid,
		item_userid,
		item_date,
		item_text,
		item_cost_min,
		item_cost_max,
		item_time_min,
		item_time_max,
		item_time_type,
		item_hidden
		)
		VALUES
		(
		".(int)$itemid.",
		".(int)$usr['id'].",
		".(int)$sys['now_offset'].",
		'".sed_sql_prep($offertext)."',
		".(int)$costmin.",
		".(int)$costmax.",
		".(int)$timemin.",
		".(int)$timemax.",
		".(int)$timetype.",
		".(int)$hidden."
		)";
  		$sql = sed_sql_query($ssql);

		if(!$usr['isadmin'])
		{

			$rsubject = "Новое предложение по Вашему проекту";
			$rbody = "Здравствуйте, ".$item['user_name'].".\nПользователь ".$usr['profile']['user_name']." ответил на опубликованный вами проект «".$item['item_title']."».\n".SED_ABSOLUTE_URL . sed_url('plug', "e=projects&m=show&itemid=".$itemid, '', true)."\n";

			sed_mail ($item['user_email'], $rsubject, $rbody);

		}


		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', 'e=projects&m=show&itemid='.$itemid));
		exit;
	}
}

if($a == 'setperformer' && !empty($user)){
	// Выбор исполнителя
	if($usr['id'] == $item['item_userid']){
		$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_name='".sed_sql_prep($user)."'");
		if($userinfo = sed_sql_fetcharray($sql)){

			$sql = sed_sql_query("UPDATE sed_offers SET item_choise='performer', item_choise_date=".$sys['now_offset']." WHERE item_pid=".$itemid." AND item_userid=".$userinfo['user_id']."");

			// Если исполнителем был другой пользователь, то ему отказ
			$sql = sed_sql_query("SELECT * FROM sed_offers WHERE item_pid=".$itemid." AND item_choise='performer' AND item_userid!=".$userinfo['user_id']."");
			if($oldperformer = sed_sql_fetcharray($sql)){
				$sql = sed_sql_query("UPDATE sed_offers SET item_choise='refuse', item_choise_date=".$sys['now_offset']." WHERE item_pid=".$itemid." AND item_choise='performer' AND item_userid=".$oldperformer['item_userid']."");
			}

			/* === Hook === */
			$extp = sed_getextplugins('offers.setperformer');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */

		}
	}
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', 'e=projects&m=show&itemid='.$itemid));
	exit;
	}

if($a == 'refuse' && !empty($user)){
	// Отказать исполнителю
	if($usr['id'] == $item['item_userid']){
		$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_name='".sed_sql_prep($user)."'");
		if($userinfo = sed_sql_fetcharray($sql)){
			$sql = sed_sql_query("UPDATE sed_offers SET item_choise='refuse', item_choise_date=".$sys['now_offset']." WHERE item_pid=".$itemid." AND item_userid=".$userinfo['user_id']."");

			/* === Hook === */
			$extp = sed_getextplugins('offers.refuse');
			if (is_array($extp))
			{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
			/* ===== */

		}
	}
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', 'e=projects&m=show&itemid='.$itemid));
	exit;
	}

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'offers', 'RWA');

// Вычисление выбранного исполнителя по проекту
$sql_performer = sed_sql_query("SELECT * FROM sed_offers WHERE item_pid=".$itemid." AND item_choise='performer'");
if($performer = sed_sql_fetcharray($sql_performer)){
	$t->assign(array(
		"PERFORMER_USERID" => $performer['item_userid'],
	));
}

// Показать автору только видимые проедложения:
if($usr['id'] != $item['item_userid'] && !$usr['isadmin']) $query_string = " AND (item_hidden!=1 OR item_userid=".$usr['id'].")";
// ==================================================

$sql = sed_sql_query("SELECT * FROM sed_offers AS o
LEFT JOIN sed_users AS u ON u.user_id=o.item_userid
WHERE item_pid=".$itemid." ".$query_string." ORDER by item_date DESC");
$totaloffers = sed_sql_numrows($sql);

/* === Hook === */
$extp = sed_getextplugins('projects.show.offers.loop');
/* ===== */

while($offers = sed_sql_fetcharray($sql))
{

	if($usr['id'] == $item['item_userid']){


		$t->assign(array(
			"OFFER_ROW_CHOISE" => $offers['item_choise'],
			"OFFER_ROW_SETPERFORMER" => sed_url('plug','e=projects&m=show&itemid='.$itemid.'&a=setperformer&user='.$offers['user_name']),
			"OFFER_ROW_REFUSE" => sed_url('plug','e=projects&m=show&itemid='.$itemid.'&a=refuse&user='.$offers['user_name']),
		));
		$t->parse("MAIN.OFFERS.OFFERS_LIST.OFFERS_ROWS.CHOISE");
	}

	$t->assign(array(
		"OFFER_ROW_OWNER" => sed_build_uname($item['user_id'], $offers['user_name'], $offers['user_fname']." ".$offers['user_sname']),
		"OFFER_ROW_AVATAR" => sed_build_avatar($offers['user_avatar'], 'thumbs'),
		"OFFER_ROW_PRO" => (sed_ispro($offers['user_protodate'])) ? '<img src="images/pro.png" align="absmiddle">' : '',
		"OFFER_ROW_DATE" => date('d.m.Y H:i', $offers['item_date']),
		"OFFER_ROW_TEXT" => sed_parse($offers['item_text']),
		"OFFER_ROW_COSTMIN" => number_format($offers['item_cost_min'], '0', '.', ' '),
		"OFFER_ROW_COSTMAX" => number_format($offers['item_cost_max'], '0', '.', ' '),
		"OFFER_ROW_TIMEMIN" => $offers['item_time_min'],
		"OFFER_ROW_TIMEMAX" => $offers['item_time_max'],
		"OFFER_ROW_TIMETYPE" => $sed_timetype[$offers['item_time_type']],
		"OFFER_ROW_HIDDEN" => $offers['item_hidden'],
	));

	/* === Hook - Part2 : Include === */
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	$t->parse("MAIN.OFFERS.OFFERS_LIST.OFFERS_ROWS");
}

if($totaloffers > 0) $t->parse("MAIN.OFFERS.OFFERS_LIST");

// Проверяем количество оставшихся ответов на проекты
if($usr['id'] != $item['item_userid']){
	$countoffersofuser = sed_getcountoffersofuser($usr['id']);
	if($cfg['offerslimit'] > 0 && $countoffersofuser < $cfg['offerslimit'] || $cfg['offerslimit'] == 0)
		$offerstosend = true;
	else
		$offerstosend = false;
}

if($usr['auth_write'] && $usr['id'] != $item['item_userid'] && $offerstosend 
|| $usr['auth_write'] && $usr['id'] != $item['item_userid'] && sed_ispro($usr['profile']['user_protodate'])){
	$sql = sed_sql_query("SELECT * FROM sed_offers
	WHERE item_pid=".$itemid." AND item_userid=".$usr['id']."");
	if(sed_sql_numrows($sql) == 0)
	{
		$t->assign(array(
			"OFFER_FORM_ACTION_URL" => sed_url('plug', 'e=projects&m=show&itemid='.$itemid.'&a=addoffer'),
			"OFFER_FORM_TIMETYPE" => sed_select_timetype('timetype', $timetype),
			"OFFER_FORM_HIDDEN" => $hidden,
		));
		$t->parse("MAIN.OFFERS.ADDOFFERFORM");
	}
}

$t->parse("MAIN.OFFERS");

?>