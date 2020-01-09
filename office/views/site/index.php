<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>
<input class="form-control" id="myInput1" type="text" placeholder="Найти страницу">
<ul id="myList1">
<?php foreach($permissions as $key => $perm){ ?>
    <li>
    <?php echo Html::a(
        $perm->description, 
        ['post/index', 'section' => $perm->name], 
        ['class' => 'btn btn-link ']
    ); ?> 
    </li>
<?php } ?>