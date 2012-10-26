<?PHP

sed_block($usr['profile']['user_maingrp'] == 4 || $usr['isadmin']);

$profile = new XTemplate(sed_skinfile('uinfo.profile.speciality', true));

$a = sed_import('a','G','ALP');

if($a == 'update'){
	$scat = sed_import('scat','P','ARR');

	if(count($scat) <= $cfg['scatlimit'] && !$urr['user_ispro'] || $urr['user_ispro']){

		$ssql = sed_sql_query("DELETE FROM sed_freelancers_scat WHERE item_userid=".$urr['user_id']."");

		foreach($scat as $i){
			$ssql = "INSERT INTO sed_freelancers_scat
				(item_userid,
				item_scat)
				VALUES
				(".$urr['user_id'].",
				".$i.")
				";
			$sql = sed_sql_query($ssql);
		}

		$sed_fcat = sed_load_fcat();
		sed_cache_store('sed_fcat', $sed_fcat, 3600);

		header("Location: " . SED_ABSOLUTE_URL . sed_url('users', 'm=details&id='.$urr['user_id'].'&u='.$urr['user_name'].'&tab=profile&sub=speciality'));
		exit;
	}
}

$profile->assign(array(
	"SPEC_FORM_ACTION_URL" => sed_url('users', "m=details&id=".$urr['user_id']."&u=".$urr['user_name']."&tab=profile&sub=speciality&a=update"),
	"SPEC_PROFILE_EDIT_URL" => sed_url('users', "m=details&id=".$urr['user_id']."&u=".$urr['user_name']."&tab=profile&sub=info"),	
));

$uscats = array();

$sql = sed_sql_query("SELECT item_scat FROM sed_freelancers_scat WHERE item_userid=".$urr['user_id']."");
while($row = sed_sql_fetcharray($sql)){ $uscats[] = $row['item_scat']; }
$check_count_of_scats = (count($uscats) >= $cfg['scatlimit']) ? true : false;

foreach($sed_fcat as $i => $cat){
	if($cat['parent'] == 0){
		foreach($sed_fcat as $i1 => $cat1){
			if($cat1['parent'] == $i){
				$profile->assign(array(
					"SCAT_ROW_TITLE" => $cat1['title'],
					"SCAT_ROW_ID" => $i1,
					"SCAT_ROW_CHECKED" => (!empty($scat) && in_array($i1, $scat) || !empty($uscats) && in_array($i1, $uscats)) ? 'checked="checked"' : '',
					"SCAT_ROW_DISABLED_MAINCAT" => ($i1 == $urr['user_cat']) ? 'disabled="disabled"' : 'class="scatcheckbox"',
					"SCAT_ROW_MAINCAT" => ($i1 == $urr['user_cat']) ? 'class="maincat"' : '',
					"SCAT_ROW_DISABLED" => ($check_count_of_scats && !in_array($i1, $uscats) && $cfg['scatlimit'] != 0 && !$urr['user_ispro']) ? 'disabled="disabled"' : '',
					""
				));
				$profile->parse("PROF.CAT_ROWS.SCAT_ROWS");
			}
		}
		$profile->assign(array(
			"CAT_ROW_TITLE" => $cat['title']
		));
		$profile->parse("PROF.CAT_ROWS");
	}
}

?>