<?php
/**
 * swoole
 */

--简介

PHP的异步、并行、高性能网络通信引擎，使用纯C语言编写，提供了PHP语言的异步多线程服务器，
异步TCP/UDP网络客户端，异步MySQL，异步Redis，数据库连接池，AsyncTask，消息队列，
毫秒定时器，异步文件读写，异步DNS查询。 
Swoole内置了Http/WebSocket服务器端/客户端、Http2.0服务器端/客户端。



--Server (服务端)

创建一个异步服务器程序，支持TCP、UDP、UnixSocket 3种协议，支持IPv4和IPv6，
支持SSL/TLS单向双向证书的隧道加密。使用者无需关注底层实现细节，仅需要设置网络事件的回调函数即可。































