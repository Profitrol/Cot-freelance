<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="shop/">{PHP.skinlang.market.market}</a></div>
<div class="mboxBody">
	<div class="lSide">
		<div class="mboxHD">{PHP.skinlang.market.catalog}</div>
		<div id="cmenu">{CATALOG}</div>
	</div>
	<div class="rSide">
		
		<div style="float:right; font-size:14px; margin-bottom:-10px;">
			<noindex><a rel="nofollow" href="shop/add/" title="Добавить товар">{PHP.skinlang.market.add}</a></noindex>
		</div>
			
		<h1 class="mboxHD">{CATTITLE}</h1>
		
		<!-- BEGIN: SEARCH -->
		<div id="schform">
			<form action="{SEARCH_ACTION_URL}" method="get">
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
				<!-- IF {PRD_ROW_COST} > 0 --><div class="cost">{PRD_ROW_COST} {PHP.skinlang.valuta}</div><!-- ENDIF -->
				<div class="title"><a href="{PRD_ROW_URL}">{PRD_ROW_TITLE}</a></div>
				<div class="thumb"><a href="{PRD_ROW_URL}">{PRD_ROW_THUMB}</a></div>
			</div>
			<!-- END: PRD_ROWS -->
			<div class="paging">{PAGENAV_PAGES}</div>
		</div>
	</div>
</div>

<!-- END: MAIN -->