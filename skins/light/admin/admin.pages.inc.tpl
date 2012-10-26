<!-- BEGIN: PAGES -->
<div id="pagtab">
	<div style="height:30px;">
	<!-- IF {PHP.c} != "" -->
	<div style="float:right; margin-bottom:10px;"><a href="admin.php?m=page&s=add&c={PHP.c}">Добавить страницу</a></div>
	<!-- ENDIF -->
	</div>
	<table cellpadding="0" cellspacing="1" width="100%">
		<tr>
			<td width="220">
				<table class="pcells">
					<tr class="coltop">
						<td>Разделы</td>
					</tr>
					<tr>
						<td style="padding:0;">
							<div id="catmenu">
								<ul>
									<!-- BEGIN: LIST_ROWCAT -->
										<li {LIST_ROWCAT_ACT}>{LIST_ROWCAT_OTSTUP}<a href="{LIST_ROWCAT_URL}">{LIST_ROWCAT_TITLE}</a></li>
									<!-- END: LIST_ROWCAT -->
								</ul>	
							</div>
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="pcells">
				<tr class="coltop">
					<td>Заголовок</td>
					<td width="200">Раздел</td>
					<td width="100"></td>	
					<td width="100">Редактировать</td>	
				</tr>
				<!-- BEGIN: PAGES_ROW -->
					<tr>
						<td><a href="{ADMIN_PAGES_URL}">{ADMIN_PAGES_TITLE}</a></td>
						<td>{ADMIN_PAGES_CAT_TITLE}</td>
						<td>{ADMIN_PAGES_URL_FOR_QUEUE}</td>
						<td><a href="{ADMIN_PAGES_URL_FOR_EDIT}">{PHP.L.Edit}</a></td>	
					</tr>
				<!-- END: PAGES_ROW -->
				</table>
				<div class="pagnav">{ADMIN_PAGES_PAGINATION_PREV} {ADMIN_PAGES_PAGNAV} {ADMIN_PAGES_PAGINATION_NEXT}</div>
			</td>
		</tr>
	</table>
</div>
<!-- END: PAGES -->