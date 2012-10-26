<!-- BEGIN: PROF -->

	<div class="mboxHD">{PHP.skinlang.usersprofile.title}</div>
	<div class="mboxBody">

		<!-- BEGIN: USERS_PROFILE_ERROR -->
		<div class="error">{USERS_PROFILE_ERROR_BODY}</div>
		<!-- END: USERS_PROFILE_ERROR -->

		<form action="{USERS_PROFILE_FORM_SEND}" method="post" enctype="multipart/form-data" name="profile">
			<input type="hidden" name="userid" value="{USERS_PROFILE_ID}" />
			<div class="tCap2"></div>
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td width="180" align="right">{PHP.skinlang.usersprofile.fname}:</td>
					<td>{USERS_PROFILE_FNAME}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.usersprofile.sname}:</td>
					<td>{USERS_PROFILE_SNAME}</td>
				</tr>
				<tr>
					<td class="top" align="right" width="150">{PHP.skinlang.usersprofile.status}:</td>
					<td>{USERS_PROFILE_STATUS}</td>
				</tr>
				<tr>
					<td align="right" class="top">{PHP.skinlang.usersprofile.about}:</td>
					<td>{USERS_PROFILE_ABOUT}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.usersprofile.region}:</td>
					<td>{USERS_PROFILE_COUNTRY} <span id="region">{USERS_PROFILE_REGION}</span> <span id="city">{USERS_PROFILE_CITY}</span></td>
				</tr>
				<tr style="display: none;">
					<td align="right">{PHP.L.Timezone}:</td>
					<td>{USERS_PROFILE_TIMEZONE}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.usersprofile.phone}:</td>
					<td>{USERS_PROFILE_PHONE}</td>
				</tr>
				<tr>
					<td align="right">{PHP.L.Website}:</td>
					<td>{USERS_PROFILE_WEBSITE}</td>
				</tr>
				<tr>
					<td align="right">Skype:</td>
					<td>{USERS_PROFILE_SKYPE}</td>
				</tr>
				<tr>
					<td align="right">{PHP.L.ICQ}:</td>
					<td>{USERS_PROFILE_ICQ}</td>
				</tr>
				<tr>
					<td align="right">{PHP.L.Birthdate}:</td>
					<td>{USERS_PROFILE_BIRTHDATE}
					</td>
				</tr>
				<tr>
					<td align="right" class="top">{PHP.L.Avatar}:</td>
					<td>{USERS_PROFILE_AVATAR}</td>
				</tr>
				<tr style="display: none;">
					<td align="right">{PHP.L.Registered}:</td>
					<td>{USERS_PROFILE_REGDATE}</td>
				</tr>
				<!-- BEGIN: USERS_PROFILE_EMAILCHANGE -->
				<tr>
					<td align="right" class="top">{PHP.L.Email}:</td>
					<td id="emailtd">
					<div style="width:300px;float:left">{USERS_PROFILE_EMAIL}</div>
					<!-- BEGIN: USERS_PROFILE_EMAILPROTECTION -->
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

$("#emailnotes").hide();
$("#emailtd").click(function(){$("#emailnotes").slideDown();});

});
//]]>
</script>
					<div>
					</div>
					<br />
					 <div class="small" id="emailnotes">{PHP.skinlang.usersprofile.Emailnotes}</div>
					<!-- END: USERS_PROFILE_EMAILPROTECTION -->
					</td>
				</tr>
				<!-- END: USERS_PROFILE_EMAILCHANGE -->
				
				<!-- BEGIN: ADMIN_USERS_PROFILE_EMAILCHANGE -->
				<tr>
					<td align="right">{PHP.L.Email}:</td>
					<td>
						{USERS_PROFILE_EMAIL}
					</td>
				</tr>
				<!-- END: ADMIN_USERS_PROFILE_EMAILCHANGE -->
				<tr style="display: none;">
					<td align="right">{PHP.skinlang.usersprofile.Hidetheemail}:</td>
					<td>{USERS_PROFILE_HIDEEMAIL}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.usersprofile.PMnotify}:</td>
					<td>{USERS_PROFILE_PMNOTIFY}<br />{PHP.skinlang.usersprofile.PMnotifyhint}</td>
				</tr>
				<tr style="display:none;">
					<td align="right">{PHP.L.Skin}:</td>
					<td>{USERS_PROFILE_SKIN}{USERS_PROFILE_THEME}</td>
				</tr>
				<tr style="display:none;">
					<td align="right">{PHP.L.Language}:</td>
					<td>{USERS_PROFILE_LANG}</td>
				</tr>
				<tr>
					<td align="right">{PHP.L.Gender}:</td>
					<td>{USERS_PROFILE_GENDER}</td>
				</tr>
				<!-- BEGIN: USERS_PROFILE_PASSCHANGE -->
				<tr>
					<td align="right" class="top">{PHP.skinlang.usersprofile.Newpassword}:</td>
					<td>
						{USERS_PROFILE_OLDPASS}	<small>{PHP.skinlang.usersprofile.Newpasswordhint1}</small><br />
						{USERS_PROFILE_NEWPASS1} <small>{PHP.skinlang.usersprofile.Newpasswordhint2}</small><br />
						{USERS_PROFILE_NEWPASS2} <small>{PHP.skinlang.usersprofile.Newpasswordhint3}</small><br />
					</td>
				</tr>
				<!-- END: USERS_PROFILE_PASSCHANGE -->
				<!-- BEGIN: ADMIN_USERS_PROFILE_PASSCHANGE -->
				<tr>
					<td align="right">{PHP.skinlang.usersprofile.password}:</td>
					<td>{ADMIN_USERSEDIT_NEWPASS}</td>
				</tr>
				<!-- END: ADMIN_USERS_PROFILE_PASSCHANGE -->
				<!-- BEGIN: ADMIN_USERS_PROFILE_DEL -->
				<tr>
					<td align="right" class="top">{PHP.L.Groupsmembership}:</td>
					<td>{ADMIN_USERSEDIT_GROUPS}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.usersprofile.delete}:</td>
					<td>{ADMIN_USERSEDIT_DELETE}</td>
				</tr>
				<!-- END: ADMIN_USERS_PROFILE_DEL -->
				<tr>
					<td></td>
					<td>
					<input type="submit" value="{PHP.skinlang.usersprofile.save}" />
					</td>
				</tr>
			</table>
			<div class="bCap"></div>
		</form>
	</div>
	
<!-- END: PROF -->