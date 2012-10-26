// bbflow, menu for markItUp!
for (i = mySettings.markupSet.length - 1; i >= 0 && mySettings.markupSet[i].className != 'mSmilies'; i--)
	;
if (0 == i)
{
	i = mySettings.markupSet.length - 1;
}
mySettings.markupSet.splice(i + 1, 0,
	{separator: '---------------'},
	{name: L.flowmenu, className: 'm_flowmenu',
	dropMenu :[
		{name: L.v_collegehumor,className: 'mv_collegehumor',	replaceWith: '[collegehumor=[![' + L.v_collegehumor_id + ']!]]'},
		{name: L.v_dailymotion,	className: 'mv_dailymotion',	replaceWith: '[dailymotion=[![' + L.v_dailymotion_id + ']!]]'},
		{name: L.v_gamespot,	className: 'mv_gamespot',		replaceWith: '[gamespot=[![' + L.v_gamespot_id + ']!]]'},
		{name: L.v_gametrailers,className: 'mv_gametrailers',	replaceWith: '[gametrailers=[![' + L.v_gametrailers_id + ']!]]'},
		{name: L.v_googlevideo,	className: 'mv_googlevideo',	replaceWith: '[googlevideo[![' + L.v_googlevideo_id + ']!]]'},
		{name: L.v_metacafe,	className: 'mv_metacafe',		replaceWith: '[metacafe=[![' + L.v_metacafe_id + ']!].swf]'},
		{name: L.v_rutube,		className: 'mv_rutube',			replaceWith: '[rutube=[![' + L.v_rutube_id + ']!]]'},
		{name: L.v_spike,		className: 'mv_spike',			replaceWith: '[spike=[![' + L.v_spike_id + ']!]]'},
		{name: L.v_veoh,		className: 'mv_veoh',			replaceWith: '[veoh=[![' + L.v_veoh_id + ']!]]'},
		{name: L.v_videomailru,	className: 'mv_videomailru',	replaceWith: '[videomailru=[![' + L.v_videomailru_id + ']!]]'},
		{name: L.v_yahoovideo,	className: 'mv_yahoovideo',		replaceWith: '[yahoovideo=[![' + L.v_yahoovideo_id + ']!]]'},
		{name: L.v_youtube,		className: 'mv_youtube',		replaceWith: '[youtube=[![' + L.v_youtube_id + ']!]]'}
	]}
);