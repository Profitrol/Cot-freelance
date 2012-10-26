<!-- BEGIN: MAIN -->
<div class="mboxHD">{PLUGIN_TITLE}</div>
<div class="mboxBody">
    <div class='main_all'>{PHP.L.plu_subtitle_all}</div>
    <div class='main_all'>
        <form id='search' name='search' action='{PLUGIN_SEARCH_ACTION}' method='post'>
            <input type='hidden' name='a' value='search' />
            <div style='text-align:right;'>
                <a href='plug.php?e=search'>{PHP.L.plu_tabs_all}</a> |
                <a href='plug.php?e=search&amp;tab=frm'>{PHP.L.plu_tabs_frm}</a> |
                <a href='plug.php?e=search&amp;tab=pag'>{PHP.L.plu_tabs_pag}</a>
            </div>

            <div class="tCap"></div>
            <table class="cells">
                <tr><td>
                        <div style='padding:15px 0 6px 15px;'>
                            {PHP.L.plu_search_req}: {PLUGIN_SEARCH_TEXT} {PLUGIN_SEARCH_KEY}
                            <div style='padding-left:55px' class='desc'>{PHP.L.plu_search_example}</div>
                        </div>
                </td></tr>
            </table>
            <div class="bCap"></div>

            <!-- BEGIN: EASY_OPTIONS -->
            <table class="flat">
                <tr>
                    <td style='width:50%'>
                        {PHP.L.plu_pag_set_sec}:
                        <div>{PLUGIN_PAGE_SEC_LIST}</div>
                        <div class='desc'>{PHP.L.plu_ctrl_list}</div>
                    </td>
                    <td style='padding-left:25px'>
                        <div style='padding:10px 0'>{PHP.L.plu_other_opt}:</div>
                        <div>{PLUGIN_PAGE_SEARCH_NAMES}</div>
                        <div style='margin:5px 0'>{PLUGIN_PAGE_SEARCH_DESC}</div>
                        <div>{PLUGIN_PAGE_SEARCH_TEXT}</div>
                    </td>
                </tr>
            </table>
            <div style='margin:10px 0'>
                <table>
                    <tr>
                        <td style='width:50%'>
                            {PHP.L.plu_frm_set_sec}:
                            <div>{PLUGIN_FORUM_SEC_LIST}</div>
                            <div class='desc'>{PHP.L.plu_ctrl_list}</div>
                        </td>
                        <td style='padding-left:25px'>
                            <div style='padding:10px 0'>{PHP.L.plu_other_opt}:</div>
                            <div>{PLUGIN_FORUM_SEARCH_NAMES}</div>
                            <div style='margin:5px 0'>{PLUGIN_FORUM_SEARCH_POST}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- END: EASY_OPTIONS -->

            <!-- BEGIN: PAGES_OPTIONS -->
            <div style='margin:20px 0'>
                <table>
                    <tr>
                        <td style='width:50%'>
                            {PHP.L.plu_pag_set_sec}:
                            <div>{PLUGIN_PAGE_SEC_LIST}</div>
                            <div class='desc'>{PHP.L.plu_ctrl_list}</div>
                            <div style='padding:15px 0 0 0'>{PHP.L.plu_res_sort}:</div>
                            <div><span>{PLUGIN_PAGE_RES_SORT}</span><span style='margin-left:12px'>{PLUGIN_PAGE_RES_DESC}</span><span style='margin-left:12px'>{PLUGIN_PAGE_RES_ASC}</span></div>
                        </td>
                        <td style='padding-left:25px'>
                            <div style='padding:10px 0'>{PHP.L.plu_other_opt}:</div>

                            <div>{PLUGIN_PAGE_SEARCH_NAMES}</div>
                            <div style='margin:5px 0'>{PLUGIN_PAGE_SEARCH_DESC}</div>
                            <div style='margin:5px 0'>{PLUGIN_PAGE_SEARCH_TEXT}</div>
                            <div>{PLUGIN_PAGE_SEARCH_FILE}</div>

                            <div style='padding:15px 0 0 0'>{PHP.L.plu_other_date}:</div>
                            {PLUGIN_PAGE_SEARCH_DATE}
                        </td>
                    </tr>
                </table>
            </div>
            <!-- END: PAGES_OPTIONS -->

                        <!-- BEGIN: FORUMS_OPTIONS -->
            <div style='margin:20px 0'>
                <table>
                    <tr>
                        <td style='width:50%'>
                            {PHP.L.plu_frm_set_sec}:

                            <div>{PLUGIN_FORUM_SEC_LIST}</div>
                            <div class='desc'>{PHP.L.plu_ctrl_list}</div>

                            <div style='padding:15px 0 0 0'>{PHP.L.plu_res_sort}:</div>
                            <div><span>{PLUGIN_FORUM_RES_SORT}</span><span style='margin-left:12px'>{PLUGIN_FORUM_RES_DESC}</span><span style='margin-left:12px'>{PLUGIN_FORUM_RES_ASC}</span></div>
                        </td>
                        <td style='padding-left:25px'>
                            <div style='padding-bottom:10px'>{PHP.L.plu_other_opt}:</div>

                            <div>{PLUGIN_FORUM_SEARCH_NAMES}</div>
                            <div style='margin:5px 0'>{PLUGIN_FORUM_SEARCH_POST}</div>
                            <div>{PLUGIN_FORUM_SEARCH_ANSW}</div>

                            <div style='padding:15px 0 0 0'>{PHP.L.plu_other_date}:</div>
                            <div>{PLUGIN_FORUM_SEARCH_DATE}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- END: FORUMS_OPTIONS -->

        </form>
    </div>

    <!-- BEGIN: ERROR -->
    <div class='main_all'>
        <div class='error' style='margin:15px 0'>{PLUGIN_ERROR}</div>
    </div>
    <!-- END: ERROR -->

  <!-- BEGIN: EASY_PAGES_RESULTS -->
    <div class="tCap"></div>
    <table class="cells">
        <tr>
            <td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.plu_tabs_pag} ({PLUGIN_EASY_PAGE_FOUND})
            </td>
        </tr>
        <!-- BEGIN: ITEM -->
        <tr>
            <td colspan="2" class="{PLUGIN_PR_ODDEVEN}">{PLUGIN_PR_TITLE}</td>
        </tr>
        <tr>
            <td colspan="2" class="{PLUGIN_PR_ODDEVEN}">{PLUGIN_PR_TEXT}</td>
        </tr>
        <tr>
            <td class="{PLUGIN_PR_ODDEVEN}"><div class="desc">{PHP.L.plu_last_date}: {PLUGIN_PR_TIME}</div></td>
            <td class="{PLUGIN_PR_ODDEVEN}"><div class="desc">{PHP.L.plu_section}: {PLUGIN_PR_CATEGORY}</div></td>
        </tr>
    <!-- END: ITEM -->
    </table>
  <!-- END: EASY_PAGES_RESULTS -->

  <!-- BEGIN: EASY_FORUMS_RESULTS -->
    <table class="cells">
        <tr>
            <td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.plu_tabs_frm} ({PLUGIN_EASY_FORUM_FOUND})
            </td>
        </tr>
        <!-- BEGIN: ITEM -->
        <tr>
            <td colspan="2" class="{PLUGIN_FR_ODDEVEN}">{PLUGIN_FR_TITLE}</td>
        </tr>
        <tr>
            <td colspan="2" class="{PLUGIN_FR_ODDEVEN}">{PLUGIN_FR_TEXT}</td>
        </tr>
        <tr>
            <td class="{PLUGIN_FR_ODDEVEN}"><div class="desc">{PHP.L.plu_last_date}: {PLUGIN_FR_TIME}</div></td>
            <td class="{PLUGIN_FR_ODDEVEN}"><div class="desc">{PHP.L.plu_section}: {PLUGIN_FR_CATEGORY}</div></td>
        </tr>
        <!-- END: ITEM -->
    </table>
    <div class="bCap"></div>
    <!-- END: EASY_FORUMS_RESULTS -->

                  <!-- BEGIN: PAGES_RESULTS -->
    <div class="tCap"></div>
    <table class="cells">
        <tr>
            <td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.plu_tabs_pag}
            </td>
        </tr>
        <!-- BEGIN: ITEM -->
        <tr>
            <td colspan="2" class="{PLUGIN_PR_ODDEVEN}">{PLUGIN_PR_TITLE}</td>
        </tr>
        <tr>
            <td colspan="2" class="{PLUGIN_PR_ODDEVEN}">{PLUGIN_PR_TEXT}</td>
        </tr>
        <tr>
            <td class="{PLUGIN_PR_ODDEVEN}"><div class="desc">{PHP.L.plu_last_date}: {PLUGIN_PR_TIME}</div></td>
            <td class="{PLUGIN_PR_ODDEVEN}"><div class="desc">{PHP.L.plu_section}: {PLUGIN_PR_CATEGORY}</div></td>
        </tr>
        <!-- END: ITEM -->
    </table>
    <div class="bCap"></div>
    <div style='margin:5px 0 30px 0'>{PLUGIN_PAGE_FOUND}</div>
    <!-- END: PAGES_RESULTS -->

                  <!-- BEGIN: FORUMS_RESULTS -->
    <div class="tCap"></div>
    <table class="cells">
        <tr>
            <td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.plu_tabs_frm}
            </td>
        </tr>
        <!-- BEGIN: ITEM -->
        <tr>
            <td colspan="2" class="{PLUGIN_FR_ODDEVEN}">{PLUGIN_FR_TITLE}</td>
        </tr>
        <tr>
            <td colspan="2" class="{PLUGIN_FR_ODDEVEN}">{PLUGIN_FR_TEXT}</td>
        </tr>
        <tr>
            <td class="{PLUGIN_FR_ODDEVEN}"><div class="desc">{PHP.L.plu_last_date}: {PLUGIN_FR_TIME}</div></td>
            <td class="{PLUGIN_FR_ODDEVEN}"><div class="desc">{PHP.L.plu_section}: {PLUGIN_FR_CATEGORY}</div></td>
        </tr>
        <!-- END: ITEM -->
    </table>
    <div class="bCap"></div>
    <div style='margin:5px 0 30px 0'>{PLUGIN_FORUM_FOUND}</div>
    <!-- END: FORUMS_RESULTS -->
    <div class="pagnav">{PLUGIN_PAGEPREV} {PLUGIN_PAGNAV} {PLUGIN_PAGENEXT}</div>
</div>
<!-- END: MAIN -->


