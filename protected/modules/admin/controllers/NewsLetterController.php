<?php

class NewsLetterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index','view','create','update', 'newsletter'),
				'expression'=>'Yii::app()->user->role == "SuperAdmin"',
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function actionNewsletter()
        {
            $model=new NewsLetter;

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='news-letter-newsletter-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['NewsLetter']))
            {
                $model->attributes=$_POST['NewsLetter'];
                $model->user_id=Yii::app()->user->id;
                if($model->validate())
                {
                    $temp=array('New Users ( < 1 Week )'=> 7, 'New Users ( < 1 Month )'=>30, 'New Users ( < 3 Months )'=>90);
                    $model->save();
                    if($model->send_to=='All')
                    {
                         $users=NewsLetterUsers::model()->findAll();
                         if(isset($users))
                         foreach($users as $u)
                             mail($u->email,$model->subject,$model->message);
                       Yii::app()->user->setFlash('users', "Successfully sent your newsletter to ".$model->send_to); 
                       
                    }
                    else if($model->send_to == 'New Users ( < 1 Week )' || $model->send_to == 'New Users ( < 1 Month )' || $model->send_to == 'New Users ( < 3 Months )' )
                    {
                        $users=NewsLetterUsers::model()->findAll('joined between date_sub(now(),INTERVAL '.$temp[$model->send_to].' DAY) and now();');
                        if(isset($users))
                        foreach($users as $u)
                             mail($u->email,$model->subject,$model->message);
                       Yii::app()->user->setFlash('users', "Successfully sent your newsletter to ".$model->send_to); 
                    }

                   $this->refresh();
                }
            }
            $this->render('newsletter',array('model'=>$model));
        }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new NewsLetterUsers;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NewsLetterUsers']))
		{
			$model->attributes=$_POST['NewsLetterUsers'];
                        $model->joined=date('Y-m-d');
			if($model->save())
				$this->redirect(array('view','id'=>$model->news_letter_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NewsLetterUsers']))
		{
			$model->attributes=$_POST['NewsLetterUsers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->news_letter_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('NewsLetterUsers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NewsLetterUsers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NewsLetterUsers']))
			$model->attributes=$_GET['NewsLetterUsers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NewsLetter the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=NewsLetterUsers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NewsLetter $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-letter-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
