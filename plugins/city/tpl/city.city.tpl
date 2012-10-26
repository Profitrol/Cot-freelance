<!-- BEGIN: MAIN -->

<div class="mboxBody">
		
	<div style="float:right; font-size:14px; margin-bottom:-10px;">
		<a href="{ADD_URL}" title="Добавить город">Добавить город</a>
	</div>
		
	<h1 class="mboxHD">Города ({COUNTRY_NAME}, {REGION_NAME})</h1>
	
	<div class="rSide">
		<!-- BEGIN: ADDFORM -->
			<form action="{ADD_FORM_ACTION_URL}" method="post" name="newregion" enctype="multipart/form-data">
				<table class="cells">			
					<tr>
						<td align="right">Название города:</td>
						<td><input type="text" name="title" value="{ADD_FORM_TITLE}" size="56" /></td>
					</tr>
					<tr>
						<td align="right">или укажите список городов:</td>
						<td><textarea name="list" rows="20" cols="30">{ADD_FORM_LIST}</textarea><br/>каждый город в отдельной строке</td>
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
						<td align="right">Название города:</td>
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
			<!-- BEGIN: CITY_ROWS -->
			<tr>
				<td>{CITY_ROW_NAME}</td><td><a href="{CITY_ROW_EDIT_URL}">изменить</a> <a href="{CITY_ROW_DEL_URL}">[x]</a></td>
			</tr>
			<!-- END: CITY_ROWS -->
		</table>	
		<div class="paging">{PAGENAV_PAGES}</div>
	</div>
</div>

<!-- END: MAIN -->