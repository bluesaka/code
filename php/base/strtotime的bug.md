# -1 month, +1 month问题
```
echo date('Y-m-d', strtotime('-1 month', strtotime('2018-07-31'))); // 输出2018-07-01
echo date('Y-m-d', strtotime('+1 month', strtotime('2018-08-31'))); // 输出2018-10-01

date内部逻辑：
1. 先处理-1 month，07-31  ->  06-31
2. 日期规范化  06-31  ->   07-01  
   date('Y-m-d', strtotime(2018-06-31'))  ->  2018-07-01
   
解决方案：
1. php5.3+
echo date('Y-m-d', strtotime('last day of -1 month', strtotime('2018-07-31')));
echo date('Y-m-d', strtotime('first day of +1 month', strtotime('2018-08-31')));

2. php5.3之前，使用mktime
```
转载自鸟哥 http://www.laruence.com/2018/07/31/3207.html
