<?PHP

defined('SED_CODE') or die('Wrong URL');

$id = sed_import('id','G','INT');
$r = sed_import('r','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'blogs', 'RWA');
sed_block($usr['auth_write']);

/* === Hook === */
$extp = sed_getextplugins('blogs.add.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='add')
{
	sed_shield_protect();
	
	/* === Hook === */
	$extp = sed_getextplugins('blogs.add.add.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$cat = sed_import('cat','P','INT');

	$newblogstitle = sed_import('newblogstitle','P','HTM');
	$newblogstext = sed_import('newblogstext','P','HTM');
	
	$error_string .= (empty($newblogstitle)) ? "Заголовок не может быть пустым<br />" : '';
	$error_string .= (empty($newblogstext)) ? "Сообщение не может быть пустым<br />" : '';
	
	if (empty($error_string))
	{
			
		if ($usr['isadmin'] && $cfg['autovalidate'])
		{
			$rpublish = sed_import('rpublish', 'P', 'ALP');
			if ($rpublish == 'OK' )
			{
				$item_state = 0;
			}
			else
			{
				$item_state = 1;
			}
		}
		else
		{
			$item_state = 1;
		}
		
		$item_state = 0;
		

		/* === Hook === */
		$extp = sed_getextplugins('blogs.add.add.query');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */
		
		$ssql = "INSERT into sed_blogs
		(item_userid,
		item_date,
		item_cat,
		item_title,
		item_text,
		item_state)
		VALUES
		(".(int)$usr['id'].",
		".(int)$sys['now_offset'].",
		".(int)$cat.",
		'".sed_sql_prep($newblogstitle)."',
		'".sed_sql_prep($newblogstext)."',
		".(int)$item_state.")";
  		$sql = sed_sql_query($ssql);

		$id = sed_sql_insertid();
		$r_url = (!$item_state) ? sed_url('plug', "e=blogs&m=show&id=".$id, '', true) : sed_url('message', "msg=300", '', true);
		
		$sed_bcat = sed_load_bcat();
		sed_cache_store('sed_bcat', $sed_bcat, 3600);
			
		if(!$usr['isadmin']){
			$rsubject = "Новое сообщение в блогах";
			$rbody = "Пожалуйста, проверьте только что опубликованное сообщение в блогах. Дата публикации: ".date('d.m.y H:i:s', $sys['now_offset'])."\n";
			sed_mail ($cfg['adminemail'], $rsubject, $rbody);
			}
			
//		//============================================
//		if($usr['isadmin']){
//			$url = SED_ABSOLUTE_URL . sed_url('plug', "e=blogs&m=show&id=".$id, '', true);
//			$message = htmlspecialchars(sed_cutstring(strip_tags(sed_parse($itemextrafields['item_title'], 1, $cfg['parsesmiliespages'], true)), 100)).' '.$url;
//
//			
//			/* Load required lib files. */
//			session_start();
//			require_once('./twitter-oauth/twitteroauth/twitteroauth.php');
//			require_once('./twitter-oauth/config.php');
//
//			/* Get user access tokens out of the session. */
//			$access_token['oauth_token'] = '184651769-8suIfqaAMiReG8t0HxWZmHbMBICUmTpW8CrgEwet';
//			$access_token['oauth_token_secret'] = 'tCBSUraUwhQjqkP16YcLwCHmDzTsCTD3UOgzAYuD0g';
//			$access_token['user_id'] = '184651769';
//			$access_token['screen_name'] = 'kamaroom';
//			//if($usr['isadmin']) print_r($access_token);
//			
//			/* Create a TwitterOauth object with consumer/user tokens. */
//			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
//			
//			/* If method is set change API call made. Test is called by default. */
//			$content = $connection->get('account/rate_limit_status');
//			echo "Current API hits remaining: {$content->remaining_hits}.";
//			
//			$connection->post('statuses/update',array('status'=>$message));
//		}
//		//===========================================	
			
		/* === Hook === */
		$extp = sed_getextplugins('blogs.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */	
		
		header("Location: " . SED_ABSOLUTE_URL . $r_url);
		exit;
	}
}

$mskin = sed_skinfile('blogs.add', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('blogs.add.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("BLOGADD_ERROR_BODY",$error_string);
	$t->parse("MAIN.BLOGADD_ERROR");
}

$pfs = sed_build_pfs($usr['id'], 'newpost', 'newblogstext',$L['Mypfs']);
$pfs .= (sed_auth('pfs', 'a', 'A')) ? " &nbsp; ".sed_build_pfs(0, 'newpost', 'newblogstext', $L['SFS']) : '';
$pfs_form_url_myfiles = (!$cfg['disable_pfs']) ? sed_build_pfs($usr['id'], "newpost", "newpageurl", $L['Mypfs']) : '';
$pfs_form_url_myfiles .= (sed_auth('pfs', 'a', 'A')) ? ' '.sed_build_pfs(0, 'newpost', 'newpageurl', $L['SFS']) : '';


$t->assign(array(
	"BLOGADD_FORM_SEND" => sed_url('plug', "e=blogs&m=add&a=add"),
	"BLOGADD_FORM_OWNERID" => $usr['id'],
	"BLOGADD_FORM_CAT" => sed_selectbox_bcat('cat', $cat),
	"BLOGADD_FORM_TITLE" => $newblogstitle,
	"BLOGADD_FORM_TEXT" => $newblogstext,
	"BLOGADD_FORM_PFS" => $pfs,
	));

/* === Hook === */
$extp = sed_getextplugins('blogs.add.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>