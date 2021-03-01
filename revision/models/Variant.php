<?php

namespace app\modules\revision\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class Variant extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%variant}}';
    }

    public function rules()
    {  return [  
            ['product_id','trim'],
            ['variant_id','trim'],
            ['price', 'trim'],
            ['inventory', 'trim'],
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(),['product_id'=>'product_id']);
    }
}
?>