<?php
error_reporting(0);
require_once( $_SERVER['DOCUMENT_ROOT'] . "/lib/wx/myfun.php");

$encodingAesKey = "dittehx2uqlgx5b8sqe43u6odittehx2uqlgx5b8sqe";
$token = "renrenjiu";
$appId = "wxeea942a6b041376f";

$main = new myFun();

$res = $main->getAllAuth();

$time_i = 60*50*2;
foreach($res as $row){
	$t_s = strtotime($row['updated']);
	$t_e = time();

	$sub_time = $t_e - $t_s;

	if ($sub_time > $time_i) {
		echo 'yes';
	} else {
		
		$component_appid = 'wxeea942a6b041376f';
		$component_appsecret = '646942cfb1b8a39908dd1a98e4da6938';

		$url = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.$key;
		$post_array = array('component_appid'=>$component_appid);
		
		$json = json_encode($post_array);

		$array = json_decode(postData($url, $json));
	}
}

?>