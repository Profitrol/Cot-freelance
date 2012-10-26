<!-- BEGIN: MAIN -->

	<h2 class="mboxHD">{PAGEEDIT_PAGETITLE}</h2>
	<div class="mboxBody">

		<!-- BEGIN: PAGEEDIT_ERROR -->
		<div class="error">{PAGEEDIT_ERROR_BODY}</div>
		<!-- END: PAGEEDIT_ERROR -->

		<form action="{PAGEEDIT_FORM_SEND}" method="post" name="update" enctype="multipart/form-data">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td style="width:176px;">{PHP.L.Category}:</td>
					<td>{PAGEEDIT_FORM_CAT}</td>
				</tr>
				<tr>
					<td>{PHP.L.Title}:</td>
					<td>{PAGEEDIT_FORM_TITLE}</td>
				</tr>
				<tr>
					<td>{PHP.L.Description}:</td>
					<td>{PAGEEDIT_FORM_DESC}</td>
				</tr>
				<tr>
					<td>{PHP.L.Author}:</td>
					<td>{PAGEEDIT_FORM_AUTHOR}</td>
				</tr>
				<tr>
					<td>{PHP.L.Date}:</td>
					<td>{PAGEEDIT_FORM_DATE}</td>
				</tr>
				<tr>
					<td>{PHP.L.Begin}:</td>
					<td>{PAGEEDIT_FORM_BEGIN}</td>
				</tr>
				<tr>
					<td>{PHP.L.Expire}:</td>
					<td>{PAGEEDIT_FORM_EXPIRE}</td>
				</tr>
				<tr>
					<td>{PHP.L.Extrakey}:</td>
					<td>{PAGEEDIT_FORM_KEY}</td>
				</tr>
				<tr>
					<td>{PHP.L.Alias}:</td>
					<td>{PAGEEDIT_FORM_ALIAS}</td>
				</tr>
				<!-- BEGIN: TAGS -->
				<tr>
					<td>{PAGEEDIT_TOP_TAGS}:</td>
					<td>{PAGEEDIT_FORM_TAGS} ({PAGEEDIT_TOP_TAGS_HINT})</td>
				</tr>
				<!-- END: TAGS -->
				<!-- BEGIN: ADMIN -->
				<tr>
					<td>{PHP.L.Owner}:</td>
					<td>{PAGEEDIT_FORM_OWNERID}</td>
				</tr>
				<tr>
					<td>{PHP.L.Parser}:</td>
					<td>{PAGEEDIT_FORM_TYPE}</td>
				</tr>
				<tr>
					<td>{PHP.L.Hits}:</td>
					<td>{PAGEEDIT_FORM_PAGECOUNT}</td>
				</tr>
				<!-- END: ADMIN -->
				<tr>
					<td colspan="2">{PHP.L.Text}:
					<div style="width:980px">{PAGEEDIT_FORM_TEXT}
					{PAGEEDIT_FORM_PFS_TEXT_USER}&nbsp;&nbsp; {PAGEEDIT_FORM_PFS_TEXT_SITE}
					</div></td>
				</tr>
                <tr>
                    <td>Миниатюра страницы:</td>
                    <td>{PAGEEDIT_FORM_THUMB}</td>
                </tr>
				<tr>
					<td>{PHP.skinlang.pageedit.Deletethispage}:</td>
					<td>{PAGEEDIT_FORM_DELETE}</td>
				</tr>
				<tr>
					<td colspan="2" class="valid">
					<!-- IF {PHP.usr_can_publish} -->
					<input name="rpublish" type="submit" class="submit" value="{PHP.L.Publish}"
						onclick="this.value='OK';return true" />
					<input type="submit" value="{PHP.L.Putinvalidationqueue}" />
					<!-- ELSE -->
					<input type="submit" class="submit" value="{PHP.L.Update}" />
					<!-- ENDIF -->
					</td>
				</tr>
			</table>
		</form>
	</div>

<!-- END: MAIN -->