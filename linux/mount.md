# 挂载

    * linux共享windows文件

    ```sh
    //  需先创建swoole-server文件夹, password前的逗号不能有空格, linux重启自动取消挂载)
    mount -t cifs -o username=administrator,password=000000  //192.168.56.220/swoole-server-git /mnt/swoole-server
    ```

    * 绑定挂载

    ```
    mount -o bind /home/felix/my_project_Runtime/ /var/www/html/my_project/Runtime/
    ```

# 取消挂载

```
umount /mnt/swoole-server
```

# 查看挂载列表

```
mount -l
```