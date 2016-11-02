<?php

namespace app\controllers;

use Yii;
use app\models\Gaceta;
use app\models\GacetaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * GacetaController implements the CRUD actions for Gaceta model.
 */
class GacetaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Gaceta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GacetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gaceta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Gaceta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gaceta();

        if ($model->load(Yii::$app->request->post()) ) {

            //get the instance of the uploaded file
            $filename = $model->numero;
            $model->file= UploadedFile::getinstance($model,'file');
            $model->file->saveAs('uploads/'.$filename.'.'.$model->file->extension );
            //save the path in the db column
            $model->ruta='uploads/'.$filename.'.'.$model->file->extension;

            //$model->save();

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                return $this->render('create', [
                  'model' => $model,
                ]);
                exit;
            }

            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gaceta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gaceta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gaceta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gaceta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gaceta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /* metodos para descargar el archivo */

    private function downloadFile($dir, $file, $extensions=[])
 {
  //Si el directorio existe
  if (is_dir($dir))
  {
  


   //Ruta absoluta del archivo
   $path = $dir.$file;
    echo("<script>console.log('Variable ".$path."');</script>");   
   //Si el archivo existe
   if (is_file($path))
   {
    //Obtener información del archivo
    $file_info = pathinfo($path);
    //Obtener la extensión del archivo
    $extension = $file_info["extension"];
    
    if (is_array($extensions))
    {
     //Si el argumento $extensions es un array
     //Comprobar las extensiones permitidas
     foreach($extensions as $e)
     {
      //Si la extension es correcta
      if ($e === $extension)
      {
           echo("<script>console.log('Extension ".$e."');</script>"); 
       //Procedemos a descargar el archivo
       // Definir headers
       $size = filesize($path);
       header("Content-Type: application/force-download");
       header("Content-Disposition: attachment; filename=$file");
       header("Content-Transfer-Encoding: binary");
       header("Content-Length: " . $size);
       // Descargar archivo
       readfile($path);
       //Correcto
       return true;
      }
     }
    }
    
   }
  }
  //Ha ocurrido un error al descargar el archivo
  return false;
 }
 
 public function actionDownload()
 {

  if (Yii::$app->request->get("file"))
  {

   //Si el archivo no se ha podido descargar
   //downloadFile($dir, $file, $extensions=[])
   
   if (!$this->downloadFile("uploads/", Html::encode($_GET["file"]), ["pdf", "txt", "doc"]))
   {
    //Mensaje flash para mostrar el error
    Yii::$app->session->setFlash("errordownload");
   }
  }
  
  return $this->render("download");
 }
}
