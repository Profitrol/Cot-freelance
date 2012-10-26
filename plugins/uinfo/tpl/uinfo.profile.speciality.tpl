<!-- BEGIN: PROF -->

<!-- IF {PHP.cfg.scatlimit} > 0 AND !{PHP.urr.user_ispro} -->
<script>
	function countChecked() {
		var n = $("input:checked").length;
		if(n >= {PHP.cfg.scatlimit}){
			elements=$('.scatcheckbox');
			var len=elements.size();
			for (index=0;index<len;index++){
				if(!elements.eq(index).attr('checked')){
					elements.eq(index).attr('disabled', true);
				}
			}
		}
		else{
			elements=$('.scatcheckbox');
			var len=elements.size();
			for (index=0;index<len;index++){
				if(!elements.eq(index).attr('checked')){
					elements.eq(index).attr('disabled', false);
				}
			}
		}
    }
</script>
<!-- ENDIF -->

	<div class="mboxHD">Дополнительные специализации</div>
	<div class="mboxBody">
		<!-- IF {PHP.urr.user_cat} -->
		<div id="scat">
		<form action="{SPEC_FORM_ACTION_URL}" method="post">
			<!-- BEGIN: CAT_ROWS -->
			<div class="col">
				<div class="title">{CAT_ROW_TITLE}</div>
				<ul>
					<!-- BEGIN: SCAT_ROWS -->
					<li {SCAT_ROW_MAINCAT}><input type="checkbox" {SCAT_ROW_DISABLED} {SCAT_ROW_DISABLED_MAINCAT} {SCAT_ROW_CHECKED} name="scat[]" value="{SCAT_ROW_ID}" onclick="countChecked();" /> {SCAT_ROW_TITLE}</li>
					<!-- END: SCAT_ROWS -->
				</ul>
			</div>
			<!-- END: CAT_ROWS -->
			<div style="clear:both;"></div>
			<input type="submit" name="submit" value="Сохранить" />
		</form>
		</div>
		<!-- ELSE -->
		Сначала нужно выбрать <a href="{SPEC_PROFILE_EDIT_URL}">основную специализацию</a>.
		<!-- ENDIF -->
	</div>

<!-- END: PROF -->