<?PHP

defined('SED_CODE') or die('Wrong URL');

$id = sed_import('id','G','INT');
$r = sed_import('r','G','ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('plug', 'market', 'RWA');
sed_block($usr['auth_write']);

// if(!$usr['isadmin'])
// {
	// if (!sed_ispro($usr['profile']['user_protodate']))
	// {
		// header("Location: " . SED_ABSOLUTE_URL . sed_url('message', "msg=1000", '', true));
		// exit;
	// }
// }

/* === Hook === */
$extp = sed_getextplugins('market.add.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='add')
{
	sed_shield_protect();
	
	/* === Hook === */
	$extp = sed_getextplugins('market.add.add.first');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */
	
	$u_tmp_name_img = $_FILES['img']['tmp_name'];
	$u_type_img = $_FILES['img']['type'];
	$u_name_img = $_FILES['img']['name'];
	$u_size_img = $_FILES['img']['size'];
	
	$cat = sed_import('cat','P','INT');
	$title = sed_import('title','P','TXT');
	$text = sed_import('text','P','TXT');
	$cost = sed_import('cost','P','TXT');
	
	$country = sed_import('country','P','INT');
	$region = sed_import('region','P','INT');
	$city = sed_import('city','P','INT');
	
	$error_string .= (empty($cat)) ? "Не выбран раздел<br />" : '';
//	$error_string .= (empty($region)) ? "Не выбран регион<br />" : '';
	$error_string .= (empty($title)) ? "Заголовок не может быть пустым<br />" : '';
	$error_string .= ($u_size_img > 1048576) ? "Размер изображения слишком большой" : '';
	
	if (empty($error_string))
	{
			
		/* === Hook === */
		$extp = sed_getextplugins('market.add.add.query');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */
		
		// Сохранение изображения
		$u_name_img  = str_replace("\'",'',$u_name_img );
		$u_name_img  = trim(str_replace("\"",'',$u_name_img ));
		$dotpos = strrpos($u_name_img,".")+1;
		$f_extension = substr($u_name_img, $dotpos, 5);
		$u_newname_img = time().".".$f_extension;
		$img = "datas/market/".$u_newname_img;
		
		if($f_extension=='jpg' || $f_extension=='jpeg' || $f_extension=='gif' || $f_extension=='png')
		{
			move_uploaded_file($u_tmp_name_img, $img);
			@chmod($img, 0766);
			
			ResizeImage($img, 'datas/market/', 'datas/market/tmp/', 900, 900, 1);
			unlink($img);
			rename(str_replace('datas/market/', 'datas/market/tmp/', $img), $img);
			unlink(str_replace('datas/market/', 'datas/market/tmp/', $img));
			
			ResizeImage($img, 'datas/market/', 'datas/market/thumbs/', 200, 200, 1);
		}
		else
		{	
			$img = '';
		}
			
		$ssql = "INSERT into sed_market
		(item_userid,
		item_date,
		item_cat,
		item_title,
		item_text,
		item_cost,
		item_img,
		item_country,
		item_region,
		item_city)
		VALUES
		(".(int)$usr['id'].",
		".(int)$sys['now_offset'].",
		".(int)$cat.",
		'".sed_sql_prep($title)."',
		'".sed_sql_prep($text)."',
		'".sed_sql_prep($cost)."',
		'".sed_sql_prep($img)."',
		".(int)$country.",
		".(int)$region.",
		".(int)$city.")";
  		$sql = sed_sql_query($ssql);

		$id = sed_sql_insertid();
		
		$sed_mcat = sed_load_mcat();
		sed_cache_store('sed_mcat', $sed_mcat, 3600);
				
		$r_url = sed_url('plug', "e=market&m=show&itemid=".$id, '', true);	
			
		/* === Hook === */
		$extp = sed_getextplugins('market.add.add.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */	
		
		header("Location: " . SED_ABSOLUTE_URL . $r_url);
		exit;
	}
}

$mskin = sed_skinfile('market.add', true);
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('market.add.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (!empty($error_string))
{
	$t->assign("PRDADD_ERROR_BODY",$error_string);
	$t->parse("MAIN.PRDADD_ERROR");
}

list($select_country, $select_region, $select_city) = sed_select_location('', $country, $region, $city);

$t->assign(array(
	"PRDADD_FORM_SEND" => sed_url('plug', "e=market&m=add&a=add"),
	"PRDADD_FORM_OWNERID" => $usr['id'],
	"PRDADD_FORM_CAT" => sed_selectbox_mcat('cat', $cat),
	"PRDADD_FORM_TITLE" => $title,
	"PRDADD_FORM_TEXT" => $text,
	"PRDADD_FORM_COST" => $cost,
	"PRDADD_FORM_COUNTRY" => $select_country,
	"PRDADD_FORM_REGION" => $select_region,
	"PRDADD_FORM_CITY" => $select_city,
));

/* === Hook === */
$extp = sed_getextplugins('market.add.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['autovalidate']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

?>