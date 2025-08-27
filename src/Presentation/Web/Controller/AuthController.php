<?php

namespace App\Presentation\Web\Controller;

class AuthController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'blank'
            ],
        ];
    }

    public function actionSignIn()
    {
        return $this->render('sign-in');
    }
}
