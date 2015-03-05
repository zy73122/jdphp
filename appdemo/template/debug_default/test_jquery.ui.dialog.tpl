<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
h1, h2, h3, h4, h5, h6, p, ul, ol, dl, dt, dd, li, body, form, input, button, img, cite, strong, em, table, td, th {
	margin:0;
	padding:0;
}
.widget_config_form_body {
	padding:0 10px;
}
.widget_config_form_body .field_item {
	border-bottom:1px dotted #DDDDDD;
	padding:5px;
}
.widget_config_form_body .field_item label {
	color:#888888;
	display:block;
	font-weight:bold;
	padding:5px 0;
}
.widget_config_form_body .field_item label span {
	color:#888888;
	font-style:italic;
	font-weight:normal;
}
</style>

<script type="text/javascript">
$(function(){



		$('input[type="submit"]').click(function(){

			var d = DialogManager.get('id_0903');
			d.hide();

			/* 显示loading... */
			var _sd = DialogManager.create('config_submitting');
			_sd.setWidth(270);
			_sd.setTitle('提交中...');
			_sd.setContents('loading', {text:'submitting...'});
			_sd.show('center');

			/* 关闭对话框时同时关闭loading对话框 */
			d.onClose = function(){
				DialogManager.close('config_submitting');
			};

			/* 提交数据 */
			$.post('/jdphp/static/other/ecmall_dialog/dialog_test.php', $('#_config_widget_form_').serialize(), function(data){
				DialogManager.close('id_0903');
			});

		});


//	$('#_config_widget_form_').submit(function(){
//		var d = DialogManager.get('id_0903');
//		d.hide();
//		DialogManager.close('id_0903');
//
//		/* 显示loading... */
//		var _sd = DialogManager.create('config_submitting');
//		_sd.setWidth(270);
//		_sd.setTitle('提交中...');
//		_sd.setContents('loading', {text:'submitting...'});
//		_sd.show('center');
//
//		/* 关闭对话框时同时关闭loading对话框 */
//		d.onClose = function(){
//			DialogManager.close('config_submitting');
//
//			return true;
//		};
//
//		return true;
//	});
//

});
</script>
</head>

<body>
<div class="widget_config_form">
	<form enctype="multipart/form-data" method="post">
		<div class="widget_config_form_body">
			<div class="field_item">
				<label>广告起始日期: (<span>选填，留空为不限制起始日期，格式 2009-10-01</span>)</label>
				<p>
					<input class="hasDatepicker" id="start_date" name="start_date" value="" type="text">
				</p>
			</div>
			<div class="field_item">
				<label>广告结束日期: (<span>选填，留空为不限制结束日期，格式 2009-10-01</span>)</label>
				<p>
					<input class="hasDatepicker" id="end_date" name="end_date" value="" type="text">
				</p>
			</div>
			<div class="field_item">
				<label>展现方式:</label>
				<p>
					<select id="style" name="style" onchange="changeTo(this.value)">
						<option value="code" selected="selected">代码</option>
						<option value="text">文字</option>
						<option value="image">图片</option>
						<option value="flash">Flash</option>
					</select>
				</p>
			</div>
			<div style="display: block;" class="field_item ecstyle" ectype="code">
				<label>广告 HTML 代码:</label>
				<p>
					<textarea name="html" style="width: 290px; height: 120px;"></textarea>
				</p>
			</div>
		</div>
		<div class="dialog_buttons_bar" style="margin-top: 20px;">
			<input class="btn1" value="提交" type="submit">
			<input class="btn2" value="重置" type="reset">
		</div>
	</form>
</div>
</body>
</html>
