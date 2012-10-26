<!-- BEGIN: MAIN -->
	
	<h1>{USERS_DETAILS_NAME}</h1>
	<div class="mboxBody">
		<div id="udetails">
			<div class="ava">
				{USERS_DETAILS_AVATAR}
			</div>
			<div class="content">
				<div class="col">
					<div class="status">{USERS_DETAILS_STATUS}</div>
					<div id="contacts">
						<!-- IF {USERS_DETAILS_LOCATION} -->
						<div class="pinfo">
							<div class="name">Город:</div>
							<div class="val">{USERS_DETAILS_LOCATION}</div>
						</div>
						<!-- ENDIF -->
						<!-- IF {USERS_DETAILS_PHONE} -->
						<div class="pinfo">
							<div class="name">Телефон:</div>
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
							<div class="name">Сайт:</div>
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
							<div class="name">Оставить сообщение:</div>
							<div class="val">{USERS_DETAILS_PM}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- IF {PHP.usr.id} == {PHP.urr.user_id} OR {PHP.usr.isadmin} -->
		<div style="float:right;">
			<a class="button_editprofile" href="{USERS_DETAILS_PROFILE_INFO_URL}">{PHP.skinlang.users.details.editinfo}</a>
		</div>
		<!-- ENDIF -->
		<div id="umenu">
			<ul class="tabs">
				<!-- IF {PHP.tab} == '' -->
				<li class="first act"><a>Информация</a></li>
				<!-- ELSE -->
				<li class="first"><a href="{USERS_DETAILS_URL}">Информация</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.tab} == 'reviews' -->
				<li class="act"><a>Отзывы</a></li>
				<!-- ELSE -->
				<li><a href="{USERS_DETAILS_REVIEWS_URL}">Отзывы</a></li>
				<!-- ENDIF -->
			</ul>
		</div>
		<div id="ucontent">
		
			<!-- BEGIN: PROFILE -->
				{PCONTENT}
			<!-- END: PROFILE -->
			
			<!-- BEGIN: INFO -->
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%">
						<div class="about">{USERS_DETAILS_ABOUT}</div>
					</td>
					<td>
						
					</td>
				</tr>
			</table>
			
			<!-- BEGIN: PROJECTS -->
			<br><br>
			<div class="title">Проекты</div>
			<div id="listprojects">
				<!-- BEGIN: PRJ_ROWS -->
				<div class="prjitem">
					<!-- IF {PRJ_ROW_COST} > 0 --><div class="cost">{PRJ_ROW_COST} руб.</div><!-- ENDIF -->
					<div class="title"><a href="{PRJ_ROW_URL}">{PRJ_ROW_TITLE}</a></div>
					<div class="owner"><span class="date">[{PRJ_ROW_DATE}] &nbsp; {PRJ_ROW_REGION} {PRJ_ROW_LOCATION} &nbsp; {PRJ_ROW_EDIT_URL}</span></div>
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
			
		</div>
		<!-- END: INFO -->
		
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