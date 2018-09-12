<?php
/**
 * 内存
 */




/**
 * https://wiki.swoole.com/wiki/page/p-table.html
 * swoole_table一个基于共享内存和锁实现的超高性能，并发数据结构。
 * 用于解决多进程/多线程数据共享和同步加锁问题。
 */

/*
	swoole_table::TYPE_INT 整形字段
	swoole_table::TYPE_FLOAT 浮点字段
	swoole_table::TYPE_STRING 字符串字段
*/

use Swoole\Table;
$table = new Table(1024);

$table->column('c1',Table::TYPE_STRING, 2); //创建列 超过大小自动截取
$table->column('c2',Table::TYPE_STRING, 10);
$table->column('c3',Table::TYPE_INT, 10);
$table->create(); //创建表 

var_dump($table->memorySize);

//设置
// for ($i=0; $i <100 ; $i++) { 
// 	$table->set('myKey'.$i,['c1'=>"test".$i,'c2'=>"test".$i]);
// }
//获取
// var_dump($table->get('myKey'));

//增长
// $table->incr('mykey', 'c3',1);
//减少
// $table->decr('mykey', 'c3',1);
// //删除
// $table->del('mykey');
// //存在
// var_dump($table->exist('mykey'));


// echo "<pre>";

// //遍历
// foreach($table as $row)
// {
//     var_dump($row);
// }
// var_dump($table);
// var_dump($table);
