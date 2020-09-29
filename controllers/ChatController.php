<?php


namespace app\controllers;


use app\models\Chat;
use app\models\User;
use Yii;
use yii\web\Response;

class ChatController extends AppController
{

    public $enableCsrfValidation = false;

    const MESSAGE_IS_CORRECT = 1;
    const MESSAGE_IS_NOT_CORRECT = 0;
    const MESSAGE_IS_ADMIN = 1;

    public function actionAddMessage()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $username = Yii::$app->request->post('username');
        $text = Yii::$app->request->post('text');

        $user = User::findByUsername($username);
        $userId = $user->getId();

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT * FROM auth_assignment WHERE user_id =" . $userId);
        $result = $command->queryAll();

        if(count($result) > 0) {
            $chat = new Chat([
                'text' => $text,
                'username' => $username,
                'is_admin' => self::MESSAGE_IS_ADMIN
            ]);
        } else {
            $chat = new Chat([
                'text' => $text,
                'username' => $username
            ]);
        }

        $chat->save();

        return [
            'success' => true
        ];

    }


    public function actionGetChat()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Chat::find()
            ->where([
                'is_correct' => self::MESSAGE_IS_CORRECT
            ])
            ->orderBy([
                'id' => SORT_DESC
            ])
            ->all();
    }

    public function actionReportMessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $messageId = Yii::$app->request->post('message-id');

        Yii::$app->db->createCommand()->update('chat', ['is_correct' => 0], 'id =' . $messageId)->execute();

        return [
            $messageId
        ];
    }

    public function actionRestoreMessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $messageId = Yii::$app->request->post('message-id');

        Yii::$app->db->createCommand()->update('chat', ['is_correct' => 1], 'id =' . $messageId)->execute();

        return [
            $messageId
        ];
    }


    public function actionGetChatForAdminPage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Chat::find()
            ->orderBy([
                'id' => SORT_DESC
            ])
            ->all();
    }

    public function actionGetNotCorrectMessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Chat::find()
            ->where([
                'is_correct' => self::MESSAGE_IS_NOT_CORRECT
            ])
            ->orderBy([
                'id' => SORT_DESC
            ])
            ->all();
    }

}