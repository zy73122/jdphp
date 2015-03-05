//提示文件效果
//message.loading();
//message.unloading();
//message.show_message_result('淡入淡出显示文字');
var message = (function(){
	
	//在调用ajax处理之前，先调用这个，以显示事务正在处理
	function loading()
	{
		dialog_loading = $.jdDialog({
			//content: '',
			type: 'loading2' //loading,loading2,loading3
		});
		dialog_loading.show();
	};
	
	function unloading()
	{
		dialog_loading.close();
	};

	/*
	//在调用ajax处理之前，先调用这个，以显示事务正在处理
	function loading()
	{
		if ($('#msg_clew').length <= 0)
		$(document.body).prepend('<div id="msg_clew">A</div>');
		
		$('#msg_clew').html("<img src='static/images/loading.gif' align='absmiddle' /> &nbsp;&nbsp;&nbsp;&nbsp;正在处理中");
		$('#msg_clew').fadeIn('fast');
	};
	
	function unloading()
	{
		if ($('#msg_clew').length > 0)
		{
			$('#msg_clew').hide();
			$('#msg_clew').remove();
		}
	};
	*/
	
	//ajax成功处理后，调用这个，以显示处理结果
	function show_message_result(msg)
	{
		//淡入淡出显示文字
		if ($('#msg_clew').length <= 0)
		$(document.body).prepend('<div id="msg_clew">V</div>');
	
		$('#msg_clew').html("<img src='"+jsvar.url+"static/images/msg.gif' align='absmiddle' /> &nbsp;&nbsp;&nbsp;&nbsp;"+ msg);
		$('#msg_clew').fadeIn('slow');
		setTimeout(function(){
			$('#msg_clew').fadeOut('slow');
			$('#msg_clew').remove();
		},3500);
	};
	
	function myalert(msg)
	{
		var dlg = $.jdDialog({
			title: '提示',
			content: msg,
			width: '370px', //'500px'
			height: 'auto', //'350px'
			textalign: 'center',//可不设置
			buttons: {
				'确 认': function() {
					dlg.close();
				}
			}
		});
		dlg.show();
	};
	
	return {	
		loading: loading,
		unloading: unloading,
		show_message_result: show_message_result,
		alert: myalert
	}
})();


//加入收藏
// <a onclick="javascript:addFavorite(document.title, location.href)">加入收藏</a>
function addFavorite(title, url){

	if (document.all) {
		window.external.AddFavorite(url, title);
	} else if (window.sidebar) {
		window.sidebar.addPanel(title, url, "")
	}
}

//设置首页
//<a onClick="setHomepage()">设为首页</a>
function setHomepage()
{
	if (document.all)
	{
		document.body.style.behavior='url(#default#homepage)';
		document.body.setHomePage(location.href);
	}
	else if (window.sidebar)
	{
		if(window.netscape)
		{
			try
			{ 
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); 
			} 
			catch (e) 
			{ 
				alert( "该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true" ); 
			}
		}
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
		prefs.setCharPref('browser.startup.homepage',location.href);
	}
}

//copyToClipboard 
function copy(txt) {
	 if(window.clipboardData) {
		window.clipboardData.clearData();
		window.clipboardData.setData("Text", txt);
	 } else if(navigator.userAgent.indexOf("Opera") != -1) {
			window.location = txt;
	 } else if (window.netscape) {
		try {
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
		} catch (e) {
			alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");
		}
		var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
		if (!clip)
			return;
		var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
		if (!trans)
			return;
		trans.addDataFlavor('text/unicode');
		var str = new Object();
		var len = new Object();
		var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
		var copytext = txt;
		str.data = copytext;
		trans.setTransferData("text/unicode",str,copytext.length*2);
		var clipid = Components.interfaces.nsIClipboard;
		if (!clip)
		return false;
		clip.setData(trans,null,clipid.kGlobalClipboard);
	 }
} 
//重写alert
//window._alert = window.alert;
//window.alert = function(msg){
//	$.jdDialog({
//		title: '提示',
//		content: msg,
//		width: '360px',
//		height: '130px'
//	}).show();
//};

