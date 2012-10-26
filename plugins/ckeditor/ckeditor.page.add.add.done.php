<?PHP
// *********************************************
// *    CKEditor Plugin for Cotonti            *
// *     Page Add add - done Part              *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            � Alex & Naty Studio  2009     *
// *********************************************
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=ckeditor
Part=page.add.add.done
File=ckeditor.page.add.add.done
Hooks=page.add.add.done
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once(sed_langfile('ckeditor'));

// Устанавливаем парсинг HTML
$sql = sed_sql_query("UPDATE $db_pages SET page_type=1 WHERE page_id=$id");

?>