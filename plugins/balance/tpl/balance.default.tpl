<!-- BEGIN: MAIN -->

<div id="sSide">
	<div class="mboxHD">Мой счет</div>
	<div class="mboxBody">
		<div id="balance">
			<div class="ubalance">На счету <span class="summ">{BALANCE_SUMM}</span> руб.</div>
			<br /><a href="{BALANCE_BILL_URL}">Пополнить счет</a>
		</div>
		<div id="umenu">
			<ul class="tabs">
				<!-- IF {PHP.tab} == '' -->
				<li class="first act"><a>Услуги</a></li>
				<!-- ELSE -->
				<li class="first"><a href="{BALANCE_URL}">Услуги</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.tab} == 'history' -->
				<li class="act"><a>История счета</a></li>
				<!-- ELSE -->
				<li><a href="{BALANCE_HISTORY_URL}">История счета</a></li>
				<!-- ENDIF -->
			</ul>
		</div>
		<div id="ubuy">
			
			<!-- BEGIN: USLUGI -->
		
			<div class="mboxHD">Оплатить услуги</div>
			<!-- BEGIN: FREELANCERS -->
			<ul>
				<li>
					<div class="title"><a href="{BUY_PRO_URL}">PRO-аккаунт</a> <img src="images/pro.png" align="absmiddle" /></div>
					<!-- IF {BALANCE_PRO_EXPIRE} -->(Действует до {BALANCE_PRO_EXPIRE})<!-- ENDIF -->
					<div class="descr">Воспользуйтесь всеми возможностями нашего сервиса для более эффективного продвижения ваших услуг.</div>
					<div class="cost">{PHP.cfg.plugin.balance.cost_pro} руб. в месяц</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_TOP_URL}">Платное размещение на главной</a></div>
					<!-- IF {BALANCE_TOP_EXPIRE} -->(Действует до {BALANCE_TOP_EXPIRE})<!-- ENDIF -->
					<div class="descr">Хотите чтобы вас заметили? Тогда эта услуга именно для вас.</div>
					<div class="cost">{PHP.cfg.plugin.balance.cost_top} руб. в месяц</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_PRJTOP_URL}">Закрепить проект</a></div>
					<div class="descr">Сделайте ваш проект более заметным.</div>
					<div class="cost">{PHP.cfg.plugin.balance.cost_prjtop} руб. в день</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_TRANSFER_URL}">Перевод на счет пользователя</a></div>
					<div class="descr">Вы можете совершить перевод на счет другого пользователя</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_PROTOUSER_URL}">Подарить PRO-аккаунт</a></div>
					<div class="descr">Сделайте подарок своему коллеге</div>
				</li>
			</ul>
			<!-- END: FREELANCERS -->
			
			<!-- BEGIN: EMPLOYERS -->
			<ul>
				<li>
					<div class="title"><a href="{BUY_PRO_URL}">PRO-аккаунт</a> <img src="images/pro.png" align="absmiddle" /></div>
					<!-- IF {BALANCE_PRO_EXPIRE} -->(Действует до {BALANCE_PRO_EXPIRE})<!-- ENDIF -->
					<div class="descr">Воспользуйтесь всеми возможностями нашего сервиса для более эффективного продвижения ваших услуг.</div>
					<div class="cost">{PHP.cfg.plugin.balance.cost_pro} руб. в месяц</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_TOP_URL}">Платное размещение на главной</a></div>
					<!-- IF {BALANCE_TOP_EXPIRE} -->(Действует до {BALANCE_TOP_EXPIRE})<!-- ENDIF -->
					<div class="descr">Хотите чтобы вас заметили? Тогда эта услуга именно для вас.</div>
					<div class="cost">{PHP.cfg.plugin.balance.cost_top} руб. в месяц</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_PRJTOP_URL}">Закрепить проект</a></div>
					<div class="descr">Сделайте ваш проект более заметным.</div>
					<div class="cost">{PHP.cfg.plugin.balance.cost_prjtop} руб. в день</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_TRANSFER_URL}">Перевод на счет пользователя</a></div>
					<div class="descr">Вы можете совершить перевод на счет другого пользователя</div>
				</li>
				<li>
					<div class="title"><a href="{BUY_PROTOUSER_URL}">Подарить PRO-аккаунт</a></div>
					<div class="descr">Сделайте подарок своему коллеге</div>
				</li>
			</ul>
			<!-- END: EMPLOYERS -->
			
			<!-- END: USLUGI -->
			
			
			<!-- BEGIN: HISTORY -->
		
			<div class="mboxHD">История счета</div>
			
			<table class="cells">
				<tr class="coltop">
					<td width="120">Дата</td>
					<td width="100">Сумма</td>
					<td>Описание</td>
				</tr>
				<!-- BEGIN: HIST_ROWS -->
				<tr>
					<td>{HIST_DATE}</td>
					<td>{HIST_SUMM}</td>
					<td>{HIST_DESC} {HIST_TOUSER}{HIST_FROMUSER}{HIST_ITEMID}</td>
				</tr>
				<!-- END: HIST_ROWS -->
			</table>
			
			<!-- END: HISTORY -->
			
		</div>
	</div>
</div>

<!-- END: MAIN -->	