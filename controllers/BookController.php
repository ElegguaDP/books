<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update', 'index', 'view', 'delete'],
                'rules' => [
                    // deny all POST requests
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->with('author')
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Book();
        $time = time();
        $model->date_create = date('Y-m-d H:i:s', $time);
        $authorData = Author::find()->all();
        $authorsList = [];
        foreach ($authorData as $author) {
            $authorsList[$author->id] = $author->firstname . ' ' . $author->lastname;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->preview = UploadedFile::getInstance($model, 'preview')) {
                $path = Yii::$app->basePath . Yii::$app->params['uploadPath'] . $model->preview;
                $model->preview->saveAs($path);
                $model->preview = Yii::$app->params['uploadPath'] . $model->preview;
                ;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'authors' => $authorsList
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $time = time();
        $model->date_update = date('Y-m-d H:i:s', $time);
        $authorData = Author::find()->all();
        $authorsList = [];
        foreach ($authorData as $author) {
            $authorsList[$author->id] = $author->firstname . ' ' . $author->lastname;
        }
        $currentImage = $model->preview;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->preview = UploadedFile::getInstance($model, 'preview')) {
                if ($currentImage) {
                    unlink(Yii::$app->basePath . $currentImage);
                }
                $path = Yii::$app->basePath . Yii::$app->params['uploadPath'] . $model->preview;
                $model->preview->saveAs($path);
                $model->preview = Yii::$app->params['uploadPath'] . $model->preview;
            }
            if (!$model->preview) {
                $model->preview = $currentImage;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'authors' => $authorsList
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $book = $this->findModel($id);
        if ($book->preview) {
            unlink(Yii::$app->basePath . $book->preview);
        }
        $book->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Book::find()->where(['id' => $id])->with('author')->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
