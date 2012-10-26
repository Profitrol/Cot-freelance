<!-- BEGIN: MAIN -->

<div id="sSide">
	<div class="mboxHD">Форма редактирования отзыва</div>
	<div class="mboxBody">

		<!-- BEGIN: REVIEWEDIT_ERROR -->
		<div class="error">{REVIEWEDIT_ERROR_BODY}</div>
		<!-- END: REVIEWEDIT_ERROR -->

		<form action="{REVIEWEDIT_FORM_SEND}" method="post" name="edit" enctype="multipart/form-data">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td style="width:176px;">Ваш отзыв:</td>
					<td><textarea name="text" cols="80" rows="5">{REVIEWEDIT_FORM_TEXT}</textarea></td>
				</tr>
				<tr>
					<td>Оценка:</td>
					<td>
						<!-- IF {REVIEWEDIT_FORM_SCORE} == -1 --> 
						<input checked="checked" type="radio" name="score" value="-1" /> Отрицательный 
						<!-- ELSE -->
						<input type="radio" name="score" value="-1" /> Отрицательный 
						<!-- ENDIF -->
						<!-- IF {REVIEWEDIT_FORM_SCORE} == 0 --> 
						<input checked="checked" type="radio" name="score" value="0" /> Нейтральный 
						<!-- ELSE -->
						<input type="radio" name="score" value="0" /> Нейтральный 
						<!-- ENDIF -->
						<!-- IF {REVIEWEDIT_FORM_SCORE} == 1 --> 
						<input checked="checked" type="radio" name="score" value="1" /> Положительный
						<!-- ELSE -->
						<input type="radio" name="score" value="1" /> Положительный
						<!-- ENDIF -->
					</td>
				</tr>
				<tr>
					<td>Удалить?</td>
					<td>{REVIEWEDIT_FORM_DELETE}</td>
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