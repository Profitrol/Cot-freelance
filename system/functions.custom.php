<?php

if (!defined('SED_CODE')) { die('Wrong URL.'); }

include_once 'datas/config_custom.php'; // Подключение дополнительных настроек

function sed_build_avatar($image, $subdir=''){

    if(empty($image) || !file_exists(str_replace('datas/avatars/', 'datas/avatars/'.$subdir.'/', $image))){
        $image = 'datas/defaultav/blank.png';
    }
    elseif(!empty($subdir) && file_exists($image)){
        $image = str_replace('datas/avatars/', 'datas/avatars/'.$subdir.'/', $image);
    }
    return '<img src="'.$image.'" alt="" class="avatar" />';
}

function sed_getcountprjofuser($userid){
	
	global $sys;
	
	list($year, $month, $day) = explode('-', @date('Y-m-d', $sys['now_offset']));
	$currentday = sed_mktime(0, 0, 0, $month, $day, $year);
	
	$sql = sed_sql_query("SELECT COUNT(*) as count FROM sed_projects WHERE item_userid=".$userid." AND item_date<".$sys['now_offset']." AND item_date>".$currentday."");
	$countprjofuser = sed_sql_result($sql, 0, 0);
	
	return $countprjofuser;
}

function sed_getcountoffersofuser($userid){
	
	global $sys;
	
	list($year, $month, $day) = explode('-', @date('Y-m-d', $sys['now_offset']));
	$currentday = sed_mktime(0, 0, 0, $month, $day, $year);
	
	$sql = sed_sql_query("SELECT COUNT(*) as count FROM sed_offers WHERE item_userid=".$userid." AND item_date<".$sys['now_offset']." AND item_date>".$currentday."");
	$countoffersofuser = sed_sql_result($sql, 0, 0);
	
	return $countoffersofuser;
}


function sed_notfound($cond=TRUE)
{
	if ($cond)
	{
		header("HTTP/1.1 404 Not Found");
		include('404.php');
		exit;
	}
	return FALSE;
}


function sed_build_uname($id, $user, $uname)
{
	$fullname = htmlspecialchars($uname);

	if(!empty($id)){
		if($fullname != " ")
			return '<a href="'.sed_url('users', 'm=details&id='.$id.'&u='.$user).'">'.trim($fullname).' ['.$user.']</a>';
		else
			return '<a href="'.sed_url('users', 'm=details&id='.$id.'&u='.$user).'">'.$user.'</a>';
		}
	else{
		if($fullname != " ")
			return trim($fullname);
		else
			return $user;
	}
}

