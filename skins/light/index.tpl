<!-- BEGIN: MAIN -->

<!-- BEGIN: TOPUSERS -->
<div id="topusers">	
	<ul>
		<!-- BEGIN: TUR_ROWS -->
		<li>
			<div class="ava"><a href="{TUR_ROW_URL}">{TUR_ROW_AVATAR}</a></div>
			<div class="info">
				<div class="name">{TUR_ROW_NAME}</div>
				<div class="cat"><a href="{TUR_ROW_URL}">{TUR_ROW_STATUS}</a></div>
			</div>	
		</li>
		<!-- END: TUR_ROWS -->
		<li>	
			<div class="ava"><img src="datas/defaultav/blank.png" alt="" /></div>
			<div class="info">
				<div class="name"><noindex><a rel="nofollow" href="balance/">{PHP.skinlang.index.free_place}</a></noindex></div>
				<div class="cat">{PHP.skinlang.index.place_for_ads}</div>
			</div>	
		</li>
		<li>
			<div class="ava"><img src="datas/defaultav/blank.png" alt="" /></div>
			<div class="info">
				<div class="name"><noindex><a rel="nofollow" href="balance/">{PHP.skinlang.index.free_place}</a></noindex></div>
				<div class="cat">{PHP.skinlang.index.place_for_ads}</div>
			</div>	
		</li>
		<li>
			<div class="ava"><img src="datas/defaultav/blank.png" alt="" /></div>
			<div class="info">
				<div class="name"><noindex><a rel="nofollow" href="balance/">{PHP.skinlang.index.free_place}</a></noindex></div>
				<div class="cat">{PHP.skinlang.index.place_for_ads}</div>
			</div>	
		</li>
		<li>
			<div class="ava"><img src="datas/defaultav/blank.png" alt="" /></div>
			<div class="info">
				<div class="name"><noindex><a rel="nofollow" href="balance/">{PHP.skinlang.index.free_place}</a></noindex></div>
				<div class="cat">{PHP.skinlang.index.place_for_ads}</div>
			</div>	
		</li>
	</ul>
</div>	
<!-- END: TOPUSERS -->

<div class="lSide">
	
	<div class="mboxHD">{PHP.skinlang.index.catalog_freelancers}</div>
	<div id="cmenu">
		{FREELANCERS_CATALOG}
	</div>
	<div class="mboxHD">{PHP.skinlang.index.catalog_projects}</div>
	<div id="cmenu">
		{PROJECTS_CATALOG}
	</div>
	
	<!-- BEGIN: NEWBLOG -->
	<div class="mboxHD">{PHP.skinlang.index.new_in_blogs}</div>
		<!-- BEGIN: BLOG_ROW -->
		<div class="postitem">
			<div class="ava">{BLOG_ROW_AVATAR}</div>
			<div class="postcontent">
				<div class="owner">{BLOG_ROW_OWNER} <span class="date">[{BLOG_ROW_DATE}]   {BLOG_ROW_EDIT_URL}</span></div>
				<div class="posttitle"><a href="{BLOG_ROW_SHOW_URL}">{BLOG_ROW_TITLE}</a></div>
			</div>
		</div>
		<!-- END: BLOG_ROW -->
	<!-- END: NEWBLOG -->
</div>
<div class="rSide">
	<!-- BEGIN: PROJECTS -->
	
	<!-- BEGIN: PTYPES -->
	<div id="tmenu">
		
		<div style="float:right; font-size:14px; margin-top:5px;">
			<noindex><a rel="nofollow" href="projects/add/" title="{PHP.skinlang.projects.add}">{PHP.skinlang.projects.add}</a></noindex>
		</div>
		
		<ul class="tabs">
			<li class="first act"><a href="{PTYPE_ALL_URL}">{PHP.skinlang.all}</a></li>
		<!-- BEGIN: PTYPES_ROWS -->
			<li><a href="{PTYPE_ROW_URL}">{PTYPE_ROW_TITLE}</a></li>
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
			<div class="owner">{PRJ_ROW_OWNER} <span class="date">[{PRJ_ROW_DATE}]</span>   {PRJ_ROW_COUNTRY} {PRJ_ROW_REGION} {PRJ_ROW_CITY}   {PRJ_ROW_EDIT_URL}</div>
			<div class="text">{PRJ_ROW_SHORTTEXT}</div>
			<div class="offers"><a href="{PRJ_ROW_OFFERS_ADDOFFER_URL}">{PHP.skinlang.projects.add_offer}</a> ({PRJ_ROW_OFFERS_COUNT})</div>
			<div class="type"><!-- IF {PHP.item.item_type} == 2 --><span class="pro">{PRJ_ROW_TYPE}</span><!-- ELSE -->{PRJ_ROW_TYPE}<!-- ENDIF --> / <a href="{PRJ_ROW_CATURL}">{PRJ_ROW_CATTITLE}</a></div>
		</div>
	<!-- END: PRJ_ROWS -->
	</div>
	<div class="paging"><a href="projects/">{PHP.skinlang.projects.view_all}</a></div>
	<!-- END: PROJECTS -->
</div>

<!-- END: MAIN -->