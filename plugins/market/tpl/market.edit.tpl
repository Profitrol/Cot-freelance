<!-- BEGIN: MAIN -->

<div id="sSide">
	<div class="mboxHD">Форма редактирования работы в магазине</div>
	<div class="mboxBody">

		<!-- BEGIN: PRDEDIT_ERROR -->
		<div class="error">{PRDEDIT_ERROR_BODY}</div>
		<!-- END: PRDEDIT_ERROR -->

		<form action="{PRDEDIT_FORM_SEND}" method="post" name="edit" enctype="multipart/form-data">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td align="right" style="width:176px;">Раздел:</td>
					<td>{PRDEDIT_FORM_CAT}</td>
				</tr>
				<tr>
					<td align="right">Регион:</td>
					<td>
						{PRDEDIT_FORM_COUNTRY}
						<span id="region">{PRDEDIT_FORM_REGION}</span>
						<span id="city">{PRDEDIT_FORM_CITY}</span>
					</td>
				</tr>
				<tr>
					<td align="right">Заголовок:</td>
					<td><input type="text" name="title" value="{PRDEDIT_FORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td align="right">Текст:</td>
					<td><textarea name="text" id="formtext" cols="60" rows="10">{PRDEDIT_FORM_TEXT}</textarea></td>
				</tr>
				<tr>
					<td align="right">Цена:</td>
					<td><input type="text" name="cost" value="{PRDEDIT_FORM_COST}" size="10" /> руб.</td>
				</tr>
				<tr>
					<td align="right">Изображение:</td>
					<td>
						<!-- IF {PRDEDIT_FORM_OLDIMG} --><img src="{PRDEDIT_FORM_OLDIMG}" /><br /><!-- ENDIF --><input type="file" name="img" value="" />
						<div class="desc">Допускаются к загрузке gif, jpg, jpeg и png изображения. Максимальный размер файла: 1Mb.</div>
					</td>
				</tr>
				<tr>
					<td align="right">Удалить?</td>
					<td>{PRDEDIT_FORM_DELETE}</td>
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