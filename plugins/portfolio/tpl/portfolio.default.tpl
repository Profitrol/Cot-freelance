<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">Главная</a> > <a href="projects">Проекты</a></div>
<div class="mboxBody">
	<div class="lSide">
		<div class="mboxHD">Каталог проектов</div>
		<div id="cmenu">{CATALOG}</div>
	</div>
	<div class="rSide">
		<div class="mboxHD">Проекты</div>
		<div id="listprojects">
			<!-- BEGIN: PRJ_ROWS -->
			<div class="prjitem">
				<div class="ava">{PRJ_ROW_AVATAR}</div>
				<div class="content">
					<!-- IF {PRJ_ROW_COST} > 0 --><div class="cost">{PRJ_ROW_COST} руб.</div><!-- ENDIF -->
					<div class="title"><a href="{PRJ_ROW_URL}">{PRJ_ROW_TITLE}</a></div>
					<div class="owner">{PRJ_ROW_OWNER} <span class="date">[{PRJ_ROW_DATE}] &nbsp; {PRJ_ROW_EDIT_URL}</span></div>
					<div class="text">{PRJ_ROW_SHORTTEXT}</div>
					<div class="offers"><a href="{PRJ_ROW_OFFERS_ADDOFFER_URL}">Ответить на проект</a> ({PRJ_ROW_OFFERS_COUNT})</div>
				</div>
			</div>
			<!-- END: PRJ_ROWS -->
			<div class="paging">{PAGENAV_PAGES}</div>
		</div>
	</div>
</div>

<!-- END: MAIN -->