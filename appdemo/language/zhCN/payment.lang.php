<?php
return array(
	/* 'code' => '代码',
	'name' => '名称',
	'desc' => '描述',
	'is_cod' => '是否支持货到付款',
	'is_online' => '是否支持在线支付',
	'author' => '作者',
	'website' => '网址',
	'version' => '版本',
	*/
	
	//yeepay
	'yeepay_name' => '易宝支付',
	'yeepay_desc' => "YeePay易宝（北京通融通信息技术有限公司）是专业从事多元化电子支付业务一站式服务的领跑者。在立足于网上支付的同时，YeePay易宝不断创新，将互联网、手机、固定电话整合在一个平台上，继短信支付、手机充值之后，首家推出了YeePay易宝电话支付业务，真正实现了离线支付，为更多传统行业搭建了电子支付的高速公路。YeePay易宝融合世界先进的电子支付文化，聚合众多金融、电信、IT、互联网等领域内的巨擘，旨在通过创新的支付机制，推动中国电子商务新进程。YeePay易宝致力于成为世界一流的电子支付应用和服务提供商，专注于金融增值服务和移动增值服务两大领域，创新并推广多元化、低成本的、安全有效的支付服务。<input type=\"button\" name=\"Submit\" value=\"立即注册\" onclick=\"window.open(\"https://www.yeepay.com/selfservice/AgentService.action?p0_Cmd=AgentRegister&p1_MerId=10000383855&hmac=bd9e7b0f85bddedb105eebb136632772\")\" />",
	'yeepay_merchant' => 'yeepay商户编号',
	'yeepay_key' => 'yeepay商户密钥',
	'yeepay_pay_button' => '立即使用YeePay易宝支付',
	
	//bank
	'bank_name' => '银行汇款/转帐',
	'bank_desc' => '银行名称' . chr(13) .
						'收款人信息：全称 ××× ；帐号或地址 ××× ；开户行 ×××。' . chr(13) .
						'注意事项：办理电汇时，请在电汇单“汇款用途”一栏处注明您的订单号。',
						
					
	//alipay
	'alipay_name' => '支付宝支付',
	'alipay_desc' => '支付宝网站(www.alipay.com) 是国内先进的网上支付平台。<br/>ECShop联合支付宝推出优惠套餐：无预付/年费，单笔费率1.5%，无流量限制。<br/><a href="https://www.alipay.com/himalayas/practicality_customer.htm?customer_external_id=C4335319945672464113&market_type=from_agent_contract&pro_codes=6AECD60F4D75A7FB " target="_blank"><font color="red">立即在线申请</font></a>',
	'alipay_pay_button' => '立即使用支付宝支付',
		
	//paypal
	'paypal_name' => 'PayPal',
	'paypal_desc' => 'PayPal 是在线付款解决方案的全球领导者，在全世界有超过七千一百六十万个帐户用户。' .
		'PayPal 可在 56 个市场以 7 种货币（加元、欧元、英镑、美元、日元、澳元、港元）使用。' .
		'（网址：http://www.paypal.com）',
	'paypal_pay_button' => '立即使用paypal支付',
	'paypal_txn_id' => 'paypal 交易号',
	
	
	//网银在线
	'chinabank_name' => '网银在线',
	'chinabank_desc' => '网银在线与中国工商银行、招商银行、中国建设银行、农业银行、民生银行等数十' .
		'家金融机构达成协议。全面支持全国19家银行的信用卡及借记卡实现网上支付。（网址：http://www.chinabank.com.cn）',
	'chinabank_pay_button' => '立即使用网银在线支付',
	
	
	//快钱
	'kuaiqian_name' => '快钱',
	'kuaiqian_desc' => '快钱是国内领先的独立第三方支付企业，旨在为各类企业及个人提供安全、便捷和保密的支付清算与账务服务，其推出的支付产品包括但不限于人民币支付，外卡支付，神州行卡支付，联通充值卡支付，VPOS支付等众多支付产品, 支持互联网、手机、电话和POS等多种终端, 以满足各类企业和个人的不同支付需求。截至2009年6月30日，快钱已拥有4100万注册用户和逾31万商业合作伙伴，并荣获中国信息安全产品测评认证中心颁发的"支付清算系统安全技术保障级一级"认证证书和国际PCI安全认证。' . '<br/><a href="send.php" target="_blank"><font color="red">点此链接在线签约快钱</font></a>',
	'kuaiqian_pay_button' => '立即使用快钱支付',
	
	//财付通
	'tenpay_name' => '财付通',
	'tenpay_desc' => '<b>财付通（www.tenpay.com） - 腾讯旗下在线支付平台，通过国家权威安全认证，支持各大银行网上支付，免支付手续费。</b><br /><a href="http://union.tenpay.com/mch/mch_register_b2c.shtml?sp_suggestuser=1202822001" target="_blank">立即免费申请：单笔费率1%</a><br /><a href="http://union.tenpay.com/mch/mch_register_b2c.shtml?sp_suggestuser=2289480" target="_blank">立即购买包量套餐：折算后单笔费率0.6-1%</a>',
	'tenpay_pay_button' => '立即使用财付通支付',
	
);
?>