<?php

use yii\db\Migration;
use frontend\modules\revision\components\CheckTb;
/**
 * Handles the creation of table `{{%product}}`.
 */
class m210227_050954_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if(CheckTb::tableexists('{{%product}}'))
        {
            $this->createTable('{{%product}}', [
                'id' => $this->primaryKey(),
                'product_id'=> $this->integer()->notNull()->unique(),
                'title' => $this->text(),
                'created_at' => $this->dateTime()
            ]);
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
        if(CheckTb::tableexists('{{%product}}')){
            echo "Table does not Exists";
        }
        else
        {
            $this->dropTable('{{%product}}');
        }    
    }
}
