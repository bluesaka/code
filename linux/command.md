# ls  列表
> ls：列出目录内容
> ls -l：以详情模式列出
> ls -h：human read 
> ls -a：列出文件夹里所有内容，包括以“.”开头的隐藏文件

# cd 打开目录
> cd /：回到根目录
> cd ..：回到上级目录

# find 查找文件
> find . -name "*.php" | xargs grep -i "Hello" --color  (xargs...)

# ln 软链接
> ln -s /var/源文件 /home/目标目录    创建软链接

# cp 复制
> cp 源文件 目标目录|文件

# mv 剪切文件（包含重命名功能）
> mv 源文件 目标目录|文件

# ps (process status) 查看进程
> ps -ef | grep cron
> ps aux | grep cron

# 查看文件tail, cat, more...
> tail -f filename 查看文件最后的内容，  -f：及时输出文件变化后追加的内容
> tail -10000 info.log | grep class_progress | awk '{print $1" "$2}'

# sudo su ：切换为root用户，不用每次sudo输入root密码

# rm xxx -rf 删除文件夹以及文件, -r:recursive递归  -f:force强制

# ab压测
> ab -c 100 -n 10000 127.0.0.1/index.php

# alias系统别名
> vim ~/.bashrc
> alias www='cd /var/www/html'
> . ~/.bashrc 或者 source ~/.bashrc，执行bash内置命令，使新加的别名生效

# chown chgrp 改变文件所属的用户/用户组
> chown felix: swoole-server -R
> chown felix:felix swoole-server -R

# grep
> 正则匹配   ps -ef | grep 9501
> 多匹配两行  ps aux | grep 9501 -2
> 总数  ps -ef | grep 9501 | wc -l

# ssh
> ssh 192.168.1.222
> ssh root@192.168.1.222

# 监测
> telnet 127.0.0.1 9501
> netcat -u 127.0.0.1 9501   -u:udp, 默认tcp
> tcpdump -i any tcp port 9501
> strace -p xx

# cli终端快捷键
> ctrl + L = clear: 清屏
> ctrl + u: 清除当前输入


# iptable
> iptables --list
> iptables -I INPUT -p tcp --dport 9200 --syn -j ACCEPT
> iptables-save

> iptables -L --line-numbers
> iptables -D INPUT 3 (3是number)




