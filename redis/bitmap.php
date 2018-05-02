<?php
/**
 * redis 位图的使用
 */

// redis 位图

// Bitmap(即Bitset)

// Bitmap是一串连续的2进制数字（0或1），
// 每一位所在的位置为偏移(offset)，
// 在bitmap上可执行AND,OR,XOR以及其它位操作。


// 可以想象一个大数组 |_0_|_1_|_2_|_3_|_4_|_5_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_| 

// 这里的0 1 2 3 4 5 分别就是【bit】位 也就是setbit的第二个参数 那个偏移量  

// setbit test 4 1 那么就相当于是在4上值为1，其他？其他地方都是0。

// 第一个【字节】也就是 0 1 2 3 4 5 6 7 这八个位置上。

// bitcount 统计的是1的个数  

// bitcount test 0 -1 就是所有的字节中1的数量

// bitcount 0 0 那么就应该是第一个字节中1的数量的


/*1.统计用登陆或活跃人数*/

$redis = new Redis();
$redis->connect('192.168.1.158',7000);

$uid = 101;
$key = 'user|login|2018-05-01';
//设置
$redis->setbit($key,$uid,1);
//获取
$res = $redis->getbit($key,$uid);
// var_dump($res);
//那天登陆人数
$that_day_num = $redis->bitcount($key);
// var_dump($that_day_num);

#另一天
$uid = 101;
$key2 = 'user|login|2018-05-02';
//设置
$redis->setbit($key2,$uid,1);

#这几天都登陆
$redis->bitop('AND','both_login',$key,$key2);
$that_day_num = $redis->bitcount('both_login');
var_dump($that_day_num);

#这几天至少一天登陆
$redis->bitop('OR','day_login',$key,$key2);
$day_login_num = $redis->bitcount('day_login');
var_dump($day_login_num);
