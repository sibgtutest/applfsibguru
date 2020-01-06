<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // добавляем разрешение "createPost"
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // добавляем разрешение "updatePost"
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // добавляем разрешение "Section"
        $permissionSection = $auth->createPermission('Section');
        $permissionSection->description = 'Section';
        $auth->add($permissionSection);   
        // добавляем разрешение "Section3"
        $permissionSection3 = $auth->createPermission('Section3');
        $permissionSection3->description = 'заголовок секции 3';
        $auth->add($permissionSection3);               

        // добавляем роль "author" и даём роли разрешение "createPost"
        $author = $auth->createRole('author');
        $auth->add($author);
        //$auth->addChild($author, $createPost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author" 
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $permissionSection);
        $auth->addChild($admin, $permissionSection3);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);

        // добавляем роль "stud"
        $stud = $auth->createRole('stud');
        $auth->add($stud);

        // добавляем роли "admin" разрешение "stud"
        $auth->addChild($admin, $stud);
        $auth->assign($stud, 4);

        // добавляем разрешение "farid"
        //$farid = $auth->createPermission('farid');
        //$farid->description = 'farid';
        //$auth->add($farid);

        // добавляем роли "stud" разрешение "farid"
        //$auth->addChild($stud, $farid);
        //$auth->assign($farid, 2);

        //$auth->assign($stud, 2);

        $staf = $auth->createRole('staf');
        $auth->add($staf);
        $auth->assign($staf, 2);

        //$farid = $auth->createPermission('farid');
        //$auth->addChild($staf, $farid);
    }

}