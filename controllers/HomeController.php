<?php


namespace app\controllers;


use Yii;

class HomeController extends AppController
{

    public function actionIndex()
    {


        return $this->render('index');
    }


    public function actionError()
    {

        Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->render('error/error');
    }
}