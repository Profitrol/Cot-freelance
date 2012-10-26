<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=balance
Part=main
File=balance
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') && defined('SED_PLUG') or die('Wrong URL');



switch($m){
	
	// Пополнение счета
	case 'bill':
	require('inc/balance.bill.inc.php');
	break;
	
	// Оплата услуг сервиса
	case 'buy':
	require('inc/balance.buy.inc.php');
	break;
	
	default:
	require('inc/balance.default.inc.php');
	break;

	}

?>