# elasticsearch-php类库

# 创建索引，默认dynamic=true
```
PUT es_log
{
    "mappings": {
        "es_log":{}
    }
}
```

# 添加mapping field
```
PUT es_log_index/_mapping/es_log_type
{
    "properties": {
        "field_add_title": {
            "type":"text"
        }
    }
}
```

# 查看mapping
```
GET thl_qa_question/thl_qa_question/_mapping
```


# 调试
```
_search?explain
```

# 分词调试
```
GET /hl_shop_product/_analyze {
    "field": "match_*",
    "text":"敬酒服",
    // "analyzer": "ik_max_word"   此参数没用， 跟着mapping走
} 
```


# 查询1
```
GET thl_set_meals/thl_set_meals/_search?explain
{
  "query": {
    "bool":{
      "filter": {
        "bool": {
          "must": [
            {
              "term": {
                "is_cpm": "1"
              }
            }
          ],
          "should": [
            {
              "term": {
                "is_lvpai": "1"
              }
            },
            {
              "geo_distance": {
                "distance": "20km",
                "location": {
                  "lat": 30.295751,
                  "lon": 120.141457
                }
              }
            }
          ]
          
        }
      }
    },
    "from":  0,
    "size": 10,
    "collapse": {"field": "cpm_plan_id"},
    "sort": [
        {
          "property_id": {
            "order": "asc"
          }
        },
        {
          "actual_price": {
            "order": "asc"
          },
          "_geo_distance": {
              "location": {
                "lat": "40.715",
                "lon": "-73.998"
              },
              "order": "asc",
              "unit": "km",
              "distance_type": "plane"
            }
        },
        {
            "id": {
                "order": "desc"
             }
        }
    ],
    "highlight": {"fields": {"match_*": {"type": "plain"}}} 
  }
}
```

# 查询2
```
GET hl_community_combine/hl_community_combine/_search
{
  "query": {
    "bool": {
      "must": {
        "bool": {
          "should": [
            {
              "bool": {
                "must": [
                  {
                    "multi_match": {
                      "query": "大婚当天",
                      "type": "phrase",
                      "fields": "match_*"
                    }
                  },
                  {
                    "term": {
                      "entity_type": "QaQuestion"  // term需要keyword类型的mapping
                    }
                  }
                ]
              }
            },
            {
              "bool": {
                "must": [
                  {
                    "bool": {
                      "should": [
                        {
                          "bool": {
                            "must": [
                              {
                                "term": {
                                  "community_channel_id": 25
                                }
                              },
                              {
                                "range": {
                                  "is_refined": {
                                    "gte": 1
                                  }
                                }
                              }
                            ]
                          }
                        },
                        {
                          "bool": {
                            "should": [
                              {
                                "multi_match": {
                                  "query": "大婚当天",
                                  "type": "phrase",
                                  "fields": "match_title"
                                }
                              },
                              {
                                "multi_match": {
                                  "query": "结婚当天",
                                  "type": "phrase",
                                  "fields": "match_title"
                                }
                              }
                            ]
                          }
                        }
                      ]
                    }
                  },
                  {
                    "term": {
                      "entity_type": "CommunityThread"
                    }
                  }
                ]
              }
            }
          ]
        }
      },
      "filter": {
        "bool": {
          "must": [
            {
              "term": {
                "deleted": 0
              }
            }
          ],
          "should": [
            {
              "bool": {
                "must": [
                  {
                    "term": {
                      "entity_type": "CommunityThread"
                    }
                  },
                  {
                    "range": {
                      "post_count": {
                        "gte": 1
                      }
                    }
                  }
                ]
              }
            },
            {
              "bool": {
                "must": [
                  {
                    "term": {
                      "entity_type": "QaQuestion"
                    }
                  },
                  {
                    "range": {
                      "answer_count": {
                        "gte": 1
                      }
                    }
                  }
                ]
              }
            }
          ]
        }
      }
    }
  },
  "sort": [
    {
      "updated_at": {
        "order": "desc"
      },
      "id": {
        "order": "desc"
      }
    }
  ]
}
```

# msearch
```
GET _msearch
{"index":"thl_set_meals","type":"thl_set_meals"}
{"sort":[{"cpm_value":{"order":"desc"}}],"collapse":{"field":"city_code"},"query":{"bool":{"filter":{"bool":{"must":[{"term":{"deleted":0}},{"term":{"status":1}},{"term":{"is_sold_out":0}},{"term":{"commodity_type":0}},{"term":{"is_cpm":1}},{"geo_distance":{"distance":"5000km","location":{"lat":"18.247871","lon":"109.50827"}}}]}}}},"from":0,"size":"10"}
{"index":"thl_set_meals","type":"thl_set_meals"}
{"sort":[{"cpm_value":{"order":"desc"}}],"collapse":{"field":"city_code"},"query":{"bool":{"filter":{"bool":{"must":[{"term":{"deleted":0}},{"term":{"status":1}},{"term":{"is_sold_out":0}},{"term":{"commodity_type":0}},{"term":{"is_cpm":1}},{"term":{"is_lvpai":1}}]}}}},"from":0,"size":3}
```

# reindex
```
https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-reindex.html

POST _reindex
{
  "source": {
    "index": "es_log"
  },
  "dest": {
    "index": "es_log_index",
    "type": "es_log_type"
  }
}
```
