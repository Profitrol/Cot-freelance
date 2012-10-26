<!-- BEGIN: MAIN -->

<div id="sSide">
	<div class="mboxHD">Форма добавления отзыва</div>
	<div class="mboxBody">

		<!-- BEGIN: REVIEWADD_ERROR -->
		<div class="error">{REVIEWADD_ERROR_BODY}</div>
		<!-- END: REVIEWADD_ERROR -->

		<form action="{REVIEWADD_FORM_SEND}" method="post" name="newreview" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{REVIEWADD_FORM_TOUSER}" />
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td style="width:176px;">Ваш отзыв:</td>
					<td><textarea name="text" cols="80" rows="5">{REVIEWADD_FORM_TITLE}</textarea></td>
				</tr>
				<tr>
					<td>Оценка:</td>
					<td><input type="radio" name="score" value="-1" /> Отрицательный <input type="radio" name="score" value="0" /> Нейтральный <input type="radio" name="score" value="1" /> Положительный  </td>
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