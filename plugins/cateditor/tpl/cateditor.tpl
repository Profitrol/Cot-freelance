<!-- BEGIN: MAIN -->

<div class="mboxHD">Редактор категорий</div>
<div class="mboxBody">
	<div class="lSide">
		<div id="cmenu">
			<ul>
				<li><a href="{CAT_PROJECTS_URL}">Категории проектов</a></li>
				<li><a href="{CAT_TYPES_URL}">Типы проектов</a></li>
				<li><a href="{CAT_FREELANCERS_URL}">Категории фрилансеров</a></li>
				<li><a href="{CAT_MARKET_URL}">Категории магазина</a></li>
				<li><a href="{CAT_BLOG_URL}">Категории блогов</a></li>
			</ul>
		</div>
	</div>
	<div class="rSide">
		<!-- BEGIN: PROJECTS -->
		<div class="mboxHD">Редактор проектов</div>
		<div id="ceditormenu">
			{CAT_SHOW}
		</div>
		<!-- END: PROJECTS -->
		
		<!-- BEGIN: TYPES -->
		<div class="mboxHD">Редактор типов проектов</div>
		<div id="ceditormenu">
			{CAT_SHOW}
		</div>
		<!-- END: TYPES -->
		
		<!-- BEGIN: FREELANCERS -->
		<div class="mboxHD">Категории фрилансеров</div>
		<div id="ceditormenu">
			{CAT_SHOW}
		</div>
		<!-- END: FREELANCERS -->
		
		<!-- BEGIN: MARKET -->
		<div class="mboxHD">Редактор магазина</div>
		<div id="ceditormenu">
			{CAT_SHOW}
		</div>
		<!-- END: MARKET -->
		
		<!-- BEGIN: BLOG -->
		<div class="mboxHD">Редактор блогов</div>
		<div id="ceditormenu">
			{CAT_SHOW}
		</div>
		<!-- END: BLOG -->
		
		<hr />
		
		<!-- BEGIN: ADDFORM -->
		<div class="mboxHD">Создать категорию</div>
		<form method="post" action="{ADDFORM_ACTION_URL}">
			<table class="cells">
				<tr>
					<td width="150">Родительская категория:</td>
					<td>{ADDFORM_PARENT}</td>
				</tr>
				<tr>
					<td>Название категории:</td>
					<td><input type="text" name="title" value="{ADDFORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td>Title:</td>
					<td><input type="text" name="mtitle" value="{ADDFORM_MTITLE}" size="56" /></td>
				</tr>
				<tr>
					<td>Meta description:</td>
					<td><input type="text" name="mdesc" value="{ADDFORM_MDESC}" size="56" /></td>
				</tr>
				<tr>
					<td>Meta keywords:</td>
					<td><input type="text" name="mkey" value="{ADDFORM_MKEY}" size="56" /></td>
				</tr>
				<tr>
					<td>Описание категории:</td>
					<td><div style="width:600px;"><textarea name="text">{ADDFORM_TEXT}</textarea></div></td>
				</tr>
				<tr>
					<td>Порядок сортировки:</td>
					<td><input type="text" name="sort" value="{ADDFORM_SORT}" size="56" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Добавить" /></td>
				</tr>
			</table>
		</form>
		<!-- END: ADDFORM -->
		
		<!-- BEGIN: EDITFORM -->
		<div class="mboxHD">Редактирование категории</div>
		<form method="post" action="{EDITFORM_ACTION_URL}">
			<table class="cells">
				<tr>
					<td width="150">Родительская категория:</td>
					<td>{EDITFORM_PARENT}</td>
				</tr>
				<tr>
					<td>Название категории:</td>
					<td><input type="text" name="title" value="{EDITFORM_TITLE}" size="56" /></td>
				</tr>
				<tr>
					<td>Title:</td>
					<td><input type="text" name="mtitle" value="{EDITFORM_MTITLE}" size="56" /></td>
				</tr>
				<tr>
					<td>Meta description:</td>
					<td><input type="text" name="mdesc" value="{EDITFORM_MDESC}" size="56" /></td>
				</tr>
				<tr>
					<td>Meta keywords:</td>
					<td><input type="text" name="mkey" value="{EDITFORM_MKEY}" size="56" /></td>
				</tr>				
				<tr>
					<td>Описание категории:</td>
					<td><div style="width:600px;"><textarea name="text">{EDITFORM_TEXT}</textarea></div></td>
				</tr>
				<tr>
					<td>Порядок сортировки:</td>
					<td><input type="text" name="sort" value="{EDITFORM_SORT}" size="56" /></td>
				</tr>
				<tr>
					<td>Удалить?:</td>
					<td>{EDITFORM_DELETE}</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Обновить" /></td>
				</tr>
			</table>
		</form>
		<!-- END: EDITFORM -->

<script type="text/javascript">
	CKEDITOR.replace( 'text',{
		baseHref : '{PHP.cfg.mainurl}',
		enterMode : CKEDITOR.ENTER_BR,
		contentsCss : '{PHP.cfg.mainurl}/skins/{PHP.skin}/{PHP.skin}.css',
		height : {PHP.cfg.plugin.ckeditor.height},
        {PHP.fileBroser}
		resize_enabled : {PHP.resize},
		resize_maxHeight : {PHP.cfg.plugin.ckeditor.resize_maxHeight},
		resize_maxWidth : {PHP.cfg.plugin.ckeditor.resize_maxWidth},
		resize_minHeight : {PHP.cfg.plugin.ckeditor.resize_minHeight},
		resize_minWidth : {PHP.cfg.plugin.ckeditor.resize_minWidth},
		skin : '{PHP.cfg.plugin.ckeditor.skin}',
		{PHP.smiles}
	});		
</script>
		
	</div>
	<div style="clear:both;">&nbsp;</div>
</div>

<!-- END: MAIN -->