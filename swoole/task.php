<?php
/**
 * 异步任务 
 */
$serv = new swoole_server("192.168.1.158", 4003);

$serv->set(array(
    'worker_num' => 2,
    //https://wiki.swoole.com/wiki/page/276.html
    'task_worker_num' => 10,
));

$serv->on('Receive', function(swoole_server $serv, $fd, $from_id, $data) {
    echo "接收数据" . $data . "\n";
    $data = trim($data);
    $task_id = $serv->task($data, 0); 
    $serv->send($fd, "分发任务，任务id为$task_id\n");
});

$serv->on('Task', function (swoole_server $serv, $task_id, $from_id, $data) {
    echo "Tasker进程接收到数据";
    echo "#{$serv->worker_id}\tonTask: [PID={$serv->worker_pid}]: task_id=$task_id, data_len=".strlen($data).".".PHP_EOL;
    echo "task_id=$task_id".PHP_EOL;
    sleep(2);
    $serv->finish($data);
});

$serv->on('Finish', function (swoole_server $serv, $task_id, $data) {
    echo "task_id=$task_id finished, data_len=".strlen($data).PHP_EOL;
});

$serv->on('workerStart', function($serv, $worker_id) {
    global $argv;
    if($worker_id >= $serv->setting['worker_num']) {
      swoole_set_process_name("php {$argv[0]}: task_worker");
    } else {
      swoole_set_process_name("php {$argv[0]}: worker");
    }   
});

$serv->start();

