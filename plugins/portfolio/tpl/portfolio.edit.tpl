<!-- BEGIN: MAIN -->

<div id="sSide">
	<div class="mboxHD">Форма редактирования работы в портфолио</div>
	<div class="mboxBody">

		<!-- BEGIN: PTFEDIT_ERROR -->
		<div class="error">{PTFEDIT_ERROR_BODY}</div>
		<!-- END: PTFEDIT_ERROR -->

		<form action="{PTFEDIT_FORM_SEND}" method="post" name="edit" enctype="multipart/form-data">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td>Раздел:</td>
					<td>{PTFEDIT_FORM_CAT}</td>
				</tr>	
				<tr>
					<td style="width:176px;">Заголовок:</td>
					<td><input type="text" name="title" value="{PTFEDIT_FORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td>Текст:</td>
					<td><textarea name="text" id="formtext" cols="60" rows="10">{PTFEDIT_FORM_TEXT}</textarea></td>
				</tr>
				<tr>
					<td>Изображение:</td>
					<td>
						<img src="{PTFEDIT_FORM_OLDIMG}" /><br /><input type="file" name="img" value="" />
						<div class="desc">Допускаются к загрузке gif, jpg, jpeg и png изображения. Максимальный размер файла: 1Mb.</div>
					</td>
				</tr>
				<tr>
					<td>Удалить?</td>
					<td>{PTFEDIT_FORM_DELETE}</td>
				</tr>
				<tr>
					<td colspan="2" class="valid">
						<input type="submit" value="{PHP.L.Submit}" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<!-- END: MAIN -->