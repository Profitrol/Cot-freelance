<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=homepage
File=freelancers.index
Hooks=index.tags
Tags=index.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$t->assign(array(
	"FREELANCERS_CATALOG" => sed_showfcat()
));

$sql = sed_sql_query("SELECT * FROM sed_users WHERE user_toptodate>".$sys['now_offset']." ORDER BY user_toptodate DESC");
while($tur = sed_sql_fetcharray($sql))
{
	$t->assign(array(
		"TUR_ROW_NAME" => (empty($tur['user_fname']) && empty($tur['user_sname'])) ? sed_build_user($tur['user_id'], htmlspecialchars($tur['user_name'])) : sed_build_uname($tur['user_id'], htmlspecialchars($tur['user_name']), htmlspecialchars($tur['user_fname']." ".$tur['user_sname'])),
		"TUR_ROW_URL" => sed_url('users', 'm=details&id='.$tur['user_id'].'&u='.$tur['user_name']),
		"TUR_ROW_AVATAR" => sed_build_avatar($tur['user_avatar'], 'thumbs'),
		"TUR_ROW_STATUS" => (!empty($tur['user_status'])) ? $tur['user_status'] : $sed_fcat[$tur['user_cat']]['title'],
		"TUR_ROW_PRO" => (sed_ispro($tur['user_protodate'])) ? '<img src="images/pro.png" align="absmiddle">' : ''
	));
	$t->parse("MAIN.TOPUSERS.TUR_ROWS");
}
$t->parse("MAIN.TOPUSERS");

?>