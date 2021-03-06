# 连接数据库

```sql
mysql -h 127.0.0.1 -P 3306 -u root -pxxx （密码紧跟-p, 或者密码不写，回车后再写，可以避免某些特殊字符被过滤）
```

# ssh通道连接数据库
```
1. 通道直连
  a. mysql连接配置相应的ssh通道即可
  D:\work\putty\plink.exe -ssh <ssh_user>@<ssh_host> -pw "<password>" -P <ssh_port> -N -L <local_port>:<db_host>:<db_port>
    
2. ssh本地端口转发
  a. ssh -o ServerAliveInterval=600 -fNg -p <ssh_port> -L<local_port>:<db_host>:<db_port> <ssh_user>@<ssh_host>  本地端口连接ssh通道
  b. 新建mysql连接 localhost:<local_port> <db_user> <db_password>  此连接无需设置ssh通道，用户密码用远程服务器的
  c. mysql命令行连接 mysql -h 127.0.0.1 -P <local_port> -u <db_user> -p<db_password>
```

# order by

```
* order by field:    select * from table order by field(id, 2,3,1,5,4);
* order by varchar:    1. select * from table order by time+0;  //+0转换成int类型
                       2. select * from table order by CAST(xx2 AS DECIMAL) | CONVERT(xx2, DECIMAL);  // CAST, CONVERT 转换类型
```

# order by 排序随机问题
```
order by排序是不稳定的
select id from xx where status = 1 order by weight desc limit 0, 20
加上id排序确保排序一致
select id from xx where status = 1 order by weight desc, id desc limit 0, 20
```

# in 索引命中问题
```
explain select id from xx where id in (1, '2')  --> 无法命中id索引
explain select id from xx where id in (1, 2)  --> 可以命中id索引
explain select id from xx where id in ('1', '2')  --> 可以命中id索引
```

# group by

```
group by a,b
* 查找重复记录: select count(id) cnt, a, b from table group by a, b having cnt > 1;
```

# 分组取前n条 select top n by group

```
1. 大数据量推荐union，效率高，可读性强
    (select * from t where level = 1 order by score desc limit 2)
    union all  --- (union有去重的动作, union all没有)
    (select * from t where level = 2 order by score desc limit 2);

2. 数据量小，子查询
select * from t as a where
(select count(*) from t as b on b.level = a.level and b.score > a.score) < 2
order by level
```

# find_in_set

```
select * from table find_in_set(2, type);
```
# EXISTS

```
// sid相同，create_time不同，取create_time最后一条
1. SELECT id, sid FROM table_name a WHERE NOT EXISTS (SELECT 1 FROM table_name where a.sid = sid AND a.create_time < create_time);
2. SELECT id, sid FROM table_name WHERE id IN (SELECT max(id) FROM table_name group by sid);
3. SELECT id, sid, max(create_time), count(*) FROM table_name group by sid
```

# insert多个

```
insert into `t` (`name`) values
('name1'),
('name2'),
('name3');
```

# replace into & on duplicate key update

```
记录存在则更新，不存在则插入

区别:
    - duplicate保留了所有字段的旧值，再覆盖一起insert，
    - replace直接删除旧值，再insert新值
    - 效率replace略高，但replace的时候，字段一定要写全，防止老数据被删除。

用法:
// id主键，若存在id=1则更新，不存在则插入，此情况AUTO_INCREMENT不影响
insert into t3(id,name) VALUES (1,'kk') on duplicate key update name = VALUES(name);
replace into t3(id,name) VALUES (1,'kk');

// unique key `uk_name_class` (`name`, `class`),  (name, class)是组合唯一索引，此情况AUTO_INCREMENT +1
insert into t2(name,class,count) values('test', 1, 3) on duplicate key update count = VALUES(count);
replace into t2(name,class,count) values('test', 1, 3);

// multi
# unique key(uuid)
insert into t (uuid, name) VALUES
(1, 'aa'),
(2, 'bb'),
(4, 'c')
on DUPLICATE key update name = VALUES(name);

replace into t select * from t_temp;
```

# if

```

SELECT
    id, IF(gender = 0, 'Male', 'Female') AS sex
FROM Student;
```

# case

```
SELECT
    id,
    CASE gender
WHEN 0 then '男'
WHEN 1 then '女'
END AS sex
FROM Student
```

# datetime, timestamp

```
`operate_time` datetime/timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间'
```

# MySQL 到 PHP 数据类型的转换关系
```
    MySQL	                                                  PHP
FLOAT, DOUBLE	                                            double(float)
INTEGER, INT, SMALLINT, TINYINT, MEDIUMINT	              int
DECIMAL, NUMERIC	                                        string
BIGINT (在操作系统int范围内是int，超过范围后是string)	       int | string
other	                                                    string

设置此参数,解决mysql数据取出时,int/float类型变成string类型的问题
MYSQLI_OPT_INT_AND_FLOAT_NATIVE = true
```
