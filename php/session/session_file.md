# 默认file存储

```
服务器端`session_id()`生成默认名为`PHPSESSID`的cookie，
返回Response中，加入`Set-Cookie:PHPSESSID=xxx`，
客户端写入cookie(默认session cookie会话cookie，浏览器关闭即失效)，
客户端再次请求时，会携带`PHPSESSID=session_id`的cookie信息，去服务器端查找session文件，进行认证校验

存储：指定文件夹(如/tmp)
文件名：sess_xxx (xxx=session_id)
文件内容：name|s:4:"adam";age|i:25; (string格式)
有效期：session_cookie_lifetime默认是0，即会话cookie，关闭浏览器即失效。如设置=60，表示一分钟之后重新生成`session_id` (`session_regenerate_id()`)
```