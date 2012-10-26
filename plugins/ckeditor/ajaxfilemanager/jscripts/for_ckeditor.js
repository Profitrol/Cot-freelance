//function below added by logan (cailongqun [at] yahoo [dot] com [dot] cn) from www.phpletter.com
function selectFile(url)
{
	var selectedFileRowNum = $('#selectedFileRowNum').val();
  if(selectedFileRowNum != '' && $('#row' + selectedFileRowNum))
  {

	  // insert information now
	  var CKEditorFuncNum = window.location.href.replace(/.*CKEditorFuncNum=(\d+).*/,"$1")||alert('Error: lost CKEditorFuncNum param from url'+window.location.href)||1;
      window.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, url);
	  window.close() ;
		
  }else
  {
  	alert(noFileSelected);
  }
  

}



function cancelSelectFile()
{
  // close popup window
  window.close() ;
}