<script type="text/javascript">
var _d = DialogManager.get('config_dialog');
_d.setWidth(350);
_d.setPosition('center');

public function changeTo(style)
{
	$(".ecstyle").hide();
	$("[ectype='" + style + "']").show();
}

$(function(){
  $('#start_date').datepicker();
  $('#end_date').datepicker();
  changeTo($('#style').val());
});
</script>
<div class="field_item">
	<label>广告起始日期: (<span>选填，留空为不限制起始日期，格式 2009-10-01</span>)</label>
	<p><input type="text" id="start_date" name="start_date" value="{$options.start_date}" /></p>
</div>
<div class="field_item">
	<label>广告结束日期: (<span>选填，留空为不限制结束日期，格式 2009-10-01</span>)</label>
	<p><input type="text" id="end_date" name="end_date" value="{$options.end_date}" /></p>
</div>
<div class="field_item">
	<label>展现方式:</label>
	<p><select id="style" name="style" onchange="changeTo(this.value)">
		<option value="code"{if $options.style eq "code"}selected="selected"{/if}>代码</option>
		<option value="text"{if $options.style eq "text"}selected="selected"{/if}>文字</option>
		<option value="image"{if $options.style eq "image"}selected="selected"{/if}>图片</option>
		<option value="flash"{if $options.style eq "flash"}selected="selected"{/if}>Flash</option>
	</select></p>
</div>
<div class="field_item ecstyle" ectype="code"{if $options.style neq "code"} style="display:none"{/if}>
	<label>广告 HTML 代码:</label>
	<p><textarea name="html" style="width:290px; height:120px;">{$options.html}</textarea></p>
</div>
<div class="field_item ecstyle" ectype="text"{if $options.style neq "text"} style="display:none"{/if}>
	<label>文字内容: (<span>必填</span>)</label>
	<p><input type="text" name="title" value="{$options.title}" /></p>
</div>
<div class="field_item ecstyle" ectype="text"{if $options.style neq "text"} style="display:none"{/if}>
	<label>文字链接: (<span>必填</span>)</label>
	<p><input type="text" name="link1" value="{$options.link1}" /></p>
</div>
<div class="field_item ecstyle" ectype="text"{if $options.style neq "text"} style="display:none"{/if}>
	<label>文字大小: (<span>选填，可使用 pt、px、em 为单位</span>)</label>
	<p><input type="text" name="size" value="{$options.size}" /></p>
</div>
<div class="field_item ecstyle" ectype="image"{if $options.style neq "image"} style="display:none"{/if}>
	<label>图片地址: (<span>必填</span>)</label>
	<p><input type="text" name="url1" value="{$options.url1}" /></p>
</div>
<div class="field_item ecstyle" ectype="image"{if $options.style neq "image"} style="display:none"{/if}>
	<label>图片链接: (<span>必填</span>)</label>
	<p><input type="text" name="link2" value="{$options.link2}" /></p>
</div>
<div class="field_item ecstyle" ectype="image"{if $options.style neq "image"} style="display:none"{/if}>
	<label>图片宽度: (<span>选填</span>)</label>
	<p><input type="text" name="width1" value="{$options.width1}" /></p>
</div>
<div class="field_item ecstyle" ectype="image"{if $options.style neq "image"} style="display:none"{/if}>
	<label>图片高度: (<span>选填</span>)</label>
	<p><input type="text" name="height1" value="{$options.height1}" /></p>
</div>
<div class="field_item ecstyle" ectype="image"{if $options.style neq "image"} style="display:none"{/if}>
	<label>图片替换文字: (<span>选填</span>)</label>
	<p><input type="text" name="alt" value="{$options.alt}" /></p>
</div>
<div class="field_item ecstyle" ectype="flash"{if $options.style neq "flash"} style="display:none"{/if}>
	<label>Flash 地址: (<span>必填</span>)</label>
	<p><input type="text" name="url2" value="{$options.url2}" /></p>
</div>
<div class="field_item ecstyle" ectype="flash"{if $options.style neq "flash"} style="display:none"{/if}>
	<label>Flash 宽度: (<span>必填</span>)</label>
	<p><input type="text" name="width2" value="{$options.width2}" /></p>
</div>
<div class="field_item ecstyle" ectype="flash"{if $options.style neq "flash"} style="display:none"{/if}>
	<label>Flash 高度: (<span>必填</span>)</label>
	<p><input type="text" name="height2" value="{$options.height2}" /></p>
</div>