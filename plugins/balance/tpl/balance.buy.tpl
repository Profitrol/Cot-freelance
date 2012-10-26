<!-- BEGIN: MAIN -->

<div id="sSide">
	{BALANCE_JS}
	<div class="mboxHD">{PHP.skinlang.balance.buy.title}</div>
	<div class="mboxBody">
		У вас на счету {BALANCE_SUMM} {PHP.skinlang.valuta}
		<br /><br />

		<!-- BEGIN: BUYPRO -->
		
		<!-- IF {PHP.balance.summ} > 0 -->
		
		{BALANCE_PRO_EXPIRE}
		<strong>{PHP.skinlang.balance.buy.pro}:</strong><br /><br />
		<p>{PHP.skinlang.balance.buy.protext}:</p>
		<form action="{BALANCE_BUY_PRO_ACTION_URL}" method="post">
			<ul class="proform">
				<li><input type="radio" value="1" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 1 месяц ({BALANCE_BUY_PRO_1M} {PHP.skinlang.valuta})</li>
				<li><input type="radio" value="3" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 3 месяца ({BALANCE_BUY_PRO_3M} {PHP.skinlang.valuta}, скидка 5%)</li>
				<li><input type="radio" value="6" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на полгода ({BALANCE_BUY_PRO_6M} {PHP.skinlang.valuta}, скидка 15%)</li>
				<li><input type="radio" value="12" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 1 год ({BALANCE_BUY_PRO_12M} {PHP.skinlang.valuta}, скидка 40%)</li>
			</ul>
			<p>Итого к оплате: <b id="result_amount" class="amount">0</b> {PHP.skinlang.valuta}</p>
			<input type="submit" name="submit" id="submitbuttontobuy" value="Оплатить" />
		</form>
		
		<!-- ELSE -->
		Пожалуйста, пополните личный счет. <a href="{BALANCE_BILL_URL}">Пополнить</a>
		<!-- ENDIF -->
		
		<!-- END: BUYPRO -->
		
		
		<!-- BEGIN: BUYTOP -->
		
		<!-- IF {PHP.balance.summ} > 0 -->
		
		{BALANCE_TOP_EXPIRE}
		<strong>Купить платное размещение на главной странице:</strong><br /><br />
		<p>Пожалуйста, выберите срок оплаты:</p>
		<form action="{BALANCE_BUY_TOP_ACTION_URL}" method="post">
			<ul class="proform">
				<li><input type="radio" value="1" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 1 месяц ({BALANCE_BUY_TOP_1M} {PHP.skinlang.valuta})</li>
				<li><input type="radio" value="3" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 3 месяца ({BALANCE_BUY_TOP_3M} {PHP.skinlang.valuta}, скидка 5%)</li>
				<li><input type="radio" value="6" name="month" OnClick="balance_calculate_result_amount(this.value)"/> на полгода ({BALANCE_BUY_TOP_6M} {PHP.skinlang.valuta}, скидка 15%)</li>
				<li><input type="radio" value="12" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 1 год ({BALANCE_BUY_TOP_12M} {PHP.skinlang.valuta}, скидка 40%)</li>
			</ul>
			<p>Итого к оплате: <b id="result_amount" class="amount">0</b> {PHP.skinlang.valuta}</p>
			<input type="submit" name="submit" id="submitbuttontobuy" value="Оплатить" />
		</form>
		
		<!-- ELSE -->
		Пожалуйста, пополните личный счет. <a href="{BALANCE_BILL_URL}">Пополнить</a>
		<!-- ENDIF -->
		
		<!-- END: BUYTOP -->
		
		<!-- BEGIN: BUYPROTOUSER -->
		
		<!-- IF {PHP.balance.summ} > 0 -->
		
		{BALANCE_PRO_EXPIRE}
		<strong>Купить PRO-аккаунт:</strong><br /><br />
		<p>Пожалуйста, укажите логин пользователя и срок оплаты:</p>
		<form action="{BALANCE_BUY_PRO_ACTION_URL}" method="post">
			Логин пользователя: <input type="text" name="touser" value="{PHP.touser}" size="10" />
			<ul class="proform">
				<li><input type="radio" value="1" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 1 месяц ({BALANCE_BUY_PRO_1M} {PHP.skinlang.valuta})</li>
				<li><input type="radio" value="3" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 3 месяца ({BALANCE_BUY_PRO_3M} {PHP.skinlang.valuta}, скидка 5%)</li>
				<li><input type="radio" value="6" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на полгода ({BALANCE_BUY_PRO_6M} {PHP.skinlang.valuta}, скидка 15%)</li>
				<li><input type="radio" value="12" name="month" OnClick="balance_calculate_result_amount(this.value)" /> на 1 год ({BALANCE_BUY_PRO_12M} {PHP.skinlang.valuta}, скидка 40%)</li>
			</ul>
			<p>Итого к оплате: <b id="result_amount" class="amount">0</b> {PHP.skinlang.valuta}</p>
			<input type="submit" name="submit" id="submitbuttontobuy" value="Оплатить" />
		</form>
		
		<!-- ELSE -->
		Пожалуйста, пополните личный счет. <a href="{BALANCE_BILL_URL}">Пополнить</a>
		<!-- ENDIF -->
		
		<!-- END: BUYPROTOUSER -->
		
		<!-- BEGIN: BUYTRANSFER -->
		
		<!-- IF {PHP.balance.summ} > 0 -->
		
		{BALANCE_PRO_EXPIRE}
		<strong>Перевод на счет другого пользователя:</strong><br /><br />
		<p>Пожалуйста, укажите логин пользователя и сумму для перевода:</p>
		<form action="{BALANCE_BUY_TRANSFER_ACTION_URL}" method="post">
			Логин пользователя: <input type="text" name="touser" value="{PHP.touser}" size="10" />
			Сумма: <input type="text" name="summ" value="{PHP.summ}" size="10" /> {PHP.skinlang.valuta}
			<input type="submit" name="submit" value="Оплатить" />
		</form>
		
		<!-- ELSE -->
		Пожалуйста, пополните личный счет. <a href="{BALANCE_BILL_URL}">Пополнить</a>
		<!-- ENDIF -->
		
		<!-- END: BUYTRANSFER -->
		
	</div>

</div>

<!-- END: MAIN -->