<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=users
File=freelancers.users.tags
Hooks=users.tags
Tags=users.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if($gm == 4)
{
	$t->assign(array(
		"FREELANCERS_CATALOG" => sed_showfcat($c),
		"CATTITLE" => (!empty($c)) ? ' / '.$sed_fcat[$c]['title'] : '',
		"CATTEXT" => $sed_fcat[$c]['text'],
	));
}

// ==============================================

list($select_country, $select_region, $select_city) = sed_select_location('', $country, $region, $city);

$t->assign(array(
	"SEARCH_ACTION_URL" => sed_url('users', "gm=".$gm."&c=".$c, '', true),
	"SEARCH_COUNTRY" => $select_country,
	"SEARCH_REGION" => $select_region,
	"SEARCH_CITY" => $select_city,
));

$t->parse("MAIN.SEARCH");
// ==============================================

?>