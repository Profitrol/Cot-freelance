<?php
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net
[BEGIN_SED]
File=users.auth.inc.php
Version=102
Updated=2006-apr-19
Type=Core
Author=Neocrome
Description=User authication
[END_SED]
==================== */

defined('SED_CODE') or die('Wrong URL');

$v = sed_import('v','G','PSW');

/* === Hook === */
$extp = sed_getextplugins('users.auth.first');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($a=='check')
{
	sed_shield_protect();

	/* === Hook for the plugins === */
	$extp = sed_getextplugins('users.auth.check');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	$rusername = sed_import('rusername','P','TXT', 100, TRUE);
	$rpassword = sed_import('rpassword','P','TXT', 16, TRUE);
	$rcookiettl = sed_import('rcookiettl', 'P', 'INT');
	$rremember = sed_import('rremember', 'P', 'BOL');
	if(empty($rremember) && $rcookiettl > 0 || $cfg['forcerememberme'])
    {
        $rremember = true;
    }
	$rmdpass  = md5($rpassword);

	$login_param = preg_match('#^[\w\p{L}][\.\w\p{L}\-]*@[\w\p{L}\.\-]+\.[\w\p{L}]+$#u', $rusername) ?
		'user_email' : 'user_name';

	// Load salt and algo from db
	$sql = sed_sql_query("SELECT user_passsalt, user_passfunc FROM $db_users WHERE $login_param='".sed_sql_prep($rusername)."'");
	if (sed_sql_numrows($sql) == 1)
	{
		$hash_params = sed_sql_fetchassoc($sql);
		$rmdpass = sed_hash($rpassword, $hash_params['user_passsalt'], $hash_params['user_passfunc']);
		unset($hash_params);
	}

	/**
	 * Sets user selection criteria for authentication. Override this string in your plugin
	 * hooking into users.auth.check.query to provide other authentication methods.
	 */
	$user_select_condition = "user_password='$rmdpass' AND $login_param='".sed_sql_prep($rusername)."'";

	/* === Hook for the plugins === */
	$extp = sed_getextplugins('users.auth.check.query');
	if (is_array($extp))
	{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
	/* ===== */

	$sql = sed_sql_query("SELECT user_id, user_name, user_maingrp, user_banexpire, user_skin, user_theme, user_lang, user_sid, user_sidtime FROM $db_users WHERE $user_select_condition");

	if ($row = sed_sql_fetcharray($sql))
	{
		$rusername = $row['user_name'];
		if ($row['user_maingrp']==-1)
		{
			sed_log("Log in attempt, user inactive : ".$rusername, 'usr');
			sed_redirect(sed_url('message', 'msg=152', '', true));
		}
		if ($row['user_maingrp']==2)
		{
			sed_log("Log in attempt, user inactive : ".$rusername, 'usr');
			sed_redirect(sed_url('message', 'msg=152', '', true));
		}
		elseif ($row['user_maingrp']==3)
		{
			if ($sys['now'] > $row['user_banexpire'] && $row['user_banexpire']>0)
			{
				$sql = sed_sql_query("UPDATE $db_users SET user_maingrp='4' WHERE user_id={$row['user_id']}");
			}
			else
			{
				sed_log("Log in attempt, user banned : ".$rusername, 'usr');
				sed_redirect(sed_url('message', 'msg=153&num='.$row['user_banexpire'], '', true));
			}
		}

		$ruserid = $row['user_id'];
		$rdeftheme = $row['user_theme'];
		$rdefscheme = $row['user_scheme'];

		$token = sed_unique(16);

		$sid = hash_hmac('sha256', $rmdpass . $row['user_sidtime'], $cfg['secret_key']);

		if (empty($row['user_sid']) || $row['user_sid'] != $sid
			|| $row['user_sidtime'] + $cfg['cookielifetime'] < $sys['now_offset'])
		{
			// Generate new session identifier
			$sid = hash_hmac('sha256', $rmdpass . $sys['now_offset'], $cfg['secret_key']);
			$update_sid = ", user_sid = '" . sed_sql_prep($sid) . "', user_sidtime = " . $sys['now_offset'];
		}
		else
		{
			$update_sid = '';
		}

		sed_sql_query("UPDATE $db_users SET user_lastip='{$usr['ip']}', user_lastlog = {$sys['now_offset']}, user_logcount = user_logcount + 1, user_token = '$token' $update_sid WHERE user_id={$row['user_id']}");

		// Hash the sid once more so it can't be faked even if you  know user_sid
		$sid = hash_hmac('sha1', $sid, $cfg['secret_key']);

		$u = base64_encode($ruserid.':'.$sid);

		if($rremember)
		{
			sed_setcookie($sys['site_id'], $u, time()+$cfg['cookielifetime'], $cfg['cookiepath'], $cfg['cookiedomain'], $sys['secure'], true);
			unset($_SESSION[$sys['site_id']]);
		}
		else
		{
			$_SESSION[$sys['site_id']] = $u;
		}

		/* === Hook === */
		$extp = sed_getextplugins('users.auth.check.done');
		if (is_array($extp))
		{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */

		$sql = sed_sql_query("DELETE FROM $db_online WHERE online_userid='-1' AND online_ip='".$usr['ip']."' LIMIT 1");
		sed_uriredir_apply($cfg['redirbkonlogin']);
		sed_uriredir_redirect(empty($redirect) ? sed_url('index') : base64_decode($redirect));
		exit;
	}
	else
	{
		sed_shield_update(7, "Log in");
		sed_log("Log in failed, user : ".$rusername,'usr');
		sed_redirect(sed_url('message', 'msg=151', '', true));
		exit;
	}
}

/* === Hook === */
$extp = sed_getextplugins('users.auth.main');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$plug_head .= '<meta name="robots" content="noindex" />';
require_once $cfg['system_dir'] . '/header.php';
$t = new XTemplate(sed_skinfile('users.auth'));

if ($cfg['maintenance'])
{
	$t->assign(array("USERS_AUTH_MAINTENANCERES" => $cfg['maintenancereason']));
	$t->parse("MAIN.USERS_AUTH_MAINTENANCE");
}

$t->assign(array(
	"USERS_AUTH_TITLE" => $L['aut_logintitle'],
	"USERS_AUTH_SEND" => sed_url('users', 'm=auth&a=check' . (empty($redirect) ? '' : "&redirect=$redirect")),
	"USERS_AUTH_USER" => "<input type=\"text\" class=\"text\" name=\"rusername\" size=\"16\" maxlength=\"32\" />",
	"USERS_AUTH_PASSWORD" => "<input type=\"password\" class=\"password\" name=\"rpassword\" size=\"16\" maxlength=\"32\" />",
	"USERS_AUTH_REGISTER" => sed_url('users', 'm=register')
));

/* === Hook === */
$extp = sed_getextplugins('users.auth.tags');
if (is_array($extp))
{ foreach($extp as $k => $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$t->parse("MAIN");
$t->out("MAIN");

require_once $cfg['system_dir'] . '/footer.php';
?>