<?php
use yii\helpers\Html;
?>
<div class="rbac-default-index">
    <h1>DbManager</h1><p>использует четыре таблицы для хранения данных:</p>
    <ul>
        <li><?= Html::a('itemTable', ['item/index']) ?>: таблица для хранения авторизационных элементов. По умолчанию "auth_item".
        <li><?= Html::a('itemChildTable', ['child/index']) ?>: таблица для хранения иерархии элементов. По умолчанию "auth_item_child".
        <li><?= Html::a('assignmentTable', ['assignment/index']) ?>: таблица для хранения назначений элементов авторизации. По умолчанию "auth_assignment".
        <li><?= Html::a('ruleTable', ['rule/index']) ?>: таблица для хранения правил. По умолчанию "auth_rule".
    </ul>
</div>