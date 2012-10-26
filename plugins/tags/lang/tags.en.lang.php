<?PHP
/**
 * English Language File for Tags Plugin
 *
 * @package Cotonti
 * @version 0.1.0
 * @author Cotonti Translators Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL.');

/**
 * Plugin Body
 */

$L['tags_All'] = 'All tags';
$L['tags_comma_separated'] = 'comma separated';
$L['tags_Found_in_forums'] = 'Found in forums';
$L['tags_Found_in_pages'] = 'Found in pages';
$L['tags_Keyword'] = 'Keyword';
$L['tags_Keywords'] = 'Keywords';
$L['tags_Orderby'] = 'Order results by';
$L['tags_Query_hint'] = 'Several comma-separated tags will be considered as logical AND between them. You can also use semicolon for logical OR. AND has a priority over OR and you cannot use parentheses for logical grouping. Asterisk (*) within a tag will be regarded as a mask for &quot;any string&quot;.';
$L['tags_Search_results'] = 'Search Results';
$L['tags_Tag_cloud'] = 'Tag Cloud';
$L['tags_Tag_cloud_none'] = 'No tags';

/**
 * Plugin Config
 */

$L['cfg_forums'] = array('Enable tags in forums');
$L['cfg_index'] = array('Index page tag cloud area');
$L['cfg_limit'] = array('Max. tags per item, 0 for unlimited');
$L['cfg_lim_forums'] = array('Tag limit for forums tag cloud, 0 for unlimited');
$L['cfg_lim_index'] = array('Tag limit for index (homepage) tag cloud, 0 for unlimited');
$L['cfg_lim_pages'] = array('Tag limit for pages tag cloud, 0 for unlimited');
$L['cfg_more'] = array('Show &quot;All tags&quot; link in tag clouds');
$L['cfg_order'] = array('Cloud output order &mdash; alphabetical, descending frequency or random');
$L['cfg_pages'] = array('Enable tags in pages');
$L['cfg_perpage'] = array('Tags displayed per page in standalone cloud, 0 is all at once');
$L['cfg_sort'] = array('Default sorting column for tag search results');
$L['cfg_title'] = array('Capitalize first letters of keywords');
$L['cfg_translit'] = array('Transliterate tags in URLs');

?>