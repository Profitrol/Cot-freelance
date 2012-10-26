<?PHP

/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=desc
Part=main
File=desc
Hooks=header.main
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */
defined('SED_CODE') or die('Wrong URL');

function desc_fltr($res)
{
$res=str_replace ('\r', "", $res);
$res=str_replace ('\n', " ", $res);
$res=htmlspecialchars($res);
return $res;
}
function key_tags($q,$loc)
{
$tags = sed_tag_list($q,$loc);
if(count($tags) > 0)
	{
		$tag_i = 0;
			foreach($tags as $tag)
			{
			$tag_t = $cfg['plugin']['tags']['title'] ? htmlspecialchars(sed_tag_title($tag)) : htmlspecialchars($tag);
			if ($tag_i > 0) $tc_html .= ', ';
			$tc_html .=$tag_t;
			$tag_i++;
			}
	$tc_html.=', ';
	}
return	$tc_html;
}

switch($z)
{
case 'index':
   $out['meta_desc']= $cfg['plugin']['desc']['desc_index'];
   if(!empty($cfg['plugin']['desc']['key_index'])) $out['meta_keywords']=$cfg['plugin']['desc']['key_index'];
break;
// case 'users':
 // if($m == 'details'){
   // $out['meta_desc'] = ($urr['user_about'] != "") ? sed_cutstring(desc_fltr($urr['user_about']),150) : $sed_fcat[$urr['user_cat']]['title'].' '.$sed_location[$urr['user_region']]['name'].' '.$sed_location[$urr['user_region']]['loc'][$urr['user_location']];
   // $out['meta_keywords'] = $sed_fcat[$urr['user_cat']]['title'];
   // }
// break;
// case 'page':
 // if(empty($m)){
   // $out['meta_desc']=(empty($pag['page_desc']))? sed_cutstring(desc_fltr($pag['page_text']),150) : desc_fltr(strip_tags($pag['page_desc']));
   // $out['meta_keywords']=key_tags($pag['page_id'],'pages').$out['meta_keywords'];
   // }
// break;
// case 'list':
   // $out['meta_desc']=(empty($sed_cat[$c]['desc']))? $out['fulltitle']:desc_fltr(strip_tags($sed_cat[$c]['desc']));
// break;
// case 'forums':
   // if($m=='posts'){
   	// $out['meta_desc']=(empty($ft_desc))? sed_cutstring(desc_fltr($ft_poll['ft_preview']),150):desc_fltr(strip_tags($ft_desc));
    // $out['meta_keywords']=key_tags($q,'forums').$out['meta_keywords'];
    // }elseif
   // ($m=='topics'){$out['meta_desc']=(empty($fs_desc))? '':desc_fltr(strip_tags($fs_desc));
   // }else{
	   // $out['meta_desc']=(empty($cfg['plugin']['desc']['desc_forum']))? $out['meta_desc']:desc_fltr(strip_tags($cfg['plugin']['desc']['desc_forum']));
	   // $out['meta_keywords']=$cfg['plugin']['desc']['key_forum'];
   	// }
// break;
// case 'plug':

    }
?>
