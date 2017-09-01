<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Admin extends Model
{
	/**
     * 上传文件
     */
    public $file;
	
	/**
     * 文本标题
     */
	 public $title;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'file'], 'required'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    

   
}
