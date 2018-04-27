<?php  
/**
 * 消费者
 */
date_default_timezone_set('Asia/Shanghai');

/*PTP*/

$stomp = new Stomp('tcp://127.0.0.1:61613');  
//订阅只对一个有效，如果启动多个脚本，只有一个会接收到消息
$stomp->subscribe('/queue/userReg');
 
while(true) {
    //判断是否有读取的信息
    if($stomp->hasFrame()) {
        $frame = $stomp->readFrame();
 
        $data = json_decode($frame->body, true);
        var_dump($data);
 
        //我们通过获取的数据
        //处理相应的逻辑，比如存入数据库，发送验证码等一系列操作。
        //$db->query("insert into user values('{$username}','{$password}')");
        //sendVerify();
 
        //表示消息被处理掉了，ack()函数很重要
        $stomp->ack($frame); //即使不用ack , 也只有一个收到
    }
    sleep(1);
}



/*pubsub*/

// $queue  = '/topic/phptest';  
  
// try {  
//     $stomp = new Stomp('tcp://127.0.0.1:61613');  
//     $stomp->subscribe($queue);  
  
//     while (true) {  
//        if ($stomp->hasFrame()) {  
//            $frame = $stomp->readFrame();  
//            if ($frame != NULL) {  
//                print "Received: " . $frame->body . " - time now is " . date("Y-m-d H:i:s"). "\n";  
//                $stomp->ack($frame);  
//            }  
//        } else {  
//            print "No frames to read\n";  
//        }  
//     }  
  
// } catch(StompException $e) {  
//     die('Connection failed: ' . $e->getMessage());  
// }  

/*PTP 分步*/

$stomp = new Stomp('tcp://192.168.1.222:61613');
$stomp->subscribe('/queue/userReg');
 
while(true) {
    //判断是否有读取的信息
    if($stomp->hasFrame()) {
        $frame = $stomp->readFrame();
 
        $data = json_decode($frame->body, true);
 
        //注册信息入库
        //$ret = db->query("insert into user values('{$data['username']}', '{$data['password']}')");
        //这里演示直接设成true了
        $ret = true;
        if($ret) {
            echo $data['username'], '入库成功', PHP_EOL;
            //如果入库成功，再次把数据发送到另一个消息队列中，进行下一步处理
            $stomp->send('/queue/sendVerify', $frame->body);
 
            $stomp->ack($frame);
        }
    }
    sleep(1);
}


$stomp = new Stomp('tcp://192.168.1.222:61613');
$stomp->subscribe('/queue/sendVerify');
 
while(true) {
    //判断是否有读取的信息
    if($stomp->hasFrame()) {
        $frame = $stomp->readFrame();
 
        $data = json_decode($frame->body, true);
 
        //$ret = sendVerify()发送验证码，实际中应该是请求某接口
        $ret = true;
        if($ret) {
            echo $data['username'], '发送验证码成功', PHP_EOL;
 
            $stomp->ack($frame);
        }
    }
    sleep(1);
}



?>