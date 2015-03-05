<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="{{$url}}lib/editors/fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$url}}lib/editors/fckeditor/fckeditor.js"></script>
<script type="text/javascript">
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
var sBasePath = '{{$url}}lib/editors/fckeditor/' ;

var oFCKeditor = new FCKeditor( 'FCKeditor_Basic' ) ;
oFCKeditor.Config['ToolbarStartExpanded'] = true ; //是否展开工具栏
oFCKeditor.BasePath		= sBasePath ;

var sSkin = 'default'; //default, office2003, silver, mac
var sLang = 'zh-cn'; //zh-cn, zh, en...
var sToolbar = 'Mine'; //Basic,Default,Mine

//工具栏设置
if (sToolbar.length!=-1)
{
	// Set the custom configurations file path (in this way the original file is mantained).
	oFCKeditor.Config['CustomConfigurationsPath'] = sBasePath + 'mine.config.js' ;
	// Let's use a custom toolbar for this sample.
	oFCKeditor.ToolbarSet	= sToolbar ;
}

//皮肤选择
if (sSkin.length!=-1)
{
	var sSkinPath = sBasePath + 'editor/skins/'+sSkin+'/' ;
	oFCKeditor.Config['SkinPath'] = sSkinPath ;
	oFCKeditor.Config['PreloadImages'] =
			sSkinPath + 'images/toolbar.start.gif' + ';' +
			sSkinPath + 'images/toolbar.end.gif' + ';' +
			sSkinPath + 'images/toolbar.buttonbg.gif' + ';' +
			sSkinPath + 'images/toolbar.buttonarrow.gif' ;
}
//

//语言选择
if (sSkin.length!=-1)
{
	oFCKeditor.Config["AutoDetectLanguage"] = false ;	//
	oFCKeditor.Config["DefaultLanguage"]	= sLang ;   //
}
else
{
	oFCKeditor.Config["AutoDetectLanguage"] = true ;
	oFCKeditor.Config["DefaultLanguage"]	= "en" ;
}
//

oFCKeditor.Value		= '<p>This is some <strong>sample text<\/strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor<\/a>.<\/p>' ;
oFCKeditor.Create() ;
</script>

</head>

<body>
<a href="{{url avg='?c=test_js&a=fckeditor&loadtype=html'}}">html方式载入</a>
<a href="{{url avg='?c=test_js&a=fckeditor&loadtype=php'}}">php方式载入</a>
</body>
</html>
