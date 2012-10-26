<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">{PHP.skinlang.Home}</a> > {PHP.skinlang.users.employers}</div>
<div class="mboxBody">
	<div class="lSide">
		
	</div>
	<div class="rSide">
		<h1 class="mboxHD">{PHP.skinlang.users.employers_catalog}</h1>
			
			<!-- BEGIN: SEARCH -->
			<div id="schform">
				<form action="{SEARCH_ACTION_URL}" method="get">
					<input type="hidden" name="c" value="{PHP.c}" />
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="140">{PHP.skinlang.loc}:</td>
						<td>
							{SEARCH_COUNTRY}
							<span id="region">{SEARCH_REGION}</span>
							<span id="city">{SEARCH_CITY}</span>
						</td>
						<td align="right"><input type="submit" name="search" value="{PHP.skinlang.search}" /></td>
					</tr>
				</table>		
				</form>
			</div>
			<!-- END: SEARCH -->
			
			<!-- BEGIN: USERS_ROW -->
			<div id="ulist">
				<!-- IF {USERS_ROW_ISPRO} -->
				<div class="prouser">
					<div class="ava">{USERS_ROW_AVATAR}</div>
					<div class="info">
						<div class="name">{USERS_ROW_ONLINE} {USERS_ROW_NAME} {USERS_ROW_PRO}</div>
						<div class="col">	
							<div class="region"><a href="{USERS_ROW_LOCATION_URL}">{USERS_ROW_COUNTRY} {USERS_ROW_REGION} {USERS_ROW_CITY}</a></div>
						</div>
						<div class="col">
							<div class="cat">{USERS_ROW_CATTITLE}</div>
							<div class="cat"><a href="{USERS_ROW_URL}">{USERS_ROW_STATUS}</a></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<!-- ELSE -->
				<div class="defuser">
					<div class="ava">{USERS_ROW_AVATAR}</div>
					<div class="info">
						<div class="name">{USERS_ROW_ONLINE} {USERS_ROW_NAME} {USERS_ROW_PRO}</div>
						<div class="col">	
							<div class="region"><a href="{USERS_ROW_LOCATION_URL}">{USERS_ROW_COUNTRY} {USERS_ROW_REGION} {USERS_ROW_CITY}</a></div>
						</div>
						<div class="col">
							<div class="cat">{USERS_ROW_CATTITLE}</div>
							<div class="cat"><a href="{USERS_ROW_URL}">{USERS_ROW_STATUS}</a></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<!-- ENDIF -->
			</div>	
			<!-- END: USERS_ROW -->

		<div class="paging">{USERS_TOP_PAGEPREV}{USERS_TOP_PAGNAV}{USERS_TOP_PAGENEXT}</div>

	</div>
</div>

<!-- END: MAIN -->