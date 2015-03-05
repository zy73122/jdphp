<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<script type="text/javascript">
  _editor_url = "{{$url}}lib/editors/htmlarea/";
  _editor_lang = "en";
</script>
<script type="text/javascript" src="{{$url}}lib/editors/htmlarea/htmlarea.js"></script>
<script type="text/javascript">
var editor = null;
function initEditor() {
  editor = new HTMLArea("ta");

  // comment the following two lines to see how customization works
  editor.generate();
  return false;
}

</script>

<style type="text/css">
html, body {
  font-family: Verdana,sans-serif;
  background-color: #fea;
  color: #000;
}
a:link, a:visited { color: #00f; }
a:hover { color: #048; }
a:active { color: #f00; }

textarea { background-color: #fff; border: 1px solid 00f; }
</style>

</head>

<body onLoad="initEditor()">
<form action="{{url avg='?c=test_htmlarea&a=doPost'}}" method="post">

<textarea id="ta" name="ta" style="width:100%" rows="20" cols="80">ssss
</textarea>

<input type="submit" name="ok" value="  submit  " />
</form>
</body>
</html>