//jquery1.9，不支持browser对象
(function(jQuery){
	if(jQuery.browser) return;
	jQuery.browser = {};
	jQuery.browser.mozilla = false;
	jQuery.browser.webkit = false;
	jQuery.browser.opera = false;
	jQuery.browser.msie = false;

	var nAgt = navigator.userAgent;
	jQuery.browser.name = navigator.appName;
	jQuery.browser.fullVersion = ''+parseFloat(navigator.appVersion);
	jQuery.browser.majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;

	// In Opera, the true version is after "Opera" or after "Version"
	if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
	jQuery.browser.opera = true;
	jQuery.browser.name = "Opera";
	jQuery.browser.fullVersion = nAgt.substring(verOffset+6);
	if ((verOffset=nAgt.indexOf("Version"))!=-1)
	jQuery.browser.fullVersion = nAgt.substring(verOffset+8);
	}
	// In MSIE, the true version is after "MSIE" in userAgent
	else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	jQuery.browser.msie = true;
	jQuery.browser.name = "Microsoft Internet Explorer";
	jQuery.browser.fullVersion = nAgt.substring(verOffset+5);
	}
	// In Chrome, the true version is after "Chrome"
	else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	jQuery.browser.webkit = true;
	jQuery.browser.name = "Chrome";
	jQuery.browser.fullVersion = nAgt.substring(verOffset+7);
	}
	// In Safari, the true version is after "Safari" or after "Version"
	else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	jQuery.browser.webkit = true;
	jQuery.browser.name = "Safari";
	jQuery.browser.fullVersion = nAgt.substring(verOffset+7);
	if ((verOffset=nAgt.indexOf("Version"))!=-1)
	jQuery.browser.fullVersion = nAgt.substring(verOffset+8);
	}
	// In Firefox, the true version is after "Firefox"
	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	jQuery.browser.mozilla = true;
	jQuery.browser.name = "Firefox";
	jQuery.browser.fullVersion = nAgt.substring(verOffset+8);
	}
	// In most other browsers, "name/version" is at the end of userAgent
	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
	(verOffset=nAgt.lastIndexOf('/')) )
	{
	jQuery.browser.name = nAgt.substring(nameOffset,verOffset);
	jQuery.browser.fullVersion = nAgt.substring(verOffset+1);
	if (jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()) {
	jQuery.browser.name = navigator.appName;
	}
	}
	// trim the fullVersion string at semicolon/space if present
	if ((ix=jQuery.browser.fullVersion.indexOf(";"))!=-1)
	jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix);
	if ((ix=jQuery.browser.fullVersion.indexOf(" "))!=-1)
	jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix);

	jQuery.browser.majorVersion = parseInt(''+jQuery.browser.fullVersion,10);
	if (isNaN(jQuery.browser.majorVersion)) {
	jQuery.browser.fullVersion = ''+parseFloat(navigator.appVersion);
	jQuery.browser.majorVersion = parseInt(navigator.appVersion,10);
	}
	jQuery.browser.version = jQuery.browser.majorVersion;
})(jQuery); 


//页面加载常用事件
$(document).ready(function(){
	
	//使用class=btnAjaxSubmit的按钮会绑定这种提交方式
	$('.btnAjaxSubmit').each(function(i){
		var _this = $(this);
		var objform = $(this).parents('form');
		//禁止表单自动提交;
		objform.submit(function(){ return false; });		
		//loading
		var oldval = '';
		var messageSubmit = {
			unloading : function(o, val)
			{
				o.val(oldval);
			},
			loading : function(o)
			{
				oldval = o.val();
				o.val('saving');
			}
		};
		//使用自定义的ajax方式提交表单 jquery.validate
		objform.validate({
			submitHandler: function(form) {
				var posturl = objform.attr('action');
				//增加ajax时，处理方会启用rest::sendResponse方式返回json结果
				if (posturl.indexOf('?') != -1) {
					posturl += '&' + 'ajax=1';
				} else {
					posturl += '?' + 'ajax=1';
				}
				$.ajax({
					url:posturl,
					type:'post',
					dataType:'json',
					data:objform.serialize(),
					beforeSend: function() {
						messageSubmit.loading(_this);
					},
					complete:function() {
						messageSubmit.unloading(_this);
					},
					error:function(XMLHttpRequest ,textStatus, errorThrown){
						//alert(XMLHttpRequest.status); //responseCode
						//alert(XMLHttpRequest.responseText); //responseBody
						message.alert('服务端响应：'+XMLHttpRequest.status +', 响应内容：'+XMLHttpRequest.responseText);
						//如果是返回json格式的话
						//var data = eval('('+XMLHttpRequest.responseText+')');
						//alert(data.msg);
					},
					success:function(json){
						if (!json || typeof(json) != 'object') {
							message.alert('提交失败');
						} else {
							message.alert(json.msg);
						}
						//alert(json.msg);
					}
				});
			}
		});
	});
		 
	/*
	//禁止表单自动提交
	$('.btnAjaxSubmit').each(function(i){
		var objform = $(this).parents('form');
		objform.submit(function(){ return false; });
	});
	//表单ajax提交
	$('.btnAjaxSubmit').click(function(){
		var _this = $(this);
		var message = {
			unloading : function(o, val)
			{
				o.html('');
			},
			loading : function(o)
			{
				o.html('saving');
			}
		};
		$.ajax({
			url:objform.attr('action'),
			type:'post',
			dataType:'json',
			data:objform.serialize(),
			beforeSend: function() {
				message.loading(_this);
			},
			error:function(XMLHttpRequest ,textStatus, errorThrown){
				message.unloading(_this);
				alert(XMLHttpRequest.status); //responseCode
				alert(XMLHttpRequest.responseText); //responseBody
				//如果是返回json格式的话
				//var data = eval('('+XMLHttpRequest.responseText+')');
				//alert(data.msg);
			},
			success:function(json){
				alert(2);
				//alert(json.msg);
			}
		});
	});
	*/
	
});