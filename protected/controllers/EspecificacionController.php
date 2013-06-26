<?php

class EspecificacionController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        $accessRules = new AccessDataRol();
        return $accessRules->getAccessRules("especificacion");
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Especificacion;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Especificacion'])) {
            $model->attributes = $_POST['Especificacion'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_especificacion));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Especificacion'])) {
            $model->attributes = $_POST['Especificacion'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_especificacion));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Especificacion');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Especificacion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Especificacion']))
            $model->attributes = $_GET['Especificacion'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Especificacion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Especificacion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Especificacion $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'especificacion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actiongetEspecificationList(){
        $manageM = new ManageModel;
        $marca = $_GET['marca'];
        $tipoEquipo =$_GET['tipoEquipo'];

        $marca = Marca::model()->find("n_nombreMarca=:marca",array(":marca"=>$marca));
        $tipoEquipo = Tipoequipo::model()->find("n_tipoEquipo=:tipoEquipo",array(":tipoEquipo"=>$tipoEquipo));
        $especificaciones = Especificacion::model()->findAll("k_idMarca=:marca AND k_idTipoEquipo=:tipoEquipo", 
                                                            array(":marca"=>$marca->k_idMarca,":tipoEquipo"=>$tipoEquipo->k_idTipo));

        $listEspecificaciones = $manageM->getColumnList($especificaciones,'n_nombreEspecificacion');       
        var_dump($listEspecificaciones);
        echo CJSON::encode($listEspecificaciones);
    }

}
