<?php
namespace app\modules\revision\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\modules\revision\models\Variant;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

/**
 * 
 */
class VariantSearch extends Variant
{
    public $from;
    public $to;
    public function rules()
    {  return [  
            ['product_id','trim'],
            ['variant_id','trim'],
            ['price', 'trim'],
            ['inventory', 'trim'],
            ['product.DisplayTitle','trim'],
            ['from','trim'],
            ['to','trim']
        ];
    }

    public function attributes()
    {
        //$arr=['product.DisplayTitle','trim','from','to'];
        return array_merge(parent::attributes(),['product.DisplayTitle']);
    }

    public function search($params)
    {
        /*echo "<pre>";
        print_r($params);
        echo "</pre>";
        die;*/
        $query = VariantSearch::find()->joinWith('product');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere(['variant.product_id' => $this->product_id]);
        $query->andFilterWhere(['=', 'product.title', $this->getAttribute('product.DisplayTitle')])
              ->andFilterWhere(['=', 'variant_id', $this->variant_id])
              ->andFilterWhere(['between','price', $this->from, $this->to])
              ->andFilterWhere(['=', 'inventory', $this->inventory]);
        return $dataProvider;
    }

}