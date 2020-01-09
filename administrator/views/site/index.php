<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Общие сведения';

?>

<div class="row">
    <div class="col-sm-4">
        <input class="form-control" id="myInput1" type="text" placeholder="Список студентов">
        <ul id="myList1">
        <?php foreach ($studs as $stud): ?>
            <li>
                <?= Html::encode("{$stud->username} - {$stud->email}") ?>
            </li>
        <?php endforeach; ?>
        </ul>        
    </div>
    <div class="col-sm-8">
        <input class="form-control" id="myInput4" type="text" placeholder="Список администраторов">
        <ul id="myList4">
        <?php foreach ($amdins as $amdin): ?>
            <li>
                <?= Html::encode("{$amdin->username} - {$stud->email}") ?>
            </li>
        <?php endforeach; ?>
        </ul>
        <input class="form-control" id="myInput2" type="text" placeholder="Список преподавателей">
        <ul id="myList2">
        <?php foreach ($stafs as $staf): ?>
            <li>
                <?= Html::encode("{$staf->username} - {$staf->email}") ?>
            </li>
        <?php endforeach; ?>
        </ul>
        <input class="form-control" id="myInput3" type="text" placeholder="Список разрешений">       
        <ul id="myList3">
            <?php foreach ($permissions as $keys => $values){ ?>
            <?php foreach ($values as $key => $value){ ?>
                <?php foreach ($value as $key1 => $value1){ ?>
                <li>
                    <?= Html::encode("{$key} - {$value1->description}({$value1->name})") ?>
                </li>
            <?php };};} ?>
        </ul>
    </div>
</div>