<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=bbflow
Name=BBCodes for flow players
Description=BBCodes for flow players
Version=2009-03-27 beta
Date=2009-mar-27
Author=dervan
Copyright=
Notes=BSD License
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=RW
Lock_members=12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
bbfv_align=01:select:left,right,center:left:Align for players from video hosts
[END_SED_EXTPLUGIN_CONFIG]
==================== */

/**
 * BBCodes for flow players: setup
 *
 * @package bbflow
 * @version 2009-03-27 beta
 * @author dervan
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL.');

define('BBF_PRIORITY', 128);
define('BBF_PLUGNAME', 'bbflow');

/**
 * Items customization: video hosts ('v' sign)
 */
$bbf_customize = array(
	'collegehumor'	=> 'v', // allowed as video host
	'dailymotion'	=> 'v',
	'gamespot'		=> 'v',
	'gametrailers'	=> 'v',
	'googlevideo'	=> 'v',
	'metacafe'		=> 'v',
	'rutube'		=> 'v',
	'spike'			=> 'v',
	'veoh'			=> 'v',
	'videomailru'	=> 'v',
	'yahoovideo'	=> 'v',
	'youtube'		=> 'v',
);

/**
 * Video hosts list: key of each item is name of BBCode
 */
$bbf_videohosts_list = array(
	'collegehumor' => array(
		'name' => 'CollegeHumor',
		'icon' => 'images/v/collegehumor.png', // png 16x16 for markItUp!
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => '52105',
		'movie' => 'http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=$1&amp;fullscreen=1',
		'width' => 480,
		'height' => 360,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'dailymotion' => array(
		'name' => 'Dailymotion',
		'icon' => 'images/v/dailymotion.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => 'x57ikw_people',
		'movie' => 'http://www.dailymotion.com/swf/$1&amp;related=1',
		'width' => 480,
		'height' => 381,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'gamespot' => array(
		'name' => 'GameSpot',
		'icon' => 'images/v/gamespot.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => '6203325',
		'movie' => 'http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/proteus2.swf',
		'width' => 432,
		'height' => 362,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => 'skin=http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/skins/gamespot.png&amp;paramsURI=http%3A%2F%2Fwww.gamespot.com%2Fpages%2Fvideo_player%2Fxml.php%3Fid%3D$1',
	),
	'gametrailers' => array(
		'name' => 'GameTrailers',
		'icon' => 'images/v/gametrailers.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => '46173',
		'movie' => 'http://www.gametrailers.com/remote_wrap.php?mid=$1',
		'width' => 480,
		'height' => 392,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'googlevideo' => array( // Seditio legacy BBCode
		'name' => 'Google Video',
		'icon' => 'images/v/googlevideo.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => '-110424371062222836',
		'movie' => 'http://video.google.com/googleplayer.swf?docid=$1&amp;hl=en&amp;fs=true',
		'width' => 400,
		'height' => 326,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'metacafe' => array( // Seditio legacy BBCode
		'name' => 'Metacafe',
		'icon' => 'images/v/metacafe.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '.swf',
		'example' => '336726/adir_miller_show',
		'movie' => 'http://www.metacafe.com/fplayer/$1',
		'width' => 400,
		'height' => 345,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'rutube' => array(
		'name' => 'RuTube',
		'icon' => 'images/v/rutube.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => 'ef46c146a78b75be8d80414c0a7f81df',
		'movie' => 'http://video.rutube.ru/$1',
		'width' => 470,
		'height' => 353,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'spike' => array(
		'name' => 'Spike',
		'icon' => 'images/v/spike.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => '2444060',
		'movie' => 'http://www.spike.com/efp',
		'width' => 320,
		'height' => 240,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => 'flvbaseclip=$1',
	),
	'veoh' => array(
		'name' => 'Veoh',
		'icon' => 'images/v/veoh.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => 'v17483327ZSaP2qQD',
		'movie' => 'http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?permalinkId=$1&amp;player=videodetailsembedded&amp;videoAutoPlay=0&amp;id=anonymous',
		'width' => 410,
		'height' => 341,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'videomailru' => array(
		'name' => 'Video@Mail.Ru',
		'icon' => 'images/v/videomailru.png',
		'regex' => '([^\s"\';&\?\(\[]+)/([^\s"\';&\?\(\[]+)/([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => 'olchik_06/486/487',
		'movie' => 'http://img.mail.ru/r/video2/player_v2.swf?par=http://content.video.mail.ru/mail/$1/$2/$$3',
		'width' => 450,
		'height' => 375,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
	'yahoovideo' => array(
		'name' => 'Yahoo! Video',
		'icon' => 'images/v/yahoovideo.png',
		'regex' => '([^\s"\';&\?\(\[]+)/([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => '1140713/5248092',
		'movie' => 'http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34',
		'width' => 512,
		'height' => 322,
		'bgcolor' => '',
		'transparent' => false, // not works in transparent with Firefox 3.0.6 for Windows
		'flashvars' => 'vid=$1&amp;id=$2&amp;lang=en-us&amp;intl=us&amp;embed=1',
	),
	'youtube' => array( // Seditio legacy BBCode
		'name' => 'YouTube',
		'icon' => 'images/v/youtube.png',
		'regex' => '([^\s"\';&\?\(\[]+)',
		'suffix' => '',
		'example' => 'Mi_Cf1OFAFY',
		'movie' => 'http://www.youtube.com/v/$1',
		'width' => 425,
		'height' => 344,
		'bgcolor' => '',
		'transparent' => true,
		'flashvars' => '',
	),
);

/**
 * Install BBCode for video host
 *
 * @global $db_bbcode
 * @global $bbf_videohosts_list
 * @param string $key Key in video hosts list, and name of BBCode
 * @return string
 */
function bbf_install_bbvideohost($key)
{
	global $db_bbcode, $bbf_videohosts_list;

	sed_sql_delete($db_bbcode, "bbc_name = '$key'");

	$item =& $bbf_videohosts_list[$key];
	return sed_bbcode_add(
		$key, 'pcre', "\[$key={$item['regex']}\]",
		'<div class="bbfv_div">'
		. "<object type=\"application/x-shockwave-flash\" data=\"{$item['movie']}\" width=\"{$item['width']}\" height=\"{$item['height']}\">"
		. "<param name=\"movie\" value=\"{$item['movie']}\" />"
		. '<param name="allowfullscreen" value="true" />'
		. '<param name="allowscriptaccess" value="always" />'
		. ($item['transparent'] ? '<param name="wmode" value="transparent" />' : '')
		. (!empty($item['bgcolor']) ? "<param name=\"bgcolor\" value=\"{$item['bgcolor']}\" />" : '')
		. (!empty($item['flashvars']) ? "<param name=\"flashvars\" value=\"{$item['flashvars']}\" />" : '')
		. '</object>'
		. '</div>'
		. '<div style="clear:both;"></div>',
		false, BBF_PRIORITY, BBF_PLUGNAME
	);
}

/**
 * Setup
 */
if ('install' == $action)
{
	sed_bbcode_remove(0, BBF_PLUGNAME);

	foreach ($bbf_customize as $key => $val)
	{
		switch ($val)
		{
			case 'v':
				bbf_install_bbvideohost($key);
			break;
		}
	}
}
elseif ('uninstall' == $action)
{
	sed_bbcode_remove(0, BBF_PLUGNAME);
}
?>