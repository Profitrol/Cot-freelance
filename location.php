<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=projects
Part=main
File=projects.ajax
Hooks=ajax
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

define('SED_CODE', TRUE);

require_once('./datas/config.php');
require_once($cfg['system_dir'].'/functions.php');
require_once($cfg['system_dir'].'/common.php');

header("Content-Type: text/html; charset=utf-8");

$field = isset($_REQUEST['field']) ? $_REQUEST['field'] : '';
$countryid = isset($_REQUEST['countryid']) ? $_REQUEST['countryid'] : 0;
$regionid = isset($_REQUEST['regionid']) ? $_REQUEST['regionid'] : 0;

if(!empty($countryid))
{
	$regions = sed_getregions($countryid);
	$select_region = "<select class=\"locselectregion\" name=\"region".$field."\" id=\"region".$field."\" onchange=\"select_city('".$field."')\">";
	$select_region .= '<option value="0">'.$L['select_region'].'</option>';
	if(is_array($regions)){
		foreach($regions as $i => $region){
			$select_region .= '<option value="'.$i.'">'.$region.'</option>';
		}
	}
	$select_region .= '</select>';

	echo($select_region);
}

if(!empty($regionid)){
	$cities = sed_getcities($regionid);
	$select_city = "<select class=\"locselectcity\" name=\"city".$field."\" id=\"city".$field."\">";
	$select_city .= '<option value="0">'.$L['select_city'].'</option>';
	if(is_array($cities)){
		foreach($cities as $i => $city){
			$select_city .= '<option value="'.$i.'">'.$city.'</option>';
		}
	}
	$select_city .= '</select>';

	echo($select_city);
}

?>