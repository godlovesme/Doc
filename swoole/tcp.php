<?php
/**
 * swoole tcp 服务 1.9.6 
 */


//创建Server主体对象，监听 192.168.1.158:4001端口   多进程           TCP
$serv = new swoole_server("192.168.1.158", 4001, SWOOLE_PROCESS, SWOOLE_SOCK_TCP); 

//设置
$serv->set(array(
    'worker_num' => 4,   //异步非阻塞: 进程数量, CPU核数的1-4倍, 同步阻塞 100或者更高
    // 'daemonize' => true, //守护进程
    //Listen队列长度 最多同时有多少个待accept的连接
    'backlog' => 128,
    // worker进程在处理完n次请求后结束运行。manager会重新创建一个worker进程。此选项用来防止worker进程内存溢出。
    'max_request'=>0, // 设置为0表示不自动重启。在Worker进程中需要保存连接信息的服务，需要设置为0.
    //指定swoole错误日志文件
    // "log_file" => 'swoole.log',
    "dispatch_mode" => 2, //1平均分配 (控制台没有日志)，2按FD取模固定分配，3抢占式分配，默认为取模(dispatch=2) 很合适SOA/RPC类的内部服务框架
));

//同时监听 UDP
$port1 = $serv->addListener("192.168.1.158", 4002, SWOOLE_SOCK_UDP);

    $port1->set([
        'open_length_check' => true,
        'package_max_length' => 1024*1024*2,
    ]);

    //监听连接进入事件
    $port1->on('Packet', function ($serv, $data, $client_info) {  
        echo "----------UDP-start-----------\n";
        var_dump($data);
        var_dump($client_info);
        echo "----------UDP-end-----------\n";
    });

//同时监听 TCP
$port2 = $serv->listen('192.168.1.158', 4003, SWOOLE_SOCK_TCP);

    $port2->set(
        array( 
            //开启包的检查长度
            'open_length_check' => true,
            'package_max_length' => 1024*1024*2,
            //包头中某个字段作为包长度的值，底层支持了10种长度类型。 N:无符号、网络字节序、4字节
            'package_length_type' => 'N',
            //length长度值在包头的第几个字节。
            'package_length_offset' => 0,
            //从第几个字节开始计算长度  如果：length的值包含了整个包（包头+包体），package_body_offset 为0
            'package_body_offset' => 4,
        )
    );


    //监听连接进入事件
    $port2->on('Connect', function ($serv, $fd) {  
        echo "-------TCP--2-Connect-----------\n";
    });

    //监听数据接收事件
    $port2->on('Receive', function ($serv, $fd, $from_id, $data) {
        echo "-------TCP--2-Receive-start-----------\n";
        var_dump($from_id);
        var_dump($fd);
        var_dump($data);
        $length = unpack("N" , $data)[1];
        echo "Length = {$length}\n";
        $msg = substr($data,-$length);
        echo "Get Message From Client {$fd}:{$msg}\n";

        $serv->send($fd, "Server: ".$data);
        echo "-------TCP--2-Receive-end-----------\n";
    });

    //监听连接关闭事件
    $port2->on('Close', function ($serv, $fd) {
        echo "-------TCP--2-Client-Close-----------\n";
    });

//同时监听 websocket 和 http 使其 走http 流程
$port3 = $serv->listen('192.168.1.158', 4004, SWOOLE_SOCK_TCP);

    $port3->set([
        // 'open_websocket_protocol' => true,    // 设置使得这个端口支持 webSocket 协议 自动打开 http协议
        'open_http_protocol' => true,    // 设置使得这个端口支持 webSocket 协议 自动打开 http协议
    ]);


// 注册主体Server的事件回调函数。

//监听连接进入事件
$serv->on('Connect', function ($serv, $fd) {  
    echo "-------TCP---Connect-----------\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
    echo "-------TCP--Receive-start-----------\n";
    var_dump($from_id);
    var_dump($fd);
    var_dump($data);
    $serv->send($fd, "Server: ".$data);
    echo "-------TCP--Receive-end-----------\n";
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "-------TCP-Close-----------\n";
});

//启动服务器
$serv->start(); 