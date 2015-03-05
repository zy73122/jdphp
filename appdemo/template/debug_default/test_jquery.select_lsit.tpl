<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="{{$url}}static/css/common.css" rel="stylesheet" type="text/css" />
<style type="text/css">
ul.selecttype {
	list-style:none;
	margin:0;
	padding:0 5px;
	border:1px solid #C3AA6F;
	width:180px;
	height:250px
}
ul.selecttype li {
	display:block;
	width:100%;
}
#widget_gx1 {
	width:12px;
	height:12px;
	display:inline-block;
	position:relative;
	left:120px;
	top:2px;
	background:url(static/images/gx.gif) no-repeat 0px 0px;
}
#widget_gx2 {
	width:12px;
	height:12px;
	display:inline-block;
	position:relative;
	left:120px;
	top:2px;
	background:url(static/images/gx.gif) no-repeat 0px -38px
}
</style>
<title>无标题文档</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
</head>

<body>
<form action="{{url avg='?c=test_js&a=onSubmitSelectTypeList'}}" method="post">
<div  style="width:400px">
	<div class="left">
		<ul id="sel1" class="selecttype">
			<li value="1">lsiaj1</li>
			<li value="2">lsiaj2</li>
			<li value="3">lsiaj3</li>
		</ul>
		<input type="hidden" name="sel1" />
		<input type="button" name="button1" id="button1" value="sel1的值" />
	</div>
	<div class="right">
		<ul id="sel2" class="selecttype">
			<li value="4">asiaj1</li>
			<li value="5">asiaj2</li>
			<li value="6">asiaj3</li>
		</ul>
	</div>
</div>
<input type="submit" name="button" id="button" value="提交" />
</form>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	//初始化
	twinSelect.init('sel1', 'sel2');//id

	//获取sel1的值
	$('#button1').click(function(){
		var selvaule = twinSelect.getValue('sel1');
		$('input[name="sel1"]').val(selvaule);
		alert($('input[name="sel1"]').val());
	});
	$('#button').click(function(){
		var selvaule = twinSelect.getValue('sel1');
		$('input[name="sel1"]').val(selvaule);
		alert($('input[name="sel1"]').val());
	});
});

<!--两个相关的类似Select的列表-->
var twinSelect = (function (){
	var selNameLeft;
	var selNameRight;

	var init = function (sel1, sel2){
		selNameLeft = sel1;
		selNameRight = sel2;

		$('#'+sel1+' li').mouseover(twinSelect.onMouseover);
		$('#'+sel1+' li').mouseout(twinSelect.onMouseout);
		$('#'+sel1+' li').click(twinSelect.onClick);
		$('#'+sel2+' li').mouseover(twinSelect.onMouseover);
		$('#'+sel2+' li').mouseout(twinSelect.onMouseout);
		$('#'+sel2+' li').click(twinSelect.onClick);

	}
	var onMouseover = function (){
		$(this).css({'background':'#efefef'});
		if ($(this).parent().attr('id')==selNameLeft)
		{
			$(this).append("<span id='widget_gx1'></span>");
		}
		else
		{
			$(this).append("<span id='widget_gx2'></span>");
		}
	};
	var onMouseout = function (){
		$(this).css({'background':'#fff'});
		$(this).children().remove();
	};
	var onClick = function (){
		$(this).css({'background':'#fff'});
		$(this).children().remove();
		if ($(this).parent().attr('id')==selNameLeft)
		{
			$('#'+selNameRight).append($(this));
		}
		else
		{
			$('#'+selNameLeft).append($(this));
		}
	};
	var getValue = function (id){
		if($('#'+id).length<=0)
			return '';
		var selvaule = '';
		$('#'+id).children('li').each(function (){
			if (selvaule!='')
			{
				selvaule += ',';
			}
			selvaule += $(this).attr('value');
		});
		return selvaule;
	};
	return {
		init:init,
		onMouseover:onMouseover,
		onMouseout:onMouseout,
		onClick:onClick,
		getValue:getValue
	};

})();
<!--两个相关的类似Select的列表end-->


</script>