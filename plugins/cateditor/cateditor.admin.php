<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=cateditor
Part=admin
File=cateditor.admin
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

// $sql = sed_sql_query("ALTER TABLE `sed_blogs_cat`  ADD `cat_mtitle` VARCHAR(255) NOT NULL AFTER `cat_title`,  ADD `cat_mdesc` VARCHAR(255) NOT NULL AFTER `cat_mtitle`,  ADD `cat_mkey` VARCHAR(255) NOT NULL AFTER `cat_mdesc`");

// $sql = sed_sql_query("ALTER TABLE `sed_market_cat`  ADD `cat_mtitle` VARCHAR(255) NOT NULL AFTER `cat_title`,  ADD `cat_mdesc` VARCHAR(255) NOT NULL AFTER `cat_mtitle`,  ADD `cat_mkey` VARCHAR(255) NOT NULL AFTER `cat_mdesc`");

// $sql = sed_sql_query("ALTER TABLE `sed_projects_cat`  ADD `cat_mtitle` VARCHAR(255) NOT NULL AFTER `cat_title`,  ADD `cat_mdesc` VARCHAR(255) NOT NULL AFTER `cat_mtitle`,  ADD `cat_mkey` VARCHAR(255) NOT NULL AFTER `cat_mdesc`");

// $sql = sed_sql_query("ALTER TABLE `sed_freelancers_cat`  ADD `cat_mtitle` VARCHAR(255) NOT NULL AFTER `cat_title`,  ADD `cat_mdesc` VARCHAR(255) NOT NULL AFTER `cat_mtitle`,  ADD `cat_mkey` VARCHAR(255) NOT NULL AFTER `cat_mdesc`");

// $sql = sed_sql_query("ALTER TABLE `sed_types_cat`  ADD `cat_mtitle` VARCHAR(255) NOT NULL AFTER `cat_title`,  ADD `cat_mdesc` VARCHAR(255) NOT NULL AFTER `cat_mtitle`,  ADD `cat_mkey` VARCHAR(255) NOT NULL AFTER `cat_mdesc`");



$plugin_title = "Редактор категорий";

$cat = sed_import('cat', 'G', 'ALP');
$a = sed_import('a', 'G', 'ALP');
$id = sed_import('id', 'G', 'INT');

$t = new XTemplate(sed_skinfile('cateditor', true));

$t->assign(array(
	"CAT_PROJECTS_URL" => sed_url("admin", "m=tools&p=cateditor&cat=projects"),
	"CAT_FREELANCERS_URL" => sed_url("admin", "m=tools&p=cateditor&cat=freelancers"),
	"CAT_TYPES_URL" => sed_url("admin", "m=tools&p=cateditor&cat=types"),
	"CAT_MARKET_URL" => sed_url("admin", "m=tools&p=cateditor&cat=market"),
	"CAT_BLOG_URL" => sed_url("admin", "m=tools&p=cateditor&cat=blogs"),
));

