<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=balance
Part=admin
File=balance.admin
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

$plugin_title = "Счета пользователей";

if($a == 'transfer'){
	$username = sed_import('username','P','ALP');
	$summ = sed_import('summ','P','INT');
	
	if(!empty($username)){
		$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_name='".sed_sql_prep($username)."'");
		$user = sed_sql_fetcharray($sql);
	}
	
	if(!empty($user)){
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
		}
		
	header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', "m=tools&p=balance", '', true));
	exit;
}

$t = new XTemplate(sed_skinfile('balance.admin', true));

//$sql = sed_sql_query("SELECT COUNT(*) FROM sed_users WHERE 1");
//$totalusers = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM sed_users WHERE 1");

// $totalpage = ceil($totalusers / $cfg['maxusersperpage']);
// $currentpage = ceil($d / $cfg['maxusersperpage']) + 1;

// $pagnav = sed_pagination(sed_url('admin', 'm=tools&p=balance'), $d, $totalusers, $cfg['maxusersperpage']);
// list($pages_prev, $pages_next) = sed_pagination_pn(sed_url('admin', 'm=tools&p=balance'), $d, $totalusers, $cfg['maxusersperpage'], TRUE);

// $t->assign(array(
	// "USERS_PAGNAV" => $pagnav,
	// "USERS_PAGEPREV" => $pages_prev,
	// "USERS_PAGENEXT" => $pages_next,
	// ));

while ($urr = sed_sql_fetcharray($sql)){
	
	$sql_balance = sed_sql_query("SELECT SUM(item_summ) as summ FROM sed_balance WHERE item_userid=".$urr['user_id']." AND item_status=1");
	$ubalance = sed_sql_fetcharray($sql_balance);
	
	if($ubalance['summ'] != 0)
	{
		$t->assign(array(
			"USR_ROW_ID" => $urr['user_id'],
			"USR_ROW_NAME" => sed_build_user($urr['user_id'], htmlspecialchars($urr['user_name'])),
			"USR_ROW_BALANCE" => number_format($ubalance['summ'], '2', '.', ' '),
		));
		
		unset($ubalance);	
	
		$t->parse("MAIN.USR_ROW");
	}	

}

$t->assign(array(
	"FORM_ACTION_URL" => sed_url('admin','m=tools&p=balance&a=transfer'),
));


$t -> parse("MAIN");
$plugin_body .= $t -> text("MAIN");

?>