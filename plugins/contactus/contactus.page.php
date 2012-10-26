<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/contactus/contactus.page.php
Version=102
Updated=2006-apr-24
Type=Plugin
Author=Neocrome
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=contactus
Part=page
File=contactus.page
Hooks=page.tags
Tags=page.tpl:{PLUGIN_CONTACTUS}
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once("plugins/contactus/lang/contactus.ru.lang.php");

if($cfg['plugin']['contactus']['pagealias'] == $pag['page_alias']){

	$a = sed_import('a','P','TXT');
	//$recipient = sed_import('recipient','P','INT');
	//$subject = sed_import('subject','P','INT');
	$message = sed_import('message','P','TXT');
	if (empty($message)) { $message = sed_import('message','G','TXT'); }
	$company = sed_import('company','P','TXT');
	$phone = sed_import('phone','P','TXT');
	$name = sed_import('name','P','STX');
	$email = sed_import('email','P','STX');
	$mailverify  = sed_import('mailverify','P','TXT');

	$plugin_title = $L['plu_title'];


	if ($a=="send") {

		if (empty($message) || empty($name) || empty($email))
			{ $error = $L['plu_empty']."<br />\n"; }

		if (!ereg("([[:alnum:]\.\-]+)(\@[[:alnum:]\.\-]+\.+)", $email))
			{ $error .= $L['plu_wrongemail']."<br />\n"; }

		require("inc/php-captcha.inc.php");

		if (!PhpCaptcha::Validate($mailverify))
			{
				$error .= $L['plu_wrongimg']."<br />\n";
			}

		if (empty($error))
			{

			sed_shield_protect();
			$cfgrecipients = $cfg['plugin']['contactus']['email'];
			$cfgsubjects = $cfg['plugin']['contactus']['subjects'];
			$rectr = $cfgrecipients;
			$subrt = $cfgsubjects;
		
			$headers = ("From: ".$name." <".$email.">\n"."Reply-To: <".$email.">\n"."Content-Type: text/plain; charset=".$cfg['charset']."\n");
			$body = $L['plu_notice']." ".$name."\n";
			$body .= $L['plu_message'].": \n\n".$message;
			sed_mail($rectr, $subrt, $body, $headers);
			$ok = $L['plu_ok'];
			unset($cfgrecipients, $cfgsubjects, $message, $name, $email);
			sed_shield_update(60, "New message");

			}

	}

	if (!empty($error)) { $plugin_body = "<div class=\"error\">".$error."</div>"; }
	if (!empty($ok)) { $plugin_body = "<div class=\"error\">".$ok."</div>"; }

	$plugin_body .= '<form action="'.sed_url('page', 'al='.$cfg['plugin']['contactus']['pagealias'], '', true).'" method="post">';
	//$inname = (empty($name)) ? $usr['name'] : sed_cc($name);
	//$inemail = (empty($email)) ? $usr['profile']['user_email'] : sed_cc($email);
	$plugin_body .= '
	<table width="100%" cellpadding="4">
	    <tr>
	    	<td width="130" class="2">Ваше имя <span class="red big">*</span></td>
	    	<td ><input type="text" name="name" value="'.$name.'" style="width:100%" maxlength="64" class="text" /></td>
	   </tr>
	    <tr>
	    	<td class="subtitle2">Ваш e-mail <span class="red big">*</span></td>
	    	<td><input type="text" name="email" value="'.$email.'" style="width:100%" maxlength="64" class="text" /></td>
	   </tr>
	    <tr>
	      <td class="subtitle2">Ваш текст <span class="red big">*</span></td>
	      <td><textarea class="text" style="width:100%; height:130px;" name="message">'.sed_cc($message).'</textarea></td>
	    </tr>
		<tr>
	      <td class="subtitle2">Защитный код <span class="red big">*</span></td>
		  <td><img align="absmiddle" src="plugins/contactus/inc/captcha.php" width="100" align="absmiddle" height="25" alt="CAPTCHA"> <input class="text" name="mailverify" type="text" id="mailverify" maxlength="6"></td>
	    </tr>
	    <tr>
	    	<td colspan=2 align="center">
		<input type="hidden" name="a" value="send" />
		<input class="submit" border="0" type="submit" value="Отправить" />
		</td>
	    </tr>
	</table>
	</form>
	';

	$t-> assign(array(
		"PLUGIN_CONTACTUS" => $plugin_body
	));

}

?>
