<!-- BEGIN: POSTS -->

<div id="projectsposts">
	<!-- BEGIN: POSTS_ROWS -->
		<div class="postitem">
			<div class="ava">{POST_ROW_AVATAR}</div>
			<div class="postcontent">
				<div class="owner">{POST_ROW_OWNER} <span class="date">[{POST_ROW_DATE}] &nbsp; {POST_ROW_EDIT_URL}</span></div>
				{POST_ROW_TEXT}
			</div>
		</div>
	<!-- END: POSTS_ROWS -->
	
	<!-- BEGIN: POSTFORM -->
	<script>
		function openpostform(offerid){
			$('#postform' + offerid).show();
			$('#sendmsglink' + offerid).hide();
		}
	</script>
	<a href="javascript:void(0);" id="sendmsglink{ADDPOST_OFFERID}" onClick="openpostform({ADDPOST_OFFERID});">{PHP.skinlang.projectsposts.add_msg}</a>
	<div class="postform" id="postform{ADDPOST_OFFERID}">
		<form action="{ADDPOST_ACTION_URL}" method="post">
			<textarea name="posttext" cols="60" rows="3">{ADDPOST_TEXT}</textarea><br/>
			<input type="submit" name="submit" value="{PHP.skinlang.projectsposts.send}" />
		</form>
	</div>
	<!-- END: POSTFORM -->
</div>
	
<!-- END: POSTS -->