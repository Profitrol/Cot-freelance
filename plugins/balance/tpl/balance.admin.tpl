<!-- BEGIN: MAIN -->


	<h2>{PHP.skinlang.balance.accounts}</h2>
	<p>
	<table class="cells">
		<tr class="coltop">
			<td width="30">ID</td>
			<td>{PHP.skinlang.balance.user}</td>
			<td width="100">{PHP.skinlang.balance.balance}</td>
		</tr>
		<!-- BEGIN: USR_ROW -->
		<tr>
			<td>{USR_ROW_ID}</td>
			<td>{USR_ROW_NAME}</td>
			<td>{USR_ROW_BALANCE} руб.</td>
		</tr>
		<!-- END: USR_ROW -->
	</table>
	
	<div class="paging">{USERS_PAGEPREV}{USERS_PAGNAV}{USERS_PAGENEXT}</div>
	</p>
	
	<form action="{FORM_ACTION_URL}" method="post">
		Введите логин пользователя: <input name="username" type="text" value="" /> Сумма к зачислению: <input name="summ" type="text" value="" /> <input name="submit" type="submit" value="Перечислить" />
	</form>
	
<div class="clear"></div>

<!-- END: MAIN -->
