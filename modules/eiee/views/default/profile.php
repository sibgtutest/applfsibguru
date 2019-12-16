<?php

/* @var $this yii\web\View */

$this->title = $this->context->action->uniqueId;

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
                <a href="/eiee/academic/index" class="list-group-item">
                    Учебная работа студента
                </a>
                <a href="/eiee/paper/index" class="list-group-item">
                    Статьи студента
                </a>                
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <a href="/eiee/scientific/index" class="list-group-item">
                    Научные достижения студента
                </a>
                <a href="/eiee/public/index" class="list-group-item">
                    Общественные достижения студента
                </a>
                <a href="/eiee/sport/index" class="list-group-item">
                    Спортивные достижения студента
                </a>                                
            </ul>
        </div>          
        <div class="col-sm-4">
            <ul class="list-group">
                <a href="/eiee/profile/index" class="list-group-item">
                    Контактные данные
                </a>
                <a href="/eiee/plan/index" class="list-group-item">
                    Учебный план
                </a>                
            </ul>
        </div>
    </div>
</div>
