<?php
namespace app\commands;
 
use Yii;
use yii\console\Controller;
 
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
 
        // Create roles
        $admin  = $auth->createRole('admin');

        // запишем их в БД
        $auth->add($admin);
 
        // Create simple viewAdminPage permissions
        $viewAdminPage  = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
 
        // Add permission-per-role in Yii::$app->authManager
        // admin
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1); 
    }
}