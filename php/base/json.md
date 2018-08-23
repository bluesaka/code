# json

## array/object to json

```
$array = ['name' => 'adam', 'age' => 25, 'sex' => '男'];
$json = json_encode($array);  // '{"name":"adam","age":25,"sex":"\u7537"}'
$json = json_encode($array, JSON_UNESCAPED_UNICODE);  //  中文转码 php5.4+

$object = new StdClass();
$object->name = "adam"; $object->age = 25;
$json = json_encode($object);

// 索引数组 to json
$array = ['a', 'b', 'c'];
$json = json_encode($array); // '["a","b","c"]'

// 把索引数组转换成object，然后json_encode
$json = json_encode((object)$array); // '{"0":"a","1":"b","2":"c"}'
$json = json_encode($array, JSON_FORCE_OBJECT); // '{"0":"a","1":"b","2":"c"}'
```

## json to array/object

```
$json = '{"name": "adam", "age": 25}';
$obj = json_decode($json);
$array = json_decode($json, true);
```

-----------------------------------------

# js json

## string to json

```
// eval是js自带的函数，不是很安全，推荐使用JSON.parse
var jsonObj = eval('(' + jsonStr + ')');

// json
var jsonObj = JSON.parse(jsonStr);
```

## json to string

```
var jsonStr = JSON.stringify(jsonObj);

# 与后端数据交互
// js
var jsonObj = {"a":"{\"status\": 2}", "b":"v2"};

$.ajax({
    url: 'xxx'
    data: jsonObj, // json字符串为 JSON.stringify(jsonObj)
    contentType: "application/json", // 默认是application/x-www-form-urlencoded
});

// php
1. application/json
   data: JSON.stringify(jsonObj)
   传参形式： Request Payload
   接收参数：json_decode(file_get_contents('php://input'), true);
   
2. application/x-www-form-urlencoded
   传参形式：Form Data
   接收参数：$_POST
 
3. 使用DHC/postman请求时:
   - application/json
        {
            "a":"{\"status\": 1}",
            "b":"v2"
        }
        接收参数：json_decode(file_get_contents('php://input'), true)
        
   - application/x-www-form-urlencoded
        {
            "a":"{\"status\": 1}",
            "b":"v2"
        }
        接收参数：json_decode(file_get_contents('php://input'), true)
        
    - application/x-www-form-urlencoded
        a={"status":1}&b=v2
        接收参数：$_POST
        
4. curl默认Content-Type: multipart/form-data
   - json_encode($arr)
     {
         "name": "a"
     }
     接收参数：json_decode(file_get_contents('php://input'), true)
     
   - form data
     name=a&age=18
     接收参数：$_POST

```
