<!-- BEGIN: CACHE -->
			<p>
				<a href="{ADMIN_CACHE_URL_REFRESH}"{ADMIN_CACHE_URL_REFRESH_AJAX}>{PHP.L.Refresh}</a> |
				<a href="{ADMIN_CACHE_URL_PURGE}"{ADMIN_CACHE_URL_PURGE_AJAX}>{PHP.L.adm_purgeall}</a> |
				<a href="{ADMIN_CACHE_URL_SHOWALL}"{ADMIN_CACHE_URL_SHOWALL_AJAX}>{PHP.L.adm_showall}</a>|
				<a href="{ADMIN_CACHE_URL_CLEAR_HTML}" onclick="return confirm('{PHP.L.adm_bbcodes_clearcache_confirm}')">{PHP.L.adm_bbcodes_clearcache}</a>
			</p>
<!-- IF {PHP.is_adminwarnings} -->
			<div class="error">{ADMIN_CACHE_ADMINWARNINGS}</div>
<!-- ENDIF -->
			<table class="cells">
			<tr>
				<td class="coltop">{PHP.L.Delete}</td>
				<td class="coltop">{PHP.L.Item}</td>
				<td class="coltop">{PHP.L.Expire}</td>
				<td class="coltop">{PHP.L.Size}</td>
				<td class="coltop">{PHP.L.Value}</td>
			</tr>
<!-- BEGIN: ADMIN_CACHE_ROW -->
			<tr>
				<td style="text-align:center;">[<a href="{ADMIN_CACHE_ITEM_DEL_URL}"{ADMIN_CACHE_ITEM_DEL_URL_AJAX}>x</a>]</td>
				<td>{ADMIN_CACHE_ITEM_NAME}</td>
				<td style="text-align:right;">{ADMIN_CACHE_EXPIRE}</td>
				<td style="text-align:right;">{ADMIN_CACHE_SIZE}</td>
				<td>{ADMIN_CACHE_VALUE}</td>
			</tr>
<!-- END: ADMIN_CACHE_ROW -->
			<tr>
				<td colspan="3">&nbsp;</td>
				<td style="text-align:right;">{ADMIN_CACHE_CACHESIZE}</td>
				<td>&nbsp;</td>
			</tr>
			</table>
<!-- END: CACHE -->