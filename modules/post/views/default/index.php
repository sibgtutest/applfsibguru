<?php
use yii\helpers\Html;
?>

<h2>Заголовки страниц</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск по заголовкам.." title="Type in a name">

<ul id="myUL">
<?php foreach($permissions as $key => $perm){ ?>
    <li>
    <?php echo Html::a(
        $perm->description, 
        ['/post/post/index/'.$perm->name], 
        ['class' => 'btn btn-link ']
    ); ?>
    </li>
<?php } ?>
</ul>