<!-- BEGIN: ADMINQV -->

<div id="amenu">
	<div class="col">
		<div class="title">Страницы сайта</div>
		<ul>
			<li><a href="admin.php?m=config&n=edit&o=core&p=page">Конфигурация</a></li>
			<li><a href="admin.php?m=page&s=structure">Структура страниц</a></li>
			<li><a href="admin.php?m=page&s=catorder">Порядок сортировки в категориях</a></li>
			<li><a href="{ADMINQV_PAGES_URL}">Страницы</a></li>
		</il>
	</div>
	<div class="prt"></div>
	<div class="col">
		<div class="title">Пользователи</div>
		<ul>
			<li><a href="admin.php?m=users">Группы пользователей</a></li>
			<li><a href="{ADMINQV_NEWUSERS_URL}">{PHP.L.plu_newusers} ({ADMINQV_NEWUSERS})</a></li>
		</il>
	</div>
	<div class="prt"></div>
	<div class="col">
		<div class="title">Мониторинг</div>
		<ul>
			<li><a href="admin.php?m=tools&p=projects">Все проекты</li>
			<li><a href="admin.php?m=tools&p=portfolio">Работы фрилансеров</a></li>
			<li><a href="admin.php?m=tools&p=market">Магазин</a></li>
			<li><a href="admin.php?m=tools&p=balance">Счета пользователей</a></li>
		</il>
	</div>
	<div class="prt"></div>
	<div class="col">
		<div class="title">Параметры</div>
		<ul>
			<li><a href="admin.php?m=tools&p=cateditor">Редактор категорий</a></li>
			<li><a href="admin.php?m=config&n=edit&o=plug&p=balance">Цены на платные услуги и настройки Robokassa</a></li>
			<li><a href="admin.php?m=config&n=edit&o=plug&p=rating">Баллы за рейтинг</a></li>
		</il>
	</div>
</div>

<h4>Cotonti:</h4>
<table class="cells">
<tr><td>{PHP.L.Version} ({PHP.L.adminqv_rev_title}) / {PHP.L.Database}</td>
<td style="text-align:right;">{ADMINQV_VERSION}({ADMINQV_REVISION}) / {ADMINQV_DB_VERSION}</td></tr>
<tr><td>{PHP.L.plu_db_rows}</td>
<td style="text-align:right;">{ADMINQV_DB_TOTAL_ROWS}</td></tr>
<tr><td>{PHP.L.plu_db_indexsize}</td>
<td style="text-align:right;">{ADMINQV_DB_INDEXSIZE}</td></tr>
<tr><td>{PHP.L.plu_db_datassize}</td>
<td style="text-align:right;">{ADMINQV_DB_DATASSIZE}</td></tr>
<tr><td>{PHP.L.plu_db_totalsize}</td>
<td style="text-align:right;">{ADMINQV_DB_TOTALSIZE}</td></tr>
<tr><td>{PHP.L.Plugins}</td>
<td style="text-align:right;">{ADMINQV_TOTALPLUGINS}</td></tr>
<tr><td>{PHP.L.Hooks}</td>
<td style="text-align:right;">{ADMINQV_TOTALHOOKS}</td></tr>
</table>


<h4>{PHP.L.plu_title}</h4>
<table class="cells" style="width:100%;">
<tr><td colspan="4" class="coltop">{PHP.L.plu_hitsmonth}</td></tr>
<!-- BEGIN: ADMINQV_ROW -->
<tr>
	<td style="width:96px;">{ADMINQV_DAY}</td>
	<td style="text-align:right; width:128px;">{PHP.L.Hits}: {ADMINQV_HITS}</td>
	<td style="text-align:right; width:40px;">{ADMINQV_PERCENTBAR}%</td>
	<td><div><div class="bar_back"><div class="bar_front" style="width:{ADMINQV_PERCENTBAR}%;"></div></div></div></td>
</tr>
<!-- END: ADMINQV_ROW -->
</table>

<!-- END: ADMINQV -->