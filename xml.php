<?PHP

define('SED_CODE', TRUE);
$location = "XML";

// TODO move this to config
$cfg_timetolive = 20; // refresh cache every N seconds
$cfg_maxitems = 3000; // max items in rss
$cfg_charset = "UTF-8";

require_once ('./datas/config.php');
require_once ($cfg['system_dir'].'/functions.php');
require_once ($cfg['system_dir'].'/common.php');

$c = sed_import('c', 'G', 'ALP');
$id = sed_import('id', 'G', 'INT');
if ($c=="")	$c = "news";

header('Content-type: text/xml');
$sys['now'] = time();
$cache = sed_cache_get("rss_".$c.$id);
if ($cache)
{
	echo $cache; // output cache if avaiable
	exit();
}


$rss_link = $cfg['mainurl'];


$domain = str_replace("http://","",$cfg['mainurl']);

/* === Hook === */
$extp = sed_getextplugins('rss.create');
if (is_array($extp))
{
	foreach($extp as $k=>$pl)
	{
		include_once ($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php');
	}
}
/* ===== */

if ($c == "structure")
{

$sql = sed_sql_query("SELECT DISTINCT page_cat FROM $db_pages AS p LEFT JOIN $db_structure AS s ON s.structure_code=p.page_cat WHERE page_state='0' ORDER BY structure_path ASC ");
$i = 0;
while ($row = sed_sql_fetcharray($sql))
        {
        $page_cat = $row['page_cat'];

        if ($page_cat != 'system' && sed_auth('page', $page_cat, 'R'))
                {
                if(in_array($page_cat, getcatsubofcat())){
		            $sql1 = sed_sql_query("SELECT * FROM $db_pages AS p
		            LEFT JOIN $db_users AS u ON u.user_id=p.page_ownerid
		            WHERE page_cat='$page_cat'
		            AND p.page_prdstate=1
					AND u.user_shopstate=1
					");
				   	$page_count = sed_sql_numrows($sql1);
					}
				else{
					$sql1 = sed_sql_query("SELECT COUNT(*) FROM $db_pages WHERE page_cat='$page_cat'");
				   	$page_count = sed_sql_result($sql1,0,"COUNT(*)");
					}
				if($page_count > 0){
			        $fcat = $sed_cat[$page_cat]['tpath'];
			        if (empty($fcat)) { $fcat = $page_cat . " ?"; }
					$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('list', "c=".$page_cat);
					$i++;
					}
 				}           
        }
  }      
        ////////////
        
        
elseif ($c == "strforum")
{

$sql = sed_sql_query("SELECT s.fs_id, s.fs_title, s.fs_category, s.fs_topiccount, s.fs_postcount FROM $db_forum_sections AS s LEFT JOIN
$db_forum_structure AS n ON n.fn_code=s.fs_category
    ORDER by fn_path ASC, fs_order ASC");
$i = 0;
while ($row = sed_sql_fetcharray($sql))
{
    $forum_cat = $row['fs_id'];
//$plugin_body .= (sed_auth('forums', $row['fs_id'], 'R')) ? "<li>".sed_build_forums($row['fs_id'], $row['fs_title'], $row['fs_category'])." (".$row['fs_topiccount']."/".$row['fs_postcount'].")</li>" : '';
$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('forums', "m=topics&s=$forum_cat");
$i++;
}

}

elseif ($c == "forums")
{
	// == All posts on forums ==
	$rss_title = $domain." : ".$L['rss_allforums_item_title'];
	$rss_description = "";

	$sql = "SELECT * FROM $db_forum_posts ORDER BY fp_creation DESC	LIMIT $cfg_maxitems ";
	$res = sed_sql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($res))
	{
		$post_id = $row['fp_id'];
		$topic_id = $row['fp_topicid'];
		$forum_id = $row['fp_sectionid'];

		$flag_private = 0;
		$sql = "SELECT * FROM $db_forum_topics WHERE ft_id='$topic_id'";
		$res2 = sed_sql_query($sql);
		$row2 = mysql_fetch_assoc($res2);
		$topic_title = $row2['ft_title'];
		if ($row2['ft_mode']=='1')
		$flag_private = 1;

		if (!$flag_private AND sed_auth('forums', $forum_id, 'R'))
		{

		//	$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('forums', "m=posts&p=$post_id", true);
	$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('forums', "m=posts&q=$topic_id");
	//$items[$i]['link'] = $rss_link."/forums.php?m=posts&amp;q=".$topic_id;
		//$items[$i]['link'] = SED_ABSOLUTE_URL."forums.php?m=posts&q=".$topic_id.";
	//$items[$i]['link'] = sed_url('forums', 'm=posts&q='.$topic_id);
			$items[$i]['pubDate'] = date('Y-m-d', $row['fp_creation']);
		}
		$i++;
	}
}
elseif ($c == "projects")
{
	// == All items ==
	$rss_title = $domain." : Заказы";
	$rss_description = "";

	$sql = "SELECT * FROM sed_projects WHERE item_state=0 ORDER BY item_date DESC LIMIT $cfg_maxitems ";
	$res = sed_sql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($res))
	{

		$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('plug', "e=projects&m=show&itemid=".$row['item_id']."");
		$items[$i]['pubDate'] = date('Y-m-d', $row['item_date']);
		
		$i++;
	}
}
elseif ($c == "pcat")
{
	// == All items ==
	$rss_title = $domain." : Каталог заказов";
	$rss_description = "";

	
	foreach($sed_pcat as $i => $cats)
	{
		$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('plug', "e=projects&c=".$i."");
		$items[$i]['pubDate'] = date('Y-m-d', $sys['now_offset']);
	}
}
elseif ($c == "market")
{
	// == All items ==
	$rss_title = $domain." : Магазин";
	$rss_description = "";

	$sql = "SELECT * FROM sed_market as m
	LEFT JOIN sed_users AS u ON u.user_id=m.item_userid
	WHERE item_state=0
	AND u.user_protodate>".$sys['now_offset']." 
	ORDER BY item_date DESC LIMIT $cfg_maxitems ";
	$res = sed_sql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($res))
	{

		$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('plug', "e=market&m=show&itemid=".$row['item_id']."");
		$items[$i]['pubDate'] = date('Y-m-d', $row['item_date']);
		
		$i++;
	}
}
elseif ($c == "mcat")
{
	// == All items ==
	$rss_title = $domain." : Каталог магазина";
	$rss_description = "";

	
	foreach($sed_mcat as $i => $cats)
	{
		$items[$i]['link'] = SED_ABSOLUTE_URL.sed_url('plug', "e=market&c=".$i."");
		$items[$i]['pubDate'] = date('Y-m-d', $sys['now_offset']);
	}
}
else
{
	// == Category rss ==
	$mtch = $sed_cat[$c]['path'].".";
	$mtchlen = strlen($mtch);
	$catsub = array();
	$catsub[] = $c;

	foreach($sed_cat as $i => $x)
	{
		if(substr($x['path'], 0, $mtchlen)==$mtch) { $catsub[] = $i; }
	}

	$sql = sed_sql_query("SELECT * FROM $db_pages AS p 
	LEFT JOIN $db_users AS u ON u.user_id=p.page_ownerid 
	WHERE page_state=0 AND page_cat NOT LIKE 'system' AND page_cat IN ('".implode("','", $catsub)."') ORDER by page_date DESC LIMIT ".$cfg_maxitems);
	$i = 0;
	while($row = mysql_fetch_assoc($sql))
	{
		
		if((in_array($row['page_cat'], getcatsubofcat()) && $row['page_prdstate'] && $row['user_shopstate']) 
			|| !in_array($row['page_cat'], getcatsubofcat())){
			$row_page_url = (!empty($row['page_alias'])) ? SED_ABSOLUTE_URL.sed_url('page', "al=".$row['page_alias'], '', true) : SED_ABSOLUTE_URL.sed_url('page', "id=".$row['page_id'], '', true);

			$items[$i]['link'] = $row_page_url;
			$items[$i]['pubDate'] = date('Y-m-d', $row['page_date']);

			$i++;
			}
	}
}

// RSS output
$out = "<?xml version=\"1.0\" encoding=\"".$cfg_charset."\"?>\n";
$out .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
$out .= "<url>\n";
$out .= "<loc>".$rss_link."</loc>\n";
//$out .= "<lastmod>".."</lastmod>";

$out .= "<priority>0.5</priority>\n";
$out .= "</url>\n";
if (count($items)>0)
{
	foreach($items as $item)
	{
$out .= "<url>\n";
$out .= "<loc>".$item['link']."</loc>\n";
$out .= "<lastmod>".$item['pubDate']."</lastmod>";
$out .= "<priority>0.5</priority>\n";
$out .= "</url>\n";
	}
}
$out .= "</urlset>\n";

/* === Hook === */
$extp = sed_getextplugins('rss.output');
if (is_array($extp))
{
	foreach($extp as $k=>$pl)
	{
		include_once ($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php');
	}
}
/* ===== */

sed_cache_store("rss_".$c.$type.$rtype.$id, $out, $cfg_timetolive);
echo $out;


?>
