<?php

namespace app\modules\revision;
use yii\base\Module;

class Revision extends \yii\base\Module
{
	public $defaultRoute='site';
    public function init()
    {
        parent::init();
        /*if (Yii::$app instanceof \yii\console\Application) {
	        $this->controllerNamespace = 'app\modules\revision\commands';
	    }*/
    }
}