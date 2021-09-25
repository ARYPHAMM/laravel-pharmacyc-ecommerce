/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// 
		// Define changes to default configuration here. For example:
	// config.uiColor = '#AADC6E';
	config.language = 'vi';
	// config.extraPlugins = 'youtube,widget,btgrid,bt_table,blockquote,glyphicons,emojione,btbutton,lineutils';
	// config.extraPlugins = 'youtube,widget,btgrid,bt_table,blockquote,glyphicons,emojione,btbutton,lineutils,simpleImageUpload,simpleImagesUpload';

	// config.uploadUrl = '../assets/ckeditor/upload.php'; // Kèm theo plugin simpleImageUpload
	// config.extraPlugins = 'simpleImageUpload';

	config.youtube_width = '500';
	config.youtube_height = '480';
	config.youtube_related = true;
	config.youtube_older = false;
	config.youtube_privacy = false;

	config.allowedContent = true;
	config.bootstrapTab_managePopupContent = true;
	config.mj_variables_allow_html = false;
	config.image_removeLinkByEmptyURL = false;

	// config.filebrowserBrowseUrl = '../app/assets/ckfinder/ckfinder.html';
	// config.filebrowserImageBrowseUrl = '../app/assets/ckfinder/ckfinder.html?Type=Images';
	// config.filebrowserFlashBrowseUrl = '../app/assets/ckfinder/ckfinder.html?Type=Flash';
	// config.filebrowserUploadUrl = '../app/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	// config.filebrowserImageUploadUrl = '../app/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	// config.filebrowserFlashUploadUrl = '../app/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
