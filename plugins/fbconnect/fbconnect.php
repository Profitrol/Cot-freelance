<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=fbconnect
Part=main
File=fbconnect
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') || die('Wrong URL.');

/**
 * Standalone pages
 *
 * @package fbconnect
 * @version 2.0.0
 * @author Trustmaster
 * @copyright (c) 2011 Vladimir Sibirov, Skuola.net
 * @license BSD
 */

// FaceBook PHP API
require_once $cfg['plugins_dir'] . '/fbconnect/lib/facebook.php';
require_once $cfg['plugins_dir'] . '/fbconnect/inc/fbconnect.functions.php';

if ($m == 'register' && $usr['id'] == 0)
{
	$_SESSION['s_uri_redir'] = $sys['uriredir_prev'];
	// FB register plugin
	if ($_POST['signed_request'])
	{
		$response = parse_signed_request($_POST['signed_request'], $cfg['plugin']['fbconnect']['secret_key']);
		if (!$response)
		{
			sed_die();
		}

		sed_shield_protect();

		/* === Hook for the plugins === */
		$extp = sed_getextplugins('users.register.add.first');
		if (is_array($extp))
		{ foreach ($extp as $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */

		$is_fb_user = isset($response['user_id']);
		$fb_user = $response['user_id'];

		// Check if e-mail exists
		$ruseremail = mb_strtolower($response['registration']['email']);
		$res = sed_sql_query("SELECT * FROM $db_users
			WHERE user_email = '" . sed_sql_prep($ruseremail) . "'");
		if (sed_sql_numrows($res) == 1)
		{
			if ($is_fb_user)
			{
				// Attach FB ID to account and log in
				$ruser = sed_sql_fetchassoc($res);
				sed_sql_query("UPDATE $db_users SET user_fbid = '".sed_sql_prep($fb_user)."'
					WHERE user_id = " . $ruser['user_id']);
				fb_autologin($ruser);
			}
			else
			{
				// Duplicate email
				sed_die();
			}
			exit;
		}

		// Check username and make it unique
		$rusername = $response['registration']['login'];
		$tried_bd = false;
		while ($res = sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM $db_users
			WHERE user_name = '" . sed_sql_prep($rusername) . "'"), 0, 0) && $res > 0)
		{
			$rusername = $response['registration']['login'];
			if ($tried_bd)
			{
				$rusername .= mt_rand(1, 999);
			}
			else
			{
				$rusername .= $bdate[2];
				$tried_bd = true;
			}
		}
		
		$ruserregtype = $response['registration']['regtype'];
		
		// Detect language
		$ruserlang = mb_substr($response['user']['locale'], 0, 2);
		if (!file_exists('./system/lang/' . $ruserlang))
		{
			$ruserlang = $cfg['defaultlang'];
		}

		// Fill the fields
		$rpassword1 = $response['registration']['password'];
		$validationkey = md5(microtime());

		$ruser['user_name'] = $rusername;
		$ruser['user_email'] = $ruseremail;
		$ruser['user_password'] = md5($rpassword1);
//		$ruser['user_country'] = $response['user']['country'];
		$ruser['user_lang'] = $ruserlang;
//		$ruser['user_location'] = $response['registration']['location']['name'];
		$ruser['user_timezone'] = $cfg['defaulttimezone'];
//		$ruser['user_gender'] = $response['registration']['gender'] == 'male' ? 'M' : 'F';
//		$ruser['user_birthdate'] = $bdate[2] . '-' . $bdate[0] . '-' . $bdate[1];
		$ruser['user_maingrp'] = ($cfg['plugin']['fbconnect']['autoactiv']) ? 4 : 2;
		$ruser['user_hideemail'] = 1;
		$ruser['user_pmnotify'] = 0;
		$ruser['user_theme'] = $cfg['defaulttheme'];
		$ruser['user_skin'] = $cfg['defaultskin'];
		$ruser['user_lang'] = $ruserlang;
		$ruser['user_regdate'] = (int)$sys['now_offset'];
		$ruser['user_logcount'] = 0;
		$ruser['user_lastip'] = $usr['ip'];
		$ruser['user_lostpass'] = $validationkey;
		
		$ruser['user_regtype'] = $ruserregtype;
		
		if($cfg['plugin']['fbconnect']['autoactiv']){
			if($ruser['user_regtype'] == 'employers'){
				$sql = sed_sql_query("SELECT grp_id FROM $db_groups WHERE grp_alias='".$ruser['user_regtype']."' LIMIT 1");
				$grp = sed_sql_fetcharray($sql);
				$ruser['user_maingrp'] = $grp['grp_id'];
			}
		}
		
		$ruser['user_fbid'] = $fb_user;

		sed_shield_update(20, 'Registration');

		sed_sql_insert($db_users, $ruser);

		$userid = sed_sql_insertid();
		$ruser['user_id'] = $userid;

		$sql = sed_sql_query("INSERT INTO $db_groups_users (gru_userid, gru_groupid) VALUES (".(int)$userid.", ".(int)$ruser['user_maingrp'].")");

		/* === Hook for the plugins === */
		$extp = sed_getextplugins('users.register.add.done');
		if (is_array($extp))
		{ foreach ($extp as $pl) { include_once($cfg['plugins_dir'].'/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
		/* ===== */

		if ($cfg['plugin']['fbconnect']['autoactiv'])
		{
			$rsubject = $cfg['maintitle']." - ".$L['Registration'];
			$rbody = sprintf($L['fbconnect_welcome'], $rusername, $rpassword1);
			$rbody .= "\n\n".$L['aut_contactadmin'];
			sed_mail($ruseremail, $rsubject, $rbody);
			fb_autologin($ruser);
			exit;
		}

		if ($cfg['regrequireadmin'])
		{
			$rsubject = $cfg['maintitle']." - ".$L['aut_regrequesttitle'];
			$rbody = sprintf($L['aut_regrequest'], $rusername, $rpassword1);
			$rbody .= "\n\n".$L['aut_contactadmin'];
			sed_mail($ruseremail, $rsubject, $rbody);

			$rsubject = $cfg['maintitle']." - ".$L['aut_regreqnoticetitle'];
			$rinactive = $cfg['mainurl'].'/'.sed_url('users', 'gm=2&s=regdate&w=desc', '', true);
			$rbody = sprintf($L['aut_regreqnotice'], $rusername, $rinactive);
			sed_mail ($cfg['adminemail'], $rsubject, $rbody);
			sed_redirect(sed_url('message', 'msg=118', '', true));
			exit;
		}
		else
		{
			$rsubject = $cfg['maintitle']." - ".$L['Registration'];
			$ractivate = $cfg['mainurl'].'/'.sed_url('users', 'm=register&a=validate&v='.$validationkey.'&y=1', '', true);
			$rdeactivate = $cfg['mainurl'].'/'.sed_url('users', 'm=register&a=validate&v='.$validationkey.'&y=0', '', true);
			$rbody = sprintf($L['aut_emailreg'], $rusername, $rpassword1, $ractivate, $rdeactivate);
			$rbody .= "\n\n".$L['aut_contactadmin'];
			sed_mail($ruseremail, $rsubject, $rbody);
			sed_redirect(sed_url('message', 'msg=105', '', true));
			exit;
		}
	}
	else
	{
		$t = new XTemplate(sed_skinfile('fbconnect.register', true));
		$t->assign(array(
			'FB_REGISTER_URL' => SED_ABSOLUTE_URL . sed_url('plug', 'e=fbconnect&m=register')
		));
	}
}

function parse_signed_request($signed_request, $secret)
{
	list($encoded_sig, $payload) = explode('.', $signed_request, 2);

	// decode the data
	$sig = base64_url_decode($encoded_sig);
	$data = json_decode(base64_url_decode($payload), true);

	if (strtoupper($data['algorithm']) !== 'HMAC-SHA256')
	{
		error_log('Unknown algorithm. Expected HMAC-SHA256');
		return null;
	}

	// check sig
	$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
	if ($sig !== $expected_sig)
	{
		error_log('Bad Signed JSON signature!');
		return null;
	}

	return $data;
}

function base64_url_decode($input)
{
	return base64_decode(strtr($input, '-_', '+/'));
}

?>
