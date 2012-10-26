<!-- BEGIN: MAIN -->

<div id="sSide">

	<!-- BEGIN: ERROR -->
	<div class="mboxHD">{ROBOX_TITLE}</div>
	<div class="mboxBody">{ROBOX_ERROR}</div>
	<!-- END: ERROR -->
	
	<!-- BEGIN: BILLFORM -->
	<div class="mboxHD">{PHP.skinlang.balance.bill}</div>
	<div class="mboxBody">
		{PHP.skinlang.balance.billtext1}:<br />
		<form action="{BILL_FORM_ACTION_URL}" method="post">
			<input type="text" name="summ" value="" size="10" /> {PHP.skinlang.valuta}
			<input type="submit" name="submit" value="{PHP.skinlang.balance.popolnit} >>" />
		</form>
	</div>
	<!-- END: BILLFORM -->
	
	<!-- BEGIN: ROBOXSEND -->
	<div class="mboxHD">{PHP.skinlang.balance.bill}</div>
	<div class="mboxBody">
		<strong>{PHP.skinlang.balance.billdesc}:</strong> {ROBOX_DESC}<br />
		<strong>{PHP.skinlang.balance.billsumm}:</strong> {ROBOX_SUMM} {ROBOX_CURR}<br /><br />
		{ROBOX_FORM}
		<br /><br /><img src="images/robokassa.jpg" alt="" /><br />{PHP.skinlang.balance.roboxtext}<br /><br />
	</div>
	<!-- END: ROBOXSEND -->
</div>

<!-- END: MAIN -->