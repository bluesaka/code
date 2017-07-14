# 简介

ElasticSearch是一个基于Lucene的搜索服务器。它提供了一个分布式多用户能力的全文搜索引擎，基于RESTful web接口。

# 集群cluster、node节点、sharding分片，分布式集群

```
cluster health:  curl -XGET 'localhost:9200/_cat/health?v&pretty'
cluster nodes list:   curl -XGET 'localhost:9200/_cat/nodes?v'
```

# 索引indices

```
curl -XGET 'localhost:9200/_cat/indices?v'
```

# 创建索引

```
curl -XPUT 'localhost:9200/class?pretty&pretty'
```

# CURD index documents 索引数据增删改查 （若user的index不存在，会自动创建）
```
新增/更新: curl -XPUT 'localhost:9200/user/external/1?pretty&pretty' -H 'Content-Type: application/json' -d'{"name": "John Doe"}' (必须指定id值，换name再执行就是更新)
新增: curl -XPOST 'localhost:9200/user/external/2?pretty&pretty' -d '{"name": "AAA"}'  (新增id为2的索引数据，id值可以不指定，elastic会随机生成一个id)
更新: curl -XPOST 'localhost:9200/user/external/2/_update?pretty&pretty' -d '{"doc": {"name": "BBB", "age": 20}}'
查看: curl -XGET 'localhost:9200/user/external/1?pretty'
删除: curl -XDELETE 'localhost:9200/user?pretty&pretty'
```

# 批量bulk

```
curl -XPOST 'localhost:9200/customer/external/_bulk?pretty&pretty' -d'
{"index":{"_id":"1"}}
{"name": "CCC" }
{"index":{"_id":"2"}}
{"name": "DDD" }
'

curl -XPOST 'localhost:9200/user/external/_bulk?pretty&pretty' -d'
{"update":{"_id":"1"}}
{"doc": { "name": "DDD becomes new DDD" } }
{"delete":{"_id":"2"}}
'
```

# 导入json文件

```
curl -XPOST 'localhost:9200/bank/account/_bulk?pretty&refresh' --data-binary "@accounts.json" //路径正确即可，如在/data/accounts.json, 则 "@/data/accounts.json"
```

# 查询 match

```
curl -XGET 'localhost:9200/bank/_search?q=*&sort=account_name:asc&pretty'

* #### match_all 匹配所有
curl -XGET 'localhost:9200/bank/_search?pretty' -H 'Content-Type: application/json' -d'
{
  "query": { "match_all": {} },
  "sort": [
    { "account_number": "asc" }
  ]
}
'

curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
	"query": {"match_all": {}},
	"from": 10,
	"size": 3,
	"sort": {"balance": {"order": "desc"}},
	"_source": ["account_number", "balance"]
}'

* #### match 绝对匹配
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
	"query": {"match": {"account_number": 20}}
}'

* #### match_phrase 模糊匹配
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
	"query": {"match_phrase": {"address": "mill"}}
}'
```

# 查询 bool

```
* bool must  所有都要满足（and）
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
  "query": {
    "bool": {
      "must": [
        { "match": { "address": "mill" } },
        { "match": { "address": "lane" } }
      ]
    }
  }
}
'

* bool should 满足其中之一 （or）
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
  "query": {
    "bool": {
      "should": [
        { "match": { "address": "mill" } },
        { "match": { "address": "lane" } }
      ]
    }
  }
}
'

* bool must_not 不满足其中任何一个
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
  "query": {
    "bool": {
      "must_not": [
        { "match": { "address": "mill" } },
        { "match": { "address": "lane" } }
      ]
    }
  }
}
'
```

# 查询过滤  fliter

```
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
  "query": {
    "bool": {
      "must": { "match_all": {} },
      "filter": {
        "range": {
          "balance": {
            "gte": 20000,
            "lte": 30000
          }
        }
      }
    }
  }
}
'
```

# 查询聚合 aggregation (like MySQL group by,  但聚合会返回聚合结果和所有的列表)

```
curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
    "aggs": {
        "group_by_lastname_adam":{
            "terms": {
                "field": "firstname"
           }
       }
   },
   "query": {
        "match": {
            "lastname": "Heath"
       }
   }
}
'

curl -XGET 'localhost:9200/bank/_search?pretty' -d'
{
    "aggs": {
        "all_state":{
            "terms": {"field": "state"},
            "aggs": {"avg_balance": {"avg": {"field": "balance"}}}
       }
   }
}
'
```