<?PHP
// *********************************************
// *    CKEditor Plugin for Cotonti            *
// *             Functions                     *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            ©  Alex & Naty Studio  2009    *
// *********************************************

if (!defined('SED_CODE')) { die('Wrong URL.'); }

function deleteDir($dir) 
{ 
   if (substr($dir, strlen($dir)-1, 1) != '/') 
       $dir .= '/'; 

   //echo $dir; 

   if ($handle = opendir($dir)) 
   { 
       while ($obj = readdir($handle)) 
       { 
           if ($obj != '.' && $obj != '..') 
           { 
               if (is_dir($dir.$obj)) 
               { 
                   if (!deleteDir($dir.$obj)) 
                       return false; 
               } 
               elseif (is_file($dir.$obj)) 
               { 
                   if (!unlink($dir.$obj)) 
                       return false; 
               } 
           } 
       } 

       closedir($handle); 

       if (!@rmdir($dir)) 
           return false; 
       return true; 
   } 
   return false; 
}; 


?>