/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
	config.autoUpdateElement = true;  // defaul - true; :) 
	config.colorButton_enableMore = true;   // default - false
    config.skin = 'office2003';

	config.toolbar_Administrator =
    [
        ['Source'],['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt','Undo','Redo'],['Find','Replace','-','SelectAll','RemoveFormat'],
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Link','Unlink','Anchor','TextColor','BGColor'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','Styles'],['Format','Font','FontSize']

    ];

        config.toolbar = 'Administrator';

};
