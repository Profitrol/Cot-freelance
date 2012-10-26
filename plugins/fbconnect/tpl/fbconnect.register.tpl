<!-- BEGIN: MAIN -->

<div class="mboxHD">{PHP.L.fbconnect_registration}</div>
<div class="mboxBody">
	<fb:registration
	  fields='[
		{"name":"name"},
		{"name":"login", "description":"{PHP.L.fbconnect_login}","type":"text"},
		{"name":"email"},
		{"name":"password"},
		{"name":"regtype", 
			"description":"{PHP.L.fbconnect_usertype}", 
			"type":"select", 
			"options":{"freelancers":"{PHP.L.fbconnect_freelancer}","employers":"{PHP.L.fbconnect_employer}"}
		}
	  ]'
	  redirect-uri="{FB_REGISTER_URL}"
	  width="720">
	</fb:registration>
	
</div> 
	
<!-- END: MAIN -->