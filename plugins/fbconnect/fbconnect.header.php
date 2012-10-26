<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=fbconnect
Part=header
File=fbconnect.header
Hooks=header.body
Tags=header.tpl:{FB_XMLNS},{FB_LOGIN},{FB_LOGOUT},{FB_LOGIN_REGISTER},{FB_LOGIN_URL},{FB_LOGOUT_URL},{FB_REGISTER_URL}
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

/**
 * Embeds FBConnect in header
 *
 * @package fbconnect
 * @version 2.0.0
 * @author Trustmaster
 * @copyright (c) 2011 Vladimir Sibirov, Skuola.net
 * @license BSD
 */

// Try to detect the locale
if (preg_match('#([a-z]{2})(\-[A-Z]{2})?#i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $fb_mt))
{
	$fb_locale = empty($fb_mt[2])
		? $fb_mt[1] . '_' . strtoupper($fb_mt[1])
		: $fb_mt[1] . str_replace('-', '_', strtoupper($fb_mt[2]));
}
else
{
	$fb_locale = $cfg['plugin']['fbconnect']['locale'];
}

$fb_channel_url = $sys['host'].$sys['site_uri'].'plugins/fbconnect/lib/facebook_channel.php';
$fb_reload_page = $usr['id'] > 0 ? 'false' : 'true';
$fb_init_script = <<<HTM
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
		appId: '{$cfg['plugin']['fbconnect']['app_id']}',
		channelURL: '//$fb_channel_url',
		status: true,
		cookie: true,
		oauth: true,
		xfbml: true
	});
	if ($fb_reload_page){
                FB.Event.subscribe('auth.login', function(response) {
                    if(response.authResponse){
                        window.location.reload();
                    }
                });
        }
};

(function(d){
	 var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
	 js = d.createElement('script'); js.id = id; js.async = true;
	 js.src = "//connect.facebook.net/$fb_locale/all.js";
	 d.getElementsByTagName('head')[0].appendChild(js);
 }(document));
</script>
HTM;

$fb_register_url = SED_ABSOLUTE_URL . sed_url('plug', 'e=fbconnect&m=register');

$out['loginout_url'] = sed_url('users', 'm=logout&'.sed_xg());
$out['loginout'] = "<a href=\"".$out['loginout_url']."\">".$L['Logout']."</a>";
$fb_logout_button = '<a href="'.$out['loginout_url'].'" onclick="FB.logout();return true;" title="'.$L['Logout'].'" >'.$L['Logout'].'</a>';

$fb_params = array();
$fb_button_params = '';
if (!empty($cfg['plugin']['fbconnect']['scope']))
{
	$fb_params['scope'] = explode(',', $cfg['plugin']['fbconnect']['scope']);
	$fb_button_params = ' perms="'.$cfg['plugin']['fbconnect']['scope'].'"';
}

$t->assign(array(
	'FB_XMLNS' => 'xmlns:fb="http://www.facebook.com/2008/fbml"',
	'FB_LOGIN' => $fb_connected ? $fb_logout_button : '<fb:login-button'.$fb_button_params.'></fb:login-button>',
	'FB_LOGOUT' => $fb_connected ? $fb_logout_button : $out['loginout'],
	'FB_LOGOUT_ONCLICK' => $fb_connected ? 'onclick="FB.logout();return true;"' : '',
	'FB_LOGIN_REGISTER' => $fb_connected ? '' : '<fb:login-button registration-url="'.$fb_register_url.'"'.$fb_button_params.'></fb:login-button>',
	'FB_REGISTER_URL' => $fb_register_url,
	'FB_LOGIN_URL' => $fb_connected ? '#' : $facebook->getLoginUrl($fb_params),
	'FB_LOGOUT_URL' => $fb_connected ? '#' : $facebook->getLogoutUrl(),
));

?>
