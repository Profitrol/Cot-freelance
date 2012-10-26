<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=freelancers
Part=users
File=freelancers.users.query
Hooks=users.query
Tags=users.tpl:
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }


if(!empty($sq))
{
	$y = $sq;
}

if ($s == 'grplevel' || $s == 'grptitle')
{
	$sqljoin = "as u LEFT JOIN $db_groups as g ON g.grp_id=u.user_maingrp";
	$sqlu = 'u.';
}
else
{
	$sqljoin = $sqlu = '';
}

if(mb_strlen($y) > 1)
{
	$sq = $y;
	$title .= $cfg['separator']." ". $L['Search']." '".htmlspecialchars($y)."'";
	$sqlmask = "as u $sqljoin WHERE ({$sqlu}user_name LIKE '%".sed_sql_prep($y)."%' OR {$sqlu}user_fname LIKE '%".sed_sql_prep($y)."%' OR {$sqlu}user_sname LIKE '%".sed_sql_prep($y)."%') AND user_maingrp=$gm";
}
elseif($g > 1)
{
	$title .= $cfg['separator']." ".$L['Maingroup']." = ".sed_build_group($g);
	$sqlmask = " as u $sqljoin WHERE {$sqlu}user_maingrp=$g";
}
elseif($gm > 1)
{
	$title .= $cfg['separator']." ".$L['Group']." = ".sed_build_group($gm);
	$sqlmask = "as u ".(empty($sqljoin) ? '' : "LEFT JOIN $db_groups as g ON g.grp_id=u.user_maingrp ")."LEFT JOIN $db_groups_users as m ON m.gru_userid=u.user_id LEFT JOIN sed_freelancers_scat AS s ON s.item_userid=u.user_id WHERE m.gru_groupid=$gm";
}
elseif(mb_strlen($f) == 1)
{
	if($f == "_")
	{
		$title .= $cfg['separator']." ".$L['use_byfirstletter']." '%'";
		$sqlmask = "$sqljoin WHERE {$sqlu}user_name NOT REGEXP(\"^[a-zA-Z]\")";
	}
	else
	{
		$f = mb_strtoupper($f);
		$title .= $cfg['separator']." ".$L['use_byfirstletter']." '".$f."'";
		$sqlmask = "$sqljoin WHERE {$sqlu}user_name LIKE '$f%'";
	}
}
elseif(mb_substr($f, 0, 8) == 'country_')
{
	$cn = mb_strtolower(mb_substr($f, 8, 2));
	$title .= $cfg['separator']." ".$L['Country']." '";
	$title .= ($cn == '00') ? $L['None']."'" : $sed_countries[$cn]."'";
	$sqlmask = "$sqljoin WHERE {$sqlu}user_country='$cn'";
}
else//if($f == 'all')
{
	$sqlmask = " as u $sqljoin WHERE 1";
}


switch ($s)
{
	case 'grplevel':
		$sqlorder = "ORDER BY g.grp_level $w";
	break;
	case 'grptitle':
		$sqlorder = "ORDER BY g.grp_title $w";
	break;
	default:
		if(empty($gm))
			$sqlorder = "ORDER BY user_$s $w";
		else
			$sqlorder = "ORDER BY user_ispro DESC, user_rating DESC, user_$s $w";
	break;
}

if(!empty($c))
{
	$catsub = sed_fcatsub($c);
	$query_string = " AND (user_cat IN ('".implode("','", $catsub)."') OR s.item_scat IN ('".implode("','", $catsub)."'))";
}

if(!empty($country))
{
	$query_string .= " AND user_country=".(int)$country."";
}

if(!empty($region))
{
	$query_string .= " AND user_region=".(int)$region."";
}

if(!empty($city))
{
	$query_string .= " AND user_location=".(int)$city."";
}

$sql = sed_sql_query("SELECT DISTINCT u.user_id, u.* FROM $db_users $sqlmask $query_string $sqlorder");
$totalusers = sed_sql_numrows($sql);
$sql = sed_sql_query("SELECT DISTINCT u.user_id, u.* FROM $db_users $sqlmask $query_string $sqlorder LIMIT $d,{$cfg['maxusersperpage']}");


?>