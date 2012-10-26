<?PHP

defined('SED_CODE') or die('Wrong URL');

$orderid = sed_import('orderid','G','INT');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'balance', 'RWA');
sed_block($usr['auth_read']);

$mskin = sed_skinfile('balance.bill', true);
$t = new XTemplate($mskin);

if(empty($a) && $usr['id'] != 0)
{
			
	$t->assign(array(
		"BILL_FORM_ACTION_URL" => sed_url('plug','e=balance&m=bill&a=send'),
	));
	$t->parse("MAIN.BILLFORM");
	
}
elseif($a == 'send' && $usr['id'] != 0)
{
	
	$summ = sed_import('summ', 'P', 'TXT');
	
	$sql = sed_sql_query("DELETE FROM sed_balance WHERE item_userid=".$usr['id']." AND item_status=0");
	
	if(!empty($summ) && is_numeric($summ))
	{
		$sql = sed_sql_query("INSERT into sed_balance ( 
			item_userid,
			item_summ,
			item_status,
			item_desc
			) 
			VALUES(
			".(int)$usr['id'].", 
			'".$summ."',
			0,
			'bill'
			)");
		$orderid = sed_sql_insertid();	
	
		$sql = sed_sql_query("SELECT * FROM sed_balance WHERE item_userid=".$usr['id']." 
			AND item_id=".$orderid."
			AND item_status=0 
			AND item_desc='bill'
			LIMIT 1" );
		sed_die(sed_sql_numrows($sql)==0);
		if($bill = sed_sql_fetcharray($sql))
		{
			// 2.
			// Оплата заданной суммы с выбором валюты на сайте ROBOKASSA
			
			// регистрационная информация (логин, пароль #1)
			$mrh_login = $cfg['plugin']['balance']['mrh_login'];
			$mrh_pass1 = $cfg['plugin']['balance']['mrh_pass1'];
			
			// номер заказа
			$inv_id = $bill['item_id'];
			
			$inv_desc1 = 'Пополнение счета #'.$usr['id'];
	
			// описание заказа
			$inv_desc = 'Пополнение счета #'.$usr['id'];
			
			// сумма заказа
			$out_summ = $bill['item_summ'];
			
			// тип товара
			$shp_item = 'bill';
			
			// предлагаемая валюта платежа
			$in_curr = 'WMR';
			
			// язык
			$culture = "ru";
			
			// формирование подписи
			$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");
			
			// форма оплаты товара
			
			$t->assign(array(
			"ROBOX_TITLE" => 'Пополнение счета #'.$usr['id'],
			"ROBOX_DESC" => $inv_desc1,
			"ROBOX_SUMM" => $out_summ,
			"ROBOX_CURR" => $in_curr,
			));
			if($cfg['plugin']['balance']['testmode'])
			{
				$t->assign(array(
					"ROBOX_FORM" => "<form action='http://test.robokassa.ru/Index.aspx' method=POST>".
					"<input type=hidden name=MrchLogin value=$mrh_login>".
					"<input type=hidden name=OutSum value=$out_summ>".
					"<input type=hidden name=InvId value=$inv_id>".
					"<input type=hidden name=Desc value='$inv_desc'>".
					"<input type=hidden name=SignatureValue value=$crc>".
					"<input type=hidden name=Shp_item value='$shp_item'>".
					"<input type=hidden name=IncCurrLabel value=$in_curr>".
					"<input type=hidden name=Culture value=$culture>".
					"<a href=\"javascript:back(-1);\"><< Вернуться назад</a> &nbsp;&nbsp;&nbsp;&nbsp; <input type=submit value='Оплатить'>".
					"</form>",
				));
			}
			else
			{
				$t->assign(array(
				  "ROBOX_FORM" => "<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>".
				  "<input type=hidden name=MrchLogin value=$mrh_login>".
				  "<input type=hidden name=OutSum value=$out_summ>".
				  "<input type=hidden name=InvId value=$inv_id>".
				  "<input type=hidden name=Desc value='$inv_desc'>".
				  "<input type=hidden name=SignatureValue value=$crc>".
				  "<input type=hidden name=Shp_item value='$shp_item'>".
				  "<input type=hidden name=IncCurrLabel value=$in_curr>".
				  "<input type=hidden name=Culture value=$culture>".
				  "<a href=\"javascript:back(-1);\"><< Вернуться назад</a> &nbsp;&nbsp;&nbsp;&nbsp; <input type=submit value='Оплатить'>".
				  "</form>",	  
				));
			}
			$t->parse("MAIN.ROBOXSEND");
		}
		else
		{
		header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=balance&m=bill", '', true));
		exit;
		}
	}
	else
	{
	header("Location: " . SED_ABSOLUTE_URL . sed_url('plug', "e=balance&m=bill", '', true));
	exit;
	}
}
elseif($a == 'result'){
	
	// регистрационная информация (пароль #2)
	// registration info (password #2)
	$mrh_pass2 = $cfg['plugin']['balance']['mrh_pass2'];
	
	//установка текущего времени
	//current date
	$tm=getdate(time()+9*3600);
	$date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";
	
	// чтение параметров
	// read parameters
	$out_summ = $_REQUEST["OutSum"];
	$inv_id = $_REQUEST["InvId"];
	$shp_item = $_REQUEST["Shp_item"];
	$crc = $_REQUEST["SignatureValue"];
	
	$crc = strtoupper($crc);
	
	$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));
	
	// проверка корректности подписи
	// check signature
	if ($my_crc !=$crc){
		$plugin_body = "Некорректная подпись";
		}
	else{
		$sql = sed_sql_query("UPDATE sed_balance SET 
			item_status=1, 
			item_date=".(int)$sys['now_offset']." 
			WHERE item_id=".$inv_id."");
			
		$plugin_body = "Оплата прошла успешно. Желаем приятной и успешной работы!";
	
		}
	
	$t->assign(array(
		"ROBOX_TITLE" => "Результат операции оплаты",
		"ROBOX_ERROR" => $plugin_body
		));		
	$t->parse("MAIN.ERROR");	
		
	}
