<?php

namespace App\Presentation\Web\Controller;

class AuthController extends \yii\web\Controller
{
    public $layout = 'blank';

    public function actionSignIn()
    {
        return $this->render('sign-in');
    }
}
