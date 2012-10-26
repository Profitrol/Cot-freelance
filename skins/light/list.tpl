<!-- BEGIN: MAIN -->

<div id="bread">
	<div class="rss-icon-title">
	<a href="{LIST_CAT_RSS}"><img src="skins/{PHP.skin}/img/rss-icon.png" border="0" alt="" /></a>
	</div>
	{LIST_PAGETITLE}
</div>
<div class="mboxHD">{LIST_SHORTTITLE}</div>
<div class="mboxBody">

<div id="subtitle">{LIST_CATDESC} &nbsp; &nbsp; {LIST_SUBMITNEWPAGE}</div>

<div id="pages">
	<!-- BEGIN: LIST_ROW -->
	<div class="pageitem">
		<div class="title"><a href="{LIST_ROW_URL}">{LIST_ROW_TITLE}</a></div>
		<div class="text">{LIST_ROW_SHORTTEXT}</div>
	</div>
	<!-- END: LIST_ROW -->
</div>

<div class="paging">{LIST_TOP_PAGEPREV}{LIST_TOP_PAGINATION}{LIST_TOP_PAGENEXT}</div>

</div>

<!-- END: MAIN -->