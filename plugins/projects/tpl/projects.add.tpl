<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="projects/">{PHP.skinlang.projects.projects}</a></div>
<div id="sSide">
	<div class="mboxHD">{PHP.skinlang.projects.addform.title}</div>
	<div class="mboxBody">

		<!-- BEGIN: PRJADD_ERROR -->
		<div class="error">{PRJADD_ERROR_BODY}</div>
		<!-- END: PRJADD_ERROR -->
		
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
		<form action="{PRJADD_FORM_SEND}" method="post" name="newadv" enctype="multipart/form-data">
			<table class="cells">
				<tr>
					<td align="right" style="width:176px;">{PHP.skinlang.projects.addform.type}:</td>
					<td>{PRJADD_FORM_TYPE}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.addform.cat}:</td>
					<td>{PRJADD_FORM_CAT}</td>
				</tr>			
				<tr>
					<td align="right">{PHP.skinlang.projects.addform.region}:</td>
					<td>
						{PRJADD_FORM_COUNTRY}
						<span id="region">{PRJADD_FORM_REGION}</span>
						<span id="city">{PRJADD_FORM_CITY}</span>
					</td>
				</tr>			
				<tr>
					<td align="right">{PHP.skinlang.projects.addform.zagolovok}:</td>
					<td><input type="text" name="title" value="{PRJADD_FORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td class="top" align="right">{PHP.skinlang.projects.addform.text}:</td>
					<td><textarea name="text" cols="60" rows="10">{PRJADD_FORM_TEXT}</textarea></td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.addform.budget}:</td>
					<td><input type="text" name="cost" value="{PRJADD_FORM_COST}" size="10" /> {PHP.skinlang.valuta}</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.addform.files}:</td>
					<td>
						<div>
							<div class="noscript">
								<input type="file" name="file[]" value="" /> <input onclick="return delfl(this);" type="button" value="x" />
							</div>
							<a href="javascript:void(0);" onclick="return addfl(this);">{PHP.skinlang.projects.addform.stickfile}</a>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="{PHP.skinlang.projects.addform.dalee}" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<!-- END: MAIN -->