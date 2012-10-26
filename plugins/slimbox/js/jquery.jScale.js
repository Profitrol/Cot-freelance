/* jScale Image Scaler v1.0
* Last updated: Feb 18th, 2009. This notice must stay intact for usage 
* Author: JavaScript Kit at http://www.javascriptkit.com/
* Modified: Kilandor for Cotonti Plugin
* Visit http://www.javascriptkit.com/script/script2/jScale/ for full source code
*/

jQuery.jScale={
	getnewSize:function(side, nvalue){
		var otherside=(side=="w")? "h" : "w"
		var odim = this.odimensions[side]
		var odim2 = this.odimensions[otherside]
		var ndim = this.ndimensions[otherside]
		if(odim > parseInt(nvalue))
		{
			if (typeof nvalue=="undefined" || nvalue==null) //if this side has no explicit size set, scale it
				var newSize=this.ndimensions[otherside] * this.odimensions[side] / this.odimensions[otherside]
			else
				var newSize=(/%/.test(nvalue))? parseInt(nvalue)/100 * this.odimensions[side] : parseInt(nvalue)
			this.ndimensions[side]=Math.round(newSize)
		}
		else if(odim2 != ndim && ndim != "undefined" && ndim != null)
		{
			if (typeof nvalue=="undefined" || nvalue==null) //if this side has no explicit size set, scale it
				var newSize=this.ndimensions[otherside] * this.odimensions[side] / this.odimensions[otherside]
			else
				var newSize=(/%/.test(nvalue))? parseInt(nvalue)/100 * this.odimensions[side] : parseInt(nvalue)
			this.ndimensions[side]=Math.round(newSize)
		}
		else
		{
			this.ndimensions[side]=odim
		}
	},
	getnewDimensions:function($, imgref, setting, callback){
 		//create temporary floating image to get original image's true dimensions (in case width/height attr set)
		var $tempimg=$('<img src="'+imgref.src+'" style="position:absolute; top:0; left:0; visibility:hidden" />').prependTo('body')
		this.odimensions={w:$tempimg.width(), h:$tempimg.height()} //get image dimensions
		var sortbysize=(this.odimensions.w>this.odimensions.h)? ["w","h"] : ["h","w"] //array to determine [largerside, shorterside]
		this.ndimensions={}
		if (typeof setting.ls!="undefined"){ //if setting.ls defined
			setting[sortbysize[0]]=setting.ls //set the correct side to the longest side's value setting
			setting[sortbysize[1]]=null
		}
		var sortbyavail=(typeof setting.w!="undefined")? ["w","h"] : (typeof setting.h!="undefined")? ["h","w"] : [] //check which side to work on based on availibility (which property is set by user)
		if (sortbyavail.length>0){
			this.getnewSize(sortbyavail[0], setting[sortbyavail[0]]) //work on side with property that's defined for sure first
			this.getnewSize(sortbyavail[1], setting[sortbyavail[1]]) //work on side with property that may or may not be defined last
			var callbackfunc=callback || function(){}
			if (setting.speed>0)
				$(imgref).animate({width:this.ndimensions.w+'px', height:this.ndimensions.h+'px'}, setting.speed, callbackfunc)
			else{
				$(imgref).css({width:this.ndimensions.w+'px', height:this.ndimensions.h+'px'})
				callbackfunc.call(imgref)
			}
		}
		$tempimg.remove()
	}
};

jQuery.fn.jScale=function(setting, callback){
	return this.each(function(){ //return jQuery obj
		var imgref=this
		if (typeof setting=="undefined" || imgref.tagName!="IMG")
			return true //skip to next matched element
		if (imgref.complete){ //account for IE not firing image.onload
			jQuery.jScale.getnewDimensions(jQuery, imgref, setting, callback)
		}
		else{
			$(this).bind('load', function(){
				jQuery.jScale.getnewDimensions(jQuery, imgref, setting, callback)
			})
		}
	})
};