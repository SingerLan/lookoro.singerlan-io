<?php
/*
Plugin Name: 百度站长
Plugin URI: http://blog.wpjam.com/project/wpjam-basic/
Description: 支持百度站长链接提交。
Version: 1.0
*/

add_action( 'wp_enqueue_scripts', function(){
	if(is_404()) return;

	if(is_ssl()){
		wp_enqueue_script( 'baidu_zz_push', 'https://zz.bdstatic.com/linksubmit/push.js', '', '', true );
	}else{
		wp_enqueue_script( 'baidu_zz_push', 'http://push.zhanzhang.baidu.com/push.js', '', '', true );
	}
});

function wpjam_notify_baidu_zz($urls, $update=false){
	$site	= wpjam_get_setting('baidu-zz', 'site');
	$token	= wpjam_get_setting('baidu-zz', 'token');
	$mip	= wpjam_get_setting('baidu-zz', 'mip');

	if($site && $token){
		if($update){
			$baidu_zz_api_url	= 'http://data.zz.baidu.com/update?site='.$site.'&token='.$token;
		}else{
			$baidu_zz_api_url	= 'http://data.zz.baidu.com/urls?site='.$site.'&token='.$token;
		}

		if($mip){
			$baidu_zz_api_url	.= '&type=mip';
		}

		$response	= wp_remote_post($baidu_zz_api_url, array(
			'headers'	=> array('Accept-Encoding'=>'','Content-Type'=>'text/plain'),
			'sslverify'	=> false,
			'blocking'	=> false,
			'body'		=> $urls
		));
	}
}

function wpjam_notify_xzh($urls, $update=false){
	$appid	= wpjam_get_setting('xzh', 'appid');
	$token	= wpjam_get_setting('xzh', 'token');

	if($appid && $token){
		if($update){
			$xzh_api_url = 'http://data.zz.baidu.com/urls?appid='.$appid.'&token='.$token.'&type=batch';
		}else{
			$xzh_api_url = 'http://data.zz.baidu.com/urls?appid='.$appid.'&token='.$token.'&type=realtime';
		}

		$response	= wp_remote_post($xzh_api_url, array(
			'headers'	=> array('Accept-Encoding'=>'','Content-Type'=>'text/plain'),
			'sslverify'	=> false,
			'blocking'	=> false,
			'body'		=> $urls
		));
	}
}



