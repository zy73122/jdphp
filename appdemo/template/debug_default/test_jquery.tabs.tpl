<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{$url}}static/js/_jsvar.js"></script>
<script type="text/javascript" src="{{$url}}static/js/common.js"></script>
<!--jquery.tabs-->
<script src="{{$url}}static/other/jquery.tabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="{{$url}}static/other/jquery.tabs/jquery.tabs.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });
});
</script>
<link rel="stylesheet" href="{{$url}}static/other/jquery.tabs/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="{{$url}}static/other/jquery.tabs/jquery.tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->
<!--jquery.tabs end-->

</head>

<body>
<div id="container-4">
			<ul>
				<li><a href="#fragment-10"><span>One</span></a></li>
				<li><a href="#fragment-11"><span>Two</span></a></li>
				<li><a href="#fragment-12"><span>Three</span></a></li>
			</ul>
			<div id="fragment-10">
				<p>
					Use a fade effect to switch tabs.
					You can optionally specify the speed for the animation with the option <code>fxSpeed: value</code>.
					The value is either a string of one of the predefined speeds in jQuery (<code>slow</code>,
					<code>normal</code>, <code>fast</code>) or an integer value specifying the duration for the animation
					in milliseconds. If omitted it defaults to <code>normal</code>.
				</p>
				<pre><code>$(&#039;#container&#039;).tabs({ fxFade: true, fxSpeed: 'fast' });</code></pre>
			</div>
			<div id="fragment-11">
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
			</div>
			<div id="fragment-12">
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
			</div>
		</div>
</body>
</html>
