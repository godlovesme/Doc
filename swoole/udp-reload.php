<?php
/**
 * swoole udp 服务 1.9.6 
 */


//创建Server主体对象，监听 192.168.1.158:4001端口   多进程           UDP
$serv = new swoole_server("192.168.1.158", 4001, SWOOLE_PROCESS, SWOOLE_SOCK_UDP); 


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
    'open_length_check' => true,
    'package_max_length' => 1024*1024*2,
));


//监听连接进入事件
$serv->on('Packet', function ($serv, $data, $client_info) {  
    echo "----------UDP-start-----------\n";
    var_dump($data);
    $data = json_decode($data,true);
    if($data['type']=='reload'){
        $serv->reload();
        echo "reload";
    }
    if($data['type']=='test'){
         Test::dump();
    }
   
    echo "wo shi ";
    echo "----------UDP-end-----------\n";
});

$serv->on('WorkerStart', function($serv, $workerId) {
    var_dump(get_included_files()); //此数组中的文件表示进程启动前就加载了，所以无法reload
    //清空加载缓存
    opcache_reset();
});

/*自动加载*/
spl_autoload_register(function ($class) { 
    var_dump($class);
    $class_arr = explode("\\", $class);
    $file = '/data/wwwroot/test/'.end($class_arr).".php";
    echo $file;
    if (file_exists($file)) {
        include $file;
    }
});



//启动服务器
$serv->start();