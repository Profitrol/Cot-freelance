<!-- BEGIN: MAIN -->

	<h2 class="mboxHD">{PAGEADD_PAGETITLE}</h2>
	<div class="mboxBody">

		<!-- BEGIN: PAGEADD_ERROR -->
		<div class="error">{PAGEADD_ERROR_BODY}</div>
		<!-- END: PAGEADD_ERROR -->

		<form action="{PAGEADD_FORM_SEND}" method="post" name="newpage" enctype="multipart/form-data">
			<div class="tCap2"></div>
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td style="width:176px;">{PHP.L.Category}:</td>
					<td>{PAGEADD_FORM_CAT}</td>
				</tr>
				<tr>
					<td>{PHP.L.Title}:</td>
					<td>{PAGEADD_FORM_TITLE}</td>
				</tr>
				<tr>
					<td>{PHP.L.Description}:</td>
					<td>{PAGEADD_FORM_DESC}</td>
				</tr>
				<tr>
					<td>{PHP.L.Author}:</td>
					<td>{PAGEADD_FORM_AUTHOR}</td>
				</tr>
				<tr>
					<td>{PHP.L.Extrakey}</td>
					<td>{PAGEADD_FORM_KEY}</td>
				</tr>
				<tr>
					<td>{PHP.L.Alias}:</td>
					<td>{PAGEADD_FORM_ALIAS}</td>
				</tr>
				<!-- BEGIN: TAGS -->
				<tr>
					<td>{PAGEADD_TOP_TAGS}:</td>
					<td>{PAGEADD_FORM_TAGS} ({PAGEADD_TOP_TAGS_HINT})</td>
				</tr>
				<!-- END: TAGS -->
				<tr>
					<td>{PHP.L.Owner}:</td>
					<td>{PAGEADD_FORM_OWNER}</td>
				</tr>
				<!-- BEGIN: ADMIN -->
				<tr>
					<td>{PHP.L.Parser}:</td>
					<td>{PAGEADD_FORM_TYPE}</td>
				</tr>
				<!-- END: ADMIN -->
				<tr>
					<td>{PHP.L.Begin}:</td>
					<td>{PAGEADD_FORM_BEGIN}</td>
				</tr>
				<tr>
					<td>{PHP.L.Expire}:</td>
					<td>{PAGEADD_FORM_EXPIRE}</td>
				</tr>
				<tr>
					<td colspan="2">{PHP.L.Text}:
						<div style="width:980px;">{PAGEADD_FORM_TEXT}</div>
						{PAGEADD_FORM_PFS_TEXT_USER}&nbsp;&nbsp; {PAGEADD_FORM_PFS_TEXT_SITE}
					</td>
				</tr>
                <tr>
                    <td>Миниатюра страницы:</td>
                    <td>{PAGEADD_FORM_THUMB}</td>
                </tr>
				<tr>
					<td colspan="2" class="valid">
					<!-- IF {PHP.usr_can_publish} -->
					<input name="rpublish" type="submit" class="submit" value="{PHP.L.Publish}"
						onclick="this.value='OK';return true" />
					<input type="submit" value="{PHP.L.Putinvalidationqueue}" />
					<!-- ELSE -->
					<input type="submit" value="{PHP.L.Submit}" />
					<!-- ENDIF -->
					</td>
				</tr>
			</table>
			<div class="bCap"></div>
		</form>
	</div>

<!-- END: MAIN -->