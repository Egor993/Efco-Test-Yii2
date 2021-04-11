<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\Signup;
use app\models\Login;
use app\models\Data;
use app\models\Change;
use app\models\Add;
use app\models\Approve;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        //Получаем данные таблицы и текущего пользователя
        $dataList = Data::find()->all();
        $user = $_SESSION['user'];
        $role = Users::findOne(['login'=>$user])->role;
        // Если нажата кнопка 'утвердить' -> утверждаем отпуск по его id (ajax)
        if(Yii::$app->request->post('approve')) {
            $id = Yii::$app->request->post('approve');
            $vac_model = new Approve();
            $vac_model->fixed = 'true';
            $vac_model->ApproveVac($id);
        }
        return $this->render('index', compact('dataList','user', 'role'));
    }

    public function actionSignup()
    {
        $model = new Signup();
        if(Yii::$app->request->post('Signup')){
            $model->attributes = Yii::$app->request->post('Signup');
            if($model->validate() and $model->signup()) {
                $_SESSION['user'] = $model->login;
                $this->goHome();
            }
        }
        return $this->render('singup', compact('model'));
    }

    public function actionLogin() {

        $login_model = new Login();
        if(Yii::$app->request->post('Login')){
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate()) {
                $_SESSION['user'] = $login_model->login;
                $this->goHome();
            }
        }

        return $this->render('login', compact('login_model'));

    }

    public function actionLogout()
    {
        unset($_SESSION['user']);

        return $this->goHome();
    }

    public function actionAdd() {
        //Заполняем данные отпуска из формы если пользователь авторизирован
        if(isset($_SESSION['user'])){
            $user = Users::findOne(['login'=>$_SESSION['user']]);
            $vac_model = new Add();
            if(Yii::$app->request->post("Add")){
                $vac_model->start = Yii::$app->request->post('Add')['start'];
                $vac_model->end = Yii::$app->request->post('Add')['end'];
                $vac_model->user_name = $user->login;
                $vac_model->fio = $user->fio;
                if($user->role != 'employer') {
                    $vac_model->post = 'Сотрудник';
                }
                else {
                    $vac_model->post = 'Руководитель';
                }
                if($vac_model->validate()){
                    $vac_model->AddVac($_SESSION['user']);
                    $this->goHome();
                }
            }
            return $this->render('add', compact('vac_model'));
        }
        else {
            return Yii::$app->response->redirect(['site/login']);
        }
    }

    public function actionChange() {

        $id = Yii::$app->request->get('id');
        //Берем данные нужного отпуска, чтобы потом подставить в input
        $vac = Data::findOne(['id'=>$id]);
        //Изменяем данные отпуска из формы если login пользователя совпадает с user_name поля таблицы и отпуск не был утвержден
        if ($vac->user_name == $_SESSION['user'] and ($vac->fixed != 'true')){
            $vac_model = new Change();
            if(Yii::$app->request->post("Change")){
                $vac_model->start = Yii::$app->request->post('Change')['start'];
                $vac_model->end = Yii::$app->request->post('Change')['end'];
                if($vac_model->validate()){
                    $vac_model->ChangeVac($id);
                    $this->goHome();
                }
            }

            return $this->render('change', compact('vac_model', 'vac'));
        }
        else {
            return Yii::$app->response->redirect(['site/error']);
        }
    }

}
