<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=balance
Part=header
File=balance.header.body
Hooks=header.body
Tags=
Order=0
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL.');

if($usr['id'] > 0)
{
	$sql_balance = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$usr['id']." AND item_status=1");
	$balance = sed_sql_fetcharray($sql_balance);
	
	$t->assign(array(
		"BALANCE_URL" => sed_url('plug', 'e=balance'),
		"BALANCE_BILL_URL" => sed_url('plug', 'e=balance&m=bill'),
		"BALANCE_SUMM" => number_format($balance['summ'], '2', '.', ' '),
	));
}

?>