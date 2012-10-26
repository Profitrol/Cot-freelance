<?PHP

defined('SED_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'balance', 'RWA');
sed_block($usr['auth_write']);

$tab = sed_import('tab','G','ALP');


$bstatuses = array(
	'bill' => "Пополнение счета",
	'pro' => "Покупка PRO-аккаунта",
	'protouser' => "Покупка PRO-аккаунта в подарок для пользователя",
	'profromuser' => "Покупка PRO-аккаунта в подарок от пользователя",
	'top' => "Покупка платного места на главной странице",
	'transferto' => "Перевод на счет пользователя",
	'transferfrom' => "Перевод на ваш счет от пользователя",
	'prjtop' => "Размещение платного проекта",
);


$mskin = sed_skinfile('balance.default', true);
$t = new XTemplate($mskin);

$sql = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$usr['id']." AND item_status=1");
$balance = sed_sql_fetcharray($sql);


$t->assign(array(
	"BALANCE_BILL_URL" => sed_url('plug', 'e=balance&m=bill'),
	"BALANCE_SUMM" => number_format($balance['summ'], '2', '.', ' '),
	"BALANCE_URL" => sed_url('plug', 'e=balance'),
	"BALANCE_HISTORY_URL" => sed_url('plug', 'e=balance&tab=history'),
	));

if(empty($tab))
{

	if($usr['profile']['user_maingrp'] == 4)
	{
		$t->assign(array(
			"BUY_PRO_URL" => sed_url('plug', 'e=balance&m=buy&type=pro'),
			"BUY_TOP_URL" => sed_url('plug', 'e=balance&m=buy&type=top'),
			"BUY_PROTOUSER_URL" => sed_url('plug', 'e=balance&m=buy&type=protouser'),
			"BUY_TRANSFER_URL" => sed_url('plug', 'e=balance&m=buy&type=transfer'),
			"BUY_PRJTOP_URL" => sed_url('users', 'm=details&id='.$usr['id'].'&u='.$usr['name']),
			"BALANCE_PRO_EXPIRE" => ($usr['profile']['user_protodate'] > $sys['now_offset']) ? date('d.m.Y H:i', $usr['profile']['user_protodate']) : '',
			"BALANCE_TOP_EXPIRE" => ($usr['profile']['user_toptodate'] > $sys['now_offset']) ? date('d.m.Y H:i', $usr['profile']['user_toptodate']) : ''
			));
		$t->parse("MAIN.USLUGI.FREELANCERS");
	}
	
	if($usr['profile']['user_maingrp'] == 8)
	{
		$t->assign(array(
			"BUY_PRO_URL" => sed_url('plug', 'e=balance&m=buy&type=pro'),
			"BUY_TOP_URL" => sed_url('plug', 'e=balance&m=buy&type=top'),
			"BUY_PROTOUSER_URL" => sed_url('plug', 'e=balance&m=buy&type=protouser'),
			"BUY_TRANSFER_URL" => sed_url('plug', 'e=balance&m=buy&type=transfer'),
			"BUY_PRJTOP_URL" => sed_url('users', 'm=details&id='.$usr['id'].'&u='.$usr['name']),
			"BALANCE_PRO_EXPIRE" => ($usr['profile']['user_protodate'] > $sys['now_offset']) ? date('d.m.Y H:i', $usr['profile']['user_protodate']) : '',
			"BALANCE_TOP_EXPIRE" => ($usr['profile']['user_toptodate'] > $sys['now_offset']) ? date('d.m.Y H:i', $usr['profile']['user_toptodate']) : ''
			));
		$t->parse("MAIN.USLUGI.EMPLOYERS");
	}
	
	$t->parse("MAIN.USLUGI");

}
elseif($tab == 'history')
{
	
	$sql = sed_sql_query("SELECT * FROM sed_balance WHERE item_status=1 AND item_userid=".$usr['id']." ORDER BY item_date DESC");
	while($balance = sed_sql_fetcharray($sql))
	{
		
		$fromuser = (!empty($balance['item_fromuser'])) ? sed_userinfo($balance['item_fromuser']) : '';
		$touser = (!empty($balance['item_touser'])) ? sed_userinfo($balance['item_touser']) : '';
		
		$t->assign(array(
			"HIST_ID" => $balance['item_id'],
			"HIST_DATE" => date('d.m.Y H:i', $balance['item_date']),
			"HIST_SUMM" => $balance['item_summ'],
			"HIST_DESC" => $bstatuses[$balance['item_desc']],
			"HIST_TOUSER" => sed_build_uname($touser['user_id'], $touser['user_name'], $touser['user_fname']." ".$touser['user_sname']),
			"HIST_FROMUSER" => sed_build_uname($fromuser['user_id'], $fromuser['user_name'], $fromuser['user_fname']." ".$fromuser['user_sname']),
			"HIST_ITEMID" => (!empty($balance['item_itemid'])) ? $balance['item_itemid'] : '',
			));
		$t->parse("MAIN.HISTORY.HIST_ROWS");
	}
	$t->parse("MAIN.HISTORY");
	
}
	
?>