function sed_load_location($onlycountries = array())
{
	if(count($onlycountries) > 0)
		$sql = sed_sql_query("SELECT * FROM sed_country
	WHERE country_id IN (".implode(",", $onlycountries).") ORDER by country_id ASC, country_name ASC");
	else
		$sql = sed_sql_query("SELECT * FROM sed_country
	WHERE 1 ORDER by country_id ASC, country_name ASC");
	while($country = sed_sql_fetchassoc($sql)){

		$sed_location[$country['country_id']]['name'] = $country['country_name'];

		$sql1 = sed_sql_query("SELECT * FROM sed_region WHERE country_id=".$country['country_id']."");
		while($reg = sed_sql_fetchassoc($sql1)){

			$sed_location[$country['country_id']]['regions'][$reg['region_id']]['name'] = $reg['region_name'];

			$sql2 = sed_sql_query("SELECT * FROM sed_city WHERE region_id=".$reg['region_id']."");
			while($city = sed_sql_fetchassoc($sql2)){
				$sed_location[$country['country_id']]['regions'][$reg['region_id']]['cities'][$city['city_id']] = $city['city_name'];
			}
		}
	}

	return $sed_location;

}

function sed_getcountries()
{
	global $sed_location;
	foreach($sed_location as $i => $item){
		$countries[$i] = $item['name'];
	}
	asort($countries);
	return $countries;
}

function sed_getregions($counrtyid = 0)
{
	global $sed_location;
	if($counrtyid != 0){
		foreach($sed_location as $i => $country){
			if($i == $counrtyid){
				if(is_array($country['regions'])){
					foreach($country['regions'] as $j => $reg){
						$regions[$j] = $reg['name'];
					}
				}
				break;
			}
		}
	}
	else{
		foreach($sed_location as $i => $country){
			if(is_array($country['regions'])){
				foreach($country['regions'] as $j => $reg){
					$regions[$j] = $reg['name'];
				}
			}
		}
	}
	if(is_array($regions)) asort($regions);
	return $regions;
}

function sed_getcities($regionid = 0)
{
	global $sed_location;
	foreach($sed_location as $i => $country){
		if($regionid != 0){
			if(is_array($country['regions'])){
				foreach($country['regions'] as $j => $reg){
					if($j == $regionid){
						if(is_array($reg['cities'])){
							foreach($reg['cities'] as $k => $city){
								$cities[$k] = $city;
							}
						}
						break;
					}
				}
			}
		}
		else{
			if(is_array($country['regions'])){
				foreach($country['regions'] as $j => $reg){
					if(is_array($reg['cities'])){
						foreach($reg['cities'] as $k => $city){
							$cities[$k] = $city;
						}
					}
				}
			}
		}
	}
	if(is_array($cities)) asort($cities);
	return $cities;
}

function sed_getcountrybyid($countryid)
{
	global $sed_location;

	return $sed_location[$countryid]['name'];
}

function sed_getregionbyid($regionid)
{
	global $sed_location;
	$regions = sed_getregions();
	return $regions[$regionid];
}

function sed_getcitybyid($cityid)
{
	global $sed_location;
	$cities = sed_getcities();
	return $cities[$cityid];
}



function sed_select_location(
	$field = '',
	$countryid = 0,
	$regionid = 0,
	$cityid = 0
	){

	global $cfg, $L;

	$countries = sed_getcountries();

	$disabled = (count($cfg['onlycountries']) == 1) ? 'disabled="disabled"' : '';
	$select_country = "<select class=\"locselectcountry\" ".$disabled." name=\"country".$field."\" id=\"country".$field."\" onchange=\"select_region('".$field."')\">";
	$select_country .= '<option value="0">'.$L['select_country'].'</option>';
	foreach($countries as $i => $country){
		if(count($cfg['onlycountries']) > 0){
			if(in_array($i,$cfg['onlycountries'])){
				$selected = ($i == $countryid) ? 'selected="selected"' : '';
				$select_country .= '<option '.$selected.' value="'.$i.'">'.$country.'</option>';
				break;
			}
		}
		else{
			$selected = ($i == $countryid) ? 'selected="selected"' : '';
			$select_country .= '<option '.$selected.' value="'.$i.'">'.$country.'</option>';
		}
	}
	$select_country .= '</select>';
	$select_country .= (count($cfg['onlycountries']) == 1) ? "<input type=\"hidden\" name=\"country".$field."\" value=\"".$countryid."\" />" : '';

//	if(!empty($regionid)){
		$regions = sed_getregions($countryid);

		$disabled = (count($cfg['onlyregions']) == 1 || empty($countryid)) ? 'disabled="disabled"' : '';
		$select_region = "<select class=\"locselectregion\" ".$disabled." name=\"region".$field."\" id=\"region".$field."\" onchange=\"select_city('".$field."')\">";
		$select_region .= '<option value="0">'.$L['select_region'].'</option>';
		foreach($regions as $i => $region){
			if(count($cfg['onlyregions']) > 0){
				if(in_array($i, $cfg['onlyregions'])){
					$selected = ($i == $regionid) ? 'selected="selected"' : '';
					$select_region .= '<option '.$selected.' '.$disabled.' value="'.$i.'">'.$region.'</option>';
					break;
				}
			}
			else{
				$selected = ($i == $regionid) ? 'selected="selected"' : '';
				$select_region .= '<option '.$selected.' value="'.$i.'">'.$region.'</option>';
			}
		}
		$select_region .= '</select>';
		$select_region .= (count($cfg['onlyregions']) == 1) ? "<input type=\"hidden\" name=\"region".$field."\" value=\"".$regionid."\" />" : '';
//	}

//	if(!empty($cityid)){
		$cities = sed_getcities($regionid);
		$disabled = (empty($regionid)) ? 'disabled="disabled"' : '';
		$select_city = "<select ".$disabled." class=\"locselectcity\" name=\"city".$field."\" id=\"city".$field."\">";
		$select_city .= '<option value="0">'.$L['select_city'].'</option>';
		if(is_array($cities)){
			foreach($cities as $i => $city){
				$selected = ($i == $cityid) ? 'selected="selected"' : '';
				$select_city .= '<option '.$selected.' value="'.$i.'">'.$city.'</option>';
			}
		}
		$select_city .= '</select>';
//	}

	return (array($select_country, $select_region, $select_city));
}



function sed_ispro($date, $userid=0)
{
	global $sys;
	
	if($date > $sys['now_offset'])
		return true;
	else{
		$sql = sed_sql_query("UPDATE sed_users SET user_protodate=0, user_ispro=0 WHERE user_id=".$userid);
		return false;
		}
		
}


$sed_timetype = array('часов', 'дней', 'месяцев');

function sed_select_timetype($name, $type)
{
	global $sed_timetype;
	
	$res = '<select name="'.$name.'">';
	foreach($sed_timetype as $i => $var)
	{
		$res .= ($type == $i) ? '<option selected="selected" value="'.$i.'">'.$var.'</option>' : '<option value="'.$i.'">'.$var.'</option>';
	}
	$res .= '</select>';
	
	return $res;
}


// ===============================


function sed_selectbox_bcat($name, $cat = 0)
{
	global $sed_bcat, $sed_bcat_result;
	
	if(!empty($sed_bcat)){
	
		$sed_bcat_result .= '<select name="'.$name.'">';
		//$sed_bcat_result .= '<option value="">Личные блоги</option>';
		
		foreach($sed_bcat as $i => $cats)
		{
			$sed_bcat_result .= ($i == $cat) ? '<option selected="selected" value="'.$i.'">'.$cats['title'].'</option>' : '<option value="'.$i.'">'.$cats['title'].'</option>';
		}
		
		$sed_bcat_result .= '</select>';
	
	}
	
	return $sed_bcat_result;
}

function sed_showbcat($c = 0)
{
	global $sed_bcat, $sed_bcat_result, $skinlang;
	
	if(!empty($sed_bcat)){
	
		$allbarketcount = 0;
		foreach($sed_bcat as $i => $cats)
		{
			if($cats['parent'] == 0) $allbarketcount += $cats['count'];
		}
		
		$sed_bcat_result .= "<ul>";
		$sed_bcat_result .= "<li><a href=\"".sed_url("plug", "e=blogs")."\">".$skinlang['all']."</a> (".$allbarketcount.")";
		foreach($sed_bcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				
				if($i == $c || $i == $sed_bcat[$c]['parent']) 
					$class = 'class="current"'; 
				elseif(!empty($c))
					$class = 'class="hidden"'; 
					
				$sed_bcat_result .= "<li><a href=\"".sed_url("plug", "e=blogs&c=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
				
	//			if($cats['count'] > 0)
	//			{
					$sed_bcat_result .= "<div ".$class."><ul>";
					foreach($sed_bcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $c) $actclass = 'class="act"';
							$sed_bcat_result .= "<li ".$actclass."><a href=\"".sed_url("plug", "e=blogs&c=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
						}
					}
					$sed_bcat_result .= "</ul></div>";
	//			}
				
				$sed_bcat_result .= "</li>";
			}
		}
		$sed_bcat_result .= "</ul>";
		
	}
	
	return $sed_bcat_result;
}


function sed_bcatsub($cat)
{
	global $sed_bcat;
	
	$catsub[] = $cat;
	if(!empty($sed_bcat))
	{
		foreach($sed_bcat as $i => $cats)
		{
			if($cats['parent'] == $cat)
			{
				$catsub[] = $i;
				
				foreach($sed_bcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						$catsub[] = $i1;
					}
				}
						
			}
		}
	}
	
	return $catsub;
}


function sed_load_bcat()
{	
	$sql = sed_sql_query("SELECT * FROM sed_blogs_cat
	WHERE 1 ORDER by cat_sort ASC");
	while($row = sed_sql_fetchassoc($sql))
	{
		$sql1 = sed_sql_query("SELECT * FROM sed_blogs_cat WHERE cat_parent=".$row['cat_id']." OR cat_id=".$row['cat_id']."");
		while($row1 = sed_sql_fetchassoc($sql1))
		{
			$catsub[] = $row1['cat_id'];
		}
		
		$sql2 = sed_sql_query("SELECT * FROM sed_blogs WHERE item_cat IN ('".implode("','", $catsub)."')");
		$row['cat_count'] = sed_sql_numrows($sql2);
	
		$sed_bcat[$row['cat_id']]['title'] = $row['cat_title'];
		$sed_bcat[$row['cat_id']]['mtitle'] = $row['cat_mtitle'];
		$sed_bcat[$row['cat_id']]['mdesc'] = $row['cat_mdesc'];
		$sed_bcat[$row['cat_id']]['mkey'] = $row['cat_mkey'];
		$sed_bcat[$row['cat_id']]['parent'] = $row['cat_parent'];
		$sed_bcat[$row['cat_id']]['sort'] = $row['cat_sort'];
		$sed_bcat[$row['cat_id']]['text'] = sed_parse($row['cat_text']);
		$sed_bcat[$row['cat_id']]['count'] = ($row['cat_count'] > 0) ? $row['cat_count'] : 0;
		
		unset($catsub);
	}

//	echo("<pre>");
//	print_r($sed_bcat);
//	echo("</pre>");	
	
	return $sed_bcat;
	
}


// ===============================


function sed_selectbox_mcat($name, $cat = 0)
{
	global $sed_mcat, $sed_mcat_result, $L;
	
	if(!empty($sed_mcat)){
		
		$sed_mcat_result .= '<select name="'.$name.'">';
		$sed_mcat_result .= '<option value="">'.$L['select_cat'].'</option>';
		
		foreach($sed_mcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				$sed_mcat_result .= ($i == $cat) ? '<option selected="selected" value="'.$i.'">'.$cats['title'].'</option>' : '<option value="'.$i.'">'.$cats['title'].'</option>';
				
				foreach($sed_mcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						$sed_mcat_result .= ($i1 == $cat) ? '<option selected="selected" value="'.$i1.'">--'.$cats1['title'].'</option>' : '<option value="'.$i1.'">--'.$cats1['title'].'</option>';
					}
				}
			}
		}
		
		$sed_mcat_result .= '</select>';
	
	}
	
	return $sed_mcat_result;
}

