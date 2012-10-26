<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="projects/">{PHP.skinlang.projects.projects}</a></div>
<div id="sSide">
	<div class="mboxHD">{PHP.skinlang.projects.editform.title}</div>
	<div class="mboxBody">

		<!-- BEGIN: PRJEDIT_ERROR -->
		<div class="error">{PRJEDIT_ERROR_BODY}</div>
		<!-- END: PRJEDIT_ERROR -->
		
		<script type="text/javascript">
		//<![CDATA[
			
			document.write('<style type="text/css">.noscript{display:none; padding-bottom:7px; } .script{display:inherit;} </style>');
			
			var accCount = 0;
			var accMax = 10;
			
			function delfl(object)
			{
		//	    if (accCount>0)
		//	    { 
					accCount--;
					if ($(object).parent().children('[name="acc_id[]"]').value !="new")
					{ 
						$(object).parent().remove(); 
					}
					else
					{ 
						$(object).parent().remove(); 
					}
		//	    }
				return false;
			}
			
			function addfl(object) {
				
				if (accCount<accMax)
				{
				var objectparent = $(object).parent();
				$(object).parent().children('div').clone().insertBefore(objectparent).show();
				accCount++;
				}
			
				return false;
			}
		//]]>
		</script>
		
		<form action="{PRJEDIT_FORM_SEND}" method="post" name="edit" enctype="multipart/form-data">
			<table class="cells" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td align="right" style="width:176px;">{PHP.skinlang.projects.editform.type}:</td>
					<td>{PRJEDIT_FORM_TYPE}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.editform.cat}:</td>
					<td>{PRJEDIT_FORM_CAT}</td>
				</tr>		
				<tr>
					<td align="right">{PHP.skinlang.projects.editform.region}:</td>
					<td>
						{PRJEDIT_FORM_COUNTRY}
						<span id="region">{PRJEDIT_FORM_REGION}</span>
						<span id="city">{PRJEDIT_FORM_CITY}</span>
					</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.editform.zagolovok}:</td>
					<td><input type="text" name="title" value="{PRJEDIT_FORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td class="top" align="right">{PHP.skinlang.projects.editform.text}:</td>
					<td><textarea name="text" cols="60" rows="10">{PRJEDIT_FORM_TEXT}</textarea></td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.editform.budget}:</td>
					<td><input type="text" name="cost" value="{PRJEDIT_FORM_COST}" size="10" /> руб.</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.editform.files}:</td>
					<td>
						<!-- BEGIN: ATTACHS -->
						<ol>
							<!-- BEGIN: ATT_ROWS -->
								<li><a href="upload.php?fileid={ATT_ID}">{PHP.skinlang.projects.editform.uploadfile}</a> <a href="{ATT_DEL_URL}">[x]</a></li>
							<!-- END: ATT_ROWS -->
						</ol>
						<!-- END: ATTACHS -->
						<div>
							<div class="noscript">
								<input type="file" name="file[]" value="" /> <input onclick="return delfl(this);" type="button" value="x" />
							</div>
							<a href="javascript:void(0);" onclick="return addfl(this);">{PHP.skinlang.projects.editform.stickfile}</a>
						</div>
					</td>
				</tr>
				<!-- IF {PHP.usr.isadmin} -->
				<tr>
					<td align="right">{PHP.skinlang.projects.editform.delete}?</td>
					<td>{PRJEDIT_FORM_DELETE}</td>
				</tr>
				<!-- ENDIF -->
				<tr>
					<td></td>
					<td>
						<input type="submit" value="{PHP.skinlang.projects.editform.dalee}" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<!-- END: MAIN -->