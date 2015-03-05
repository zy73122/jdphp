<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{$url}}static/js/_jsvar.js"></script>
<script type="text/javascript" src="{{$url}}static/js/common.js"></script>
<!--jquery-validate-->
<script type="text/javascript" src="{{$url}}static/jquery-validation-1.13.0/dist/jquery.validate.js"></script>
<script type="text/javascript" src="{{$url}}static/jquery-validation-1.13.0/dist/additional-methods.mine.js"></script>
<script type="text/javascript" src="{{$url}}static/jquery-validation-1.13.0/dist/localization/messages_zh.js"></script>
<script type="text/javascript" src="{{$url}}static/js/jquery.metadata.js"></script>
<!--jquery-validate end-->
<!--jdDialog-->
<script type="text/javascript" src="{{$url}}static/jdDialog/jquery.jdDialog.js"></script>
<link href="{{$url}}static/jdDialog/jquery.jdDialog.css" rel="stylesheet" type="text/css" />
<!--jdDialog end-->
<script type="text/javascript">
$(function(){
});
</script>
</head>

<body>
<span id="btnAddAttr">test</span>
<form id="form1" name="form1" method="post" action="{{url avg='?c=test_js&a=jquery_common'}}">
  <input type="text" name="textfield" id="textfield" />
  <input type="submit" name="button" id="button" value="Ajax提交" class="btnAjaxSubmit" />
</form>
</body>
</html>
