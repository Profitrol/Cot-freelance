<!-- BEGIN: MAIN -->

{PFSVIEW_HEADER1}

<link href="skins/{PHP.skin}/{PHP.theme}.css" type="text/css" rel="stylesheet" />

{PFSVIEW_HEADER2}

<div id="pfsHeader">
	<div id="pfsBack"><a href="javascript:history.go(-1)"> [Go Back]</a></div>
	<div id="pfsTitle">{PFSVIEW_FILE_DESC}</div>
	<div><strong>{PHP.skinlang.pfs.Dimensions}:</strong> {PFSVIEW_FILE_SIZEX} x {PFSVIEW_FILE_SIZEY}</div>
	<div><strong>{PHP.L.Size}:</strong> {PFSVIEW_FILE_SIZE} {PHP.L.kb}</div>
	<div><strong>{PHP.L.Owner}:</strong> {PFSVIEW_FILE_USERNAME}</div>
</div>
<div id="pfsImage">{PFSVIEW_FILE_IMAGE}</div>

{PFSVIEW_FOOTER}

<!-- END: MAIN -->