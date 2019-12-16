<?php
use yii\helpers\Html;
?>
<div class="rbac-default-index">
    <div class="row">
        <div class="col-sm-6">
            <h1>DbManager</h1>
            <p>использует четыре таблицы для хранения данных:</p>
            <ul>
                <li><?= Html::a('itemTable', ['item/index']) ?>: таблица для хранения авторизационных элементов. По умолчанию "auth_item".
                <li><?= Html::a('itemChildTable', ['child/index']) ?>: таблица для хранения иерархии элементов. По умолчанию "auth_item_child".
                <li><?= Html::a('assignmentTable', ['assignment/index']) ?>: таблица для хранения назначений элементов авторизации. По умолчанию "auth_assignment".
                <li><?= Html::a('ruleTable', ['rule/index']) ?>: таблица для хранения правил. По умолчанию "auth_rule".
            </ul>
        </div>
        <div class="col-sm-6">
            <img src="/img/yii2-rbac-table.png" alt="Lights" style="width:100%">
        </div>
    </div>
</div>
