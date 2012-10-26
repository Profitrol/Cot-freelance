<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">Главная</a> > <a href="shop/">Магазин</a> > <a href="{PRD_USER_PRDURL}">{PRD_USER}</a></div>
<div class="mboxBody">
	<h1>{PRD_TITLE}</h1>
	<div class="lSide">
		<center><a href="{PRD_IMG}">{PRD_THUMB}</a></center>
	</div>
	<div class="rSide">	
		<div class="prdshow">
			<div class="ava">{PRD_AVATAR}</div>
			<div class="content">
				<!-- IF {PRD_COST} > 0 --><div class="cost">{PRD_COST} руб.</div><!-- ENDIF -->
				<div class="owner">{PRD_OWNER} <span class="date">[{PRD_DATE}] &nbsp; {PRD_ADMIN_EDIT}</span></div>
				<div class="location">{PRD_COUNTRY} {PRD_REGION} {PRD_CITY}</div>
				<div class="text">{PRD_TEXT}</div>
			</div>
		</div>	
	</div>
</div>

<!-- END: MAIN -->