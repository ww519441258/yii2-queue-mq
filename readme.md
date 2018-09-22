## About

这个项目是使用 [yii2-queue](https://github.com/yiisoft/yii2-queue) 做的轻量级MQ,仅仅用于测试说明,主要功能是用队列发送邮件.

## 使用

1. 安装扩展

```
vagrant@homestead:~/code/yii2-queue-mq$ composer install
```

2. 初始化

```shell
vagrant@homestead:~/code/yii2-queue-mq$ php init
```

3. 修改配置

修改 `common\config\main-local.php` 中DB,Redis,Queue,Mailer 中的配置

4. 数据迁移

使用下列命令生成数据库并生成测试数据,生成后注意修改 `{{%user}}` 表中生成数据的 `email` 字段为自己的可测试邮箱.

```shell
vagrant@homestead:~/code/yii2-queue-mq$ php yii migrate/up
```

### 测试运行

- 启动测试脚本,像队列中添加EmailJob

```shell
vagrant@homestead:~/code/yii2-queue-mq$ php yii mq
```

- 每隔一秒查询下Job的状态

```shell
vagrant@homestead:~/code/yii2-queue-mq$ php yii mq/status 1
```

- 查看队列当前信息

```shell
vagrant@homestead:~/code/yii2-queue-mq$ php yii queue/info
```

- 开始执行队列,并注意队列中Job的执行状态

```shell
vagrant@homestead:~/code/yii2-queue-mq$ php yii queue/run --verbose --isolate --color
```

### 测试结果

![](http://qiniu.blog.lerzen.com/o_1co10nro6elp1rrs1ropsom3bl7.gif)
```

## 运行结果

![](https://qiniu.blog.lerzen.com/75ef3010-bd84-11e8-a59d-6d4df176b9c8.gif)