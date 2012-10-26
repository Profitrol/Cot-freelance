<!-- BEGIN: MAIN -->
	
	<div class="ustatus">{USERS_DETAILS_STATUS}</div>
	<h1>{USERS_DETAILS_ONLINE} {USERS_DETAILS_NAME} {USERS_DETAILS_PRO}</h1>
	
	<div class="mboxBody">
		<div id="udetails">
			<div class="ava">
				{USERS_DETAILS_AVATAR}
			</div>
			<div class="content">
				<div id="uratings">
					<div class="col">
						<div class="title">{PHP.skinlang.users.details.reviews}</div>
						<div class="summ">+{USERS_DETAILS_REVIEWS_POZITIVE_SUMM}/{USERS_DETAILS_REVIEWS_NEGATIVE_SUMM}</div>
					</div>
					<div class="col">
						<div class="title">{PHP.skinlang.users.details.rating}</div>
						<div class="summ">{USERS_DETAILS_RATING}</div>
					</div>
				</div>
				<div class="col1">
					<div id="contacts">
						<!-- IF {USERS_DETAILS_COUNTRY} != "" -->
						<div class="pinfo">
							<span class="name">{PHP.skinlang.users.details.country}:</span>
							<span class="val">{USERS_DETAILS_COUNTRY}</span>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_REGION} != "" -->
						<div class="pinfo">
							<span class="name">{PHP.skinlang.users.details.region}:</span>
							<span class="val">{USERS_DETAILS_REGION}</span>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_CITY} != "" -->
						<div class="pinfo">
							<span class="name">{PHP.skinlang.users.details.city}:</span>
							<span class="val">{USERS_DETAILS_CITY}</span>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_PHONE} -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.phone}:</div>
							<div class="val">{USERS_DETAILS_PHONE}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_ICQ} -->
						<div class="pinfo">
							<div class="name">ICQ:</div>
							<div class="val">{USERS_DETAILS_ICQ}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_SKYPE} -->
						<div class="pinfo">
							<div class="name">Skype:</div>
							<div class="val">{USERS_DETAILS_SKYPE}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_WEBSITE} -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.website}:</div>
							<div class="val">{USERS_DETAILS_WEBSITE}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_EMAIL} != "Скрыто" -->
						<div class="pinfo">
							<div class="name">E-mail:</div>
							<div class="val">{USERS_DETAILS_EMAIL}</div>
						</div>
						<!-- ENDIF -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.pm}:</div>
							<div class="val"><noindex>{USERS_DETAILS_PM}</noindex></div>
						</div>
					</div>
				</div>
				<div class="col2">
				
					<div id="sinfo">
						
						<div class="pinfo">
							<div class="name">Специализация:</div>
							<div class="val">
								<b>{USERS_DETAILS_CAT}</b><br/>
								<!-- BEGIN: SCATS -->
								{SCAT_TITLE}<br/>
								<!-- END: SCATS -->
							</div>
						</div>
						
						<!-- IF {USERS_DETAILS_AGE} -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.age}:</div>
							<div class="val">{USERS_DETAILS_AGE}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_EXPERIENCE} -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.experience}:</div>
							<div class="val">{USERS_DETAILS_EXPERIENCE}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_PORTFOLIO_COUNT} -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.works}:</div>
							<div class="val"><a href="{USERS_DETAILS_PORTFOLIO_URL}">{USERS_DETAILS_PORTFOLIO_COUNT}</a></div>
						</div>
						<!-- ENDIF -->
						<div class="pinfo">
							<div class="name">{PHP.skinlang.users.details.regdate}:</div>
							<div class="val">{USERS_DETAILS_REGDATE}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- IF {PHP.usr.id} == {PHP.urr.user_id} OR {PHP.usr.isadmin} -->
			<div style="float:right;">
				<a class="button_editprofile" href="{USERS_DETAILS_PROFILE_INFO_URL}">{PHP.skinlang.users.details.editinfo}</a><br/>
				<a class="button_editprofile" href="{USERS_DETAILS_PROFILE_SPECIALITY_URL}">{PHP.skinlang.users.details.editfcats}</a><br/>
				<a class="button_editprofile" href="balance/">{PHP.skinlang.users.details.uslugi}</a><br/><br/>
			</div>
		<!-- ENDIF -->
		<div id="umenu">
			<ul class="tabs">
				<!-- IF {PHP.tab} == '' -->
				<li class="first act"><a>{PHP.skinlang.users.details.info}</a></li>
				<!-- ELSE -->
				<li class="first"><a href="{USERS_DETAILS_URL}">{PHP.skinlang.users.details.info}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.tab} == 'portfolio' -->
				<li class="act"><a>{PHP.skinlang.users.details.portfolio}</a></li>
				<!-- ELSE -->	
				<li><a href="{USERS_DETAILS_PORTFOLIO_URL}">{PHP.skinlang.users.details.portfolio}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.tab} == 'market' -->
				<li class="act"><a>{PHP.skinlang.users.details.shop}</a></li>
				<!-- ELSE -->	
				<li><a href="{USERS_DETAILS_MARKET_URL}">{PHP.skinlang.users.details.shop}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.tab} == 'reviews' -->
				<li class="act"><a>{PHP.skinlang.users.details.reviews}</a></li>
				<!-- ELSE -->
				<li><a href="{USERS_DETAILS_REVIEWS_URL}">{PHP.skinlang.users.details.reviews}</a></li>
				<!-- ENDIF -->
			</ul>
		</div>
		<div id="ucontent">
		
			<!-- BEGIN: PROFILE -->
				{PCONTENT}
			<!-- END: PROFILE -->
			
			<!-- BEGIN: INFO -->
			{USERS_DETAILS_ABOUT}
			
			<!-- BEGIN: PORTFOLIO -->
			<br><br>
			<div class="portfolio">
				<!-- IF {PHP.usr.id} == {PHP.urr.user_id} --><div class="add"><a href="{PTF_ADDWORK_URL}">Добавить работу</a></div><!-- ENDIF -->
				<div class="title">{PHP.skinlang.users.details.portfolio}</div>
				<!-- BEGIN: PTF_ROWS -->
					<div class="item">
						<div class="title"><a href="{PTF_ROW_URL}">{PTF_ROW_TITLE}</a></div>
						<div class="thumb"><a href="{PTF_ROW_URL}">{PTF_ROW_THUMB}</a></div>
					</div>
				<!-- END: PTF_ROWS -->
			</div>
			<!-- END: PORTFOLIO -->
			
			<!-- BEGIN: PROJECTS -->
			<div style="clear: both;"></div>
			<br><br>
			<div class="title">{PHP.skinlang.users.details.projects}</div>
			<div id="listprojects">
				<!-- BEGIN: PRJ_ROWS -->
				<div class="prjitem">
					<!-- IF {PRJ_ROW_COST} > 0 --><div class="cost">{PRJ_ROW_COST} {PHP.skinlang.valuta}</div><!-- ENDIF -->
					<div class="title"><a href="{PRJ_ROW_URL}">{PRJ_ROW_TITLE}</a></div>
					<div class="owner"><span class="date">[{PRJ_ROW_DATE}] &nbsp; {PRJ_ROW_COUNTRY} {PRJ_ROW_REGION} {PRJ_ROW_CITY} &nbsp; {PRJ_ROW_EDIT_URL}</span></div>
					<div class="text">{PRJ_ROW_SHORTTEXT}</div>
					<div class="type">{PRJ_ROW_TYPE}</div>
					<!-- BEGIN: OWNERMENU -->
					<div id="ownermenu">
						{PRJ_ROW_ADMIN_EDIT} &nbsp; 
						<a href="{PRJ_ROW_HIDEPROJECT_URL}">{PRJ_ROW_HIDEPROJECT_TITLE}</a>
					</div>
					<!-- END: OWNERMENU -->
				</div>
				<!-- END: PRJ_ROWS -->
				<div class="paging">{PAGENAV_PAGES}</div>
			</div>
			<!-- END: PROJECTS -->
			
			<!-- END: INFO -->
	
			
			<!-- BEGIN: PORTFOLIO -->
			<div class="portfolio">
				<!-- IF {PHP.usr.id} == {PHP.urr.user_id} --><div class="add"><a href="{PTF_ADDWORK_URL}">Добавить работу</a></div><!-- ENDIF -->
				<div class="title">{PHP.skinlang.users.details.portfolio}</div>
				<!-- BEGIN: PTF_ROWS -->
					<div class="item">
						<div class="title"><a href="{PTF_ROW_URL}">{PTF_ROW_TITLE}</a></div>
						<div class="thumb"><a href="{PTF_ROW_URL}">{PTF_ROW_THUMB}</a></div>
					</div>
				<!-- END: PTF_ROWS -->
			</div>
			<!-- END: PORTFOLIO -->
			
			
			<!-- BEGIN: MARKET -->
			<div class="market">
				<!-- IF {PHP.usr.id} == {PHP.urr.user_id} --><div class="add"><a href="{PRD_ADDPRD_URL}">{PHP.skinlang.users.details.addproduct}</a></div><!-- ENDIF -->
				<div class="title">{PHP.skinlang.users.details.shop}</div>
				<!-- BEGIN: PRD_ROWS -->
					<div class="item">
						<div class="title"><a href="{PRD_ROW_URL}">{PRD_ROW_TITLE}</a></div>
						<div class="thumb"><a href="{PRD_ROW_URL}">{PRD_ROW_THUMB}</a></div>
						<!-- IF {PRD_ROW_COST} > 0 --><div class="cost">{PRD_ROW_COST} {PHP.skinlang.valuta}</div><!-- ENDIF -->
					</div>
				<!-- END: PRD_ROWS -->
			</div>
			<!-- END: MARKET -->
			
			<!-- BEGIN: REVIEWS -->
				<div class="reviews"><!-- IF {PHP.usr.id} != {PHP.urr.user_id} AND {PHP.usr.id} != 0 --><div class="add"><a href="{USERS_DETAILS_REVIEWS_ADDURL}" class="uibutton large special">{PHP.skinlang.users.details.addreview}</a></div><!-- ENDIF -->
				<div class="title">{PHP.skinlang.users.details.reviews}</div>
				<!-- BEGIN: REVIEWS_ROWS -->
				<div class="review">
					<div class="ava">{REVIEW_ROW_AVATAR}</div>
					<div class="score">{REVIEW_ROW_SCORE}</div>
					<div class="text">
						<div>{REVIEW_ROW_TEXT}</div>
						<!-- IF {PHP.item.item_userid} == {PHP.usr.id} --><div class="edit"><a href="{REVIEW_ROW_EDIT_URL}">{PHP.skinlang.edit}</a></div><!-- ENDIF -->
					</div>
				</div>
				<!-- END: REVIEWS_ROWS -->
			</div>
			<!-- END: REVIEWS -->
		
		</div>
		
	</div>

<!-- END: MAIN -->