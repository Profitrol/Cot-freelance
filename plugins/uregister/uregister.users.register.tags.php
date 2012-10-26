<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uregister
Part=main
File=uregister.users.register.tags
Hooks=users.register.tags
Tags=users.register.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }


if($ruserregtype == 'freelancers')
	$selectregtype = '<input type="radio" checked="checked" name="ruserregtype" value="freelancers"/> '.$skinlang['users']['freelancer'].' &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ruserregtype" value="employers"/> '.$skinlang['users']['employer'];
elseif($ruserregtype == 'employers')
	$selectregtype = '<input type="radio" name="ruserregtype" value="freelancers"/> '.$skinlang['users']['freelancer'].' &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  checked="checked" name="ruserregtype" value="employers"/> '.$skinlang['users']['employer'];
else
	$selectregtype = '<input type="radio" name="ruserregtype" value="freelancers"/> '.$skinlang['users']['freelancer'].' &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ruserregtype" value="employers"/> '.$skinlang['users']['employer'];

	
$t->assign(array(
	"USERS_REGISTER_REGTYPE" => $selectregtype
	));

?>
