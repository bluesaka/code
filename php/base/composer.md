# composer
composer是PHP5.3以上的一个依赖管理工具

# composer安装

```
// 全局安装
curl -sS https://install.phpcomposer.com/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

# composer.json

```json
"name": "test-composer-json",
"description": "this composer.json is just for test",
"keywords": ["test", "composer"],
"licence": "MIT",
"type": "project",
"require": {
    "php": ">= 5.6.4",
    "laravel/framework": "5.3.*",
    "monolog/monolog": "~1.21"
},
"require-dev":{ // for development
    "phpunit/phpunit": "~5.0",
    "mockery/mockery": "0.9.*"
},
"repositories": {
    "packagist": {
        "type": "composer",
        "url": "https://packagist.phpcomposer.com"
    }
},
"autoload": {
    "classmap": ["test-dir"], //扫描指定目录下以.php或.inc结尾的文件中的class，生成class到指定file path的映射，并加入新生成的 vendor/composer/autoload_classmap.php
    "files": [  // common, helper functions
        "common/functions.php",
        "config/config.php"
    ],
    "psr-4": {
        "App\\": "app/"
    }
},
"autoload-dev": { // for development
    "classmap": [
        "tests/TestCase.php"
    ],
    "psr-4": {
        "App\\Tests\\": "tests/"
    }
},
"config": {
    "preferred-install": "dist",
    "sort-packages": true
}

```

# 加速

* composer config -g repo.packagist composer "https://packagist.phpcomposer.com"
* --prefer-dist
* 编辑composer.json

```json
"repositories": {
    "packagist": {
        "type": "composer",
        "url": "https://packagist.phpcomposer.com"
    }
}
```