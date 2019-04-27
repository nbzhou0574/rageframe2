<?php

use yii\db\Migration;

class m190218_025043_member_address extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%member_address}}', [
            'id' => 'int(10) NOT NULL AUTO_INCREMENT COMMENT \'主键\'',
            'member_id' => 'int(11) unsigned NULL COMMENT \'用户id\'',
            'provinces' => 'int(10) unsigned NULL COMMENT \'省id\'',
            'city' => 'int(10) unsigned NULL COMMENT \'市id\'',
            'area' => 'int(10) unsigned NULL COMMENT \'区id\'',
            'address_name' => 'varchar(200) NULL DEFAULT \'\' COMMENT \'地址\'',
            'address_details' => 'varchar(200) NULL DEFAULT \'\' COMMENT \'详细地址\'',
            'is_default' => 'tinyint(2) unsigned NULL DEFAULT \'0\' COMMENT \'默认地址\'',
            'zip_code' => 'int(10) unsigned NULL COMMENT \'邮编\'',
            'realname' => 'varchar(100) NULL DEFAULT \'\' COMMENT \'真实姓名\'',
            'home_phone' => 'varchar(20) NULL DEFAULT \'\' COMMENT \'家庭号码\'',
            'mobile' => 'varchar(20) NULL DEFAULT \'\' COMMENT \'手机号码\'',
            'status' => 'tinyint(4) NOT NULL DEFAULT \'1\' COMMENT \'状态(-1:已删除,0:禁用,1:正常)\'',
            'created_at' => 'int(10) unsigned NULL COMMENT \'创建时间\'',
            'updated_at' => 'int(10) unsigned NULL COMMENT \'修改时间\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户_收货地址表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%member_address}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

