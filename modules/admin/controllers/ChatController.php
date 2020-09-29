<?php


namespace app\modules\admin\controllers;


use yii\filters\AccessControl;

class ChatController extends AdminBaseController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin']
                    ]
                ]
            ]
        ];
    }


    public function actionIndex()
    {

        return $this->render('index');
    }

}