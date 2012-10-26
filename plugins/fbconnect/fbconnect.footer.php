<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=fbconnect
Part=footer
File=fbconnect.footer
Hooks=footer.tags
Tags=footer.tpl:{FB_CONNECT}
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

/**
 * FBConnect footer javascript for quicker page load
 *
 * @package fbconnect
 * @version 2.0.0
 * @author Trustmaster
 * @copyright (c) 2011 Vladimir Sibirov, Skuola.net
 * @license BSD
 */

$t->assign('FB_CONNECT', $fb_init_script);

?>
