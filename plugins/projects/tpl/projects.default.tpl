<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="projects/">{PHP.skinlang.projects.projects}</a></div>
<h1 class="mboxHD">{PHP.skinlang.projects.projects} <!-- IF {CATTITLE} -->/ {CATTITLE}<!-- ENDIF --></h1>
<div class="mboxBody">
	<div class="lSide">
		<div id="cmenu">{CATALOG}</div>		
	</div>
	<div class="rSide">
				
		<!-- BEGIN: PTYPES -->
		<div id="tmenu">
		
			<div style="float:right; font-size:14px; margin-top:5px;">
				<noindex><a rel="nofollow" href="projects/add/" title="{PHP.skinlang.projects.add}">{PHP.skinlang.projects.add}</a></noindex>
			</div>
			
			<ul class="tabs">
				<li class="first {PTYPE_ALL_ACT}"><a href="{PTYPE_ALL_URL}">{PHP.skinlang.all}</a></li>
			<!-- BEGIN: PTYPES_ROWS -->
				<li class="{PTYPE_ROW_ACT} <!-- IF {PTYPE_ROW_ID} == 2 -->greentab<!-- ENDIF -->"><a href="{PTYPE_ROW_URL}">{PTYPE_ROW_TITLE}</a></li>
			<!-- END: PTYPES_ROWS -->
			</ul>
		</div>	
		<!-- END: PTYPES -->
		
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
		
		<!-- BEGIN: OFFERSLEFT -->
			<div id="offersleft">{COUNTUSEROFFERSLEFT}</div>
		<!-- END: OFFERSLEFT -->
		
		<!-- BEGIN: PRJLEFT -->
			<div id="prjleft">{COUNTUSERPRJLEFT}</div>
		<!-- END: PRJLEFT -->
		
		<div id="listprojects">
			<!-- BEGIN: PRJ_ROWS -->
			<div class="prjitem {PRJ_ROW_ISTOP}">
				<!-- IF {PRJ_ROW_COST} > 0 --><div class="cost">{PRJ_ROW_COST} {PHP.skinlang.valuta}</div><!-- ENDIF -->
				<div class="title"><a href="{PRJ_ROW_URL}">{PRJ_ROW_TITLE}</a></div>
				<div class="owner">{PRJ_ROW_OWNER} <span class="date">[{PRJ_ROW_DATE}]</span> &nbsp;{PRJ_ROW_COUNTRY} {PRJ_ROW_REGION} {PRJ_ROW_CITY} &nbsp; {PRJ_ROW_EDIT_URL}</div>
				<div class="text">{PRJ_ROW_SHORTTEXT}</div>
				<div class="offers"><a href="{PRJ_ROW_OFFERS_ADDOFFER_URL}">{PHP.skinlang.projects.add_offer}</a> ({PRJ_ROW_OFFERS_COUNT})</div>
				<div class="type"><!-- IF {PHP.item.item_type} == 2 --><span class="pro">{PRJ_ROW_TYPE}</span><!-- ELSE -->{PRJ_ROW_TYPE}<!-- ENDIF --> / <a href="{PRJ_ROW_CATURL}">{PRJ_ROW_CATTITLE}</a></div>
			</div>
			<!-- END: PRJ_ROWS -->
			<div class="paging">{PAGENAV_PAGES}</div>
		</div>
		
		<!-- IF {CATTEXT} -->
			<div class="cattext">
				{CATTEXT}
			</div>
		<!-- ENDIF -->
		
	</div>
</div>

<!-- END: MAIN -->