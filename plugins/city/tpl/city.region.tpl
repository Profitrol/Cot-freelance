<!-- BEGIN: MAIN -->

<div class="mboxBody">
		
	<div style="float:right; font-size:14px; margin-bottom:-10px;">
		<a href="{ADD_URL}" title="Добавить регион">Добавить регион</a>
	</div>
		
	<h1 class="mboxHD">Регионы ({COUNTRY_NAME})</h1>
	
	<div class="rSide">
		<!-- BEGIN: ADDFORM -->
			<form action="{ADD_FORM_ACTION_URL}" method="post" name="newregion" enctype="multipart/form-data">
				<table class="cells">			
					<tr>
						<td align="right">Название региона:</td>
						<td><input type="text" name="title" value="{ADD_FORM_TITLE}" size="56" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" value="Добавить" />
						</td>
					</tr>
				</table>
			</form>
		<!-- END: ADDFORM -->
		
		<!-- BEGIN: EDITFORM -->
			<form action="{EDIT_FORM_ACTION_URL}" method="post" name="rregion" enctype="multipart/form-data">
				<table class="cells">			
					<tr>
						<td align="right">Название региона:</td>
						<td><input type="text" name="title" value="{EDIT_FORM_TITLE}" size="56" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" value="Изменить" />
						</td>
					</tr>
				</table>
			</form>
		<!-- END: EDITFORM -->
		
	</div>
	<div class="lSide">
		<table class="cells">
			<!-- BEGIN: REGION_ROWS -->
			<tr>
				<td><a href="{REGION_ROW_URL}">{REGION_ROW_NAME}</a></td><td><a href="{REGION_ROW_EDIT_URL}">изменить</a> <a href="{REGION_ROW_DEL_URL}">[x]</a></td>
			</tr>
			<!-- END: REGION_ROWS -->
		</table>	
		<div class="paging">{PAGENAV_PAGES}</div>
	</div>	
</div>

<!-- END: MAIN -->