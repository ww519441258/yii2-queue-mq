<?php

use yii\db\Migration;

/**
 * Class m180922_130005_insert_test_users
 */
class m180922_130005_insert_test_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = \Faker\Factory::create();
        $this->insert('{{%user}}',
            [
                'username' => $faker->userName,
                'email' => $faker->email,
                'status' => 10,
                'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
                'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('password_'.random_bytes(10)),
                'password_reset_token' => Yii::$app->getSecurity()->generateRandomString(),
                'created_at' => $faker->time(),
                'updated_at' => $faker->time()
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180922_130005_insert_test_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180922_130005_insert_test_users cannot be reverted.\n";

        return false;
    }
    */
}
