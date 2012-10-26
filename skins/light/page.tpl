<!-- BEGIN: MAIN -->

	<div class="mboxHD">{PAGE_SHORTTITLE}</div>
	<div class="mboxBody">

		<div class="pageBody">

			<div id="subtitle">{PAGE_DESC}</div>

			{PAGE_ADMIN_EDIT}&nbsp;
			<!-- BEGIN: PAGE_ADMIN -->
			{PAGE_ADMIN_UNVALIDATE} &nbsp; ({PAGE_ADMIN_COUNT})<br />
			<!-- END: PAGE_ADMIN -->
			{PAGE_RATINGS_DISPLAY}
			
		</div>

		<div class="fmsg">{PAGE_TEXT}</div>
		
		{PLUGIN_CONTACTUS}

		<!-- BEGIN: PAGE_MULTI -->
		<div class="paging">{PAGE_MULTI_TABNAV}</div>
		<div class="block">
			<h5>{PHP.skinlang.page.Summary}</h5>
			{PAGE_MULTI_TABTITLES}
		</div>
		<!-- END: PAGE_MULTI -->

	</div>

<!-- END: MAIN -->