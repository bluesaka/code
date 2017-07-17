# PHP扩展开发

```
工具：
    gcc  c语言编译器
    make 自动构建工具
    autoconf  检测系统环境及编译参数
```

## 1. 下载php源码，生成扩展模块

```
cd path/to/ext
./ext_skel --extname=test
```

## 2. 修改config.m4, 生成autoconf文件

```
去除相关dnl注释
```

## 3. phpize 生成 configure脚本
## 4. 执行 configure 生成 MakeFile
## 5. make 编译
## 6. make install 安装

--------------------------------------

# test extension

## config.m4

```
PHP_ARG_ENABLE(test, whether to enable test support,
[  --enable-test           Enable test support])
```

## php_test.h

```
PHP_FUNCTION(adam_test);
```

## test.c

```
PHP_FUNCTION(adam_test)
{
	long a;
	long b;
	char *c;
	int c_len;
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lls", &a, &b, &c, &c_len) != SUCCESS) {
		return;
	}

	char *str;
	int len = spprintf(&str, 0, "%s : %d\n", c, a * b);
	RETURN_STRINGL(str, len, 0);
}

const zend_function_entry test_functions[] = {
	//PHP_FE(confirm_test_compiled,	NULL)		/* For testing, remove later. */
	PHP_FE(adam_test, NULL)
	PHP_FE_END	/* Must be the last line in test_functions[] */
};
```

## php

```
php --rf "adam_test" // Function [ <internal:test> function adam_test ]
php -r "echo adam_test(11, 22, "11x22");" // 11x22: 242
```
