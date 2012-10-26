<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=blogs
Part=homepage
File=blogs.index
Hooks=index.tags
Tags=index.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$sql = sed_sql_query("SELECT * 
	FROM sed_blogs as b
	LEFT JOIN sed_users AS u ON u.user_id=b.item_userid
	WHERE item_state='0'
	ORDER BY item_date DESC LIMIT 3");
	
$jj=1;	

while ($item = sed_sql_fetcharray($sql)){
	$jj++;
	
	$t->assign(array(
		"BLOG_ROW_OWNER" => sed_build_uname($item['user_id'], $item['user_name'], $item['user_fname']." ".$item['user_sname']),
		"BLOG_ROW_SHOW_URL" => sed_url('plug', 'e=blogs&m=show&id='.$item['item_id'], '', true),
		"BLOG_ROW_ODDEVEN" => sed_build_oddeven($jj),
    	"BLOG_ROW_NUM" => $jj,
		"BLOG_ROW_DATE" => date('d.m', $item['item_date']),
		"BLOG_ROW_TITLE" => $item['item_title'],
		"BLOG_ROW_AVATAR" => sed_build_avatar($item['user_avatar'], 'thumbs'),
		"BLOG_ROW_SHORTTEXT" => sed_cutstring($item['item_text'], 200),
		"BLOG_ROW_BEGIN" => ($jj % 2 == 0) ? '<tr>' : '',
		"BLOG_ROW_END" => ($jj+1 % 2 == 0) ? '</tr>' : '',
		));

	$t->parse("MAIN.NEWBLOG.BLOG_ROW");
	}

$t->parse("MAIN.NEWBLOG");

?>