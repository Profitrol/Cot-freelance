<!-- BEGIN: MAIN -->

<div id="sSide">
	<div class="mboxHD">Форма добавления работы в магазин</div>
	<div class="mboxBody">

		<!-- BEGIN: PRDADD_ERROR -->
		<div class="error">{PRDADD_ERROR_BODY}</div>
		<!-- END: PRDADD_ERROR -->

		<form action="{PRDADD_FORM_SEND}" method="post" name="newwork" enctype="multipart/form-data">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td align="right" style="width:176px;">Раздел:</td>
					<td>{PRDADD_FORM_CAT}</td>
				</tr>
				<tr>
					<td align="right">Заголовок:</td>
					<td><input type="text" name="title" value="{PRDADD_FORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td align="right">Регион:</td>
					<td>
						{PRDADD_FORM_COUNTRY}
						<span id="region">{PRDADD_FORM_REGION}</span>
						<span id="city">{PRDADD_FORM_CITY}</span>
					</td>
				</tr>
				<tr>
					<td align="right">Текст:</td>
					<td><textarea name="text" id="formtext" cols="60" rows="10">{PRDADD_FORM_TEXT}</textarea></td>
				</tr>
				<tr>
					<td align="right">Цена:</td>
					<td><input type="text" name="cost" value="{PRDADD_FORM_COST}" size="10" /> руб.</td>
				</tr>
				<tr>
					<td align="right">Изображение:</td>
					<td>
						<input type="file" name="img" value="" />
						<div class="desc">Допускаются к загрузке gif, jpg, jpeg и png изображения. Максимальный размер файла: 1Mb.</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="{PHP.L.Submit}" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<!-- END: MAIN -->