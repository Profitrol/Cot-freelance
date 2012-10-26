<!-- BEGIN: HEADER -->
{HEADER_DOCTYPE}
<html xmlns="http://www.w3.org/1999/xhtml" {FB_XMLNS}>
<head>
<title>{HEADER_TITLE}</title>
<meta http-equiv="content-type" content="{HEADER_META_CONTENTTYPE}; charset={HEADER_META_CHARSET}" />
<meta name="description" content="{HEADER_META_DESCRIPTION}" />
<meta name="keywords" content="{HEADER_META_KEYWORDS}" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="last-modified" content="{HEADER_META_LASTMODIFIED} GMT" />
{HEADER_HEAD}
{HEADER_BASEHREF}
<link rel="shortcut icon" href="favicon.ico" />
<link href="skins/{PHP.skin}/{PHP.theme}.css" type="text/css" rel="stylesheet" />
{HEADER_COMPOPUP}
{HEADER_AUTOALIAS}

<!--[if lt IE 7]>
	<script type="text/javascript" src="js/unitpngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link href="js/redmond/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.maxlength.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
</head>
<body>
	<div id="top">
		<div id="header">
			<div id="userBar">
				 <!-- BEGIN: GUEST -->
				 {FB_LOGIN}
				<a href="auth/">{PHP.L.Login}</a>&nbsp;&#8226;&nbsp;<a href="register/">{PHP.L.Register}</a>
				<!-- END: GUEST -->
				<!-- BEGIN: USER -->
				<a href="users/{HEADER_USER_NAME}">{HEADER_USER_NAME}</a> | <a href="{BALANCE_URL}">Мой счет {BALANCE_SUMM} руб.</a><br>{HEADER_USER_PMREMINDER}
				{HEADER_NOTICES}<br>{HEADER_USER_ADMINPANEL} <!-- IF {FB_LOGOUT} -->{FB_LOGOUT}<!-- ELSE -->{HEADER_USER_LOGINOUT}<!-- ENDIF -->
				
				<!-- END: USER -->
			</div>
			<div id="logo">
				<a href="/"><img src="skins/{PHP.skin}/img/logo.png" /></a>
			</div>
			<div id="qi">
				<div class="slogan">Демонстрационная версия<br/>биржи удаленной работы</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<!-- IF {PHP.e} == "projects" -->
				<li class="act"><a href="projects/">{PHP.skinlang.menu.projects}</a></li>
				<!-- ELSE -->
				<li><a href="projects/">{PHP.skinlang.menu.projects}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.gm} == "4" AND {PHP.z} == "users" OR {PHP.urr.user_maingrp} == 4 -->
				<li class="act"><a href="freelancers/">{PHP.skinlang.menu.freelancers}</a></li>
				<!-- ELSE -->
				<li><a href="freelancers/">{PHP.skinlang.menu.freelancers}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.gm} == "8" AND {PHP.z} == "users" OR {PHP.urr.user_maingrp} == 8 -->
				<li class="act"><a href="employers/">{PHP.skinlang.menu.employers}</a></li>
				<!-- ELSE -->
				<li><a href="employers/">{PHP.skinlang.menu.employers}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.e} == "market" -->
				<li class="act"><a href="shop/">{PHP.skinlang.menu.shop}</a></li>
				<!-- ELSE -->
				<li><a href="shop/">{PHP.skinlang.menu.shop}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.e} == "blogs" -->
				<li class="act"><a href="blogs/">{PHP.skinlang.menu.blogs}</a></li>
				<!-- ELSE -->
				<li><a href="blogs/">{PHP.skinlang.menu.blogs}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.z} == "forums" -->
				<li class="act"><a href="forums.php">{PHP.skinlang.menu.forums}</a></li>
				<!-- ELSE -->
				<li><a href="forums.php">{PHP.skinlang.menu.forums}</a></li>
				<!-- ENDIF -->
				<!-- IF {PHP.c} == "articles" -->
				<li class="act"><a href="articles/">{PHP.skinlang.menu.articles}</a></li>
				<!-- ELSE -->
				<li><a href="articles/">{PHP.skinlang.menu.articles}</a></li>
				<!-- ENDIF -->
			</ul>
		</div>
	</div>
	<div id="wrapper">	
		<div id="content">

<!-- END: HEADER -->
