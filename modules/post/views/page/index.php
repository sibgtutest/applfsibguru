<?php
use yii\helpers\Html;
?>
<?php
    foreach ($query as $value){
        if ($value['key_post'] == 'Заголовок' && $value['status'] == 0) {
            echo '<h1>' . $value['value_post'] . '</h1>';
        };
        if ($value['key_post'] == 'Абзац' && $value['status'] == 0) {
            echo '<p>' . $value['value_post'] . '</p>';
        };
    }
?>