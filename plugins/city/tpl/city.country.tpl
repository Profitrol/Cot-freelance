<!-- BEGIN: MAIN -->

<div class="mboxBody">
		
	<div style="float:right; font-size:14px; margin-bottom:-10px;">
		<a href="{ADD_URL}" title="Добавить страну">Добавить страну</a>
	</div>
		
	<h1 class="mboxHD">Страны</h1>
	
	<div class="rSide">
		<!-- BEGIN: ADDFORM -->
			<form action="{ADD_FORM_ACTION_URL}" method="post" name="newcountry" enctype="multipart/form-data">
				<table class="cells">			
					<tr>
						<td align="right">Название страны:</td>
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
			<form action="{EDIT_FORM_ACTION_URL}" method="post" name="rcountry" enctype="multipart/form-data">
				<table class="cells">			
					<tr>
						<td align="right">Название страны:</td>
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
			<!-- BEGIN: COUNTRY_ROWS -->
			<tr>
				<td><a href="{COUNTRY_ROW_URL}">{COUNTRY_ROW_NAME}</a></td><td><a href="{COUNTRY_ROW_EDIT_URL}">изменить</a></td>
			</tr>
			<!-- END: COUNTRY_ROWS -->
		</table>	
		<div class="paging">{PAGENAV_PAGES}</div>
	</div>
</div>

<!-- END: MAIN -->