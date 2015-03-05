<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮件测试</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script type="text/javascript">
$(function(){
	$('#send_test_email').click(send_test_email);
});
function send_test_email(){
	var email_type = $('input[name="email_type"]:checked').val();
	var email_ssl = $('input[name="email_ssl"]:checked').val();
	$.ajax({
		url:"index.php",
		type:"GET",
		data:'c=test_mail&a=ajax_send_test_email&email_type='+email_type+'&email_host='+$("#email_host").val()+'&email_port='+$("#email_port").val()+'&email_addr='+$("#email_addr").val()+'&email_id='+$("#email_id").val()+'&email_pass='+$("#email_pass").val()+'&email_test='+$("#email_test").val()+'&email_ssl='+email_ssl,
		dataType:"json",
		success:function(data){
			if(data.done){
				alert(data.msg);
			}
			else{
				alert(data.msg);
			}
		},
		error: function(){alert('测试邮件发送失败，请重新配置邮件服务器');}
	});
}
</script>
<div id="err"></div>
<div id="warp">
	<div id="top">
		<p>邮件测试</p>
	</div>
	<div class="content">
		<form method="post" enctype="multipart/form-data">
			<table class="infoTable">
				<tbody>
					<tr>
						<th class="paddingT15"> <label for="email_type">邮件发送方式:</label></th>
						<td class="paddingT15 wordSpacing5"><label>
								<input name="email_type" value="1" checked="checked" type="radio">
								&nbsp;采用其他的SMTP服务</label>
							&nbsp;
							<label>
								<input name="email_type" value="0" type="radio">
								&nbsp;采用服务器内置的Mail服务</label>
							&nbsp;
							<label class="field_notice">如果您选择服务器内置方式则无须填写以下选项</label></td>
					</tr>
					<tr>
						<th class="paddingT15">邮件服务器是否要求加密连接(SSL): </th>
						<td class="paddingT15 wordSpacing5"><input name="email_ssl" type="radio" id="email_ssl_0" value="1" checked="checked" />
							否
							<input type="radio" name="email_ssl" value="0" id="email_ssl_1" />
							是
							<label class="field_notice"></label></td>
					</tr>
					<tr>
						<th class="paddingT15"> SMTP 服务器:</th>
						<td class="paddingT15 wordSpacing5"><input class="infoTableInput" id="email_host" name="email_host" value="smtp.163.com" type="text">
							<label class="field_notice">设置 SMTP 服务器的地址</label></td>
					</tr>
					<tr>
						<th class="paddingT15"> SMTP 端口:</th>
						<td class="paddingT15 wordSpacing5"><input class="infoTableInput" id="email_port" name="email_port" value="25" type="text">
							<label class="field_notice">设置 SMTP 服务器的端口，默认为 25；Gmail为 465</label></td>
					</tr>
					<tr>
						<th class="paddingT15"> 发信人邮件地址:</th>
						<td class="paddingT15 wordSpacing5"><input class="infoTableInput" id="email_addr" name="email_addr" value="zy73122@163.com" type="text">
							<label class="field_notice">如果 SMTP 服务器要求身份验证，必须为本服务器的邮件地址</label></td>
					</tr>
					<tr>
						<th class="paddingT15"> SMTP 身份验证用户名:</th>
						<td class="paddingT15 wordSpacing5"><input class="infoTableInput" id="email_id" name="email_id" value="zy73122" type="text"></td>
					</tr>
					<tr>
						<th class="paddingT15"> SMTP 身份验证密码:</th>
						<td class="paddingT15 wordSpacing5"><input class="infoTableInput" id="email_pass" name="email_pass" value="" type="password"></td>
					</tr>
					<tr>
						<th class="paddingT15"> 测试邮件地址:</th>
						<td class="paddingT15 wordSpacing5"><input class="infoTableInput" id="email_test" name="email_test" value="zy73122@163.com" type="text">
							&nbsp;&nbsp;
							<input id="send_test_email" class="formbtn" name="send_test_email" value="测试" type="button"></td>
					</tr>
					<tr>
						<th></th>
						<td class="ptb20"><input class="formbtn" name="Submit" value="提交" type="submit">
							<input class="formbtn" name="Submit2" value="重置" type="reset"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div id="footer">Copyright 2003-2009 Wzv Inc.,All rights reserved.</div>
</div>
</body>
</html>