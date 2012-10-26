<!-- BEGIN: MAIN -->

<h1 class="mboxHD">Магазин</h1>
<div class="mboxBody" id="ucontent">

	<!-- BEGIN: SEARCH -->
	<div id="schform">
		<form action="{SEARCH_ACTION_URL}" method="get">
			<input type="hidden" name="m" value="{PHP.m}" />
			<input type="hidden" name="p" value="{PHP.p}" />
			<input type="hidden" name="c" value="{PHP.c}" />
			<input type="hidden" name="type" value="{PHP.type}" />
			<table width="100%" cellpadding="5" cellspacing="0">
				<tr>
					<td align="right">{PHP.skinlang.search}:</td>
					<td>{SEARCH_SQ}</td>
					<td align="right"><input type="submit" name="search" value="{PHP.skinlang.search}" /></td>
				</tr>
				<tr>
					<td align="right" width="100">{PHP.skinlang.loc}:</td>
					<td>
						{SEARCH_COUNTRY}
						<span id="region">{SEARCH_REGION}</span>
						<span id="city">{SEARCH_CITY}</span>
					</td>
					<td></td>
				</tr>
			</table>		
		</form>
	</div>
	<!-- END: SEARCH -->
	
	<div id="listmarket">
		<!-- BEGIN: PRD_ROWS -->
		<div class="item">
			<div class="title"><a href="{PRD_ROW_URL}" target="blank">{PRD_ROW_TITLE}</a></div>
			<div class="thumb"><a href="{PRD_ROW_URL}" target="blank">{PRD_ROW_THUMB}</a></div>
			<!-- IF {PRD_ROW_COST} > 0 --><div class="cost">{PRD_ROW_COST} руб.</div><!-- ENDIF -->
		</div>
		<!-- END: PRD_ROWS -->
		<div class="paging">{PAGENAV_PAGES}</div>
	</div>
	<div style="clear:both;">&nbsp;</div>
</div>

<!-- END: MAIN -->