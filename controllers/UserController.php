<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignUpForm;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }


        return $this->render('login', compact('model'));
    }

    public function actionSignup()
    {

        $model = new SignUpForm();

        if ($model->load(Yii::$app->request->post()) && $user = $model->save()) {
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success', 'Регистрация и авторизация прошла успешно');
            return $this->goHome();
        }

        return $this->render('signup', compact('model'));
    }

    public function actionLogout ()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