if($a == 'add')
{
	$parent = sed_import('parent','P','INT');
	$mtitle = sed_import('mtitle','P','TXT');
	$mdesc = sed_import('mdesc','P','TXT');
	$mkey = sed_import('mkey','P','TXT');
	$title = sed_import('title','P','TXT');
	$text = sed_import('text','P','HTM');
	$sort = sed_import('sort','P','INT');
	
	$error_string .= (empty($title)) ? "Название категории не может быть пустым<br />" : '';
	
	if (empty($error_string) && !empty($cat))
	{
		
		$ssql = "INSERT into sed_".$cat."_cat
		(cat_parent,
		cat_title,
		cat_mtitle,
		cat_mdesc,
		cat_mkey,
		cat_text,
		cat_sort)
		VALUES
		(".(int)$parent.",
		'".sed_sql_prep($title)."',
		'".sed_sql_prep($mtitle)."',
		'".sed_sql_prep($mdesc)."',
		'".sed_sql_prep($mkey)."',
		'".sed_sql_prep($text)."',
		".(int)$sort.")";
  		$sql = sed_sql_query($ssql);
		
		if($cat == 'projects')
		{
			$sed_pcat = sed_load_pcat();
			sed_cache_store('sed_pcat', $sed_pcat, 3600);
		}
		elseif($cat == 'types')
		{
			$sed_ptype = sed_load_ptype();
			sed_cache_store('sed_ptype', $sed_ptype, 3600);
		}
		elseif($cat == 'freelancers')
		{
			$sed_fcat = sed_load_fcat();
			sed_cache_store('sed_fcat', $sed_fcat, 3600);
		}
		elseif($cat == 'market')
		{
			$sed_mcat = sed_load_mcat();
			sed_cache_store('sed_mcat', $sed_mcat, 3600);
		}
		elseif($cat == 'blogs')
		{
			$sed_bcat = sed_load_bcat();
			sed_cache_store('sed_bcat', $sed_bcat, 3600);
		}
		
		header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=cateditor&cat='.$cat, '#footer', true));
		exit;
	}
	
}
elseif($a == 'update')
{
	$parent = sed_import('parent','P','INT');
	$title = sed_import('title','P','TXT');
	$mtitle = sed_import('mtitle','P','TXT');
	$mdesc = sed_import('mdesc','P','TXT');
	$mkey = sed_import('mkey','P','TXT');
	$text = sed_import('text','P','HTM');
	$sort = sed_import('sort','P','INT');
	$delete = sed_import('delete','P','BOL');
	
	$error_string .= (empty($title)) ? "Название категории не может быть пустым<br />" : '';
	
	if (empty($error_string) && !empty($cat))
	{
		
		if ($delete)
		{
			$sql = sed_sql_query("SELECT * FROM sed_".$cat."_cat WHERE cat_id='$id' LIMIT 1");

			if ($row = sed_sql_fetchassoc($sql))
			{	
				
				$sql = sed_sql_query("DELETE FROM sed_".$cat."_cat WHERE cat_id='$id'");
				
				if($cat == 'projects')
				{
					$sed_pcat = sed_load_pcat();
					sed_cache_store('sed_pcat', $sed_pcat, 3600);
				}
				elseif($cat == 'types')
				{
					$sed_ptype = sed_load_ptype();
					sed_cache_store('sed_ptype', $sed_ptype, 3600);
				}
				elseif($cat == 'freelancers')
				{
					$sed_fcat = sed_load_fcat();
					sed_cache_store('sed_fcat', $sed_fcat, 3600);
				}
				elseif($cat == 'market')
				{
					$sed_mcat = sed_load_mcat();
					sed_cache_store('sed_mcat', $sed_mcat, 3600);
				}
				elseif($cat == 'blogs')
				{
					$sed_bcat = sed_load_bcat();
					sed_cache_store('sed_bcat', $sed_bcat, 3600);
				}
				
				header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=cateditor&cat='.$cat, '#footer', true));
				exit;
			}
		}
		else
		{
		
			$ssql = "UPDATE sed_".$cat."_cat SET
				cat_parent = ".(int)$parent.",
				cat_title = '".sed_sql_prep($title)."',
				cat_mtitle = '".sed_sql_prep($mtitle)."',
				cat_mdesc = '".sed_sql_prep($mdesc)."',
				cat_mkey = '".sed_sql_prep($mkey)."',
				cat_text = '".sed_sql_prep($text)."',
				cat_sort = ".(int)$sort."
				WHERE cat_id='$id'";
			$sql = sed_sql_query($ssql);
			
			if($cat == 'projects')
			{
				$sed_pcat = sed_load_pcat();
				sed_cache_store('sed_pcat', $sed_pcat, 3600);
			}
			elseif($cat == 'types')
			{
				$sed_ptype = sed_load_ptype();
				sed_cache_store('sed_ptype', $sed_ptype, 3600);
			}
			elseif($cat == 'freelancers')
			{
				$sed_fcat = sed_load_fcat();
				sed_cache_store('sed_fcat', $sed_fcat, 3600);
			}
			elseif($cat == 'market')
			{
				$sed_mcat = sed_load_mcat();
				sed_cache_store('sed_mcat', $sed_mcat, 3600);
			}
			elseif($cat == 'blogs')
			{
				$sed_bcat = sed_load_bcat();
				sed_cache_store('sed_bcat', $sed_bcat, 3600);
			}
			
			header("Location: " . SED_ABSOLUTE_URL . sed_url('admin', 'm=tools&p=cateditor&cat='.$cat, '#footer', true));
			exit;
		
		}
	}
}

