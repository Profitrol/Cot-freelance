<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=uregister
Part=auth
File=uregister.users.auth.check.done
Hooks=users.auth.check.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

$sql = sed_sql_query("SELECT user_id, user_maingrp, user_regtype, user_logcount FROM $db_users WHERE user_id=".$ruserid." LIMIT 1");
if ($row = sed_sql_fetcharray($sql)){
	if($row['user_regtype'] == 'employers' && $row['user_maingrp']==4 && $row['user_logcount'] == 1){
		$sql = sed_sql_query("SELECT grp_id FROM $db_groups WHERE grp_alias='".$row['user_regtype']."' LIMIT 1");
		$grp = sed_sql_fetcharray($sql);
		$sql = sed_sql_query("UPDATE $db_users SET user_maingrp=".$grp['grp_id']." WHERE user_id=".$row['user_id']." AND user_maingrp=4");
		$sql = sed_sql_query("UPDATE $db_groups_users SET gru_groupid=".$grp['grp_id']." WHERE gru_groupid=4 AND gru_userid=".$row['user_id']."");	
		}
	}


	
?>