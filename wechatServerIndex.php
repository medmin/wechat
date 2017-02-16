<?php
	
	include('../info/wechatSettings.php');
	// 直接用面向过程的算了 首先验证 微信会发来san个GET请求

	// // 口令  
	$token = token;
	// // 随机数
	$nonce = $_GET["nonce"];
	// // 时间戳	我就说以前写的时候不用写时区
	$timestamp = $_GET["timestamp"];

	// // 第一步：将token、timestamp、nonce三个参数进行字典序排序 
	$signature = array($token, $timestamp, $nonce);
	sort($signature);

	// // 第二步：将三个参数字符串拼接成一个字符串进行sha1加密
	$signature = implode('', $signature);
	$signature = sha1($signature);

	// // 判断是否是微信发来的消息 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
	//官方说的 这里最好加一个判断
	if ($_GET["signature"] == $signature && isset($_GET["echostr"]))
	{
		echo $_GET["echostr"];
	}
