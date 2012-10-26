<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=offers
Part=plug
File=offers.projects.default.loop
Hooks=projects.default.loop
Tags=projects.default.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$offers_sql = sed_sql_query("SELECT COUNT(*) as count FROM sed_offers WHERE item_pid=".$item['item_id']."");
$prjoffers = sed_sql_fetcharray($offers_sql);

$t->assign(array(
	"PRJ_ROW_OFFERS_ADDOFFER_URL" => sed_url('plug', 'e=projects&m=show&itemid='.$item['item_id'], '#addofferform'),
	"PRJ_ROW_OFFERS_COUNT" => $prjoffers['count'],
));

?>