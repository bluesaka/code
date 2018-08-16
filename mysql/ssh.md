# ssh通道连接数据库

# 通道直连
```
mysql连接配置相应的ssh通道即可
D:\work\putty\plink.exe -ssh kaifa_xxx@118.178.xxx.250 -pw "4X6PbQM..." -P 20002 -N -L 3606:rm-bp...mysql.rds.aliyuncs.com:3306
```

# 本地连接通道
```
a. ssh -fNg -p {ssh_port} -L{local_port}:{db_host}:{db_port} {ssh_user}@{ssh_host}  本地端口连接ssh通道
   -- ssh -fNg -p 20002 -L 33068:rm-bpxxx.mysql.rds.aliyuncs.com:3306 root@116.62.xxx.192
b. 新建mysql连接 localhost:{local_port} {db_user} {db_password}  此连接无需设置ssh通道，用户密码用远程服务器的
c. mysql命令行连接 mysql -h 127.0.0.1 -P {local_port} -u {db_user} -p{db_password}
```
