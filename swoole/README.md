# Swoole
```
PHP的异步、并行、高性能网络通信引擎。
使用纯C语言编写，提供了PHP语言的异步多线程服务器，异步TCP/UDP网络客户端，
异步MySQL，异步Redis，数据库连接池，AsyncTask，消息队列，毫秒定时器，异步文件读写，异步DNS查询。

Swoole是标准的PHP扩展，不过Swoole在运行后会接管PHP的控制权，进入事件循环。
当IO事件发生后，Swoole会自动回调指定的php函数。
```

## 源码安装
```
1. wget https://github.com/swoole/swoole-src/archive/1.8.11-stable.tar.gz

2. tar zxvf 1.8.11-stable.tar.gz -C /usr/local/src/

3. cd /usr/local/src/swoole-src-1.8.11-stable
   phpize

4. 生成MakeFile
./configure \
--enable-openssl \
--enable-swoole-debug

5. 安装
make & make install

6. 加入php模块
php -i | grep php.ini  找到指定的php配置文件（可能cli和apache有两个配置文件），加入
extension=swoole.so

7. 查看swoole扩展是否安装
php -m | grep swoole
```

## pecl 安装
```
pecl install swoole
```