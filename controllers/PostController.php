<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 19.09.2016
 * Time: 15:00
 */

namespace app\controllers;
use app\models\User;
use app\models\Comment;
use Yii;
use app\models\Post;
use yii\data\Pagination;
use app\models\SigningForm;
use app\models\CommentForm;
use app\models\LoginForm;
use yii\helpers\url;

class PostController extends AppController {

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex (){

        $query = Post::find()->select('id,title,content,image_path,view,comment')->
        asArray()->orderBy('id DESC');

        $pages = new Pagination([
            'totalCount' => $query->count()
            , 'pageSize' => PER_PAGE
            ,'pageSizeParam' => false
            ,'forcePageParam' => false
        ]);
        $posts = $query->
        offset($pages->offset)->
        limit($pages->limit)->
        all();
        return $this->render('index',compact('posts','pages'));
    }

    public function actionView($id,$page,$step=1) {
        $post =Post::find()->where(['id' => $id])->
                with('comments')->one();
        if ( empty($post) ) throw new \yii\web\HttpException(404,
            'This page is absent.');
        if ( $step == 1 ) $post->view++;
        $post->save();
        foreach ($post->comments as $key => $comment ){
            $user = User::findOne($comment->user_id);
            $post->comments[$key]['user_id'] = $user->login;// change user_id by login
        }
        return $this->render('view',compact('post','page'));
    }

    public function actionTest ($password='qwerty'){
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        $bool = Yii::$app->getSecurity()->validatePassword($password,$hash);
        return $this->render('test',compact('hash','password','bool'));
    }

    public function actionHello (){
        return $this->render('hello');
    }

    public function actionSigning()
    {

        $model = new SigningForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user =  New User();
            $user->first_name = $model->firstname;
            $user->last_name = $model->lastname;
            $user->login = $model->login;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $user->role_id = 0;
            $user->save();
            $identity = User::findOne(['login' => $user->login]);
            Yii::$app->user->login($identity);
            return $this->redirect(['index']);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('signing', ['model' => $model]);
        }
    }
    public  function actionClass (){

        return $this->render('class',['class' => User::className()]);
    }

    public function actionComment($id,$page)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('SignLogin', 'To leave a comment, sign or login, please.');
            return $this->redirect( Url::to(['post/view','id' => $id, 'page' => $page, 'step' => 0]));
        }
        $model = new CommentForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $comment = New Comment();
            $comment->comment = $model->comment;
            $comment->article_id = $id;
            $comment->user_id = Yii::$app->user->identity->id;
            $comment->save();
            $post = Post::findOne($id);
            $post->comment++;
            $post->save();
            return $this->redirect( Url::to(['post/view','id' => $id, 'page' => $page, 'step' => 0 ]));
        }else{
            // either the page is initially displayed or there is some validation error
            return $this->render('comment', ['model' => $model]);
        }
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

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
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
}