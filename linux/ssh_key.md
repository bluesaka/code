# ssh key免密登录

* 生成ssh key

```
ssh-keygen
生成 id_rsa私钥和id_rsa.pub公钥
```

* 将id_rsa.pub公钥拷贝至需要需要登录的服务器的 `.ssh/authorized_keys` 文件里

* 重启ssh，使之生效

```
sudo service ssh restart
```

* 登录

```
ssh username@192.168.56.222
```

* 注销

```
exit
```