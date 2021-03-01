<?php

use yii\db\Migration;
use frontend\modules\revision\components\CheckTb;
/**
 * Handles the creation of table `{{%variant}}`.
 */
class m210227_061834_create_variant_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if(CheckTb::tableexists('{{%variant}}'))
        {
            $this->createTable('{{%variant}}', [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'variant_id' => $this->integer()->notNull()->unique(),
                'price'=> $this->money(),
                'inventory'=> $this->integer()
            ]);
            $this->addForeignkey('fk-variant-product_id','variant','product_id','product','product_id','CASCADE','CASCADE');
        }
        else
        {
            echo "Table Exists";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if(CheckTb::tableexists('{{%variant}}')){
            echo "Table does not Exists";
        }
        else
        {
            $this->dropTable('{{%variant}}');            
        }
    }
}
