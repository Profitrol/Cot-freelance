<?PHP
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=tags
Part=forums
File=tags.forums
Hooks=forums.sections.tags
Tags=forums.sections.tpl:{FORUMS_SECTIONS_TAG_CLOUD},{FORUMS_TAG_CLOUD_ALL_LINK}
Order=10
[END_SED_EXTPLUGIN]
==================== */

/**
 * Part of plug tags
 *
 * @package Cotonti
 * @version 0.0.3
 * @author Trustmaster - Vladimir Sibirov
 * @copyright All rights reserved. 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL');

if($cfg['plugin']['tags']['forums'])
{
	require_once(sed_langfile('tags'));
	require_once $cfg['plugins_dir'].'/tags/inc/config.php';
	// Get all subcategories
	$limit = $cfg['plugin']['tags']['lim_forums'] == 0 ? null : (int) $cfg['plugin']['tags']['lim_forums'];
	$tcloud = sed_tag_cloud('forums', $cfg['plugin']['tags']['order'], $limit);
	$tc_html = '<ul class="tag_cloud">';
	$tag_count = 0;
	foreach($tcloud as $tag => $cnt)
	{
		$tag_count++;
		$tag_t = $cfg['plugin']['tags']['title'] ? sed_tag_title($tag) : $tag;
		$tag_u = sed_urlencode($tag, $cfg['plugin']['tags']['translit']);
		$tl = $lang != 'en' && $tag_u != $tag ? 1 : null;
		foreach($tc_styles as $key => $val)
		{
			if($cnt <= $key)
			{
				$dim = $val;
				break;
			}
		}
		$tc_html .= '<li><a href="'.sed_url('plug', array('e' => 'tags', 'a' => 'forums', 't' => $tag_u, 'tl' => $tl)).'" class="'.$dim.'">'.htmlspecialchars($tag_t)."</a><span>".$cnt."</span></li>\r\n";
	}
	$tc_html .= '</ul>';
	$tc_html = ($tag_count > 0) ? $tc_html : $L['tags_Tag_cloud_none'];
	$t->assign(array(
	'FORUMS_SECTIONS_TAG_CLOUD' => $tc_html
	));
	if($cfg['plugin']['tags']['more'] && $limit > 0 && $tag_count == $limit)
	{
		$t->assign('FORUMS_SECTIONS_TAG_CLOUD_ALL_LINK', '<a class="more" href="'
			.sed_url('plug', 'e=tags&a=forums').'">'.$L['tags_All'].'</a>');
	}
}

?>