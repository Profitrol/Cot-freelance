<!-- BEGIN: MAIN -->

<div id="bread">
	<div class="rss-icon-title">
	<a href="{LIST_CAT_RSS}"><img src="skins/{PHP.skin}/img/rss-icon.png" border="0" alt="" /></a>
	</div>
	{LIST_PAGETITLE}
</div>
<h1>{LIST_CATTITLE}</h1>
<div class="mboxBody">

<div id="subtitle">{LIST_SUBMITNEWPAGE}</div>

<div id="artcats">
	<ul>
	<!-- BEGIN: LIST_ROWCAT -->
		<li>	
			<div class="title"><a href="{LIST_ROWCAT_URL}">{LIST_ROWCAT_TITLE}</a></div>
			<!-- IF {LIST_ROWCAT_DESC} -->
			<div class="descr">{LIST_ROWCAT_DESC}</div>
			<!-- ENDIF -->
		</li>
	<!-- END: LIST_ROWCAT -->
	</ul>
</div>

<ul>
	<!-- BEGIN: LIST_ROW -->
	<li>
		<div class="title"><a href="{LIST_ROW_URL}">{LIST_ROW_TITLE}</a></div>
	</li>
	<!-- END: LIST_ROW -->
</ul>

<div class="paging">{LIST_TOP_PAGEPREV}{LIST_TOP_PAGINATION}{LIST_TOP_PAGENEXT}</div>

</div>

<!-- END: MAIN -->