<?php

#发送 UDP 数据

$data = array('type'=>"reload");
$data = array('type'=>"test");
$socket = stream_socket_client("udp://192.168.1.158:4001", $error_code, $error_message, 30);
var_dump($error_code);
var_dump($error_message);
if ( $socket) 
{
	if( is_array( $data))
	{
		$log_buff_str = json_encode($data);
		@fwrite($socket, $log_buff_str);
	}
}
exit;

#发送 TCP
// $socket = stream_socket_client("tcp://192.168.1.158:4004", $error_code, $error_message, 30);
// $data = json_encode(array('type'=>1,'name'=>"test"));
// $msg_length = pack("N" , strlen($data) ). $data;
// @fwrite($socket, $msg_length);
// var_dump($error_code);
// var_dump($error_message);



// 创建一个新cURL资源
$ch = curl_init();
// 设置URL和相应的选项
curl_setopt($ch, CURLOPT_URL, "http://192.168.1.158:4004");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1); //设置为POST方式
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
curl_setopt($ch, CURLOPT_POSTFIELDS, array('test' =>"123456"));//POST数据
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($ch);

var_dump($res);