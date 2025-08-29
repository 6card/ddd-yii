<?php

/** @var \yii\web\View $this */

use yii\web\HttpException;

/** @var string $message */
/** @var string $name */
/** @var \Throwable|null $exception */

$exceptionCode =  $exception instanceof HttpException ? $exception->statusCode : $exception->getCode();

?>
<style type="text/css">
    h1.header.error {
        font-size: 5rem;
    }
    h2.header.error {
        font-size: 3rem;
    }

</style>

<h1 class="ui teal header error"><?= $exceptionCode ?></h1>
<h2 class="ui teal header error"><?= $message ?></h2>
