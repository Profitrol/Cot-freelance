
<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > <a href="projects/">{PHP.skinlang.projects.projects}</a></div>
<div class="mboxBody">
	<div class="sSide">
		<h1 class="tboxHD">{PRJ_TITLE}</h1>
		<div class="prjshow">
			<!-- IF {PRJ_ISPRO} OR {PHP.usr.isadmin} --><div class="ava">{PRJ_AVATAR}</div><!-- ENDIF -->
			<!-- IF {PRJ_ISPRO} OR {PHP.usr.isadmin} --><div class="content"><!-- ELSE --><div class="content1"><!-- ENDIF -->
				<!-- IF {PRJ_COST} > 0 --><div class="cost">{PRJ_COST} {PHP.skinlang.valuta}</div><!-- ENDIF -->
				<div class="owner">{PRJ_OWNER} <span class="date">[{PRJ_DATE}] &nbsp; {PRJ_TYPE}</span></div>
				<div class="location">{PRJ_COUNTRY} {PRJ_REGION} {PRJ_CITY}</div>
				<div class="text">{PRJ_TEXT}</div>
				
				<!-- BEGIN: ATTACHS -->
				<ol>
					<!-- BEGIN: ATT_ROWS -->
						<li><a href="upload.php?fileid={ATT_ID}">{PHP.skinlang.projects.upload}</a></li>
					<!-- END: ATT_ROWS -->
				</ol>
				<!-- END: ATTACHS -->
				
				<!-- BEGIN: OWNERMENU -->
				<div id="ownermenu">
					{PRJ_ADMIN_EDIT} &nbsp; 
					<a href="{PRJ_HIDEPROJECT_URL}">{PRJ_HIDEPROJECT_TITLE}</a>
				</div>
				<!-- END: OWNERMENU -->	
			</div>
			
			<div class="clear"></div>
		</div>
		
		<!-- BEGIN: OFFERS -->
		
		<!-- BEGIN: OFFERS_LIST -->
		<div id="offers">	
			<div class="sboxHD">{PHP.skinlang.projects.offers}</div>
			<!-- BEGIN: OFFERS_ROWS -->
				<div class="offeritem">
					<div class="binfo">
						<div class="cost">
						<!-- IF {OFFER_ROW_COSTMAX} > {OFFER_ROW_COSTMIN} AND {OFFER_ROW_COSTMIN} != 0 -->
						{PHP.skinlang.projects.budget}: {PHP.skinlang.projects.ot} {OFFER_ROW_COSTMIN} {PHP.skinlang.projects.do} {OFFER_ROW_COSTMAX} {PHP.skinlang.valuta}
						<!-- ENDIF -->
						<!-- IF {OFFER_ROW_COSTMAX} == {OFFER_ROW_COSTMIN} AND {OFFER_ROW_COSTMIN} != 0 OR {OFFER_ROW_COSTMAX} == 0 AND {OFFER_ROW_COSTMIN} != 0 -->
						{PHP.skinlang.projects.budget}: {OFFER_ROW_COSTMIN} {PHP.skinlang.valuta}
						<!-- ENDIF -->
						</div>
						<div class="time">
						<!-- IF {OFFER_ROW_TIMEMAX} > {OFFER_ROW_TIMEMIN} AND {OFFER_ROW_TIMEMIN} != 0 -->
						{PHP.skinlang.projects.sroki}: {PHP.skinlang.projects.ot} {OFFER_ROW_TIMEMIN} {PHP.skinlang.projects.do} {OFFER_ROW_TIMEMAX} {OFFER_ROW_TIMETYPE}
						<!-- ENDIF -->
						<!-- IF {OFFER_ROW_TIMEMAX} == {OFFER_ROW_TIMEMIN} AND {OFFER_ROW_TIMEMIN} != 0 OR {OFFER_ROW_TIMEMAX} == 0 AND {OFFER_ROW_TIMEMIN} != 0 -->
						{PHP.skinlang.projects.sroki}: {OFFER_ROW_TIMEMIN} {OFFER_ROW_TIMETYPE}
						<!-- ENDIF -->
						</div>
					</div>
					<div class="ava">{OFFER_ROW_AVATAR}</div>
					<div class="content">
						<div class="owner">{OFFER_ROW_OWNER} {OFFER_ROW_PRO} <span class="date">[{OFFER_ROW_DATE}] &nbsp; {OFFER_ROW_EDIT}</span></div>
						<div class="text">{OFFER_ROW_TEXT}</div>
						
						{PROJECTS_POSTS}
							
						<!-- BEGIN: CHOISE -->
							<!-- IF {OFFER_ROW_CHOISE} != "refuse" -->
								<a href="{OFFER_ROW_REFUSE}">{PHP.skinlang.projects.otkazat}</a> 
							<!-- ENDIF -->
							<!-- IF {OFFER_ROW_CHOISE} == "refuse" -->
								{PHP.skinlang.projects.otkazali}!
							<!-- ENDIF -->
							<!-- IF {OFFER_ROW_CHOISE} != "performer" AND {PERFORMER_USERID} == "" -->
								<a href="{OFFER_ROW_SETPERFORMER}">{PHP.skinlang.projects.ispolnitel}</a> 
							<!-- ENDIF -->
							<!-- IF {OFFER_ROW_CHOISE} == "performer" -->
								{PHP.skinlang.projects.vibran_ispolnitel}!
							<!-- ENDIF -->
						<!-- END: CHOISE -->
						
					</div>
				</div>
			<!-- END: OFFERS_ROWS -->
		</div>
		<!-- END: OFFERS_LIST -->
		
		<!-- BEGIN: ADDOFFERFORM -->
		<div id="addofferform">
			<div class="sboxHD">{PHP.skinlang.projects.ostavit_predl}</div>
			<form action="{OFFER_FORM_ACTION_URL}" method="post" enctype="multipart/form-data">
			<table class="cells">
				<tr>
					<td width="150" align="right">{PHP.skinlang.projects.budget}:</td>
					<td>{PHP.skinlang.projects.ot} <input type="text" name="costmin" value="{PHP.costmin}" size="7" /> {PHP.skinlang.projects.do} <input type="text" name="costmax" value="{PHP.costmax}" size="7" /> руб.</td>
				</tr>
				<tr>
					<td align="right">{PHP.skinlang.projects.sroki}:</td>
					<td>{PHP.skinlang.projects.ot} <input type="text" name="timemin" value="{PHP.tiimemin}" size="7" /> {PHP.skinlang.projects.do} <input type="text" name="timemax" value="{PHP.timemax}" size="7" /> {OFFER_FORM_TIMETYPE}</td>
				</tr>
				<tr>
					<td align="right" class="top">{PHP.skinlang.projects.text_predl}:</td>
					<td><textarea name="offertext" style="width:99%" rows="7">{PHP.offertext}</textarea></td>
				</tr>
				<tr>
					<td align="left"></td>
					<td>
						<!-- IF {OFFER_FORM_HIDDEN} -->
						<input type="checkbox" name="hidden" value="1" checked="checked" />
						<!-- ELSE -->
						<input type="checkbox" name="hidden" value="1" />
						<!-- ENDIF -->
						{PHP.skinlang.projects.hide_offer}
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="{PHP.skinlang.projects.add_predl}" /></td>
				</tr>
			</table>
			</form>
		</div>
		<!-- END: ADDOFFERFORM -->
		
		<!-- END: OFFERS -->
		
		<!-- BEGIN: FORGUEST -->
		<div id="forguestmsg">
			{PHP.skinlang.projects.forguest}
		</div>
		<!-- END: FORGUEST -->
		
	</div>
</div>

<!-- END: MAIN -->