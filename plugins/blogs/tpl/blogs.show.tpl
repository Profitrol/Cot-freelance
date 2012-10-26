<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="blogs">{PHP.skinlang.blogs.blogs}</a></div>
<div class="mboxBody">
	<br />
	<div class="sSide">
		<div class="postitem">
			<div class="ava">{BLOG_AVATAR}</div>
			<div class="postcontent">
				<div class="owner">{BLOG_OWNER} <span class="date">[{BLOG_DATE}] &nbsp; {BLOG_ADMIN_EDIT}</span></div>
				<h1 class="posttitle">{BLOG_TITLE}</h1>
				{BLOG_TEXT}
			</div>
		</div>
		<hr />
		<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div> 
		<h4>{PHP.skinlang.comments.comments}:</h4>
		<div id="comments">
			{BLOG_COMMENTS_DISPLAY}
		</div>
	</div>
</div>

<!-- END: MAIN -->