<?php

namespace app\modules\revision\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function rules()
    {  return [  
            ['product_id','trim'],
            ['title','trim'],
            ['created_at', 'trim'],
        ];
    }

    public function getDisplayTitle()
    {
        return $this->title;
    }
}
?>