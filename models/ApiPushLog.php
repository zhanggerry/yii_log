<?php

namespace app\models;

class ApiPushLog extends \yii\db\ActiveRecord
{
 
	public static function tableName(){
		return "{{%api_push_log}}";
	}

}
