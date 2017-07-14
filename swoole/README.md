# Swoole

PHP的异步、并行、高性能网络通信引擎
使用纯C语言编写，提供了PHP语言的异步多线程服务器，异步TCP/UDP网络客户端，
异步MySQL，异步Redis，数据库连接池，AsyncTask，消息队列，毫秒定时器，异步文件读写，异步DNS查询。

Swoole是标准的PHP扩展，不过Swoole在运行后会接管PHP的控制权，进入事件循环。
当IO事件发生后，Swoole会自动回调指定的php函数。