<?php

namespace backend\controllers;

use Yii;
use app\models\cms;
use app\models\Admin;
use yii\filters\AccessControl;
use app\models\searchcms;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CmsController implements the CRUD actions for cms model.
 */
class CmsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'index', 'delete', 'view', 'multipledelete'],
                        'allow' => true,
                    ],
                    
                ],
                
            ],
            
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get', 'post', 'delete'],
                    'multipledelete' => ['post','get'],
                ],
            ],
        ];
    }

     
          
    /**
     * Lists all cms models.
     * @return mixed
     */
    public function actionIndex()
    {
        
   if(!isset(Yii::$app->user->id) )
                 {
                   return $this->redirect(['/site/login']);     
		 }
         /*$modelcms = new cms();
         $model = $modelcms->search();
		//$model->unsetAttributes();  
		
		if (isset($_GET['cms']))
		    $model->attributes = $_GET['cms'];
	
		$this->render('index', [
		    'model' => $model,
		]); */
                 
                   $model = new cms();
         if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model = new cms(); //reset model
        }
        
        $searchModel = new searchcms();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'model' => $model,
        ]);
    }

    /**
     * Displays a single cms model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!isset(Yii::$app->user->id) )
                 {
                   return $this->redirect(['/site/login']);     
		 }
                 
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new cms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!isset(Yii::$app->user->id) )
                 {
                   return $this->redirect(['/site/login']);     
		 }
                 
        $model = new cms();
        $modelAdmin = Admin::findOne(Yii::$app->user->id);
        
        $model->createdBy = $modelAdmin->user_title;
        $model->modifiedDate =  date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('create', true);
                 return   $this->redirect(['index']);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing cms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!isset(Yii::$app->user->id) )
                 {
                   return $this->redirect(['/site/login']);     
		 }
                 
        $model = $this->findModel($id);
         $modelAdmin = Admin::findOne(Yii::$app->user->id);
        
        $model->updatedBy = $modelAdmin->user_title;
        $model->modifiedDate =  date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
                Yii::$app->session->setFlash('update', true);
                 return   $this->redirect(['cms/index']);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing cms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!isset(Yii::$app->user->id) )
                 {
                   return $this->redirect(['/site/login']);     
		 }
                 
            $this->findModel($id)->delete();
           Yii::$app->session->setFlash('deletecms', true);
        return $this->redirect(['index']);
    }
    
    /**
	   * Change discontinued Status
	   */ 
	public function actionMultipledelete()
	{
           
           
		 // $model = new Cms();
                 if(count($_POST['id']) > 0)
                 {
                  foreach($_POST['id'] as $id)
                 {
                      $model=$this->findModel($id);
                      $model->delete();
                      
                      
                  }
                  
                 }
                 return "Deleted";
                  
		
	
	}
        

    /**
     * Finds the cms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return cms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = cms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
