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
// html
var jsonObj = {"a":"v1", "b":"v2"};
jsonObj = JSON.stringify(jsonObj);
$.ajax({
    url: 'xxx'
    data: {"data":jsonObj},
});
// php
// 1. 不加stringify处理，直接传json对象的话，会被处理为数组 (z[a]:v1  z[b]:v2)
// 2. 加stringify转换成json字符串 '{"a":"v1", "b":"v2"}'
json_decode($_REQUEST['data'], true) 得到数组
```