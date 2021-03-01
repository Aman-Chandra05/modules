<?php

namespace frontend\modules\revision\components;
use yii\db\Schema;
use Yii;
/**
 * 
 */
class CheckTb{
	
	public static function tableexists($name)
	{
		if(Yii::$app->db->getTableSchema($name, true) === null)
		{
			return true;
		}else{
			return false;
		}
	}

	public static function cc($table,$fields,$name){
		$fl=count($fields);
		$check=0;
		$var= Yii::$app->db->getTableSchema($table);
		// $primary=$var->primaryKey;
		$frn=$var->foreignKeys;
		foreach ($frn as $key => $value) {
			$check=0;
			if($key==$name)
			{
				return true;
			}
			for($i=0;$i<$fl;$i++)
			{
				if(isset($value[$fields[$i]]))
				{
					$check++;
				}
			}
		}
		if($check==$fl)
		{
			return true;
		}
		else
		{
			$ind=Yii::$app->db->schema->findUniqueIndexes($var);
			$check=0;
			foreach ($ind as $key => $value) {
				$check=0;
				if($key==$name)
				{
					return true;
				}
				for($i=0;$i<$fl;$i++)
				{
					for ($j=0; $j <count($value) ; $j++) { 
						if($fields[$i]==$value[$j]){
							$check++;
						}		
					}
				}
			}
			if($check==$fl)
			{
				return true;
			}
		}
		return false;
	}

	


	public static function columnexists($col,$table)
	{
		$var=Yii::$app->db->getTableSchema($table, true);
		if (isset($var->columns[$col])) 
		{
		    return true;
		}
		else
		{
			return false;
		}
	}

	public static function colwithtype($col,$type,$table)
	{
		$var=Yii::$app->db->getTableSchema($table, true);
			if($var->columns[$col]->type===$type)
				return true;
			else return false;
	}
}
?>