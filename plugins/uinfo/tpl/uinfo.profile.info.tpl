<!-- BEGIN: PROF -->

	<div class="mboxHD">Редактирование данных</div>
	<div class="mboxBody">

		<!-- BEGIN: USERS_PROFILE_ERROR -->
		<div class="error">{USERS_PROFILE_ERROR_BODY}</div>
		<!-- END: USERS_PROFILE_ERROR -->

		<form action="{USERS_PROFILE_FORM_SEND}" method="post" enctype="multipart/form-data" name="profile">
			<input type="hidden" name="userid" value="{USERS_PROFILE_ID}" />
			<div class="tCap2"></div>
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td>{PHP.skinlang.usersprofile.fname}:</td>
					<td>{USERS_PROFILE_FNAME}</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersprofile.sname}:</td>
					<td>{USERS_PROFILE_SNAME}</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersprofile.status}:</td>
					<td>{USERS_PROFILE_STATUS}</td>
				</tr>
				<tr>
					<td width="150">{PHP.skinlang.usersprofile.fcat}:</td>
					<td>{USERS_PROFILE_CAT}</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersprofile.about}:</td>
					<td>{USERS_PROFILE_ABOUT}</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersprofile.experience}:</td>
					<td>{USERS_PROFILE_EXPERIENCE}</td>
				</tr>
				<tr style="display:none;">
					<td>{PHP.L.Country}:</td>
					<td>{USERS_PROFILE_COUNTRY}</td>
				</tr>
				<tr>
					<td>{PHP.L.Region}:</td>
					<td>{USERS_PROFILE_COUNTRY} <span id="region">{USERS_PROFILE_REGION}</span> <span id="city">{USERS_PROFILE_CITY}</span></td>
				</tr>
				<tr>
					<td>{PHP.L.Timezone}:</td>
					<td>{USERS_PROFILE_TIMEZONE}</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersprofile.phone}:</td>
					<td>{USERS_PROFILE_PHONE}</td>
				</tr>
				<tr>
					<td>{PHP.L.Website}:</td>
					<td>{USERS_PROFILE_WEBSITE}</td>
				</tr>
				<tr>
					<td>Skype:</td>
					<td>{USERS_PROFILE_SKYPE}</td>
				</tr>
				<tr>
					<td>{PHP.L.ICQ}:</td>
					<td>{USERS_PROFILE_ICQ}</td>
				</tr>
				<tr>
					<td>{PHP.L.Birthdate}:</td>
					<td>{USERS_PROFILE_BIRTHDATE}
					</td>
				</tr>
				<tr>
					<td>{PHP.L.Avatar}:</td>
					<td>{USERS_PROFILE_AVATAR}</td>
				</tr>
				<tr>
					<td>{PHP.L.Registered}:</td>
					<td>{USERS_PROFILE_REGDATE}</td>
				</tr>
				<!-- BEGIN: USERS_PROFILE_EMAILCHANGE -->
				<tr>
					<td>{PHP.L.Email}:</td>
					<td id="emailtd">
					<div style="width:350px;float:left">{PHP.L.Email}:
					<br />{USERS_PROFILE_EMAIL}</div>
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
					{PHP.skinlang.usersprofile.Emailpassword}:
					<br />{USERS_PROFILE_EMAILPASS}
					</div>
					<br />
					 <div class="small" id="emailnotes">{PHP.skinlang.usersprofile.Emailnotes}</div>
					<!-- END: USERS_PROFILE_EMAILPROTECTION -->
					</td>
				</tr>
				<!-- END: USERS_PROFILE_EMAILCHANGE -->
				<tr>
					<td>{PHP.skinlang.usersprofile.Hidetheemail}:</td>
					<td>{USERS_PROFILE_HIDEEMAIL}</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersprofile.PMnotify}:</td>
					<td>{USERS_PROFILE_PMNOTIFY}<br />{PHP.skinlang.usersprofile.PMnotifyhint}</td>
				</tr>
				<tr style="display:none;">
					<td>{PHP.L.Skin}:</td>
					<td>{USERS_PROFILE_SKIN}{USERS_PROFILE_THEME}</td>
				</tr>
				<tr style="display:none;">
					<td>{PHP.L.Language}:</td>
					<td>{USERS_PROFILE_LANG}</td>
				</tr>
				<tr>
					<td>{PHP.L.Gender}:</td>
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
					<td colspan="2" class="valid">
					<input type="submit" value="{PHP.L.Update}" />
					</td>
				</tr>
			</table>
			<div class="bCap"></div>
		</form>
	</div>
	
<!-- END: PROF -->