function sed_showmcat($c = 0)
{
	global $sed_mcat, $sed_mcat_result, $skinlang;
	
	$allmarketcount = 0;
	
	if(!empty($sed_mcat)){
		
		foreach($sed_mcat as $i => $cats)
		{
			if($cats['parent'] == 0) $allmarketcount += $cats['count'];
		}
		
		$sed_mcat_result .= "<ul>";
		$sed_mcat_result .= "<li><a href=\"".sed_url("plug", "e=market")."\">".$skinlang['all']."</a> (".$allmarketcount.")";
		foreach($sed_mcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				
				if($i == $c || $i == $sed_mcat[$c]['parent']) 
					$class = 'class="current"'; 
				elseif(!empty($c))
					$class = 'class="hidden"'; 
					
				$sed_mcat_result .= "<li><a href=\"".sed_url("plug", "e=market&c=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
				
	//			if($cats['count'] > 0)
	//			{
					$sed_mcat_result .= "<div ".$class."><ul>";
					foreach($sed_mcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $c) $actclass = 'class="act"';
							$sed_mcat_result .= "<li ".$actclass."><a href=\"".sed_url("plug", "e=market&c=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
						}
					}
					$sed_mcat_result .= "</ul></div>";
	//			}
				
				$sed_mcat_result .= "</li>";
			}
		}
		$sed_mcat_result .= "</ul>";
		
	}
	
	return $sed_mcat_result;
}


function sed_mcatsub($cat)
{
	global $sed_mcat;
	
	$catsub[] = $cat;
	if(!empty($sed_mcat))
	{
		foreach($sed_mcat as $i => $cats)
		{
			if($cats['parent'] == $cat)
			{
				$catsub[] = $i;
				
				foreach($sed_mcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						$catsub[] = $i1;
					}
				}
						
			}
		}
	}
	
	return $catsub;
}


function sed_load_mcat()
{	
	$sql = sed_sql_query("SELECT * FROM sed_market_cat
	WHERE 1 ORDER by cat_sort ASC");
	while($row = sed_sql_fetchassoc($sql))
	{
		$sql1 = sed_sql_query("SELECT * FROM sed_market_cat WHERE cat_parent=".$row['cat_id']." OR cat_id=".$row['cat_id']."");
		while($row1 = sed_sql_fetchassoc($sql1))
		{
			$catsub[] = $row1['cat_id'];
		}
		
		$sql2 = sed_sql_query("SELECT * FROM sed_market WHERE item_cat IN ('".implode("','", $catsub)."')");
		$row['cat_count'] = sed_sql_numrows($sql2);
	
		$sed_mcat[$row['cat_id']]['title'] = $row['cat_title'];
		$sed_mcat[$row['cat_id']]['mtitle'] = $row['cat_mtitle'];
		$sed_mcat[$row['cat_id']]['mdesc'] = $row['cat_mdesc'];
		$sed_mcat[$row['cat_id']]['mkey'] = $row['cat_mkey'];
		$sed_mcat[$row['cat_id']]['parent'] = $row['cat_parent'];
		$sed_mcat[$row['cat_id']]['sort'] = $row['cat_sort'];
		$sed_mcat[$row['cat_id']]['text'] = sed_parse($row['cat_text']);
		$sed_mcat[$row['cat_id']]['count'] = ($row['cat_count'] > 0) ? $row['cat_count'] : 0;
		
		unset($catsub);
	}

//	echo("<pre>");
//	print_r($sed_mcat);
//	echo("</pre>");	
	
	return $sed_mcat;
	
}

// ===============================

function sed_load_ptype()
{	
	$sql = sed_sql_query("SELECT * FROM sed_types_cat
	WHERE 1 ORDER by cat_sort ASC");
	while($row = sed_sql_fetchassoc($sql))
	{
	
		$sed_ptype[$row['cat_id']]['title'] = $row['cat_title'];
		$sed_ptype[$row['cat_id']]['sort'] = $row['cat_sort'];
		$sed_ptype[$row['cat_id']]['text'] = sed_parse($row['cat_text']);

	}
	
	return $sed_ptype;
	
}

function sed_selectbox_ptype($name, $type = 0)
{
	global $sed_ptype, $sed_ptype_result;
	
	if(!empty($sed_ptype)){
		
		$sed_ptype_result .= '<select name="'.$name.'">';
		
		foreach($sed_ptype as $i => $cats)
		{
			$sed_ptype_result .= ($i == $type || $i == 2 && $type == 0) ? '<option selected="selected" value="'.$i.'">'.$cats['title'].'</option>' : '<option value="'.$i.'">'.$cats['title'].'</option>';
		}
		
		$sed_ptype_result .= '</select>';
	
	}
	
	return $sed_ptype_result;
}



function sed_selectbox_pcat($name, $cat = 0)
{
	global $sed_pcat, $sed_pcat_result, $L;

	if(!empty($sed_pcat)){	
			
		$sed_pcat_result .= '<select name="'.$name.'">';
		$sed_pcat_result .= '<option value="">'.$L['select_cat'].'</option>';
		
		foreach($sed_pcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				$sed_pcat_result .= ($i == $cat) ? '<option selected="selected" value="'.$i.'">'.$cats['title'].'</option>' : '<option value="'.$i.'">'.$cats['title'].'</option>';
				
				foreach($sed_pcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						$sed_pcat_result .= ($i1 == $cat) ? '<option selected="selected" value="'.$i1.'">--'.$cats1['title'].'</option>' : '<option value="'.$i1.'">--'.$cats1['title'].'</option>';
					}
				}
			}
		}
		
		$sed_pcat_result .= '</select>';
	
	}
	
	return $sed_pcat_result;
}

function sed_showpcat($c = 0)
{
	global $sed_pcat, $sed_pcat_result, $skinlang;
	
	if(!empty($sed_pcat)){
	
		$allprojectscount = 0;
		foreach($sed_pcat as $i => $cats)
		{
			if($cats['parent'] == 0) $allprojectscount += $cats['count'];
		}
		
		$sed_pcat_result .= "<ul>";
		$sed_pcat_result .= "<li><a href=\"".sed_url("plug", "e=projects")."\">".$skinlang['all']."</a> (".$allprojectscount.")";
		foreach($sed_pcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				
				if($i == $c || $i == $sed_pcat[$c]['parent']) 
					$class = 'class="current"'; 
				elseif(!empty($c))
					$class = 'class="hidden"'; 
					
				$sed_pcat_result .= "<li><a href=\"".sed_url("plug", "e=projects&c=".$i)."\">".$cats['title']."</a> (".$cats['count'].")";
				
	//			if($cats['count'] > 0)
	//			{
					$sed_pcat_result .= "<div ".$class."><ul>";
					foreach($sed_pcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $c) $actclass = 'class="act"';
							$sed_pcat_result .= "<li ".$actclass."><a href=\"".sed_url("plug", "e=projects&c=".$i1)."\">".$cats1['title']."</a> (".$cats1['count'].")</li>";
						}
					}
					$sed_pcat_result .= "</ul></div>";
	//			}
				
				$sed_pcat_result .= "</li>";
			}
		}
		$sed_pcat_result .= "</ul>";
	}
	return $sed_pcat_result;
}


