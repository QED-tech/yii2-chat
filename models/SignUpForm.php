<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\log\Logger;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignUpForm extends Model
{
    public $username;
    public $password;
    public $email;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['username'], 'unique', 'targetClass' => User::class, 'message' => 'Пользователь уже существует'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['email'], 'unique', 'targetClass' => User::class, 'message' => 'Такой E-mail уже занят'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6]
        ];


    }


    public function save()
    {
        if ($this->validate()) {
            $user = new User();
            $user->email = $this->email;
            $user->username = $this->username;
            $user->created_at = time();
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);


            if ($user->save()) {
                return $user;
            }
        }

    }
}
