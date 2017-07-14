# 数据库数据导入es

    ```php
    $teachers = M('teachers')->limit(0,500)->select();
    $data = '';
    foreach($teachers as $t) {
        $data .= '{"index": {"_id": '.$t['id'].'}}'.PHP_EOL;  //必须要空行
        $ts = json_encode($t);
        $data .= $ts.PHP_EOL;
    }
    $url = "localhost:9200/es/teachers/_bulk?pretty&pretty";

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data
    ]);

    $ret = curl_exec($ch);
    dump($ret);
    dump(curl_error($ch));

    curl_close($ch);
    ```

# 查询状态(1,3,4)的老师

```
curl -XGET 'localhost:9200/es/teachers/_search?pretty' -d'
{
    "size":10,
    "_source":["id","nickname","status"],
    "query": {
        "terms": {"status":[1,3,4]}
   }
}
'
$url = "localhost:9200/abc360/teachers/_search?pretty";

$source_str = '"_source":["id","nickname","status"],';
$size_str = '"size":10,';
$query_str = '"query":{"terms": {"status":[1,3,4]}}';
$data = "{".$source_str.$size_str.$query_str."}"; // 必须双引号，最后不能有逗号

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_RETURNTRANSFER => true,  //将返回值赋给curl_exec()，而不是直接打印在页面
]);
$ret = curl_exec($ch);
dump($ret);
dump(curl_error($ch));
curl_close($ch);

$ret = json_decode($ret, true)['hits']['hits'];
$ids = [];
foreach ($ret as $v) {
    $ids[] = $v['_source']['id'];
}
dump($ids);
```

# 模糊匹配

```
// match匹配单词，默认不区分大小写
{
    "query": {
        "match": {"intro": "hello NaMe adam"}
   }
}
```

