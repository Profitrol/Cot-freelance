<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="blogs">{PHP.skinlang.blogs.blogs}</a></div>
<div class="mboxBody">
	<div class="lSide">
	</div>
	<div class="rSide">
		<h1 class="mboxHD">{PHP.skinlang.blogs.addform.title}</h1>
		<div class="mboxBody">
	
			<!-- BEGIN: BLOGADD_ERROR -->
			<div class="error">{BLOGADD_ERROR_BODY}</div>
			<!-- END: BLOGADD_ERROR -->
	
			<form action="{BLOGADD_FORM_SEND}" method="post" name="newpost" enctype="multipart/form-data">
				<table class="cells" border="0" cellspacing="1" cellpadding="2">
					<tr>
						<td>
							<strong>{PHP.skinlang.blogs.addform.cat}:</strong><br />
							{BLOGADD_FORM_CAT}
						</td>
					</tr>
					<tr>
						<td>
							<strong>{PHP.skinlang.blogs.addform.zagolovok}:</strong><br />
							<input type="text" name="newblogstitle" style="width:99%" value="{BLOGADD_FORM_TITLE}" />
						</td>
					</tr>
					<tr>
						<td>
							<strong>{PHP.skinlang.blogs.addform.text}:</strong><br />
							<textarea class="editor" name="newblogstext" style="width:99%" rows="15">{BLOGADD_FORM_TEXT}</textarea>
							{BLOGADD_FORM_PFS}
						</td>
					</tr>
					<tr>
						<td class="valid">
							<input type="submit" value="{PHP.L.Submit}" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>	
</div>

<!-- END: MAIN -->