if(!empty($cat))
{
	switch($cat)
	{
		case 'projects':
		
		$sed_pcat_result .= "<ul>";
		foreach($sed_pcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				if($i == $id || $cats['parent'] == $id) $currentclass = 'class="current"'; 
				$sed_pcat_result .= "<li ".$currentclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=projects&id=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
				
//				if($cats['count'] > 0)
//				{
					$sed_pcat_result .= "<ul>";
					foreach($sed_pcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $id) $actclass = 'class="act"';
							$sed_pcat_result .= "<li ".$actclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=projects&id=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
						}
					}
					$sed_pcat_result .= "</ul>";
//				}
				
				$sed_pcat_result .= "</li>";
			}
		}
		$sed_pcat_result .= "</ul>";
		
		$t->assign(array(
			"CAT_SHOW" => $sed_pcat_result
		));
		if(empty($id)) $t->parse("MAIN.PROJECTS");
		
		break;
		
		// ===================================================
		
		case 'types':
		
		$sed_ptype_result .= "<ul>";
		foreach($sed_ptype as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				if($i == $id || $cats['parent'] == $id) $currentclass = 'class="current"'; 
				$sed_ptype_result .= "<li ".$currentclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=types&id=".$i)."\">".$cats['title']."</a></li>";
			}
		}
		$sed_ptype_result .= "</ul>";
		
		$t->assign(array(
			"CAT_SHOW" => $sed_ptype_result
		));
		if(empty($id)) $t->parse("MAIN.TYPES");
		
		break;
		
		// ===================================================
		
		case 'freelancers':
		
		$sed_fcat_result .= "<ul>";
		foreach($sed_fcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				if($i == $id || $cats['parent'] == $id) $currentclass = 'class="current"'; 
				$sed_fcat_result .= "<li ".$currentclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=freelancers&id=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
				
//				if($cats['count'] > 0)
//				{
					$sed_fcat_result .= "<ul>";
					foreach($sed_fcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $id) $actclass = 'class="act"';
							$sed_fcat_result .= "<li ".$actclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=freelancers&id=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
						}
					}
					$sed_fcat_result .= "</ul>";
//				}
				
				$sed_fcat_result .= "</li>";
			}
		}
		$sed_fcat_result .= "</ul>";
		
		$t->assign(array(
			"CAT_SHOW" => $sed_fcat_result 
		));
		if(empty($id)) $t->parse("MAIN.FREELANCERS");
		
		break;
		
		case 'market':
		
		if(count($sed_mcat) > 0){
			$sed_mcat_result .= "<ul>";
			foreach($sed_mcat as $i => $cats)
			{
				if($cats['parent'] == 0)
				{
					if($i == $id || $cats['parent'] == $id) $currentclass = 'class="current"'; 
					$sed_mcat_result .= "<li ".$currentclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=market&id=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
					
	//				if($cats['count'] > 0)
	//				{
						$sed_mcat_result .= "<ul>";
						foreach($sed_mcat as $i1 => $cats1)
						{
							if($cats1['parent'] == $i)
							{
								if($i1 == $id) $actclass = 'class="act"';
								$sed_mcat_result .= "<li ".$actclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=market&id=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
							}
						}
						$sed_mcat_result .= "</ul>";
	//				}
					
					$sed_mcat_result .= "</li>";
				}
			}
			$sed_mcat_result .= "</ul>";
		}
		
		$t->assign(array(
			"CAT_SHOW" => $sed_mcat_result 
		));
		if(empty($id)) $t->parse("MAIN.MARKET");
		
		break;
		
		// ===================================================
		
		case 'blogs':
		
		$sed_bcat_result .= "<ul>";
		foreach($sed_bcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				if($i == $id || $cats['parent'] == $id) $currentclass = 'class="current"'; 
				$sed_bcat_result .= "<li ".$currentclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=blogs&id=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
				
//				if($cats['count'] > 0)
//				{
					$sed_bcat_result .= "<ul>";
					foreach($sed_bcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $id) $actclass = 'class="act"';
							$sed_bcat_result .= "<li ".$actclass."><a href=\"".sed_url("admin", "m=tools&p=cateditor&cat=blogs&id=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
						}
					}
					$sed_bcat_result .= "</ul>";
