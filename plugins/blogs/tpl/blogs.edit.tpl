<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="blogs">{PHP.skinlang.blogs.blogs}</a></div>
<div class="mboxBody">
	<div class="lSide">
	</div>
	<div class="rSide">
		<h1 class="mboxHD">{PHP.skinlang.blogs.editform.title}</h1>
		<div class="mboxBody">
	
			<!-- BEGIN: BLOGEDIT_ERROR -->
			<div class="error">{BLOGEDIT_ERROR_BODY}</div>
			<!-- END: BLOGEDIT_ERROR -->
	
			<form action="{BLOGEDIT_FORM_SEND}" method="post" name="update" enctype="multipart/form-data">
				{BLOGEDIT_FORM_OWNERID}
				<table class="cells" border="0" cellspacing="1" cellpadding="2">
					<tr>
						<td>
							<strong>{PHP.skinlang.blogs.editform.cat}:</strong><br />
							{BLOGEDIT_FORM_CAT}
						</td>
					</tr>
					<tr>
						<td>
							<strong>{PHP.skinlang.blogs.editform.zagolovok}:</strong><br />
							<input type="text" name="rblogstitle" style="width:99%" value="{BLOGEDIT_FORM_TITLE}" />
						</td>
					</tr>
					<tr>
						<td>
							<strong>{PHP.skinlang.blogs.editform.text}:</strong><br />
							<textarea class="editor" name="rblogstext" style="width:99%" rows="15">{BLOGEDIT_FORM_TEXT}</textarea>
							{BLOGEDIT_FORM_PFS}
						</td>
					</tr>
					<tr>
						<td>{PHP.skinlang.pageedit.Deletethispage}: {BLOGEDIT_FORM_DELETE}</td>
					</tr>
					<tr>
						<td class="valid">
							<input type="submit" class="submit" value="{PHP.L.Update}" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- END: MAIN -->