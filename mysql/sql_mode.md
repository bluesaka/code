# 1. NO_ZERO_IN_DATE  NO_ZERO_DATE

## 问题：
```
mysql 5.6 导出表结构到 mysql 5.7
time timestamp/datetime not null default '0000-00-00 00:00:00'
报错：Invalid default value for 'time'
```

## 原因：
```
mysql 5.7的sql_mode有NO_ZERO_IN_DATE,NO_ZERO_DATE，限制了DATE不能为0
```

## 解决：
```
查看sql_mode：  select @@sql_mode
修改sql_mode：
会话SET SESSION sql_mode='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'
全局SET GLOBAL sql_mode='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'    
```

# 2. STRICT_TRANS_TABLES

## 问题：
```
insert into test(`score`) values ('80%');
报错：Data truncated for column 'score' at row 1

insert into test(`score`) values (2147483648);
报错：Out of range value for column 'score' at row 1

sql_mode有STRICT_TRANS_TABLES时，InnoDB表，字符串类型不能转换成int float decimal等其他类型，超出int范围2147483647会报错
```

## 原因：
```
sql_mode中有STRICT_TRANS_TABLES或STRICT_ALL_TABLES
```

## 解决：
```
修改sql_mode：
SET GLOBAL sql_mode='ONLY_FULL_GROUP_BY,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'
```

