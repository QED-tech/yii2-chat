<?php


namespace app\models;


use yii\db\ActiveRecord;

class Chat extends ActiveRecord
{


    public static function tableName()
    {
        return 'chat';
    }


    public function rules()
    {
        return [
            ['username', 'safe'],
            ['text', 'safe']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'text' => 'Text',
            'created_at' => 'Created At',
        ];
    }

}