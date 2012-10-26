<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/slimbox/slimbox.header.php
Version=1
Date=2009-mar-04
Type=Plugin
Author=Kilandor
Description=Slimbox+ImageScale Jquery Plugins
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=slimbox
Part=slimbox.header
File=slimbox.header
Hooks=header.main
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }
if($cfg['plugin']['slimbox']['scale'])
{
	$scale_js = '<script type="text/javascript" src="'.$cfg['plugins_dir'].'/slimbox/js/jquery.jScale.js"></script>';
	if(empty($cfg['plugin']['slimbox']['scalelspx']))
	{
		$scale_info[] = (!empty($cfg['plugin']['slimbox']['scalewpx'])) ? 'w:"'.$cfg['plugin']['slimbox']['scalewpx'].'px"' : '';
		$scale_info[] = (!empty($cfg['plugin']['slimbox']['scalehpx'])) ? 'h:"'.$cfg['plugin']['slimbox']['scalehpx'].'px"' : '';
		$scale_info = implode(', ', $scale_info);
	}
	else
	{
		$scale_info = 'ls:"'.$cfg['plugin']['slimbox']['scalelspx'].'px"';
	}
	$scale_info = (!empty($scale_info) && !empty($cfg['plugin']['slimbox']['scalespeed'])) ? $scale_info.', speed:'.$cfg['plugin']['slimbox']['scalespeed'] : $scale_info;
	$scale_init = '$(".scale").jScale({'.$scale_info.'})';
}
$out['compopup'] .= '
	<link rel="stylesheet" type="text/css" href="'.$cfg['plugins_dir'].'/slimbox/css/slimbox2.css" media="screen" />
	<script type="text/javascript" src="'.$cfg['plugins_dir'].'/slimbox/js/slimbox2.js"></script>
	'.$scale_js.'
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function() {
			jQuery(function($) {
				$("a[href]").filter(function() {
					return /\.(jpg|jpeg|png|gif)$/i.test(this.href);
				}).slimbox({}, null, function(el) {
					return (this == el) || (this.parentNode && (this.parentNode == el.parentNode));
				});
			});
			'.$scale_init.'

		});
		//]]>
	</script>
';
?>
