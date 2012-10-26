<!-- BEGIN: MAIN -->
<h1 class="mboxHD">Каталог проектов</h1>
<div class="mboxBody">	
	
	<!-- BEGIN: PTYPES -->
	<div id="tmenu">
		
		<ul class="tabs">
			<li class="first {PTYPE_ALL_ACT}"><a href="{PTYPE_ALL_URL}">Все</a></li>
		<!-- BEGIN: PTYPES_ROWS -->
			<li class="{PTYPE_ROW_ACT}"><a href="{PTYPE_ROW_URL}">{PTYPE_ROW_TITLE}</a></li>
		<!-- END: PTYPES_ROWS -->
		</ul>
	</div>	
	<!-- END: PTYPES -->
	
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
	
	<div id="listprojects">
		<!-- BEGIN: PRJ_ROWS -->
		<div class="prjitem">
			<!-- IF {PRJ_ROW_COST} > 0 --><div class="cost">{PRJ_ROW_COST} руб.</div><!-- ENDIF -->
			<div class="title"><a href="{PRJ_ROW_URL}" target="blank">{PRJ_ROW_TITLE}</a></div>
			<div class="owner">{PRJ_ROW_OWNER} <span class="date">[{PRJ_ROW_DATE}]</span> &nbsp; {PRJ_ROW_REGION} {PRJ_ROW_LOCATION} &nbsp; <a href="{PRJ_ROW_EDIT_URL}" target="blank">Редактировать</a></div>
			<div class="text">{PRJ_ROW_SHORTTEXT}</div>
			<div class="offers"><a href="{PRJ_ROW_OFFERS_ADDOFFER_URL}">Оставить предложение</a> ({PRJ_ROW_OFFERS_COUNT})</div>
			<div class="type">{PRJ_ROW_TYPE} / {PRJ_ROW_CATTITLE}</div>
		</div>
		<!-- END: PRJ_ROWS -->
		<div class="paging">{PAGENAV_PAGES}</div>
	</div>
</div>

<!-- END: MAIN -->