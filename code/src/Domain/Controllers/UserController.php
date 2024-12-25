<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Domain\Models\User;

class UserController extends AbstractController {

    protected array $actionsPermissions = [
        'actionHash' => ['admin', 'some'],
        'actionSave' => ['admin']
    ];

    public function actionIndex(): string {
        $users = User::getAllUsersFromStorage();
        
        $render = new Render();

        if(!$users){
            return $render->renderPage(
                'user-empty.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        }
        else{
            return $render->renderPage(
                'user-index.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    public function actionIndexRefresh(){
        $limit = null;
        
        if(isset($_POST['maxId']) && ($_POST['maxId'] > 0)){
            $limit = $_POST['maxId'];
        }

        $users = User::getAllUsersFromStorage($limit);
        $usersData = [];
        
        /*
        $render = new Render();
 
        if(!$users){
            return $render->renderPartial(
                'user-empty.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        }
        else{
            return $render->renderPartial(
                'user-index.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
        */

        if(count($users) > 0) {
            foreach($users as $user){
                $usersData[] = $user->getUserDataAsArray();
            }
        }

        return json_encode($usersData);
    }

    public function actionSave(): string {
        if(User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();

            return $render->renderPage(
                'user-created.tpl', 
                [
                    'title' => 'Пользователь создан',
                    'message' => "Создан пользователь " . $user->getUserName() . " " . $user->getUserLastName()
                ]);
        }
        else {
            throw new \Exception("Переданные данные некорректны");
        }
    }

    public function actionEdit(): string {
        $render = new Render();
        
        return $render->renderPageWithForm(
                'user-form.tpl', 
                [
                    'title' => 'Форма создания пользователя'
                ]);
    }

    public function actionAuth(): string {
        $render = new Render();
        
        return $render->renderPageWithForm(
                'user-auth.tpl', 
                [
                    'title' => 'Форма логина'
                ]);
    }

    public function actionHash(): string {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionLogin(): string {
        $result = false;

        if(isset($_POST['login']) && isset($_POST['password'])){
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }
        
        if(!$result){
            $render = new Render();

            return $render->renderPageWithForm(
                'user-auth.tpl', 
                [
                    'title' => 'Форма логина',
                    'auth-success' => false,
                    'auth-error' => 'Неверные логин или пароль'
                ]);
        }
        else{
            header('Location: /');
            return "";
        }
    }

    public function actionDelete(): string {
        if (!isset($_POST['id'])) {
            http_response_code(400);
            return json_encode(['error' => 'Не указан ID пользователя']);
        }
    
        $userId = (int)$_POST['id'];
    
        $sql = "DELETE FROM users WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $userId]);
    
        return json_encode(['success' => true]);
    }
    
    public function actionEdit(): string {
        if (!isset($_GET['id'])) {
            throw new \Exception("Не указан ID пользователя");
        }
    
        $userId = (int)$_GET['id'];
    
        $sql = "SELECT * FROM users WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $userId]);
        $user = $handler->fetch();
    
        if (!$user) {
            throw new \Exception("Пользователь не найден");
        }
    
        $render = new Render();
    
        return $render->renderPageWithForm('user-form.tpl', [
            'title' => 'Редактирование пользователя',
            'user' => $user
        ]);
    }
    
    public function actionUpdate(): string {
        if (!User::validateRequestData()) {
            throw new \Exception("Переданные данные некорректны");
        }
    
        $userId = (int)$_POST['id'];
        $user = new User();
        $user->setParamsFromRequestData();
    
        $sql = "UPDATE users SET user_name = :user_name, user_lastname = :user_lastname, user_birthday_timestamp = :user_birthday, login = :user_login, password_hash = :user_password WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'id' => $userId,
            'user_name' => $user->getUserName(),
            'user_lastname' => $user->getUserLastName(),
            'user_birthday' => $user->getUserBirthday(),
            'user_login' => $user->getUserLogin(),
            'user_password' => $user->getUserPassword()
        ]);
    
        $render = new Render();
        return $render->renderPage('user-created.tpl', [
            'title' => 'Пользователь обновлен',
            'message' => "Данные пользователя обновлены"
        ]);
    }
    
}