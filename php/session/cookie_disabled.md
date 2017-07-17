# 客户端cookie禁用了，session还能用吗？

## 默认的PHP Session机制

> 默认情况下，SessionID是需要存储在客户端的cookie中，默认cookie名为PHPSESSID
> 1. 第一次访问网站
> 2. 服务器端开启了Session `session_start()`
> 3. 服务器端会生成一个不重复的`session_id`文件 `sess_xxx`，存放在服务器指定的目录
> 4. 在返回头(Response Headers)中，加入 `Set-Cookie:PHPSESSID=xxx`
> 5. 客户端收到`Set-Cookie`的头，将PHPSESSID写入cookie
> 6. 当第二次访问网站时，`PHPSESSID`的cookie会附带在请求头(Request Headers)中，发送给服务器端
> 7. 服务器识别`PHPSESSID`，去目录中查找相应的session文件
> 8. 找到session文件后，检查是否过期，若没有过期，则读取session文件中的信息；若已过期，则清空其中的信息

如果客户端禁用cookie，`PHPSESSID`无法写入客户端，此种情况下，Session不能用

## 巧妙传递session_id

如果客户端禁用了cookie，可以在url后带上session_id的信息

```
GET  http://www.xxx.com/index.php?session_id=xxx
POST http://www.xxx.com/post.php?session_id=xxx
```

然后在脚本开头使用 `session_id($_GET['session_id'])` (在`session_start()`之前)，来强制指定当前的 `session_id`

这种情况下，session又可以使用了

> 不过这种情况，如果你把url复制给其他人，那其他人就会有你的身份信息。
> 而且cookie也会被盗用，如XSS注入。
> 所以Laravel等框架中，内部都实现了Session的所有逻辑，并将`PHPSESSID`设置为`httponly`并加密，这样前端js就无法读取和修改。