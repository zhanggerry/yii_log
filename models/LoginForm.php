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
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
			$params = [':username'=>$this->username];
			$rc = Yii::$app->db->createCommand('SELECT * FROM `r_admin` WHERE username=:username', $params)->queryOne();
			if(!empty($rc)){
				$check_password = $rc['password'];
				$this->password = md5($this->password.$rc['salt']);
				
				if($check_password == $this->password){				
					//更新数据
					$id = Yii::$app->db->createCommand()->update('r_admin',['lastlogin'=>time(), 'lastip'=>$_SERVER['REMOTE_ADDR']], 'id = '.$rc['id'])->execute();
					if(!empty($id)){
						return true;
					}
				}
			}
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
