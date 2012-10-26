<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=bbflow
Part=header
File=bbflow.header
Hooks=header.main
Tags=header.tpl:{HEADER_COMPOPUP}
Minlevel=0
Order=11
[END_SED_EXTPLUGIN]
==================== */

/**
 * BBCodes for flow players: header
 *
 * markItUp! connection, BBCode CSS connection
 *
 * @package bbflow
 * @version 2009-03-27 beta
 * @author dervan
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL.');

if (defined('SED_INDEX') || defined('SED_LIST') || defined('SED_MESSAGE'))
{
	return; // see plugins/markitup/markitup.header.php
}

$bbf_lang = "{$cfg['plugins_dir']}/bbflow/markitup/lang/$lang.lang.js";
if (!file_exists($bbf_lang))
{
	$bbf_lang = "{$cfg['plugins_dir']}/bbflow/markitup/lang/en.lang.js";
}

$bbf_search = "<script type=\"text/javascript\" src=\"{$cfg['plugins_dir']}/markitup/js/set.js\"></script>";
$bbf_replace = <<<HTM
$bbf_search
<script type="text/javascript" src="$bbf_lang"></script>
<script type="text/javascript" src="{$cfg['plugins_dir']}/bbflow/markitup/set.js"></script>
<link rel="stylesheet" type="text/css" href="{$cfg['plugins_dir']}/bbflow/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="{$cfg['plugins_dir']}/bbflow/tpl/v.{$cfg['plugin']['bbflow']['bbfv_align']}.css" />
HTM;
$out['compopup'] = str_ireplace($bbf_search, $bbf_replace, $out['compopup']);
?>