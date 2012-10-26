<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=fbconnect
Part=input
File=fbconnect.input
Hooks=input
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

require_once $cfg['plugins_dir'] . '/fbconnect/lib/facebook.php';
require_once $cfg['plugins_dir'] . '/fbconnect/inc/fbconnect.functions.php';

$facebook = new Facebook(array(
  'appId'  => $cfg['plugin']['fbconnect']['app_id'],
  'secret' => $cfg['plugin']['fbconnect']['secret_key'],
  'cookie' => true,
));

$fb_user = $facebook->getUser();

$fb_connected = false;
$fb_me = null;

if ($fb_user)
{
	try
	{
		$fb_me = $facebook->api('/me');
		$fb_connected = true;
	}
	catch (FacebookApiException $fb_e)
	{
		error_log($fb_e);
		$fb_connected = false;
	}
}


if ($fb_connected)
{
	if ($usr['id'] > 0)
	{
		// Logged in both on FB and Cotonti
		if (empty($usr['profile']['user_fbid']))
		{
			sed_sql_query("UPDATE $db_users SET user_fbid = '".sed_sql_prep($fb_user)."'
				WHERE user_id = " . $usr['id']);
		}
		// continue normal execution
	}
	elseif (!defined('SED_USERS') && !defined('SED_MESSAGE')
		&& !(defined('SED_PLUG') && $_GET['e'] == 'fbconnect'
			&& $_GET['m'] == 'register')
		&& !(defined('SED_PLUG') && $_GET['e'] == 'scuola'
			&& $_GET['m'] == 'register')) // avoid deadlocks and loops
	{
		// Remember this URL
		sed_uriredir_store();
		// Check if this FB user has a native Cotonti account
		$fb_res = sed_sql_query("SELECT * FROM $db_users WHERE user_fbid = '".sed_sql_prep($fb_user)."'");
		if ($row = sed_sql_fetchassoc($fb_res))
		{
			// Load user account and log him in
			fb_autologin($row);
			exit;
		}
		elseif ($cfg['plugin']['fbconnect']['autoreg'])
		{
			// Forward to quick account registration,
			// except for users module to let existing users log in and have FB UID filled
			sed_redirect(sed_url('plug', 'e=fbconnect&m=register', '', TRUE));
			exit;
		}
		sed_sql_freeresult($fb_res);
	}
}

// Disable Anti-CSRF for built-in registration
if (defined('SED_PLUG') && $_GET['e'] == 'fbconnect' && $_GET['m'] == 'register')
{
	define('SED_NO_ANTIXSS', true);
	$sys['uriredir_prev'] = $_SESSION['s_uri_redir'];
}

?>
