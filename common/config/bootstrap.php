<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@wechat', dirname(dirname(__DIR__)) . '/wechat');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/storage');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@root', dirname(dirname(__DIR__)) . '/');
Yii::setAlias('@addons', dirname(dirname(__DIR__)) . '/addons');
Yii::setAlias('@attachment', dirname(dirname(__DIR__)) . '/web/attachment');
Yii::setAlias('@attachurl', '/attachment');
// 各自应用域名配置，如果没有配置应用独立域名请忽略
Yii::setAlias('@backendUrl', '');
Yii::setAlias('@frontendUrl', '');
Yii::setAlias('@wechatUrl', '');
Yii::setAlias('@apiUrl', '');