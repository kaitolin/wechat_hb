<?php
return array(
	//'配置项'=>'配置值'
	
	"URL_MODEL" => 1,

	/***微信***/
	"wx_appID" => "wx05bea89969772c06",
	"wx_appsecret" => "3f2776c68894136aa2780e12c2fc6458",
	"weixin_token" => "kid",
	/**OAuth2.0授权后跳转到的默认页面**/
	"wx_webauth_callback_url" => urlencode(""),
	"wx_webauth_expire" => 6500,

	'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'wechat_hb', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'wc_', // 数据库表前缀 
);
?>