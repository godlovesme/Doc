<?php  
/**
 * pub/sub
 */

date_default_timezone_set('Asia/Shanghai');

/*PTP*/
$stomp = new Stomp('tcp://127.0.0.1:61613');  
$obj = new Stdclass();
$obj->username = 'test';
$obj->password = '123456';
//发送一个注册消息到队列，我们这里模拟用户注册
$stomp->send('/queue/userReg', json_encode($obj));



/*pubsub*/
// $queue  = '/topic/phptest';  
// $msg    = 'bar';  
  
// try {  
//     $stomp = new Stomp('tcp://127.0.0.1:61613');  
  
//     while (true) {  
//       $stomp->send($queue, $msg." ". date("Y-m-d H:i:s"));  
//       sleep(1);  
//     }  
  
// } catch(StompException $e) {  
//     die('Connection failed: ' . $e->getMessage());  
// }  