<?PHP

defined('SED_CODE') or die('Wrong URL');

$type = sed_import('type','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'balance', 'RWA');
sed_block($usr['auth_write']);

$mskin = sed_skinfile('balance.buy', true);
$t = new XTemplate($mskin);

$sql = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$usr['id']." AND item_status=1");
$balance = sed_sql_fetcharray($sql);

$month = sed_import('month','P','INT');
$touser = sed_import('touser','P','TXT');
$summ = sed_import('summ','P','TXT');

if($a == 'pay' && $type == 'pro' && !empty($month))
{
	
	if(!empty($touser)){
		$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_name='".sed_sql_prep($touser)."'");
		$user = sed_sql_fetcharray($sql);
	}
	
	if($month == 3)
		$skidka = 0.95;
	elseif($month == 6)
		$skidka = 0.85;
	elseif($month == 12)
		$skidka = 0.60;
	else
		$skidka = 1;
		
	$summ = $month*$cfg['plugin']['balance']['cost_pro']*$skidka;
	
	if($balance['summ']-$summ >= 0)
	{
		
		$protodate = ($usr['profile']['user_protodate'] > $sys['now_offset']) ? $usr['profile']['user_protodate']+$month*30*24*60*60 : $sys['now_offset']+$month*30*24*60*60;
		
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_date,
			item_status,
			item_desc
			) 
			VALUES(
			".(int)$usr['id'].", 
			'".-$summ."',
			".(int)$sys['now_offset'].",
			1,
			'".sed_sql_prep($type)."'
			)");
		
		$sql = sed_sql_query("UPDATE sed_users SET 
			user_protodate=".$protodate.",
			user_ispro=1
			WHERE user_id=".$usr['id']."");
		
		/* === Hook === */
		$extp = sed_getextplugins('balance.buy.pro.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */			
		
		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=balance", '', true));
		exit;	
	}
}

if($a == 'pay' && $type == 'protouser' && !empty($month) && !empty($touser))
{
	
	if(!empty($touser)){
		$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_name='".sed_sql_prep($touser)."'");
		$user = sed_sql_fetcharray($sql);
	}
	
	if($month == 3)
		$skidka = 0.95;
	elseif($month == 6)
		$skidka = 0.85;
	elseif($month == 12)
		$skidka = 0.60;
	else
		$skidka = 1;
		
	$summ = $month*$cfg['plugin']['balance']['cost_pro']*$skidka;
	
	if($balance['summ']-$summ >= 0)
	{
		
		$protodate = ($usr['profile']['user_protodate'] > $sys['now_offset']) ? $usr['profile']['user_protodate']+$month*30*24*60*60 : $sys['now_offset']+$month*30*24*60*60;
		
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_date,
			item_status,
			item_desc,
			item_touser
			) 
			VALUES(
			".(int)$usr['id'].", 
			'".-$summ."',
			".(int)$sys['now_offset'].",
			1,
			'protouser',
			".(int)$user['user_id']."
			)");
			
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_date,
			item_status,
			item_desc,
			item_fromuser
			) 
			VALUES(
			".(int)$user['user_id'].", 
			'',
			".(int)$sys['now_offset'].",
			'1',
			'profromuser',
			".(int)$usr['id']."
			)");	
		
		$sql = sed_sql_query("UPDATE sed_users SET 
			user_protodate=".$protodate.",
			user_ispro=1
			WHERE user_id=".$user['user_id']."");
		
		/* === Hook === */
		$extp = sed_getextplugins('balance.buy.pro.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */			
		
		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=balance", '', true));
		exit;	
	}
}


if($a == 'pay' && $type == 'top')
{
	
	if($month == 3)
		$skidka = 0.95;
	elseif($month == 6)
		$skidka = 0.85;
	elseif($month == 12)
		$skidka = 0.60;
	else
		$skidka = 1;
		
	$summ = $month*$cfg['plugin']['balance']['cost_top']*$skidka;
		
	if($balance['summ']-$summ >= 0)
	{	
			
		$toptodate = ($usr['profile']['user_toptodate'] > $sys['now_offset']) ? $usr['profile']['user_toptodate']+$month*30*24*60*60 : $sys['now_offset']+$month*30*24*60*60;
		
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_date,
			item_status,
			item_desc
			) 
			VALUES(
			".(int)$usr['id'].", 
			'".-$summ."',
			".(int)$sys['now_offset'].",
			1,
			'".sed_sql_prep($type)."'
			)");
		
	
		$sql = sed_sql_query("UPDATE sed_users SET 
			user_toptodate=".(int)$toptodate."
			WHERE user_id=".$usr['id']."");
			
		/* === Hook === */
		$extp = sed_getextplugins('balance.buy.top.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */		
			
		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=balance", '', true));
		exit;	
	}
}


if($a == 'pay' && $type == 'transfer' && !empty($touser) && !empty($summ) && $summ > 0)
{
	
	if(!empty($touser)){
		$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_name='".sed_sql_prep($touser)."'");
		$user = sed_sql_fetcharray($sql);
	}
	
	if($balance['summ']-$summ >= 0)
	{
		
		// Вычитаем со счета отправилетя
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_date,
			item_status,
			item_desc,
			item_touser
			) 
			VALUES(
			".(int)$usr['id'].", 
			'".-$summ."',
			".(int)$sys['now_offset'].",
			1,
			'transferto',
			".(int)$user['user_id']."
			)");
		
		// Начисляем на счет получателя
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_date,
			item_status,
			item_desc,
			item_fromuser
			) 
			VALUES(
			".(int)$user['user_id'].",		
			'".$summ."',
			".(int)$sys['now_offset'].",
			1,
			'transferfrom',
			".(int)$usr['id']."
			)");	
		
		/* === Hook === */
		$extp = sed_getextplugins('balance.buy.transfer.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */			
		
		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=balance", '', true));
		exit;	
	}
}



$sql = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$usr['id']." AND item_status=1");
$balance = sed_sql_fetcharray($sql);


