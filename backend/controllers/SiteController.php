<?php
namespace backend\controllers;

use app\models\Apple;
use app\models\EatForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'apple', 'eat', 'fall', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionApple(){
        return $this->render('apple');
    }

    public function actionEat($id){
        $apple = Apple::findOne($id);
        $model = new EatForm();
        if ($apple->checkRotten())
            $this->redirect('/backend/web/index.php?r=site/apple');

        if ( $model->load(Yii::$app->request->post()) && $model->validate() === true) {
            $apple->eat($model->eating_amount);
            $this->redirect('/backend/web/index.php?r=site/apple');
        } else {
            return $this->render('eat', [
                'apple' => $apple,
                'model' => $model,
            ]);
        }

    }

    public function actionFall($id){
        $apple = Apple::findOne($id);
        $apple->fallToGround();
        $apple->save();
        $this->redirect('/backend/web/index.php?r=site/apple');
    }

    public function actionCreate(){
        $apple = new Apple();
        if ($apple->load(Yii::$app->request->post()) && $apple->save()) {
            $this->redirect('/backend/web/index.php?r=site/apple');
        } else {
            return $this->render('create', [
                'apple' => $apple
            ]);
        }
    }
}
