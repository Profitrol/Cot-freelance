<!-- BEGIN: COMMENTS -->

<a name="comments"></a>
<div class="comments" style="display:{COMMENTS_DISPLAY}">
<!-- BEGIN: COMMENTS_ROW -->
<div class="commitem">
	<div class="ava">
		{COMMENTS_ROW_AVATAR}
	</div>
	<div class="commcontent">
		<span class="title">
		<a href="{COMMENTS_ROW_URL}" id="c{COMMENTS_ROW_ID}"><img src="skins/{PHP.skin}/img/system/icon-comment.gif" alt="" /> {COMMENTS_ROW_ORDER}.</a>
		 &nbsp; {PHP.skinlang.comments.Postedby} {COMMENTS_ROW_AUTHOR}</span> &nbsp; {COMMENTS_ROW_DATE} &nbsp; {COMMENTS_ROW_ADMIN} &nbsp; {COMMENTS_ROW_EDIT} 

		<p>{COMMENTS_ROW_TEXT}</p>
	</div>
</div>
<!-- END: COMMENTS_ROW -->

<!-- BEGIN: PAGNAVIGATOR -->
<div class="pagnav">{COMMENTS_PAGES_PAGESPREV} {COMMENTS_PAGES_PAGNAV} {COMMENTS_PAGES_PAGESNEXT}</div>
<p>{COMMENTS_PAGES_INFO}</p>
<!-- END: PAGNAVIGATOR -->

<!-- BEGIN: COMMENTS_EMPTY -->
<div class="block">{COMMENTS_EMPTYTEXT}</div>
<!-- END: COMMENTS_EMPTY -->

<!-- BEGIN: COMMENTS_ERROR -->
<div class="error">{COMMENTS_ERROR_BODY}</div>
<!-- END: COMMENTS_ERROR -->

<!-- BEGIN: COMMENTS_NEWCOMMENT -->
<form action="{COMMENTS_FORM_SEND}" method="post" name="newcomment">
	<h4>{PHP.skinlang.comments.Comment}:</h4>
	<div style="width:100%;">{COMMENTS_FORM_TEXTBOXER}<br />{COMMENTS_FORM_HINT}</div>
	<p><input type="submit" value="{PHP.L.Submit}" /></p>
</form>
<!-- END: COMMENTS_NEWCOMMENT -->

<!-- BEGIN: COMMENTS_CLOSED -->
<div class="error">{COMMENTS_CLOSED}</div>
<!-- END: COMMENTS_CLOSED -->

</div>
<!-- END: COMMENTS -->