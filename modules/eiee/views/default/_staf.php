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
                    Научная работа преподавателя
                ', ['academic/index', 'section' => 'science'], ['class' => 'list-group-item']) ?>
                <?= Html::a('
                    Личные достижения преподавателя
                ', ['academic/index', 'section' => 'personal'], ['class' => 'list-group-item']) ?>  
                <?= Html::a('
                    Публикации преподавателя
                ', ['academic/index', 'section' => 'publication'], ['class' => 'list-group-item']) ?>                             
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <?= Html::a('
                    Повышение квалификации преподавателя
                ', ['academic/index', 'section' => 'professional'], ['class' => 'list-group-item']) ?>     
                <?= Html::a('
                    Учебно-методическая работа преподавателя
                ', ['academic/index', 'section' => 'educational'], ['class' => 'list-group-item']) ?>                              
            </ul>
        </div>          
        <div class="col-sm-4">
            <ul class="list-group">
                <?= Html::a('
                    Контактные данные
                ', ['/eiee/profile/index'], ['class' => 'list-group-item']) ?>               
            </ul>
        </div>
    </div>
</div>