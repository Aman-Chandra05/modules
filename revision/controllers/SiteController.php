<?php
namespace app\modules\revision\controllers;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\modules\revision\models\Product;
use app\modules\revision\models\Variant;
use app\modules\revision\models\VariantSearch;
use yii\caching\Cache;
use Yii;


class SiteController extends Controller
{
    public function actionIndex()
    {
    	$model = new VariantSearch();
  		$count = Yii::$app->Cache->get('count');

        if ($count === false) {
            $count =$model->find()->count();
            \Yii::$app->Cache->set('count', $count);
        }
        /*$data=Yii::$app->request->get();
        echo "<pre>";
        print_r($data);
        die;*/

		$searchModel = new VariantSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->get());

		return $this->render('index',[
			'dataProvider'=>$dataProvider,
			'searchModel' => $searchModel,
			'count' =>$count
		]);
    }

    public function actionRefresh()
    {
        Yii::$app->Cache->flush();
        return $this->redirect('index');
    }

    public function actionUpdate($id)
    {
        $model = new Variant();
        $data=$model->findOne($id);
        if ($data->load(Yii::$app->request->post())) 
        {
            if($data->save())
            {     
                Yii::$app->session->setFlash('success', 'Record Updated in database');
                return $this->redirect(['index']);        
            }
        }
        return $this->render('update', [
            'model' => $data,
        ]);
    }

    public function actionDelete($id)
    {
        $model = new Variant();
        $data=$model->findOne($id);
        if($data->delete())
        {
            Yii::$app->session->setFlash('success', 'Record Deleted from database');
        }
        return $this->redirect('index');
    }
    public function actionBulkaction()
    {

		$data=(Yii::$app->request->post('select'));
		echo"<pre>";
		print_r($data);
		echo "</pre>";
    }
}
