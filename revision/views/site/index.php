<?php
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;
?>
<div>
	<span>Total Products: <?=$count?></span>
	<span><a href='refresh' class='btn btn-primary btn-sm'>Refresh</a></span>
</div>
<?
$form = ActiveForm::begin(['action'=>'bulkaction']); ?>
 <div class="form-group">
    <?= Html::submitButton('Export', ['class' => 'btn btn-primary', 'name' => 'export']) ?>
</div>
<?php
ActiveForm::end(); 
echo GridView::widget([
		    'dataProvider' => $dataProvider,
		    'filterModel' => $searchModel,
		    //'emptyCell'=>'aman',
		     'columns' => [
		     	[
		            'class' => 'yii\grid\CheckboxColumn',
		            'cssClass'=>'aman',
		            'name'=>'select',
		            
		        ],
		        'product_id',
		        [
		        	'attribute'=>'product.DisplayTitle',
		        	'format'=>'text',
		        	'label'=>'Title',
		        ],
		         'variant_id',
				[
		        	'attribute'=>'price',
		        	'value'=>function($searchModel){
		        		$max=$searchModel->find()->max('price');
		        		$min=$searchModel->find()->min('price');
		        		return $min.' - '.$max;
		        		//return $data->price;
		        	},
		        	'filter'=>$this->render('_search', ['model' => $searchModel])
		        ],
    			[
		        	'attribute'=>'inventory',
		        	'value'=>function($data){

		        		return $data->inventory;
		        	},
		        	//'filter'=>$this->render('_search', ['model' => $searchModel])
		        ],
    			[
    				'header'=>'Action',
		        	'class' => 'yii\grid\ActionColumn',
		        	'template' => '{update} {delete}',


		        ],
		    ]
		]);

?>
<?//= $this->render('_search', ['model' => $searchModel]) ?>