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
		        'id',
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
		        	'buttons' =>[
		        				'delete' => function ($model, $key, $index) {
		        					
		        							$tag="<a href='#' class='glyphicon glyphicon-trash bin', id='$index' data-id='$index', data-toggle='modal' data-target='#alert'></a>";

										          return $tag;
										      }

		        	]
		        ],
		    ]
		]);
?>
<?//= $this->render('_search', ['model' => $searchModel]) ?>

<!-- Modal -->
<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are You Sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="autoclick" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="delconfirm">
  yes
</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="confirmmsg" placeholder="yes/no">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-primary" id="proceeddel">Delete</a>
      </div>
    </div>
  </div>
</div>

<?php
$js= "

$('.bin').click(function(){
	let id=event.target.id;
	let href='delete?id='+id;
	$('#proceeddel').attr('href',href);
});

$('#delconfirm').click(function(){
	$('#autoclick').click();
	$('#proceeddel').hide();
	$('#confirmmsg').val('');		
	});
	
$('#confirmmsg').keyup(function(){
 	let msg=$('#confirmmsg').val();
 	if(msg=='yes' || msg=='YES')
 	{
		$('#proceeddel').show();
 	}
 	else $('#proceeddel').hide();
});

";
$this->registerJs($js);

?>