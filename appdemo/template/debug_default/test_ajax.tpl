<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(function(){
/*	$.get('http://www.baidu.com/',
		function(data){
			$('#cont1').hide()
			.html(data)
			.fadeIn('slow');
		}); */


		/*
			$.ajax({
				url:"?m=cms&a=article_desc&id=1", 
				type:'GET', 
				dataType:'script', 
				success:function(data){
					$('#cont1').css({'display':'none'})
					.html(data)
					.fadeIn('slow');
				}
			});*/



});
</script>
</head>

<body>
<p id="cont1"><img name="" src="{{$url}}static/images/loading.gif" width="16" height="16" alt="loading" /></p>
</body>
</html>
