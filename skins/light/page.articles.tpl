<!-- BEGIN: MAIN -->

<div class="sSide">
	<div id="bread">{PAGE_CATPATH}</div>
	<h1>{PAGE_SHORTTITLE}</h1>
	<div class="mboxBody">
	
		<div class="fmsg">{PAGE_TEXT}</div>

		<!-- BEGIN: PAGE_MULTI -->
		<div class="paging">{PAGE_MULTI_TABNAV}</div>
		<div class="block">
			<h5>{PHP.skinlang.page.Summary}</h5>
			{PAGE_MULTI_TABTITLES}
		</div>
		<!-- END: PAGE_MULTI -->
		
		{PAGE_ADMIN_EDIT}&nbsp;
		<!-- BEGIN: PAGE_ADMIN -->
		{PAGE_ADMIN_UNVALIDATE} &nbsp; ({PAGE_ADMIN_COUNT})<br />
		<!-- END: PAGE_ADMIN -->
	
	</div>
</div>

<!-- END: MAIN -->