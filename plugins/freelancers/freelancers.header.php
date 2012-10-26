<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=header
File=freelancers.header
Hooks=header.main
Tags=
Order=0
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL.');

if($z == 'users')
{

	$c = sed_import('c','G','INT');
	$tab = sed_import('tab','G','ALP');

	$tabs = array(
		'portfolio' => 'Портфолио',
		'projects' => 'Проекты',
		'market' => 'Магазин',
		'reviews' => 'Отзывы'
	);

	$country = sed_import('country','G','INT');
	$region = sed_import('region','G','INT');
	$city = sed_import('city','G','INT');

	$title_tags[] = array('{MAINTITLE}', '{DESCRIPTION}', '{SUBTITLE}');
	$title_tags[] = array('%1$s', '%2$s', '%3$s');

	$username = sed_build_uname('', $urr['user_name'], $urr['user_fname']." ".$urr['user_sname']);
	$userstatus = (empty($urr['user_status'])) ? $sed_fcat[$urr['user_cat']]['title'] : $urr['user_status'];

	if($gm == 4){
		if(!empty($c))
			{
			$out['subtitle'] = ($sed_fcat[$c]['mtitle']) ? $sed_fcat[$c]['mtitle'] : $sed_fcat[$c]['title'];
			$out['meta_desc'] = (!empty($sed_fcat[$c]['mdesc'])) ? $sed_fcat[$c]['mdesc'] : '';
			$out['meta_keywords'] = (!empty($sed_fcat[$c]['mkey'])) ? $sed_fcat[$c]['mkey'] : '';
			}
		else{
			$out['subtitle'] = (!empty($c)) ? $sed_fcat[$c]['title'] : $sed_groups[$gm]['title'];
			$out['meta_desc'] = '';
			$out['meta_keywords'] = $sed_groups[$gm]['title'];
			}
	}
	elseif($gm == 8){
		if(!empty($c))
			{
			$out['subtitle'] = ($sed_fcat[$c]['mtitle']) ? $sed_fcat[$c]['mtitle'] : $sed_fcat[$c]['title'];
			$out['meta_desc'] = (!empty($sed_fcat[$c]['mdesc'])) ? $sed_fcat[$c]['mdesc'] : '';
			$out['meta_keywords'] = (!empty($sed_fcat[$c]['mkey'])) ? $sed_fcat[$c]['mkey'] : '';
			}
		else{
			$out['subtitle'] = $sed_groups[$gm]['title'];
			$out['meta_desc'] = '';
			$out['meta_keywords'] = '';
			}
	}

	if(!empty($id)) $out['subtitle'] = (!empty($userstatus)) ? $userstatus.' - '.$username : $username;

	$out['subtitle'] .= (!empty($city)) ? ' - '.  sed_getcitybyid($city) : '';
	$out['subtitle'] .= (!empty($region)) ? ' - '.  sed_getregionbyid($region) : '';
	$out['subtitle'] .= (!empty($country)) ? ' - '. sed_getcountrybyid($country) : '';

	$out['subtitle'] .= (!empty($urr['user_location'])) ? ' - '.sed_getcitybyid($urr['user_location']) : '';
	$out['subtitle'] .= (!empty($urr['user_region'])) ? ' - '.sed_getregionbyid($urr['user_region']) : '';
	$out['subtitle'] .= (!empty($urr['user_country'])) ? ' - '.sed_getcountrybyid($urr['user_country']) : '';

	$out['subtitle'] .= (!empty($tab)) ? ' - '.$tabs[$tab] : '';

	$title_data = array($cfg['maintitle'], $cfg['subtitle'], $out['subtitle']);
	$out['fulltitle'] = sed_title('title_header', $title_tags, $title_data);

}

$usr_name = sed_build_uname($usr['profile']['user_id'], $usr['profile']['user_name'], $usr['profile']['user_fname']." ".$usr['profile']['user_sname']);


if($usr['isadmin']){
	
	$setpro = sed_import('setpro','G','INT');
	$userid = sed_import('userid','G','INT');
	
	if(isset($setpro) && !empty($userid)){
		sed_check_xg();
		
		$setprotodate = 2147483647; // 2147483647 максимальный срок действия PRO
		
		if($setpro){
			$sql = sed_sql_query("UPDATE sed_users SET user_isprosetadmin=1, user_protodate=".$setprotodate.", user_ispro=1 WHERE user_id=".$userid."");
		}
		else{
			$sql = sed_sql_query("UPDATE sed_users SET user_isprosetadmin=0, user_protodate=0, user_ispro=0 WHERE user_id=".$userid."");
		}
		
		header("Location: " . SED_ABSOLUTE_URL . sed_url('users', 'f='.$f.'&s='.$s.'&w='.$w.'&gm='.$gm, '#user'.$userid, true));
		exit;	
		
	}
}


?>
