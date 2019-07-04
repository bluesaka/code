# 问题：
```
mysql 5.6 导出表结构到 mysql 5.7
time timestamp/datetime not null default '0000-00-00 00:00:00'
报错，Invalid default value for 'time'
```

# 原因：
```
mysql 5.7的sql_mode有NO_ZERO_IN_DATE,NO_ZERO_DATE，限制了DATE不能为0
```

# 解决：
```
查看sql_mode  select @@sql_mode
修改sql_mode
  当前会话生效 - SET SESSION sql_mode='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'
  全局生效 - SET GLOBAL sql_mode='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'    
```

