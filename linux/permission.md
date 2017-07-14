# 权限

```
drwxr-xr-x
-rwxr-xr--.
lrwxrwxrwx.
d：代表文件夹，-：代表文件
r w x 分别对应 读、写、可执行的权限  ( . 代表ACL权限)
l：代表软链接(相当于windows下的快捷方式)，权限都是rwxrwxrwx

r=4, w=2, x=1
777权限： -rwxrwxrwx  表示任何人都有读、写、运行三项权限
666权限：-rw-rw-rw-
```

# 权限所属

-rwxr-xr--

rwx | r-x | r--
--- | --- | ---
u所有者 | g所属组 | o其他人

# 修改权限

```
// 改变文件权限
chmod 777 -R dir_name

// 改变文件所属的用户组
chgrp -R user_group dir_name

// 改变文件拥有者和群组
chown root:root file_name
chown root: file_name
chown :root file_name
```