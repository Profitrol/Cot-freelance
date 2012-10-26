<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=users
File=freelancers.comments.loop
Hooks=comments.loop
Tags=comments.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$author = sed_userinfo($row['com_authorid']);

if(!empty($author['user_fname']) || !empty($author['user_sname']))
{
	$t->assign(array(
		"COMMENTS_ROW_AUTHOR" => sed_build_uname($row['com_authorid'], $author['user_name'], $author['user_fname']." ".$author['user_sname']),
	));	
}


?>