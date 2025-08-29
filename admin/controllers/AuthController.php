<?php

namespace admin\controllers;

use App\Application\Command\UserSignInCommand;
use App\Application\Service\AuthService;
use App\Infrastructure\Auth\Identity;
use App\Presentation\Admin\Form\UserAuthForm;
use Yii;

class AuthController extends \yii\web\Controller
{
    public $layout = 'blank';

    private readonly AuthService $authService;

    public function __construct($id, $module, AuthService $authService, $config = [])
    {
        $this->authService = $authService;
        parent::__construct($id, $module, $config);
    }

    public function actionSignIn()
    {
        $form = new UserAuthForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $command = new UserSignInCommand($form->email, $form->password);
                $user = $this->authService->signIn($command);
                Yii::$app->user->login(new Identity($user), $form->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->redirect(['site/index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->addFlash('error', $e->getMessage());
            }
        }
        if ($form->hasErrors()) {
            foreach ($form->getErrors() as $attribute => $errors) {
                foreach ($errors as $errorMessage) {
                    Yii::$app->session->addFlash('error', $errorMessage);
                }
            }
        }

        return $this->render('sign-in', ['form' => $form]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
