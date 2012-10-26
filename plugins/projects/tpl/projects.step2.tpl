<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="projects/">{PHP.skinlang.projects.projects}</a></div>
<div class="mboxBody">
	<div class="sSide">
		{PHP.jscode}
		<h1 class="tboxHD">{PHP.skinlang.projects.step2.title}</h1>
		<div class="lSide">
			<form action="{PRJ_BUY_ACTION_URL}" method="post" >
				<!-- IF {PHP.cfg.plugin.balance.cost_prjtop} <= {PHP.balance.summ} -->
				<input type="checkbox" name="prjtop" id="prjtop_checkbox" onClick="prjtop_checked();" value="1" /> 
				<!-- ENDIF -->
				<strong>{PHP.skinlang.projects.step2.selectproject}</strong> <br />
				<div id="prjedit_buy">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; на <input type="text" size="2" name="days" value="1" onChange="prjtop_calculate_result_amount(this.value);" /> {PHP.skinlang.projects.step2.days} = <span id="result_amount">{PHP.cfg.plugin.balance.cost_prjtop}</span> {PHP.skinlang.valuta}
					<br/>
					<div id="warning"></div>
					<div id="prjedit_button"><input type="submit" name="buy" value="{PHP.skinlang.projects.step2.buy}" /></div>
				</div>
			</form>
			<!-- IF {PHP.balance.summ} < {PHP.cfg.plugin.balance.cost_prjtop} -->
			<p>{PHP.skinlang.projects.step2.nomoney}</p>
			<!-- ENDIF -->
		</div>
		<div class="rSide">
			<div class="mboxHD">{PRJ_TITLE}</div>
			<div class="prjshow">
				<div class="content1">
					<!-- IF {PRJ_COST} > 0 --><div class="cost">{PRJ_COST} руб.</div><!-- ENDIF -->
					<div class="owner"><span class="date">[{PRJ_DATE}] &nbsp; {PRJ_TYPE} &nbsp; {PRJ_ADMIN_EDIT}</span></div>
					<div class="location">{PRJ_REGION} {PRJ_LOCATION}</div>
					<div class="title"></div>
					<div class="text">{PRJ_TEXT}</div>
				</div>
			</div>
			<a href="{PRJ_SAVE_URL}"><span>{PHP.skinlang.projects.step2.save}</span></a>&nbsp;&nbsp;&nbsp; <a href="{PRJ_EDIT_URL}"><span>{PHP.skinlang.projects.step2.edit}</span></a>
		</div>
	</div>
</div>

<!-- END: MAIN -->