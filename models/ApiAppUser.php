<?php

namespace app\models;

class ApiAppUser extends \yii\db\ActiveRecord
{
 
	public static function tableName(){
		return "{{%api_app_user}}";
	}

}
