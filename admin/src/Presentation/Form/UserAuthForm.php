<?php

namespace App\Presentation\Admin\Form;

use yii\base\Model;

class UserAuthForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string', 'max' => 255],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Password',
            'rememberMe' => 'Remember Me',
        ];
    }
}