$t->assign(array(
	"BALANCE_BILL_URL" => sed_url('plug', 'e=balance&m=bill'),
	"BALANCE_SUMM" => number_format($balance['summ'], '2', '.', ' '),
	));
	
	
	
if($type == 'pro')
{	
	$jscode = '
	<script type="text/javascript">
		function balance_calculate_result_amount(months)
		{
			balance = '.$balance['summ'].';
			cost = '.$cfg['plugin']['balance']['cost_pro'].';

			var result_amount = 0;

			if(months == 3)
				result_amount = cost*months*0.95;
			if(months == 6)
				result_amount = cost*months*0.85;
			if(months == 12)
				result_amount = cost*months*0.60;
			if(months < 3)
				result_amount = cost*months;	

			if (isNaN(result_amount)) result_amount = 0;
			else result_amount = Math.abs(result_amount);

			document.getElementById("result_amount").innerHTML = result_amount;
			if(balance < result_amount) 
				$("#submitbuttontobuy").hide();
			else
				$("#submitbuttontobuy").show();
		}
		
	</script>';

	$t->assign(array(
		"BALANCE_BUY_PRO_ACTION_URL" => sed_url('plug', 'e=balance&m=buy&type=pro&a=pay'),
		"BALANCE_JS" => $jscode,
		"BALANCE_BUY_PRO_1M" => $cfg['plugin']['balance']['cost_pro'],
		"BALANCE_BUY_PRO_3M" => $cfg['plugin']['balance']['cost_pro']*3*0.95,
		"BALANCE_BUY_PRO_6M" => $cfg['plugin']['balance']['cost_pro']*6*0.85,
		"BALANCE_BUY_PRO_12M" => $cfg['plugin']['balance']['cost_pro']*12*0.60,
	));
	$t->parse("MAIN.BUYPRO");
}	

if($type == 'top')
{	
	$jscode = '
	<script type="text/javascript">
		function balance_calculate_result_amount(months)
		{
			balance = '.$balance['summ'].';
			cost = '.$cfg['plugin']['balance']['cost_top'].';

			var result_amount = 0;

			if(months == 3)
				result_amount = cost*months*0.95;
			if(months == 6)
				result_amount = cost*months*0.85;
			if(months == 12)
				result_amount = cost*months*0.60;
			if(months < 3)
				result_amount = cost*months;	

			if (isNaN(result_amount)) result_amount = 0;
			else result_amount = Math.abs(result_amount);

			document.getElementById("result_amount").innerHTML = result_amount;
			if(balance < result_amount) 
				$("#submitbuttontobuy").hide();
			else
				$("#submitbuttontobuy").show();
		}
		
	</script>';
	
	$t->assign(array(
		"BALANCE_BUY_TOP_ACTION_URL" => sed_url('plug', 'e=balance&m=buy&type=top&a=pay'),
		"BALANCE_JS" => $jscode,
		"BALANCE_BUY_TOP_COST" => $cfg['plugin']['balance']['cost_top'],
		"BALANCE_BUY_TOP_1M" => $cfg['plugin']['balance']['cost_top'],
		"BALANCE_BUY_TOP_3M" => $cfg['plugin']['balance']['cost_top']*3*0.95,
		"BALANCE_BUY_TOP_6M" => $cfg['plugin']['balance']['cost_top']*6*0.85,
		"BALANCE_BUY_TOP_12M" => $cfg['plugin']['balance']['cost_top']*12*0.60,
	));
	$t->parse("MAIN.BUYTOP");
}


if($type == 'protouser')
{	
	$jscode = '
	<script type="text/javascript">
		function balance_calculate_result_amount(months)
		{
			balance = '.$balance['summ'].';
			cost = '.$cfg['plugin']['balance']['cost_pro'].';

			var result_amount = 0;

			if(months == 3)
				result_amount = cost*months*0.95;
			if(months == 6)
				result_amount = cost*months*0.85;
			if(months == 12)
				result_amount = cost*months*0.60;
			if(months < 3)
				result_amount = cost*months;	

			if (isNaN(result_amount)) result_amount = 0;
			else result_amount = Math.abs(result_amount);

			document.getElementById("result_amount").innerHTML = result_amount;
			if(balance < result_amount) 
				$("#submitbuttontobuy").hide();
			else
				$("#submitbuttontobuy").show();
		}
		
	</script>';

	$t->assign(array(
		"BALANCE_BUY_PRO_ACTION_URL" => sed_url('plug', 'e=balance&m=buy&type=protouser&a=pay'),
		"BALANCE_JS" => $jscode,
		"BALANCE_BUY_PRO_1M" => $cfg['plugin']['balance']['cost_pro'],
		"BALANCE_BUY_PRO_3M" => $cfg['plugin']['balance']['cost_pro']*3*0.95,
		"BALANCE_BUY_PRO_6M" => $cfg['plugin']['balance']['cost_pro']*6*0.85,
		"BALANCE_BUY_PRO_12M" => $cfg['plugin']['balance']['cost_pro']*12*0.60,
	));
	$t->parse("MAIN.BUYPROTOUSER");
}	

if($type == 'transfer')
{	

	$t->assign(array(
		"BALANCE_BUY_TRANSFER_ACTION_URL" => sed_url('plug', 'e=balance&m=buy&type=transfer&a=pay'),
	));
	$t->parse("MAIN.BUYTRANSFER");
}

?>