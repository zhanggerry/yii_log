<?php

namespace app\models;

class ApiAcceptLog extends \yii\db\ActiveRecord
{
 
	public static function tableName(){
		return "{{%api_accept_log}}";
	}

}
