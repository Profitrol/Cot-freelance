<?PHP

/* ====================

[BEGIN_SED_EXTPLUGIN]
Code=rating
Part=main
File=rating.users.details.tags
Hooks=users.details.tags
Tags=users.details.tpl:
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once('plugins/rating/inc/functions.php');

$t->assign(array(
	"USERS_DETAILS_RATING" => number_format(sed_getuserrating($urr['user_id']), '1', '.', ' '),
));

?>
