<?php

use yii\helpers\Html;

?>
<div>
    <h3>
        Электронное портфолио обучающегося, 
        в том числе сохраненные работы обучающегося, 
        рецензии и оценки на эти работы со стороны любых участников образовательного процесса
    </h3>
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-group">
                <?= Html::a('
                    Учебная работа студента
                ', ['academic/index', 'section' => 'academic'], ['class' => 'list-group-item']) ?>
                <?= Html::a('
                    Статьи студента 
                ', ['academic/index', 'section' => 'paper'], ['class' => 'list-group-item']) ?>             
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <?= Html::a('
                    Научные достижения студента 
                ', ['academic/index', 'section' => 'scientific'], ['class' => 'list-group-item']) ?>     
                <?= Html::a('
                    Общественные достижения студента 
                ', ['academic/index', 'section' => 'public'], ['class' => 'list-group-item']) ?>  
                <?= Html::a('
                    Спортивные достижения студента 
                ', ['academic/index', 'section' => 'sport'], ['class' => 'list-group-item']) ?>                              
            </ul>
        </div>          
        <div class="col-sm-4">
            <ul class="list-group">
                <?= Html::a('
                    Контактные данные
                ', ['/eiee/profile/index'], ['class' => 'list-group-item']) ?>  
                <a href="http://lfsibgu.ru/sveden/education/#docs" class="list-group-item">
                    Учебный план
                </a>                
            </ul>
        </div>
    </div>
</div>