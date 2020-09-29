<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m200929_055649_create_rbac_data
 */
class m200929_055649_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);


        $user = new User([
            'email' => 'admin@admin.com',
            'username' => 'Admin',
            'password_hash' => '$2y$13$veg09QZHSnWoxDPQMEyjeO0On2SvSMuhypEtogZJ9ueowzuF1hkUu'
        ]);

        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->created_at = time();
        $user->save();

        $auth->assign($adminRole, $user->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200929_055649_create_rbac_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200929_055649_create_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
