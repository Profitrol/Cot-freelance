<?PHP

defined('SED_CODE') or die('Wrong URL');

$pid = sed_import('pid','G','INT');
$id = sed_import('id','G','INT');
$touser = sed_import('touser','G','INT');
$r = sed_import('r','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'reviews', 'RWA');
sed_block($usr['auth_write']);

/* === Hook === */
$extp = sed_getextplugins('reviews.add.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='add')
{
	sed_shield_protect();
	
	/* === Hook === */
	$extp = sed_getextplugins('reviews.add.add.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$id = sed_import('id','P','INT');
	$text = sed_import('text','P','TXT');
	$score = sed_import('score','P','INT');
	
	$error_string .= (empty($text)) ? "Отзыв не может быть пустым<br />" : '';
	$error_string .= (empty($score)) ? "Укажите оценку<br />" : '';
	
	if (empty($error_string))
	{

		$touserinfo = sed_userinfo($id);
		
		$pid = (!empty($pid)) ? $pid : 0;
		
		/* === Hook === */
		$extp = sed_getextplugins('reviews.add.add.query');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */
		
		$ssql = "INSERT into sed_reviews
		(item_userid,
		item_touserid,
		item_text,
		item_score,
		item_date,
		item_pid
		)
		VALUES
		(".(int)$usr['id'].",
		".(int)$id.",
		'".sed_sql_prep($text)."',
		".(int)$score.",
		".(int)$sys['now_offset'].",
		".(int)$pid.")";
		
  		$sql = sed_sql_query($ssql);
		
		$itemid = sed_sql_insertid();
		
		$r_url = sed_url('users', "m=details&id=".$touserinfo['user_id']."&u=".$touserinfo['user_name']."&tab=reviews", '', true);
			
		/* === Hook === */
		$extp = sed_getextplugins('reviews.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */	
		
		header("Location: " . SED_ABSOLUTE_URL . $r_url);
		exit;
	}
}

$mskin = sed_skinfile('reviews.add', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('reviews.add.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("REVIEWADD_ERROR_BODY",$error_string);
	$t->parse("MAIN.REVIEWADD_ERROR");
}

$t->assign(array(
	"REVIEWADD_FORM_SEND" => sed_url('plug', "e=reviews&m=add&a=add&pid=".$pid.""),
	"REVIEWADD_FORM_OWNERID" => $usr['id'],
	"REVIEWADD_FORM_TOUSER" => (empty($touser)) ? $id : $touser,
	"REVIEWADD_FORM_TEXT" => $text,
	"REVIEWADD_FORM_SCORE" => $score,
));

/* === Hook === */
$extp = sed_getextplugins('reviews.add.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>