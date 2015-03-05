<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
<!--jquery-ui-->
<link href="{{$url}}static/jquery-ui-1.11.0/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$url}}static/jquery-ui-1.11.0/jquery-ui.min.js"></script>
<!--jquery-ui end-->

<script type="text/javascript">
$(function(){

				// Datepicker
/*				$('#datepicker').datepicker({ inline: true });
				$('#datepicker').datepicker(
				'option', {dateFormat: "yy-mm-dd"},
				'option', $.datepicker.regional["zh-CN"]
				);*/


				$('#from').datepicker();
				$('#from').datepicker('option', $.datepicker.regional["zh-CN"]);

				var dates = $('#from, #to').datepicker(
				{
					inline: true,
					dateFormat: "yy-mm-dd",
					defaultDate: "aa",
					changeMonth: true,
					numberOfMonths: 3,
					onSelect: function(selectedDate) {
						var option = this.id == "from" ? "minDate" : "maxDate";
						var instance = $(this).data("datepicker");
						var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
						dates.not(this).datepicker("option", option, date);
					}
				}
				);

});
</script>
<style type="text/css">
body,td,th {
	font-size: 12px;
}
</style>
</head>

<body>

<label for="from">From</label>
<input type="text" id="from" name="from"/>
<label for="to">to</label>
<input type="text" id="to" name="to"/>


</body>
</html>