//				}
				
				$sed_bcat_result .= "</li>";
			}
		}
		$sed_bcat_result .= "</ul>";
		
		$t->assign(array(
			"CAT_SHOW" => $sed_bcat_result 
		));
		if(empty($id)) $t->parse("MAIN.BLOG");
		
		break;
		
	}
	
	// Родительские категории
	$sed_select_parentcats = '<select name="parent">';
	$sed_select_parentcats .= '<option value="0">--</option>';
	if($cat == 'projects')
		$scat = $sed_pcat;
	elseif($cat == 'types')
		$scat[] = 0;	
	elseif($cat == 'freelancers')
		$scat = $sed_fcat;
	elseif($cat == 'market')
		$scat = $sed_mcat;
	elseif($cat == 'blogs')
		$scat[] = 0;	
	
	if(count($scat) > 0){
		foreach($scat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{	
				$sed_select_parentcats .= '<option value="'.$i.'">'.$cats['title'].'</option>';
			}
		}
	}
	$sed_select_parentcats .= '</select>';
	
	$fileBroser = "";
	unset ($_SESSION['FileBroserFolder']);
	$_SESSION['FileBroserMaxUploadFileSize'] = 0;
	$_SESSION['FileBroserAllowedExts'] = '';
	
	if ($cfg['plugin']['ckeditor']['useAltFileManager']){
		$fileBroser = "
			filebrowserBrowseUrl : '/plugins/ckeditor/ajaxfilemanager/ajaxfilemanager.php?editor=ckeditor',
			filebrowserWindowWidth : '782',
			filebrowserWindowHeight : '500',";
	
		// Заряжаем настройки для AjaxFileManager
		$_SESSION['FileBroserFolder'] = $cfg['plugin']['ckeditor']['altFolder'];
		$_SESSION['FileBroserMaxUploadFileSize'] = $cfg['plugin']['ckeditor']['altFolder_maxUploadFileSize']*1024;
		$_SESSION['FileBroserAllowedExts'] = $cfg['plugin']['ckeditor']['altFolder_allowedExts'];
	
		// TODO проверка прав пользователя на использование Ajax FileManajer
		if ($cfg['plugin']['ckeditor']['altFileManForAdm'] && !$usr['isadmin']){
			$fileBroser = "";
			unset ($_SESSION['FileBroserFolder']);
			$_SESSION['FileBroserMaxUploadFileSize'] = 0;
			$_SESSION['FileBroserAllowedExts'] = '';
		}
	}
	$smiley_descriptions = '';
	$smiley_images = '';
	$i = 0;
	$smiles = '';
	if (is_array($sed_smilies)){
		foreach($sed_smilies as $smile){
			if ($i > 0){
				$smiley_descriptions .= ",";
				$smiley_images .=  ",";
			}
			$smiley_descriptions .= "'".$smile["code"]."'";
			$smiley_images .=  "'".$smile["file"]."'";
			$i++;
		}
		$smiles = "smiley_descriptions : [$smiley_descriptions],
				   smiley_images : [$smiley_images],
				   smiley_path : '/images/smilies/'";
	}

	$resize = ($cfg['plugin']['ckeditor']['resize_enabled']) ? 'true' : 'false';
		
	// Создание новой категории
	if(empty($id))
	{
		
		$t->assign(array(
			"ADDFORM_ACTION_URL" => sed_url('admin', 'm=tools&p=cateditor&cat='.$cat.'&a=add'),
			"ADDFORM_PARENT" => $sed_select_parentcats,
			"ADDFORM_TITLE" => $title,
			"ADDFORM_MTITLE" => $mtitle,
			"ADDFORM_MDESC" => $mdesc,
			"ADDFORM_MKEY" => $mkey,
			"ADDFORM_TEXT" => $text,
			"ADDFORM_SORT" => $sort,
		));
		$t->parse("MAIN.ADDFORM");
		
	}
	
	// Редактирование категории
	if(!empty($id))
	{
		$sql = sed_sql_query("SELECT * FROM sed_".$cat."_cat WHERE cat_id=".$id."");
		$item = sed_sql_fetcharray($sql);

		$sed_select_parentcats = '<select name="parent">';
		$sed_select_parentcats .= '<option value="0">--</option>';
		if($cat == 'projects'){
			$scat = $sed_pcat;
			$checkcat = ($sed_pcat[$item['cat_id']]['count'] == 0 && count(sed_pcatsub($item['cat_id'])) == 1) ? 1 : 0;
		}
		elseif($cat == 'types'){
			$scat[] = 0;		
			$checkcat = ($sed_ptype[$item['cat_id']]['count'] == 0) ? 1 : 0;
		}
		elseif($cat == 'freelancers'){
			$scat = $sed_fcat;
			$checkcat = ($sed_fcat[$item['cat_id']]['count'] == 0 && count(sed_fcatsub($item['cat_id'])) == 1) ? 1 : 0;
		}
		elseif($cat == 'market'){
			$scat = $sed_mcat;
			$checkcat = ($sed_mcat[$item['cat_id']]['count'] == 0 && count(sed_mcatsub($item['cat_id'])) == 1) ? 1 : 0;
		}
		elseif($cat == 'blogs'){
			$scat[] = 0;		
			$checkcat = ($sed_bcat[$item['cat_id']]['count'] == 0 && count(sed_bcatsub($item['cat_id'])) == 1) ? 1 : 0;
		}
			
		foreach($scat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				$sed_select_parentcats .= ($i == $item['cat_parent']) ? '<option selected="selected" value="'.$i.'">'.$cats['title'].'</option>' : '<option value="'.$i.'">'.$cats['title'].'</option>';
			}
		}
		$sed_select_parentcats .= '</select>';

		$item_form_delete = "<input type=\"radio\" class=\"radio\" name=\"delete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"delete\" value=\"0\" checked=\"checked\" />".$L['No'];
		
		$t->assign(array(
			"EDITFORM_ACTION_URL" => sed_url('admin', 'm=tools&p=cateditor&cat='.$cat.'&id='.$id.'&a=update', '', true),
			"EDITFORM_PARENT" => $sed_select_parentcats,
			"EDITFORM_TITLE" => $item['cat_title'],
			"EDITFORM_MTITLE" => $item['cat_mtitle'],
			"EDITFORM_MDESC" => $item['cat_mdesc'],
			"EDITFORM_MKEY" => $item['cat_mkey'],
			"EDITFORM_TEXT" => $item['cat_text'],
			"EDITFORM_SORT" => $item['cat_sort'],
			"EDITFORM_DELETE" => ($checkcat) ? $item_form_delete : 'Чтобы удалить эту категорию нужно сначала удалить все товары в этой категории, а также все подкатегории.'
		));
		$t->parse("MAIN.EDITFORM");
	}
}
		
$t -> parse("MAIN");
$plugin_body .= $t -> text("MAIN");

?>