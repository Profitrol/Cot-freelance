<?PHP

defined('SED_CODE') or die('Wrong URL');

$id = sed_import('id','G','INT');
$r = sed_import('r','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'portfolio', 'RWA');
sed_block($usr['auth_write']);

/* === Hook === */
$extp = sed_getextplugins('portfolio.add.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='add')
{
	sed_shield_protect();
	
	/* === Hook === */
	$extp = sed_getextplugins('portfolio.add.add.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$u_tmp_name_img = $_FILES['img']['tmp_name'];
	$u_type_img = $_FILES['img']['type'];
	$u_name_img = $_FILES['img']['name'];
	$u_size_img = $_FILES['img']['size'];
	
	$title = sed_import('title','P','TXT');
	$text = sed_import('text','P','TXT');
	$cat = sed_import('cat','P','INT');
	
	$error_string .= (empty($title)) ? "Заголовок не может быть пустым<br />" : '';
	$error_string .= ($u_size_img > 1048576) ? "Размер изображения слишком большой" : '';
	
	if (empty($error_string))
	{
			
		/* === Hook === */
		$extp = sed_getextplugins('portfolio.add.add.query');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */
		
		// Сохранение изображения
		$u_name_img  = str_replace("\'",'',$u_name_img );
		$u_name_img  = trim(str_replace("\"",'',$u_name_img ));
		$dotpos = strrpos($u_name_img,".")+1;
		$f_extension = substr($u_name_img, $dotpos, 5);
		$u_newname_img = time().".".$f_extension;
		$img = "datas/portfolio/".$u_newname_img;
		
		if($f_extension=='jpg' || $f_extension=='jpeg' || $f_extension=='gif' || $f_extension=='png')
		{
			move_uploaded_file($u_tmp_name_img, $img);
			@chmod($img, 0766);
			
			ResizeImage($img, 'datas/portfolio/', 'datas/portfolio/tmp/', 900, 900, 2);
			unlink($img);
			rename(str_replace('datas/portfolio/', 'datas/portfolio/tmp/', $img), $img);
			unlink(str_replace('datas/portfolio/', 'datas/portfolio/tmp/', $img));
			
			ResizeImage($img, 'datas/portfolio/', 'datas/portfolio/thumbs/', 200, 200, 1);
		}
		else
		{	
			$img = '';
		}
			
		$ssql = "INSERT into sed_portfolio
		(item_userid,
		item_cat,
		item_date,
		item_title,
		item_text,
		item_img)
		VALUES
		(".(int)$usr['id'].",
		".(int)$cat.",
		".(int)$sys['now_offset'].",
		'".sed_sql_prep($title)."',
		'".sed_sql_prep($text)."',
		'".sed_sql_prep($img)."')";
  		$sql = sed_sql_query($ssql);

		$id = sed_sql_insertid();
				
		$r_url = sed_url('plug', "e=portfolio&m=show&itemid=".$id, '', true);	
			
		/* === Hook === */
		$extp = sed_getextplugins('portfolio.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */	
		
		header("Location: " . SED_ABSOLUTE_URL . $r_url);
		exit;
	}
}

$mskin = sed_skinfile('portfolio.add', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('portfolio.add.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("PTFADD_ERROR_BODY",$error_string);
	$t->parse("MAIN.PTFADD_ERROR");
}

$t->assign(array(
	"PTFADD_FORM_SEND" => sed_url('plug', "e=portfolio&m=add&a=add"),
	"PTFADD_FORM_OWNERID" => $usr['id'],
	"PTFADD_FORM_TITLE" => $title,
	"PTFADD_FORM_TEXT" => $text,
	"PTFADD_FORM_CAT" => sed_selectbox_fcat('cat', $cat),
));

/* === Hook === */
$extp = sed_getextplugins('portfolio.add.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>