elseif($a == 'success'){
	
	// регистрационная информация (пароль #1)
	// registration info (password #1)
	$mrh_pass1 = $cfg['plugin']['balance']['mrh_pass1'];
	
	// чтение параметров
	// read parameters
	$out_summ = $_REQUEST["OutSum"];
	$inv_id = $_REQUEST["InvId"];
	$shp_item = $_REQUEST["Shp_item"];
	$crc = $_REQUEST["SignatureValue"];
	
	$crc = strtoupper($crc);
	
	$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item"));
	
	$plugin_body = "Отказ от оплаты.";
	
	// проверка корректности подписи
	// check signature
	if ($my_crc != $crc){
		$plugin_body = "Некорректная подпись";
		}
	else{
		// проверка наличия номера счета в истории операций
		$sql = sed_sql_query("SELECT * FROM sed_balance WHERE item_userid=".$usr['id']." AND item_id=".$inv_id." AND item_status=1 AND item_desc='bill' LIMIT 1" );
		if($bill = sed_sql_fetcharray($sql)){
			$plugin_body = "Оплата прошла успешно. Желаем приятной и успешной работы!";
			}	
		}
		
	$t->assign(array(
		"ROBOX_TITLE" => "Результат операции оплаты",
		"ROBOX_ERROR" => $plugin_body
		));
	$t->parse("MAIN.ERROR");			
	}
elseif($a == 'fail'){
	$t->assign(array(
		"ROBOX_TITLE" => "Результат операции оплаты",
		"ROBOX_ERROR" => "Оплата не произведена! Пожалуйста, повторите попытку. Если ошибка повторится, обратитесь к администратору сайта."
		));
	$t->parse("MAIN.ERROR");
	}
else{
	sed_die();
	}

?>