function sed_pcatsub($cat)
{
	global $sed_pcat;
	
	$catsub[] = $cat;
	if(!empty($sed_pcat))
	{
		foreach($sed_pcat as $i => $cats)
		{
			if($cats['parent'] == $cat)
			{
				$catsub[] = $i;
				
				foreach($sed_pcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						$catsub[] = $i1;
					}
				}
						
			}
		}
	}
	
	return $catsub;
}


function sed_load_pcat()
{	
	$sql = sed_sql_query("SELECT * FROM sed_projects_cat
	WHERE 1 ORDER by cat_sort ASC");
	while($row = sed_sql_fetchassoc($sql))
	{
		$sql1 = sed_sql_query("SELECT * FROM sed_projects_cat WHERE cat_parent=".$row['cat_id']." OR cat_id=".$row['cat_id']."");
		while($row1 = sed_sql_fetchassoc($sql1))
		{
			$catsub[] = $row1['cat_id'];
		}
		
		$sql2 = sed_sql_query("SELECT * FROM sed_projects WHERE item_state=0 AND item_cat IN ('".implode("','", $catsub)."')");
		$row['cat_count'] = sed_sql_numrows($sql2);
	
		$sed_pcat[$row['cat_id']]['title'] = $row['cat_title'];
		$sed_pcat[$row['cat_id']]['mtitle'] = $row['cat_mtitle'];
		$sed_pcat[$row['cat_id']]['mdesc'] = $row['cat_mdesc'];
		$sed_pcat[$row['cat_id']]['mkey'] = $row['cat_mkey'];
		$sed_pcat[$row['cat_id']]['parent'] = $row['cat_parent'];
		$sed_pcat[$row['cat_id']]['sort'] = $row['cat_sort'];
		$sed_pcat[$row['cat_id']]['text'] = sed_parse($row['cat_text']);
		$sed_pcat[$row['cat_id']]['count'] = ($row['cat_count'] > 0) ? $row['cat_count'] : 0;
		
		unset($catsub);
	}

//	echo("<pre>");
//	print_r($sed_pcat);
//	echo("</pre>");	
	
	return $sed_pcat;
	
}

function sed_selectbox_fcat($name, $cat = 0, $hidd = array())
{
	global $sed_fcat, $sed_fcat_result, $L;

	if(!empty($sed_fcat)){
		
		$sed_fcat_result = '<select name="'.$name.'">';
		$sed_fcat_result .= '<option value="">'.$L['select_fcat'].'</option>';
		
		foreach($sed_fcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				$sed_fcat_result .= '<option disabled="disabled" value="">'.$cats['title'].'</option>';
				
				foreach($sed_fcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						if(is_array($hidd)) $disabled = (in_array($i1, $hidd)) ? 'disabled="disabled"' : '';
						$sed_fcat_result .= ($i1 == $cat) ? '<option selected="selected" '.$disabled.' value="'.$i1.'">--'.$cats1['title'].'</option>' : '<option '.$disabled.' value="'.$i1.'">--'.$cats1['title'].'</option>';
					}
				}
			}
		}
		
		$sed_fcat_result .= '</select>';
		
	}	
	
	return $sed_fcat_result;
}

function sed_showfcat($c = 0)
{
	global $sed_fcat, $sed_fcat_result;
	
	if(!empty($sed_fcat)){
		$sed_fcat_result .= "<ul>";
		foreach($sed_fcat as $i => $cats)
		{
			if($cats['parent'] == 0)
			{
				
				if($i == $c || $i == $sed_fcat[$c]['parent']) 
					$class = 'class="current"'; 
				elseif(!empty($c))
					$class = 'class="hidden"'; 
					
				$sed_fcat_result .= "<li ".$currentclass."><a href=\"".sed_url("users", "gm=4&c=".$i)."\">".$cats['title']."</a>";

	//			if($cats['count'] > 0)
	//			{
					$sed_fcat_result .= "<div ".$class."><ul>";
					foreach($sed_fcat as $i1 => $cats1)
					{
						if($cats1['parent'] == $i)
						{
							if($i1 == $c) $actclass = 'class="act"';
							$sed_fcat_result .= "<li ".$actclass."><a href=\"".sed_url("users", "gm=4&c=".$i1)."\">".$cats1['title']." (".$cats1['count'].")</a></li>";
						}
					}
					$sed_fcat_result .= "</ul></div>";
	//			}
				
				$sed_fcat_result .= "</li>";
			}
		}
		$sed_fcat_result .= "</ul>";
	}
	
	return $sed_fcat_result;
}


function sed_fcatsub($cat)
{
	global $sed_fcat;
	
	$catsub[] = $cat;
	
	if(!empty($sed_fcat))
	{
		foreach($sed_fcat as $i => $cats)
		{
			if($cats['parent'] == $cat)
			{
				$catsub[] = $i;
				
				foreach($sed_fcat as $i1 => $cats1)
				{
					if($cats1['parent'] == $i)
					{
						$catsub[] = $i1;
					}
				}
						
			}
		}
	}
	
	return $catsub;
}


