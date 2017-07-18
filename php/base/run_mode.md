# PHP运行模式

## CGI

```
CGI即通用网关接口(Common Gateway Interface)，是一段程序。是程序和web服务器之间的翻译官。
每个CGI只处理一个请求，处理完后结束进程。进程反复加载，耗费系统资源和cpu，使得cgi性能低下
```

## FastCGI

```
FastCGI是CGI的升级版，会预先生成多个CGI进程，等待web服务器的请求，而不用每次请求到来时fork一个进程。
PHP-FPM：是PHP的FastCGI进程的管理器(FastCGI Process Manager)，被PHP官方收录
```

## cli

```
Command Line Interface 命令行运行模式
```

## apache2handler

```
php作为apache服务器的模块(mod_php)运行。apache服务器在运行时，会预先生成多个子进程驻留在内存中，等待请求到来。
请求处理完后，子进程不会立即退出，而是继续驻留等待下次请求。
```