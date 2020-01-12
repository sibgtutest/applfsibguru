<?php

// file 'NavBar.php'
$config = [
    [
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ],
];

return $config;

?>