function sed_load_fcat()
{	

	$sql = sed_sql_query("SELECT * FROM sed_users
	WHERE 1");
	while($urr = sed_sql_fetchassoc($sql))
	{
		$sql1 = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat
		WHERE item_userid=".$urr['user_id']);
		while($row = sed_sql_fetchassoc($sql1))
		{
			$uscats[] = $row['item_scat'];
		}
		
		if(count($uscats) > 0)
		{
			sed_sql_query("UPDATE sed_users SET user_scat='".implode(",", $uscats)."' WHERE user_id=".$urr['user_id']);
		}
		
		unset($uscats);
	}
	
	$sql = sed_sql_query("SELECT * FROM sed_freelancers_cat
	WHERE 1 ORDER by cat_sort ASC");
	while($row = sed_sql_fetchassoc($sql))
	{
		// $sql1 = sed_sql_query("SELECT * FROM sed_freelancers_cat WHERE cat_parent=".$row['cat_id']." OR cat_id=".$row['cat_id']."");
		// while($row1 = sed_sql_fetchassoc($sql1))
		// {
			// $catsub[] = $row1['cat_id'];
		// }
		
		// $sql2 = sed_sql_query("SELECT * FROM sed_users AS u
		// LEFT JOIN sed_freelancers_scat AS s ON s.item_userid=u.user_id
		// WHERE user_cat IN ('".implode("','", $catsub)."') OR s.item_scat IN ('".implode("','", $catsub)."') GROUP BY u.user_id");
		
		$sql2 = sed_sql_query("SELECT * FROM sed_users AS u
		LEFT JOIN sed_freelancers_scat AS s ON s.item_userid=u.user_id
		WHERE user_cat=".$row['cat_id']." OR s.item_scat=".$row['cat_id']." GROUP BY u.user_id");
		
		$row['cat_count'] = sed_sql_numrows($sql2);
		
		$sed_fcat[$row['cat_id']]['title'] = $row['cat_title'];
		$sed_fcat[$row['cat_id']]['mtitle'] = $row['cat_mtitle'];
		$sed_fcat[$row['cat_id']]['mdesc'] = $row['cat_mdesc'];
		$sed_fcat[$row['cat_id']]['mkey'] = $row['cat_mkey'];
		$sed_fcat[$row['cat_id']]['parent'] = $row['cat_parent'];
		$sed_fcat[$row['cat_id']]['sort'] = $row['cat_sort'];
		$sed_fcat[$row['cat_id']]['text'] = sed_parse($row['cat_text']);
		$sed_fcat[$row['cat_id']]['count'] = ($row['cat_count'] > 0) ? $row['cat_count'] : 0;
		
		unset($catsub);
	}

	// echo("<pre>");
	// print_r($sed_fcat);
	// echo("</pre>");	
	
	return $sed_fcat;
	
}


function sed_build_user_name($id, $user='')
{
	global $cfg;
	
	$userinfo = sed_userinfo($id);

	if($userinfo['user_maingrp'] == 5)
		return '--';
	elseif(!empty($userinfo['user_firstname']))
		return '<a href="'.sed_url('users', 'm=details&id='.$id.'&u='.$userinfo['user_name']).'">'.$userinfo['user_surname'].' '.$userinfo['user_firstname'].' '.$userinfo['user_lastname'].'</a>';
	else
		return '<a href="'.sed_url('users', 'm=details&id='.$id.'&u='.$userinfo['user_name']).'">'.$userinfo['user_name'].'</a>';

}

// ==================== Products extrafields =======================-

function sed_extrafield_projects_update($sql_table, $oldname, $name, $type, $html, $variants="", $description="")
{
	global $db_extra_fields, $db_x;
	$fieldsres = sed_sql_query("SELECT COUNT(*) FROM $db_extra_fields
			WHERE field_name = '$oldname' AND field_location='$sql_table'");
	if (sed_sql_numrows($fieldsres) <= 0
		|| $name != $oldname
			&& sed_sql_numrows(sed_sql_query("SHOW COLUMNS FROM ".$db_x."catalog LIKE '%\_$name'")) > 0)
	{
		// Attempt to edit non-extra field or override an existing field
		return FALSE;
	}
	$field = sed_sql_fetchassoc($fieldsres);
	$fieldsres = sed_sql_query("SELECT * FROM ".$db_x."catalog LIMIT 1");
	$column = mysql_fetch_field($fieldsres, 0);
	$column_prefix = substr($column->name, 0, strpos($column->name, "_"));
	$alter = FALSE;
	if ($name != $field['field_name'])
	{
		$extf['name'] = $name;
		$alter = TRUE;
	}
	if ($type != $field['field_type'])
	{
		$extf['type'] = $type;
		$alter = TRUE;
	}
	if ($html != $field['field_html'])
		$extf['html'] = $html;
	if ($variants != $field['field_variants'])
		$extf['variants'] = $variants;
	if ($description != $field['field_description'])
		$extf['description'] = $description;
	$step1 = sed_sql_update($db_extra_fields, "field_name = '$oldname' AND field_location='$sql_table'", $extf, 'field_') == 1;
	
	if (!$alter) return $step1;

	switch ($type)
	{
		case "input": $sqltype = "VARCHAR(255)"; break;
		case "textarea": $sqltype = "TEXT"; break;
		case "select": $sqltype = "VARCHAR(255)"; break;
		case "checkbox": $sqltype = "BOOL"; break;
		case "radio": $sqltype = "VARCHAR(255)"; break;
	}
	$sql = "ALTER TABLE ".$db_x."catalog CHANGE ".$column_prefix."_$oldname ".$column_prefix."_$name $sqltype ";
	$step2 = sed_sql_query($sql);
	
	$step3 = sed_sql_query("UPDATE ".$db_x."extra_fields_variants SET field_name='$name' WHERE field_name='$oldname'") == 1;

	return $step1&&$step2&&$step3;
}

function sed_extrafield_projects_add($sql_table, $name, $type, $html, $variants="", $description="", $noalter = FALSE)
{
	global $db_extra_fields, $db_x;
	$fieldsres = sed_sql_query("SELECT field_name FROM $db_extra_fields WHERE field_location='$sql_table'");
	while($row = sed_sql_fetchassoc($fieldsres))
	{
		$extrafieldsnames[] = $row['field_name'];
	}
	if(count($extrafieldsnames)>0) if (in_array($name,$extrafieldsnames)) return 0; // No adding - fields already exist

	// Check table sed_$sql_table - if field with same name exists - exit.
	if (sed_sql_numrows(sed_sql_query("SHOW COLUMNS FROM ".$db_x."catalog LIKE '%\_$name'")) > 0 && !$noalter)
	{
		return FALSE;
	}
	$fieldsres = sed_sql_query("SELECT * FROM ".$db_x."catalog LIMIT 1");
	while ($i < mysql_num_fields($fieldsres))
	{
		$column = mysql_fetch_field($fieldsres, $i);
		// get column prefix in this table
		$column_prefix = substr($column->name, 0, strpos($column->name, "_"));
		preg_match("#.*?_$name$#",$column->name,$match);
		if($match[1]!="" && !$noalter) return false; // No adding - fields already exist
		$i++;
	}

	$extf['location'] = $sql_table;
	$extf['name'] = $name;
	$extf['type'] = $type;
	$extf['html'] = $html;
	$extf['variants'] = $variants;
	$extf['description'] = $description;
	$step1 = sed_sql_insert($db_extra_fields, $extf, 'field_') == 1;
	if ($noalter)
	{
		return $step1;
	}
	switch($type)
	{
		case "input": $sqltype = "VARCHAR(255)"; break;
		case "textarea": $sqltype = "TEXT"; break;
		case "select": $sqltype = "VARCHAR(255)"; break;
		case "checkbox": $sqltype = "BOOL"; break;
		case "radio": $sqltype = "VARCHAR(255)"; break;
	}
	$sql = "ALTER TABLE ".$db_x."catalog ADD ".$column_prefix."_$name $sqltype ";
	$step2 = sed_sql_query($sql);
	return $step1&&$step2;
}

function sed_extrafield_projects_remove($sql_table, $name)
{
	global $db_extra_fields, $db_x;
	if ((int) sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM $db_extra_fields
		WHERE field_name = '$name' AND field_location='$sql_table'"), 0, 0) <= 0)
	{
		// Attempt to remove non-extra field
		return FALSE;
	}
	$fieldsres = sed_sql_query("SELECT * FROM ".$db_x."catalog LIMIT 1");
	$column = mysql_fetch_field($fieldsres, 0);
	$column_prefix = substr($column->name, 0, strpos($column->name, "_"));
	$step1 = sed_sql_delete($db_extra_fields, "field_name = '$name' AND field_location='$sql_table'") == 1;
	$sql = "ALTER TABLE ".$db_x."catalog DROP ".$column_prefix."_".$name;
	$step2 = sed_sql_query($sql);
	return $step1&&$step2;
}

function sed_build_extrafields_with_options($rowname, $rrowname, $tpl_tag, $extrafields, $data=array(), $importnew=FALSE)
{
	global $L, $t, $global;
	$importrowname = ($importnew) ? 'new'.$rrowname : 'r'.$rrowname;
	foreach($extrafields as $i=>$row)
	{
		isset($L[$rowname.'_'.$row['field_name'].'_title']) ? $t->assign($tpl_tag.'_'.strtoupper($row['field_name']).'_TITLE', $L[$rowname.'_'.$row['field_name'].'_title']) : $t->assign($tpl_tag.'_'.strtoupper($row['field_name']).'_TITLE', $row['field_description']);
		$t1 = $tpl_tag.'_'.strtoupper($row['field_name']);
		$t2 = $row['field_html'];
		switch($row['field_type']) 
		{
			case "input":
				$t2 = str_replace('<input ','<input name="'.$importrowname.$row['field_name'].'" ', $t2);
				$t2 = str_replace('<input ','<input value="'.htmlspecialchars($data[$rrowname.'_'.$row['field_name']]).'" ', $t2);
			break;
			case "textarea":
				$t2 = str_replace('<textarea ','<textarea name="'.$importrowname.$row['field_name'].'" ', $t2);
				$t2 = str_replace('</textarea>',htmlspecialchars($data[$rrowname.'_'.$row['field_name']]).'</textarea>', $t2);
			break;
			case "select":
				$t2 = str_replace('<select','<select name="'.$importrowname.$row['field_name'].'"', $t2);
				
				$sql = sed_sql_query("SELECT var_id, var_name, var_alias FROM sed_extra_fields_variants WHERE field_location='".$rowname."' AND field_name='".$row['field_name']."' ORDER BY var_sort ASC, var_name ASC");
				while($variant = sed_sql_fetcharray($sql)){
					$opt_array[$variant['var_id']]['name'] = $variant['var_name'];
					$opt_array[$variant['var_id']]['alias'] = $variant['var_alias'];
					}
				
				$options = "\n<option value=\"\" $sel>--</option>\n";
				if(count($opt_array)!=0)
					foreach ($opt_array as $var)
					{
						
						$var_n = (!empty($var['alias'])) ? $var['alias'] : $var['name'];
						
						$sel = (!empty($var['alias']) && $var['alias'] == $data[$rrowname.'_'.$row['field_name']] || $var['name'] == $data[$rrowname.'_'.$row['field_name']]) ? ' selected="selected"' : '';
						$options .= "<option value=\"$var_n\" $sel>".$var['name']."</option>\n";
					}
				$t2 = str_replace("</select>","$options</select>",$t2);
				unset($opt_array);
			break;
			case "checkbox":
				$t2 = str_replace('<input','<input name="'.$importrowname.$row['field_name'].'"', $t2);
				$sel = ($data[$rrowname.'_'.$row['field_name']] == 1) ? ' checked' : '';
				$t2 = str_replace('<input ','<input value="on" '.$sel.' ', $t2);
			break;
			case "radio":
				$t2 = str_replace('<input','<input name="'.$importrowname.$row['field_name'].'"', $t2);
				$options = "";
				$opt_array = explode(",",$row['field_variants']);
				if(count($opt_array)!=0)
					foreach ($opt_array as $var)
					{
						$var_text = (!empty($L[$rowname.'_'.$row['field_name'].'_'.$var])) ? $L[$rowname.'_'.$row['field_name'].'_'.$var] : $var;
						$sel = ($var == $data[$rrowname.'_'.$row['field_name']]) ? ' checked="checked"' : '';
						$buttons .= str_replace('/>', 'value="'.$var.'"'.$sel.' />'.$var_text.'&nbsp;&nbsp;', $t2);	
					}
				$t2 = $buttons;
			break;		
		}
		$return_arr[$t1] = $t2;
	}
	return $return_arr;
}


function sed_build_extrafields_users_with_options($rowname, $tpl_tag, $extrafields, $data=array(), $importnew=FALSE)
{
	global $L, $t, $global;
	$importrowname = ($importnew) ? 'new'.$rowname : 'r'.$rowname;
	foreach($extrafields as $i=>$row)
	{
		isset($L[$rowname.'_'.$row['field_name'].'_title']) ? $t->assign($tpl_tag.'_'.strtoupper($row['field_name']).'_TITLE', $L[$rowname.'_'.$row['field_name'].'_title']) : $t->assign($tpl_tag.'_'.strtoupper($row['field_name']).'_TITLE', $row['field_description']);
		$t1 = $tpl_tag.'_'.strtoupper($row['field_name']);
		$t2 = $row['field_html'];
		switch($row['field_type']) 
		{
			case "input":
				$t2 = str_replace('<input ','<input name="'.$importrowname.$row['field_name'].'" ', $t2);
				$t2 = str_replace('<input ','<input value="'.htmlspecialchars($data[$rowname.'_'.$row['field_name']]).'" ', $t2);
			break;
			case "textarea":
				$t2 = str_replace('<textarea ','<textarea name="'.$importrowname.$row['field_name'].'" ', $t2);
				$t2 = str_replace('</textarea>',htmlspecialchars($data[$rowname.'_'.$row['field_name']]).'</textarea>', $t2);
			break;
			case "select":
				$t2 = str_replace('<select','<select name="'.$importrowname.$row['field_name'].'"', $t2);
				
				$sql = sed_sql_query("SELECT var_id, var_name, var_alias FROM sed_extra_fields_variants WHERE field_location='users' AND field_name='".$row['field_name']."' ORDER BY var_sort ASC");
				while($variant = sed_sql_fetcharray($sql)){
					$opt_array[$variant['var_id']]['name'] = $variant['var_name'];
					$opt_array[$variant['var_id']]['alias'] = $variant['var_alias'];
					}
				
				$options = "\n<option value=\"\" $sel>--</option>\n";
				if(count($opt_array)!=0)
					foreach ($opt_array as $var)
					{
						
						$var_n = (!empty($var['alias'])) ? $var['alias'] : $var['name'];
						
						$sel = (!empty($var['alias']) && $var['alias'] == $data[$rowname.'_'.$row['field_name']] || $var['name'] == $data[$rowname.'_'.$row['field_name']]) ? ' selected="selected"' : '';
						$options .= "<option value=\"$var_n\" $sel>".$var['name']."</option>\n";
					}
				$t2 = str_replace("</select>","$options</select>",$t2);
				unset($opt_array);
			break;
			case "checkbox":
				$t2 = str_replace('<input','<input name="'.$importrowname.$row['field_name'].'"', $t2);
				$sel = ($data[$rowname.'_'.$row['field_name']] == 1) ? ' checked' : '';
				$t2 = str_replace('<input ','<input value="on" '.$sel.' ', $t2);
			break;
			case "radio":
				$t2 = str_replace('<input','<input name="'.$importrowname.$row['field_name'].'"', $t2);
				$options = "";
				$opt_array = explode(",",$row['field_variants']);
				if(count($opt_array)!=0)
					foreach ($opt_array as $var)
					{
						$var_text = (!empty($L[$rowname.'_'.$row['field_name'].'_'.$var])) ? $L[$rowname.'_'.$row['field_name'].'_'.$var] : $var;
						$sel = ($var == $data[$rowname.'_'.$row['field_name']]) ? ' checked="checked"' : '';
						$buttons .= str_replace('/>', 'value="'.$var.'"'.$sel.' />'.$var_text.'&nbsp;&nbsp;', $t2);	
					}
				$t2 = $buttons;
			break;		
		}
		$return_arr[$t1] = $t2;
	}
	return $return_arr;
}

function sed_build_extrafields_projects_data($rowname, $type, $field_name, $value)
{
	if(!empty($value)){
		$sql = sed_sql_query("SELECT var_id, var_name, var_alias FROM sed_extra_fields_variants WHERE field_location='catalog' AND field_name='".$field_name."' AND var_alias='".$value."' LIMIT 1");
		if($variant = sed_sql_fetcharray($sql)){
			$res = $variant['var_name'];
			}
		else{
			$res = $value;
			}
		}
	return $res;
}

function sed_getcatofalias($field_location, $field_name, $alias){
	
	$sql = sed_sql_query("SELECT var_name FROM sed_extra_fields_variants WHERE field_location='".$field_location."' AND field_name='".$field_name."' AND var_alias='".$alias."' LIMIT 1");
	$res = sed_sql_fetchassoc($sql);
	
	return $res['var_name'];
	}


/**
 * Changes  to / for List URLS
 *
 * @param array $args Args passed over from sed_url
 * @param array $spec Special info passed over from sed_url
 * @return string
 */
function list_url_structure(&$args, &$spec)
{
	global $sed_cat;
	
	$url = str_replace('.', '/', $sed_cat[$args['c']]['path']).'/';
	unset($args['c']);
	
	return $url;
}

/**
 * Changes  to / for Page URLS
 *
 * @param array $args Args passed over from sed_url
 * @param array $spec Special info passed over from sed_url
 * @return string
 */
function page_url_structure(&$args, &$spec)
{
	global $sed_cat, $pag, $row, $rpagecat, $newpagecat;

	$page_cat = (!empty($sed_cat[$rpagecat]['path']) && empty($page_cat)) ? $sed_cat[$rpagecat]['path'] : $page_cat;
	$page_cat = (!empty($sed_cat[$newpagecat]['path']) && empty($page_cat)) ? $sed_cat[$newpagecat]['path'] : $page_cat;
	$page_cat = (!empty($sed_cat[$pag['page_cat']]['path']) && empty($page_cat)) ? $sed_cat[$pag['page_cat']]['path'] : $page_cat;
	$page_cat = (!empty($sed_cat[$row['page_cat']]['path']) && empty($page_cat)) ? $sed_cat[$row['page_cat']]['path'] : $page_cat;
	$url =  str_replace('.', '/', $page_cat).'/';	
	if($args['id'])
	{
		$url .= $args['id'];
		unset($args['id']);
	}
	else
	{
		$url .= urlencode($args['al']);
		unset($args['al']);
	}
	return $url;
}

function getcatsubofcat($c='catalog')
{
	
	global $sed_cat;
	
	$gcs_mtch = $sed_cat[$c]['path'].".";
	$gcs_mtchlen = mb_strlen($gcs_mtch);
	$gcs_catsub = array();
	$gcs_catsub[] = $c;

	foreach($sed_cat as $i => $x)
	{
		if(mb_substr($x['path'], 0, $gcs_mtchlen) == $gcs_mtch && sed_auth('page', $i, 'R')){
			$gcs_catsub[] = $i;
		}
	}
	reset ($sed_cat);

	return $gcs_catsub;
}

function RoundFloatValue( $float_value )
{
	return round (100*$float_value)/100;
}

function RoundFloatValueStr( $float_value )
{
	$str = RoundFloatValue( $float_value );
	$index = strpos($str,".");
	if ( $index === false )
		return $str.".00";
	else
	{
		if ( strlen($str)-1-$index == 1 )
			return $str."0";
		else
			return $str;
	}
}

function sed_selectbox_subcategories($check, $name, $hideprivate=TRUE)
{
	global $db_structure, $usr, $sed_cat, $L;

	$result =  "<select name=\"$name\" size=\"1\">";

	foreach($sed_cat as $i => $x)
	{
		$pathcodes = explode('.', $x['path']);
		$root_pos = in_array($check, $pathcodes);
		if($root_pos)
		{
			$root_path = $pathcodes[0];
		}
	}
	
	foreach($sed_cat as $i => $x)
	{
		$pathcodes = explode('.', $x['path']);
		$root_pos = empty($root_path) ? -1 : in_array($root_path, $pathcodes);
		
		if($root_pos)
		{
			$display = ($hideprivate) ? sed_auth('page', $i, 'W') : TRUE;
	
			if (sed_auth('page', $i, 'R') && $i!='all' && $display)
			{
				$selected = ($i==$check) ? "selected=\"selected\"" : '';
				$result .= "<option value=\"".$i."\" $selected> ".$x['tpath']."</option>";
			}
		}

	}
	$result .= "</select>";
	return($result);
}


function russiansupport($text)
	{
	$alpha_after = array (
					"a", "b", "v", "g", "d", "e", "e", "g", "z", "i", "i", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "c", "ch", "sh", "sch", "", "y", "", "e", "yu", "ya",
					"A", "B", "V", "G", "D", "E", "E", "G", "Z", "I", "I", "K", "L", "M", "N", "O", "P", "R", "S", "T", "U", "F", "H", "C", "CH", "SH", "SCH", "", "Y", "", "E", "YU", "YA", "_" );
	$alpha_before = array (
					"а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я",
					"А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я", " " );
	$text = str_replace($alpha_before, $alpha_after, $text);
	return($text);
	}
	
	
function ResizeImage($url, $olddir, $newdir, $new_w, $new_h, $mode=0){
	global $cfg;
	$dotpos = strrpos($url,".")+1;
	$f_extension = substr($url, $dotpos, 5);
	$filename = str_replace($olddir, "", $url);
	$newfilename = str_replace($olddir, $newdir, $url);
	$gd_supported = array('jpg', 'jpeg', 'png', 'gif');

	if (in_array($f_extension, $gd_supported) && file_exists($url) && !file_exists($newfilename)){

		$th_colortext = array(hexdec(substr($cfg['th_colortext'],0,2)), hexdec(substr($cfg['th_colortext'],2,2)), hexdec(substr($cfg['th_colortext'],4,2)));

		$th_colorbg = array(hexdec(substr($cfg['th_colorbg'],0,2)), hexdec(substr($cfg['th_colorbg'],2,2)), hexdec(substr($cfg['th_colorbg'],4,2)));

		$imagesize = getimagesize($url);

		if($mode==1){
			$debug = "mode: 1";
			if($imagesize[0]>$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			elseif($imagesize[0]<$imagesize[1] && $imagesize[1]>$new_h){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			elseif($imagesize[0]==$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			else{
				copy($url, $newfilename);
				}
			}
		elseif($mode==2){
			$debug = "mode: 2";
			if($imagesize[0]>$imagesize[1] && $imagesize[0]>$new_w){
				$k = $imagesize[0]/$new_w;
				$orientation = ($imagesize[1]/$k >= $new_h) ? "Width" : "Height";
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], $orientation);
				}
			elseif($imagesize[0]<$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			elseif($imagesize[0]==$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}	
			else{
				copy($url, $newfilename);
				}
			}
		else{
			$debug = "mode: 0";
			if($imagesize[0]<$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			elseif($imagesize[1]<$imagesize[0] && $imagesize[1]>$new_h){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			elseif($imagesize[0]==$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			elseif($imagesize[0]<$new_w || $imagesize[1]<$new_h){
				if($imagesize[0]<$new_w)
					sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				else
					sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}	
			else{
				copy($url, $newfilename);
				}
			}
		}
		
		// $f = fopen('log.txt', "a" );
		// fwrite($f, $debug);
		// fclose($f);
		
	}

function ResizeBigImage($url, $olddir, $newdir, $new_w, $new_h, $mode=0){
	global $cfg;
	$dotpos = strrpos($url,".")+1;
	$f_extension = substr($url, $dotpos, 5);
	$filename = str_replace($olddir, "", $url);
	$newfilename = str_replace($olddir, $newdir, $url);
	$gd_supported = array('jpg', 'jpeg', 'png', 'gif');

	if (in_array($f_extension, $gd_supported) && file_exists($url)){

		$th_colortext = array(hexdec(substr($cfg['th_colortext'],0,2)), hexdec(substr($cfg['th_colortext'],2,2)), hexdec(substr($cfg['th_colortext'],4,2)));

		$th_colorbg = array(hexdec(substr($cfg['th_colorbg'],0,2)), hexdec(substr($cfg['th_colorbg'],2,2)), hexdec(substr($cfg['th_colorbg'],4,2)));

		$imagesize = getimagesize($url);

		if($mode==1){
			if($imagesize[0]>$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			elseif($imagesize[0]<$imagesize[1] && $imagesize[1]>$new_h){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			else{
				copy($url, $newfilename);
				}
			}
		elseif($mode==2){
			if($imagesize[0]>$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			elseif($imagesize[0]<$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			elseif($imagesize[0]==$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			else{
				copy($url, $newfilename);
				}
			}
		else{
			if($imagesize[0]<$imagesize[1] && $imagesize[0]>$new_w){ // Если ширина меньше высоты и ширина больше заданной ширины
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Width");
				}
			if($imagesize[0]<$imagesize[1] && $imagesize[1]>$new_h){ // Если ширина меньше высоты и высота больше заданной высоты
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			elseif($imagesize[1]<$imagesize[0] && $imagesize[1]>$new_h){ // Если высота меньше ширины и высота больше заданной высоты
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			elseif($imagesize[0]==$imagesize[1] && $imagesize[0]>$new_w){
				sed_createthumb($url, $newfilename, $new_w, $new_h, $cfg['th_keepratio'], $f_extension, $filename, floor($u_size/1024), $th_colortext, $cfg['th_textsize'], $th_colorbg, $cfg['th_border'], $cfg['th_jpeg_quality'], "Height");
				}
			else{
				copy($url, $newfilename);
				}
			}
		}
	}




function Resize($sSrc, $sDest, $iMaxWidth, $iMaxHeight)
	{
		# -size			=  ,      ( ) -
		# -auto-orient	=  ,   "" ( jpg)
		# -thumbnail	=  -resize,      jpg  (, ).
		$sCommand = "convert -size {$iMaxWidth}x{$iMaxHeight} {$sSrc} -thumbnail {$iMaxWidth}x{$iMaxHeight} {$sDest}";

		@exec($sCommand);

		return file_exists($sDest);
	}


// function img_crop($src, $dest, $x, $y, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {

	// if (!file_exists($src)) {
		// return false;
	// }

	// $size = getimagesize($src);

	// if ($size === false) {
		// return false;
	// }

    // $imgsize = getimagesize($src);

    // if($imgsize[0] > $width){
        // $x = abs(floor(($imgsize[0] - $width)/2));
    // }

    // if($imgsize[1] > $height){
        // $y = abs(floor(($imgsize[1] - $height)/2));
    // }

	// $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
	// $icfunc = 'imagecreatefrom'.$format;

	// if (!function_exists($icfunc)) {
		// return false;
	// }

	// $isrc  = $icfunc($src);
	// $idest = imagecreatetruecolor($imgsize[0], $imgsize[1]);

	// imagefill($idest, 0, 0, $rgb);
	// imagecopyresampled($idest, $isrc, 0, 0, $x, $y, $width, $height, $width, $height);

	// imagejpeg($idest, $dest, $quality);

	// imagedestroy($isrc);
	// imagedestroy($idest);

	// return true;
// }


function img_crop($src, $dest, $x, $y, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {

	if (!file_exists($src)) {
		return false;
	}

	$size = getimagesize($src);

	if ($size === false) {
		return false;
	}

	$format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
	$icfunc = 'imagecreatefrom'.$format;

	if (!function_exists($icfunc)) {
		return false;
	}

	$isrc  = $icfunc($src);
	$idest = imagecreatetruecolor($width, $height);
	
	$imagesize = getimagesize($src);
	
	if($imagesize[0] > $$imagesize[1]){
		$x = floor(($imagesize[0] - $width)/2);
		$y = 0;
	}
	else{
		$x = 0;
		$y = floor(($imagesize[1] - $height)/2);
	}
	
	imagefill($idest, 0, 0, $rgb);
	imagecopyresampled($idest, $isrc, 0, 0, $x, $y, $width, $height, $width, $height);

	imagejpeg($idest, $dest, $quality);

	imagedestroy($isrc);
	imagedestroy($idest);

	return true;
}

function sed_pfswatermark_mergeimg($img1_file, $img1_extension, $img2_file, $img2_extension, $img2_x, $img2_y, $position,  $trsp=100, $jpegqual=100)
	{
	global $cfg;

	$gd_supported = array('jpg', 'jpeg', 'png', 'gif');

	switch($img1_extension)
		{
		case 'gif':
		$img1 = imagecreatefromgif($img1_file);
		break;

		case 'png':
		$img1 = imagecreatefrompng($img1_file);
		break;

		default:
		$img1 = imagecreatefromjpeg($img1_file);
		break;
		}

	switch($img2_extension)
		{
		case 'gif':
		$img2 = imagecreatefromgif($img2_file);
		break;

		case 'png':
		$img2 = imagecreatefrompng($img2_file);
		break;

		default:
		$img2 = imagecreatefromjpeg($img2_file);
		break;
		}

	$img1_w = imagesx($img1);
	$img1_h = imagesy($img1);
	$img2_w = imagesx($img2);
	$img2_h = imagesy($img2);

	switch($position)
		{
		case 'Top left':
		$img2_x = 8;
		$img2_y = 8;
		break;

		case 'Top right':
		$img2_x = $img1_w - 8 - $img2_w;
		$img2_y = 8;
		break;

		case 'Bottom left':
		$img2_x = 8;
		$img2_y = $img1_h - 8 - $img2_h;
		break;

		default:
		$img2_x = $img1_w - 8 - $img2_w;
		$img2_y = $img1_h - 8 - $img2_h;
		break;
		}

	imagecopymerge($img1, $img2, $img2_x, $img2_y, 0, 0, $img2_w, $img2_h, $trsp);

	switch($img1_extension)
		{
		case 'gif':
		imagegif($img1, $img1_file);
		break;

		case 'png':
		imagepng($img1, $img1_file);
		break;

		default:
		imagejpeg($img1, $img1_file, $jpegqual);
		break;
		}

	imagedestroy($img1);
	imagedestroy($img2);
	}


function sed_thumb_url($dir, $file)
{
	$newfilename = str_replace('datas/'.$dir.'/', 'datas/'.$dir.'/thumbs/', $file);
	return $newfilename;
}

function sed_preview_url($dir, $file)
{
	$newfilename = str_replace('datas/'.$dir.'/', 'datas/'.$dir.'/previews/', $file);
	return $newfilename;
}

	
function toupper($co) {
$co = strtr($co, "абвгдеёжзийклмнорпстуфхцчшщъьыэюя",
 "АБВГДЕЁЖЗИЙКЛМHОРПСТУФХЦЧШЩЪЬЫЭЮЯ");
return strtoupper($co);
}	
	
?>