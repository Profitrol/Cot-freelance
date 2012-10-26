<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="blogs">{PHP.skinlang.blogs.blogs}</a></div>
<h1 class="mboxHD">
<!-- IF {PHP.usr.id} > 0 -->
	<div style="float:right; font-size:14px;">
		<a href="blogs/?m=add">{PHP.skinlang.blogs.add}</a>
	</div>
<!-- ENDIF -->
	{PHP.skinlang.blogs.blogs} {CATTITLE}
</h1>

<div class="mboxBody">
	<div class="lSide">
		<div id="blogscat">{CATALOG}</div>
	</div>
	<div class="rSide">
	
		<!-- BEGIN: LIST_ROW -->
		<div class="postitem">
			<div class="ava">{LIST_ROW_AVATAR}</div>
			<div class="postcontent">
				<div class="owner">{LIST_ROW_OWNER} <span class="date">[{LIST_ROW_DATE}] &nbsp; {LIST_ROW_EDIT_URL}</span></div>
				<div class="posttitle"><a href="{LIST_ROW_SHOW_URL}">{LIST_ROW_TITLE}</a></div>
				{LIST_ROW_SHORTTEXT}
				<div class="other">{LIST_ROW_COMMENTS}</div>
			</div>
		</div>
		<!-- END: LIST_ROW -->		
		
		
		<div class="paging">{LIST_TOP_PAGEPREV} {LIST_TOP_PAGINATION} {LIST_TOP_PAGENEXT}</div>
		
	</div>
</div>

<!-- END: MAIN -->