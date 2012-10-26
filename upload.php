<?PHP
/**
 * Home page loader
 *
 * @package Cotonti
 * @version 0.0.3
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

define('SED_CODE', TRUE);

require_once('./datas/config.php');
require_once($cfg['system_dir'].'/functions.php');
require_once($cfg['system_dir'].'/common.php');

$fileid = sed_import('fileid','G','INT');

$sql = sed_sql_query("SELECT * FROM sed_attachs WHERE att_id=".$fileid."");

if($att = sed_sql_fetcharray($sql)){
	
	$filename = $att['att_file'];
	 
	// если файла нет
	if( !file_exists($filename) ) {
		header ( 'HTTP/1.1 404 Not Found' );
		die();
	}
	else {
		header('Location: ' . SED_ABSOLUTE_URL . $filename);
		echo("<script type='text/javascript'>location.href='". SED_ABSOLUTE_URL . $filename."';</script>Redirecting...");
		exit;
	}
}
else{
	header ( 'HTTP/1.1 404 Not Found' );
	die();
}

?>