<?php

use yii\helpers\Html;

?>

<div class="eiee-default-index">
    <h1>Электронная информационно-образовательная среда</h1>
<div class="row">
  <div class="col-sm-6">
    <ul class="list-group">
        <a href="http://lfsibgu.ru/sveden/education/#docs" class="list-group-item">
        Доступ к учебным планам, 
        аннотациям рабочих программам дисциплин (модулей), 
        рабочим программам практик
        </a>
        <a href="http://www.lfsibgu.ru/elektronnyj-katalog" class="list-group-item">
        Доступ к изданиям электронных библиотечных систем и 
        электронным образовательным ресурсам, указанным в рабочих программах
        </a>  
        <?= Html::a('
          Взаимодействие между участниками образовательного процесса
        ', ['/chat/default/index'], ['class' => 'list-group-item']) ?>
    </ul>
  </div>
  <div class="col-sm-6">
    <ul class="list-group">
        <a href="http://www.lfsibgu.ru/studentu/kontrolnaya-nedelya" class="list-group-item">
          Фиксация хода образовательного процесса
        </a>
        <?= Html::a('
          Результаты промежуточной аттестации 
          и результаты освоения программы бакалавриата
        ', ['/eiee/default/index'], ['class' => 'list-group-item']) ?>
        <?= Html::a('
          Электронное портфолио обучающегося, 
          в том числе сохраненные работы обучающегося, 
          рецензии и оценки на эти работы 
          со стороны любых участников образовательного процесса
        ', ['/eiee/default/profile1'], ['class' => 'list-group-item']) ?>
    </ul>
  </div>
</div>

  <a href="http://lfsibgu.ru/images/IT/rukovodstvo.pdf" class="list-group-item">
Руководство пользователя ЭИОС
  </a>
</div>