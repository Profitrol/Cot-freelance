<!-- BEGIN: MAIN -->

	<div class="mboxHD">Регистрация нового пользователя</div>
	<div class="mboxBody">

		<div id="subtitle">{USERS_REGISTER_SUBTITLE}</div>

		<!-- BEGIN: USERS_REGISTER_ERROR -->
		<div class="error">{USERS_REGISTER_ERROR_BODY}</div>
		<!-- END: USERS_REGISTER_ERROR -->

		<form name="login" action="{USERS_REGISTER_SEND}" method="post">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td>Тип аккаунта:</td>
					<td>{USERS_REGISTER_REGTYPE} *</td>
				</tr>
				<tr>
					<td style="width:200px;">Логин:</td>
					<td>{USERS_REGISTER_USER} *</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersregister.Validemail}:</td>
					<td>{USERS_REGISTER_EMAIL} *<br />
					{PHP.skinlang.usersregister.Validemailhint}</td>
				</tr>
				<tr>
					<td>{PHP.L.Password}:</td>
					<td>{USERS_REGISTER_PASSWORD} *</td>
				</tr>
				<tr>
					<td>{PHP.skinlang.usersregister.Confirmpassword}:</td>
					<td>{USERS_REGISTER_PASSWORDREPEAT} *</td>
				</tr>
				<tr>
					<td>{USERS_REGISTER_AGREEMENT_TITLE}:</td>
					<td>{USERS_REGISTER_AGREEMENT} <a href="agreement.html" target="_blank">Пользовательское соглашение</a></td>
				</tr>
				<tr>
                    <td>Введите защитный код <br />(без учета регистра):</td>
                    <td>{USERS_REGISTER_VERIFYIMG} {USERS_REGISTER_VERIFYINPUT}</td>
                </tr>
				<tr>
					<td colspan="2" class="valid"><input type="submit" value="{PHP.L.Submit}" /></td>
				</tr>
			</table>
		</form>

	</div>

<!-- END: MAIN -->
