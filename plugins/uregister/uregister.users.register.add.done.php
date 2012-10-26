<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uregister
Part=main
File=uregister.users.register.add.done
Hooks=users.register.add.done
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$rsubject = "Регистрация нового пользователя ".$urr['user_name'];
$rbody = "Сообщаем Вам, что на Вашем сайте зарегистрировался новый пользователь.\n\n";
$rbody .= "Логин: ".$rusername."\n";
sed_mail ($cfg['adminemail'], $rsubject, $rbody);	

?>
