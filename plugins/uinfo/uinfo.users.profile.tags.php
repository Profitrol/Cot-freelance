<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=uinfo
Part=main
File=uinfo.users.profile.tags
Hooks=profile.tags
Tags=profile.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }


//if(empty($urr['user_uname'])) ? $urr['user_uname'] = $urr['user_name'];

if($m == 'details'){
$profile->assign(array(
//	"USERS_PROFILE_CAT" => sed_selectbox_fcat('rusercat', $urr['user_cat']),
	"USERS_PROFILE_UTYPE" => $sch_select_utype,
	"USERS_PROFILE_ISPRO" => sed_ispro($urr['user_protodate'])
));
}
else{
$t->assign(array(
//	"USERS_PROFILE_CAT" => sed_selectbox_fcat('rusercat', $urr['user_cat']),
	"USERS_PROFILE_UTYPE" => $sch_select_utype,
	"USERS_PROFILE_ISPRO" => sed_ispro($urr['user_protodate'])
));
}

?>
