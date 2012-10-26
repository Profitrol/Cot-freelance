<!-- BEGIN: MAIN -->

<div id="bread"><a href="/">Главная</a> > {USERS_TITLE}</div>
<div class="mboxBody">
	<h1 class="mboxHD">Каталог пользователей {CATTITLE}</h1>
	
	<!-- BEGIN: USERS_ROW -->
	<div id="ulist">
		<!-- IF {USERS_ROW_ISPRO} -->
		<div class="prouser">
			<a id="user{USERS_ROW_ID}"></a>
			{USERS_ROW_SETPRO}
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
			<a id="user{USERS_ROW_ID}"></a>
			{USERS_ROW_SETPRO}
			<div class="ava">{USERS_ROW_AVATAR}</div>
			<div class="info">
				<div class="name">{USERS_ROW_ONLINE} {USERS_ROW_NAME} {USERS_ROW_PRO}</div>
				<div class="col">	
					<div class="cat">{USERS_ROW_CATTITLE}</div>
				</div>
				<div class="col">
					<div class="region"><a href="{USERS_ROW_LOCATION_URL}">{USERS_ROW_COUNTRY} {USERS_ROW_REGION} {USERS_ROW_CITY}</a></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- ENDIF -->
	</div>	
	<!-- END: USERS_ROW -->

	<div class="paging">{USERS_TOP_PAGEPREV}{USERS_TOP_PAGNAV}{USERS_TOP_PAGENEXT}</div>
</div>

<!-- END: MAIN -->