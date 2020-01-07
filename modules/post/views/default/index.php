<?php
    use yii\helpers\Html;
?>
<div class="container">
    <h2>Страницы</h2>
    <p>Щелкните заголовки, чтобы отсортировать таблицу.</p>
    <p>Введите что-нибудь в поле ввода для поиска в таблице:</p>  
    <input class="form-control" id="myInput" type="text" placeholder="Поиск..">
    <br/>
    <table class="table table-bordered table-striped" id="myTable2">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Новый</th>
                <th onclick="sortTable(1)">Заголовок страницы</th>
                <th onclick="sortTable(2)">Изменен</th>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php foreach($permissions as $key => $perm){ ?>
            <tr>
                <td></td>
                <td>
                    <?php echo Html::a(
                        $perm->description, 
                        ['/post/post/index/'.$perm->name], 
                        ['class' => 'btn btn-link ']
                    ); ?>
                </td>
                <td></td>
            </tr>    
        <?php } ?>
        </tbody>
    </table>
    <p>Обратите внимание, что мы начинаем поиск в tbody, чтобы предотвратить фильтрацию headers таблиц.</p>
</div>